<x-app-layout>
    <x-slot name="header"></x-slot>
    
    <!-- Create Task and Create Group Buttons -->
    <div class="position-fixed start-0 top-50 translate-middle-y d-flex flex-column gap-2 ms-5">
        <a href="{{ route('tasks.create') }}" class="btn btn-outline-dark">Create Task</a>
        <a href="{{ route('groups.create') }}" class="btn btn-outline-dark">Create Group</a>
        <a href="{{ route('todo.create')}}" class="btn btn-outline-dark">TO-DO作成</a>
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
                <div class="row row-cols-auto" style="max-width: 100%;">
                    @php
                        $fromDate = new DateTime($todo->from);
                        $toDate = new DateTime($todo->to);
                        $interval = $fromDate->diff($toDate)->days + 1;
                    @endphp

                    @for ($i = $interval; $i >= 1; $i--)
                        <div class="col border p-3 text-center">
                            <label for="day{{ $i }}" class="form-label">
                                Day {{ $i == 1 ? 0 : $i - 1 }}
                            </label>
                            <div id="pageSetContainer" class="container mt-4">
        <div class="page-set mb-4">
            <h5>既存のページセット</h5>
             <!-- 新しいページセットを追加するボタン -->
        <button onclick="addPageSet()" class="btn btn-outline-primary mb-3">＋ ページセットを追加</button>
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="テキスト名を入力">
            </div>
            <div class="row mb-3">
                <div class="col">
                    <input type="number" id="startPage1" class="form-control" placeholder="開始ページ">
                </div>
                <div class="col">
                    <input type="number" id="endPage1" class="form-control" placeholder="終了ページ">
                </div>
            </div>
            <div class="mb-3">
                <select id="pageOption1" class="form-select">
                    <option value="all">すべてのページ</option>
                    <option value="even">偶数ページ</option>
                    <option value="odd">奇数ページ</option>
                </select>
            </div>
            <button onclick="generatePages(1)" class="btn btn-primary mb-3">ページを生成</button>
            <div id="pageContainer1" class="d-flex flex-wrap gap-2 mt-3"></div>
        </div>

       
    </div>
                        </div>
                    @endfor
                </div>
            </div>
        @endforeach
    </div>

   
    <script>
        let setCount = 1; // 既存セットのカウントから開始

        function addPageSet() {
            setCount++;

            const pageSetDiv = document.createElement('div');
            pageSetDiv.className = 'page-set mb-4';
            pageSetDiv.innerHTML = `
                <h5>ページセット ${setCount}</h5>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="テキスト名を入力">
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="number" id="startPage${setCount}" class="form-control" placeholder="開始ページ">
                    </div>
                    <div class="col">
                        <input type="number" id="endPage${setCount}" class="form-control" placeholder="終了ページ">
                    </div>
                </div>
                <div class="mb-3">
                    <select id="pageOption${setCount}" class="form-select">
                        <option value="all">すべてのページ</option>
                        <option value="even">偶数ページ</option>
                        <option value="odd">奇数ページ</option>
                    </select>
                </div>
                
                <div id="pageContainer${setCount}" class="d-flex flex-wrap gap-2 mt-3"></div>
           
            <button onclick="generatePages(${setCount})" class="btn btn-primary mb-3">ページを生成</button>
             `;
            document.getElementById('pageSetContainer').appendChild(pageSetDiv);
        }

        function generatePages(setId) {
            const startPageInput = document.getElementById(`startPage${setId}`);
            const endPageInput = document.getElementById(`endPage${setId}`);
            const pageOptionSelect = document.getElementById(`pageOption${setId}`);

            if (!startPageInput || !endPageInput || !pageOptionSelect) {
                console.error(`IDが見つかりません: startPage${setId} または endPage${setId} または pageOption${setId}`);
                return;
            }

            const startPage = parseInt(startPageInput.value);
            const endPage = parseInt(endPageInput.value);
            const pageOption = pageOptionSelect.value;

            const pageContainer = document.getElementById(`pageContainer${setId}`);
            pageContainer.innerHTML = '';

            for (let i = startPage; i <= endPage; i++) {
                if (pageOption === 'even' && i % 2 !== 0) continue;
                if (pageOption === 'odd' && i % 2 === 0) continue;

                const pageButton = document.createElement('button');
                pageButton.className = 'btn btn-outline-secondary page-button';
                pageButton.innerText = `Page ${i}`;
                pageButton.onclick = function() {
                    pageButton.classList.toggle('btn-success');
                };
                pageContainer.appendChild(pageButton);
            }
        }
    </script>
</x-app-layout>
