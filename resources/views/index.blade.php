<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>small poject</title>
</head>


<body>
    <div class="text-center">
        <h1>User Profile!</h1>

    </div>
    <span id="output"></span>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <div class="container">
    <form id="my-form">
       
        <div class="row">
            <div class="col">
                <label for="code" class="form-label">Code</label>
                <input type="text" name="code" class="form-control" placeholder="Code">

                <label for="Name" class="form-label">Name list</label>
                <input type="text" name="name" class="form-control" placeholder="Name">

                <label for="dob" class="form-label">Date of birth</label>
                <input type="date" name="dob" id="dob" class="form-control" placeholder="Date of birth" onchange="calculateAge()">

                <label for="age" class="form-label">Age list</label>
                <input type="text" name="age" id="age" class="form-control" placeholder="Age" readonly>
            </div>
            <div class="col">
                <label for="area" class="form-label">Sex</label>
                <select name="sex" id="sex" class="form-control">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>

                <label for="o_number" class="form-label">User Name</label>
                <input type="text" name="user_name" class="form-control" placeholder="user_name">

                <label for="password" class="form-label">Password</label>
                <input type="text" name="password" class="form-control" placeholder="password">

                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-end">
           
            <button type="submit" id="btnSubmit" class="btn btn-primary">Add</button>

        </div>
    </form>
</div>
    <div class="container">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Code</th>
          <th scope="col">Name</th>
         
          <th scope="col">Age</th>
          <th scope="col">Sex</th>
          <th scope="col">user name</th>
          <!-- <th scope="col"> Image</th> -->
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @php $i=1 @endphp
        @foreach ($homes as $data)

        <tr>

          <td>{{ $data->code }}</td>
          <td>{{ $data->name }}</td>
          <td>{{ $data->age }} </td>
          <td>{{ $data->sex }} </td>
          <td>{{ $data->user_name }} </td>
          <!-- <td><img src="{{ asset('storage/' . $data->image) }}" alt="User Image"></td> -->
        


          <td>
            <div class="btn-group">
              <a href="{{ route('edit', $data->id) }}">
                <button class="btn btn-md btn-success me-1 p-1"><i class="fas fa-edit"></i></button>
              </a>

              <form action="{{ route('delete') }}" method="POST" onsubmit="return confirm('Are you sure?')">
                @method('DELETE')
                @csrf
                <input type="hidden" name="data_id" value="{{ $data->id }}">
                <button class="btn btn-md btn-danger p-1"><i class="fas fa-trash-alt"></i></button>
              </form>
            </div>
          </td>

        </tr>

        @endforeach

      </tbody>
    </table>
  </div>


<!-- age script -->
<script>
function calculateAge() {
    const dobElement = document.getElementById("dob");
    const ageElement = document.getElementById("age");

    if (dobElement.value) {
        const dob = new Date(dobElement.value);
        const today = new Date();

        const years = today.getFullYear() - dob.getFullYear();
        const months = today.getMonth() - dob.getMonth();
        const days = today.getDate() - dob.getDate();

        if (days < 0) {
            const prevMonthLastDay = new Date(today.getFullYear(), today.getMonth(), 0).getDate();
            days += prevMonthLastDay;
            months--;
        }
        if (months < 0) {
            months += 12;
            years--;
        }

        ageElement.value = years + " years, " + months + " months, " + days + " days";
    } else {
        ageElement.value = ""; 
    }
}
</script>

    


<script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
            }
        })
    </script>
<script>
    $(document).ready(function() {
        $("#my-form").on("submit", function(e) {
            e.preventDefault();
            var form = $("#my-form")[0];
            var data = new FormData(form);

            // Disable the submit button while the AJAX request is in progress
            $("#btnSubmit").prop("disabled", true);

            // Send the AJAX request
            $.ajax({
                type: "POST",
                url: "{{ route('storeData') }}", // Replace with your server-side endpoint
                data: data,
                processData: false,
                contentType: false,
                success: function(data) {
                
                    // Handle the response from the server
                    $("#output").text(data.message);
                    setTimeout(function() {
                        $("#output").text("");
                        }, 2000);

                    $("#btnSubmit").prop("disabled", false); // Re-enable the submit button
                    form.reset();
                    $('table').load(location.href+' .table');
                    
                },
                error: function(e) {
                    // Handle the error
                    $("#output").text(data.responseText);
                    $("#btnSubmit").prop("disabled", false); // Re-enable the submit button
                }
            });
        });
    });
</script>

<script>
$(document).ready(function () {
    // When the Save button is clicked
    $("#saveButton").click(function (e) {
        e.preventDefault(); // Prevent the default form submission behavior

        // Serialize the form data
        var formData = new FormData($("#dataForm")[0]);

        // Send an AJAX request to store the data
        $.ajax({
            url: "{{ route('storeData') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // Handle the response here (e.g., display a success message)
                console.log(response);
            },
            error: function (error) {
                // Handle errors here (e.g., display an error message)
                console.log(error);
            }
        });
    });
});
</script>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>