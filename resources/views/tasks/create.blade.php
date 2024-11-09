<x-app-layout>
    <x-slot name="header"></x-slot>
<body>
   <div class="position-absolute top-0 start-50 translate-middle-x">グループでのタスク作成</div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
   <div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card w-75" style="max-width: 500px;"> 
  <div class="card-header text-center">
    どんな活動をしますか？？
  </div>
 

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
         <div class="card-body">
        <div class="form-group mb-3">
            <input type="text" class ="form-label mb-2" name="title" placeholder="タスク名"/><br>
            <input type="text" class ="form-label mb-2" name="description" placeholder="メモ"/><br>
            <label for="group_id">グループ:</label>
            <select name="group_id" class ="form-label" id="group_id" class="form-control">
                <option value="">選択してください</option>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">作成</button>
    </form>
  </div>
 </div>
</div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb4FVAAZ2LRR8UQQ1nrV+8F3BlzE1ANdGx6LOhGdiZNd0/l8P" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhG81rKh0W5n0e5ZR2g1Ra1bb1gE0M5wJkFp1MGm7c6twXgAw1pHp+0KS9Km" crossorigin="anonymous"></script>
</body>
</x-app-layout>
