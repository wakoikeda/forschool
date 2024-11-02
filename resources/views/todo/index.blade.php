<!--<!DOCTYPE html>-->
<!--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">-->
<!--<head>-->
<!--    <meta charset="utf-8">-->
<!--    <title>TO-DOリスト</title>-->
<!--     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->
<!--    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">-->
<!--</head>-->
<!--<body>-->
<!--    <h1>TO-DOリスト</h1>-->

<!--    @if ($errors->any())-->
<!--        <div class="alert alert-danger">-->
<!--            <ul>-->
<!--                @foreach ($errors->all() as $error)-->
<!--                    <li>{{ $error }}</li>-->
<!--                @endforeach-->
<!--            </ul>-->
<!--        </div>-->
<!--    @endif-->
    
<!--    <form action="{{ route('todo.store') }}" method="POST">-->
<!--        @csrf-->
<!--        <div class="form-group">-->
<!--            <input type="text" name="title" placeholder="TO-DO"/><br>-->
<!--            <input type="text" name="description" placeholder="メモ"/><br>-->
<!--        </div>-->
<!--        <div class="container">-->
<!--  <div class="row">-->
<!--    <div class="col-１２ mt-3">-->

<!--      <div class="input-daterange input-group" id="datepicker">-->
<!--        <div class="input-group-prepend">-->
<!--          <span class="input-group-text">開始日付</span>-->
<!--        </div>-->
<!--        <input type="text" class="input-sm form-control" name="from" />-->
<!--        <div class="input-group-append">-->
<!--          <span class="input-group-text">終了日付</span>-->
<!--        </div>-->
<!--        <input type="text" class="input-sm form-control" name="to" />-->
<!--      </div>-->

<!--    </div>-->
<!--  </div>-->

<!--</div>-->
<!--        <button type="submit" class="btn btn-primary">作成</button>-->
<!--    </form>-->
<!--    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb4FVAAZ2LRR8UQQ1nrV+8F3BlzE1ANdGx6LOhGdiZNd0/l8P" crossorigin="anonymous"></script>-->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhG81rKh0W5n0e5ZR2g1Ra1bb1gE0M5wJkFp1MGm7c6twXgAw1pHp+0KS9Km" crossorigin="anonymous"></script>-->
<!--</body>-->
<!--</html>-->
