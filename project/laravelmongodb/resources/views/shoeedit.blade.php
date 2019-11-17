<!-- shoeedit.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Laravel MongoDB CRUD Tutorial With Example</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
  </head>
  <body>
    <div class="container">
      <h2>Edit A Form</h2><br/>
      <div class="container">
    </div>
      <form method="post" action="{{action('ShoeController@update', $_id)}}">
        @csrf
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="CID">CID:</label>
            <input type="text" class="form-control" name="CID" value="{{$shoe->CID}}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Category">Category:</label>
            <input type="text" class="form-control" name="Category" value="{{$shoe->Category}}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="SubCategory">SubCategory:</label>
            <input type="text" class="form-control" name="SubCategory" value="{{$shoe->SubCategory}}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="HeelHeight">HeelHeight:</label>
            <input type="text" class="form-control" name="HeelHeight" value="{{$shoe->HeelHeight}}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Insole">Insole:</label>
            <input type="text" class="form-control" name="Insole" value="{{$shoe->Insole}}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Closure">Closure:</label>
            <input type="text" class="form-control" name="Closure" value="{{$shoe->Closure}}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Gender">Gender:</label>
            <input type="text" class="form-control" name="Gender" value="{{$shoe->Gender}}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="Material">Material:</label>
            <input type="text" class="form-control" name="Material" value="{{$shoe->Material}}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="ToeStyle">ToeStyle:</label>
            <input type="text" class="form-control" name="ToeStyle" value="{{$shoe->ToeStyle}}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <button type="submit" class="btn btn-success">Update</button>
          </div>
        </div>
      </form>
   </div>
  </body>
</html>