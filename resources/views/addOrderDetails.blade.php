<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>

    @if (Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{{ Session::get('success') }}</li>
        </ul>
    </div>
@endif


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    <form action="{{route('store.detail')}}" method="post">
      
@csrf
      
      
        <div class="container">
            <h3>Enter Order Details</h3>
            <br><br>

          <label for="uname"><b>name</b></label>
          <input type="text" placeholder="Enter name" name="name" required>
      
          <label for="psw"><b>address</b></label>
          <input type="text" placeholder="Enter address" name="address" required>

          <label for="psw"><b>state</b></label>
          <input type="text" placeholder="Enter state" name="state" required>

          <label for="psw"><b>city</b></label>
          <input type="text" placeholder="Enter city" name="city" required>

          <label for="psw"><b>	pin-code</b></label>
          <input type="text" placeholder="Enter pin-code" name="pin-code" required>

          <label for="psw"><b>mobile</b></label>
          <input type="text" placeholder="Enter mobile" name="mobile" required>

         

         
      
          <button type="submit">Login</button>
         
        </div>
      
        {{-- <div class="container" style="background-color:#f1f1f1">
          <button type="button" class="cancelbtn">Cancel</button>
          <span class="psw">Forgot <a href="#">password?</a></span>
        </div> --}}
      </form>

     


</body>
</html>

