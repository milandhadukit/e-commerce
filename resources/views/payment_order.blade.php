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

    <a href="{{route('view.detail')}}">View Order Address</a>

    <form action="{{route('payment')}}" method="post">
      
@csrf

{{-- {{ request()->get('id') }} --}}
    
    
        <div class="container">
            <h3>Enter payment Details</h3>
            <br><br>

            <label for="psw"><b>coupon_code</b></label>
            <input type="text" placeholder="Enter coupon_code" name="coupon_code" ><br><br>

            <label for="psw"><b>fullName</b></label>
            <input type="text" placeholder="Enter fullName" name="fullName" required><br>
         
          <label for="psw"><b>card_number</b></label>
          <input type="text" placeholder="Enter card_number" name="card_number" required><br>

          <label for="psw"><b>month</b></label><br>
          <input type="text" placeholder="Enter month" name="month" required><br>

          <label for="psw"><b>year</b></label>
          <input type="text" placeholder="Enter year" name="year" required>
          
          <label for="psw"><b>cvv</b></label>   
          <input type="text" placeholder="Enter cvv" name="cvv" required>

         
      

          <input type="hidden" name="product_id" value="{{ request()->get('id') }}">

         <br>

          <button type="submit">Done</button>
         
        </div>
      
     
      </form>

     


</body>
</html>

