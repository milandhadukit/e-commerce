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


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    


    <form action="{{ route('update-address', $userDetails->id)}}" method="POST">

        @csrf


        <div class="container">
            <h3>address Update</h3>
            <br><br>

            <label for="uname"><b>name</b></label>
            <input type="text" placeholder="Enter name" name="name" value="{{ $userDetails->name }}" required>

            <label for="uname"><b>address</b></label>
            <input type="text" placeholder="Enter address" name="address" value="{{ $userDetails->address }}"
                required>

            <label for="uname"><b>state</b></label>
            <input type="text" placeholder="Enter state" name="state" value="{{ $userDetails->state }}" required>


            <label for="uname"><b>city</b></label>
            <input type="text" placeholder="Enter city" name="city" value="{{ $userDetails->city }}" required>


            <label for="uname"><b>pin-code</b></label>
            <input type="text" placeholder="Enter pin-code" name="pin-code" value="{{ $userDetails['pin-code'] }}"
                required>


            <label for="uname"><b>mobile</b></label>
            <input type="text" placeholder="Enter mobile" name="mobile" value="{{ $userDetails->mobile }}" required>


            <button type="submit">done</button>

        </div>


    </form>




</body>

</html>
