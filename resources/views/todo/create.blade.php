<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>TO-DOリスト</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <h1>TO-DOリスト</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('todo.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" name="title" placeholder="TO-DO"/><br>
            <input type="text" name="description" placeholder="メモ"/><br>
        </div>
        <div class="container">
  <div class="row">
    <div class="col-１２ mt-3">

      <div class="input-daterange input-group" id="datepicker">
        <div class="input-group-prepend">
          <span class="input-group-text">開始日付</span>
        </div>
        <input type="text" class="input-sm form-control" name="from" />
        <div class="input-group-append">
          <span class="input-group-text">終了日付</span>
        </div>
        <input type="text" class="input-sm form-control" name="to" />
      </div>

    </div>
  </div>

</div>
        <button type="submit" class="btn btn-primary" onclick="generateGrid()">作成</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb4FVAAZ2LRR8UQQ1nrV+8F3BlzE1ANdGx6LOhGdiZNd0/l8P" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhG81rKh0W5n0e5ZR2g1Ra1bb1gE0M5wJkFp1MGm7c6twXgAw1pHp+0KS9Km" crossorigin="anonymous"></script>
     <!-- jQuery, popper.js, Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <!-- bootstrap-datepicker -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.ja.min.js"></script>
  
  <script>
      $('.input-daterange').datepicker({
        language:'ja', // 日本語化
        format: 'yyyy/mm/dd', // 日付表示をyyyy/mm/ddにフォーマット
      })
      .on({
        changeDate: function() {
          // datepickerの日付を取得
          console.log('開始日付 :', $('input[name="from"]').val() );  // 開始日付を取得
          console.log('終了日付 :', $('input[name="to"]').val() );    // 終了日付を取得
        }
      });
     
     function generateGrid() {
        const fromDate = new Date(document.getElementById('from_date').value);
        const toDate = new Date(document.getElementById('to_date').value);
        const timeDiff = toDate - fromDate;
        const dayCount = timeDiff / (1000 * 60 * 60 * 24) + 1;

        const gridContainer = document.getElementById('grid-container');
        gridContainer.innerHTML = '';

        for (let i = 1; i <= dayCount; i++) {
            const gridItem = document.createElement('div');
            gridItem.className = 'col border p-3 text-center';
            gridItem.innerText = `Day ${i}`;
            gridContainer.appendChild(gridItem);
        }
    }
    }

    </script>
</body>
</html>
