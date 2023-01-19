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

{{-- {{$edit->product_id}}    --}}
    <form action="{{route('update-cart',$edit->product_id)}}" method="POST">
      
@csrf
      
      
        <div class="container">
            <h3>Cart Update</h3>
            <br><br>

          <label for="uname"><b>quantity</b></label>
          <input type="number" placeholder="Enter quantity" name="quantity" value="{{$edit->quantity}}" required>
      
    
          <button type="submit">done</button>
         
        </div>
      
       
      </form>

     


</body>
</html>

