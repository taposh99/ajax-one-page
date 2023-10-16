<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, Crud!</title>
  </head>
  <body>
      <div class="text-center">
        <h1>Update</h1>
      

      </div>

      <div class="container">
        <form method="POST" action="{{ route('update') }}">
          @csrf
            <input type="text" name="data_id" hidden value="{{ $home->id }}">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Name</label>
              <input type="text" name="name" class="form-control" required value="{{ $home->name }}">
              
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Code</label>
              <input type="text" name="code" class="form-control" required value="{{ $home->code }}">
              
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">user_name</label>
              <input type="text" name="user_name" class="form-control" required value="{{ $home->user_name }}">
              
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">password</label>
              <input type="text" name="password" class="form-control" required value="{{ $home->password }}">
              
            </div>
          
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>

    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
