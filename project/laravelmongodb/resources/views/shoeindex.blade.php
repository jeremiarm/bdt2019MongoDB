<!-- shoeindex.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Index Page</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
    <table class="table table-striped">
    <thead>
      <tr>
        <th>_id</th>
        <th>CID</th>
        <th>Category</th>
        <th>SubCategory</th>
        <th>HeelHeight</th>
        <th>Insole</th>
        <th>Closure</th>
        <th>Gender</th>
        <th>Material</th>
        <th>ToeStyle</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($shoes as $shoe)
      <tr>
        <td>{{$shoe->_id}}</td>
        <td>{{$shoe->CID}}</td>
        <td>{{$shoe->Category}}</td>
        <td>{{$shoe->SubCategory}}</td>
        <td>{{$shoe->HeelHeight}}</td>
        <td>{{$shoe->Insole}}</td>
        <td>{{$shoe->Closure}}</td>
        <td>{{$shoe->Gender}}</td>
        <td>{{$shoe->Material}}</td>
        <td>{{$shoe->ToeStyle}}</td>
        <td><a href="{{action('ShoeController@edit', $shoe->_id)}}" class="btn btn-warning">Edit</a></td>
        <td>
          <form action="{{action('ShoeController@destroy', $shoe->_id)}}" method="post">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $shoes->links() }}
  </div>
  </body>
</html>