<x-app-layout>
    <x-slot name="header"></x-slot>

    <!-- Create Task and Create Group Buttons -->
    <div class="position-fixed start-0 top-50 translate-middle-y d-flex flex-column gap-2 ms-5">
        <a href="{{ route('tasks.create') }}" class="btn btn-outline-dark">Create Task</a>
        <a href="{{ route('groups.create') }}" class="btn btn-outline-dark">Create Group</a>
        <a href="{{ route('todo.create') }}" class="btn btn-outline-dark">TO-DO作成</a>
    </div>

    <div class="container mt-4" style="max-width: 60vw;">
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif

        <!-- Tasks by Group Section -->
        @foreach ($tasksByGroup as $groupName => $tasks)
            <div class="task-group my-4">
                <h3 class="task-group-title text-center mb-3">{{ $groupName }}</h3>
                <div class="row">
                    @foreach ($tasks as $task)
                        <div class="col-md-4 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                                    <a href="{{ route('tasks.show', $task->id) }}" class="task-title h5 mb-2 text-decoration-none text-white">{{ $task->title }}</a>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                    <p class="card-text">メモ: {{ $task->description }}</p>
                                    <div class="d-flex justify-content-between">
                                        <form id="form_{{ $task->id }}" action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-outline-danger" onclick="confirmDelete({{ $task->id }});">完了</button>
                                        </form>
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-outline-warning">編集</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <!-- TO-DO List Section -->
        @foreach ($todos as $todo)
            <div class="todo-item mt-5">
                <h2>{{ $todo->title }}</h2>
                <p>{{ $todo->description }}</p>
                <p>開始日: {{ $todo->from }}</p>
                <p>終了日: {{ $todo->to }}</p>

                <!-- グリッド生成 -->
                <div class="row row-cols-3 g-3">
                    @php
                        $fromDate = new DateTime($todo->from);
                        $toDate = new DateTime($todo->to);
                        $interval = $fromDate->diff($toDate)->days + 1;
                    @endphp

                    @for ($i = $interval; $i >= 1; $i--)
                        <div class="col border p-3 text-start day-container rounded shadow-sm bg-light">
                            <label for="day{{ $i }}" class="form-label">
                                Day {{ $i == 1 ? 0 : $i - 1 }}
                            </label>
                            <button onclick="addPageSet(this)" class="btn btn-outline-primary btn-sm mt-2 rounded-pill px-3">＋</button>
                            <div class="page-set-container mt-2"></div>
                        </div>
                    @endfor
                </div>
            </div>
        @endforeach
    </div>

    <script>
        let setCount = 1;

        function addPageSet(button) {
            const pageSetDiv = document.createElement('div');
            pageSetDiv.className = 'page-set mb-2';
            pageSetDiv.innerHTML = `
                <h6>ページセット ${setCount}</h6>
                <input type="text" class="form-control mb-2" placeholder="テキスト名を入力">
                <div class="row mb-2">
                    <div class="col">
                        <input type="number" class="form-control" placeholder="開始ページ">
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" placeholder="終了ページ">
                    </div>
                </div>
                <div class="mb-2">
                    <select class="form-select">
                        <option value="all">すべてのページ</option>
                        <option value="even">偶数ページ</option>
                        <option value="odd">奇数ページ</option>
                    </select>
                </div>
                <button onclick="generatePages(this)" class="btn btn-primary btn-sm mb-2">ページを生成</button>
                <button onclick="removePageSet(this)" class="btn btn-danger btn-sm">削除</button>
                <div class="page-buttons mt-2 d-flex flex-wrap gap-2"></div>
            `;
            setCount++;

            // ボタンの親要素の中にある page-set-container に追加
            button.nextElementSibling.appendChild(pageSetDiv);
        }

        function removePageSet(button) {
            const pageSetDiv = button.closest('.page-set');
            pageSetDiv.remove();
        }

        function generatePages(button) {
            const pageContainer = button.nextElementSibling;
            pageContainer.innerHTML = ''; // 既存のページボタンをクリア

            const startPage = parseInt(button.previousElementSibling.previousElementSibling.children[0].children[0].value);
            const endPage = parseInt(button.previousElementSibling.previousElementSibling.children[1].children[0].value);
            const pageOption = button.previousElementSibling.querySelector('select').value;

            for (let i = startPage; i <= endPage; i++) {
                if (pageOption === 'even' && i % 2 !== 0) continue;
                if (pageOption === 'odd' && i % 2 === 0) continue;

                const pageButton = document.createElement('button');
                pageButton.className = 'btn btn-outline-secondary page-button btn-sm';
                pageButton.innerText = `Page ${i}`;
                pageButton.onclick = function() {
                    pageButton.classList.toggle('btn-success');
                };
                pageContainer.appendChild(pageButton);
            }
        }
    </script>
</x-app-layout>
