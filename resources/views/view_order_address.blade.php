<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>view Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>

<body>
    @if (Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{{ Session::get('success') }}</li>
        </ul>
    </div>
@endif
<div>
    <a href="{{route('view-cart')}}">CartView</a><br>
</div>
    <table>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>address</th>
            <th>state </th>
            <th>city</th>
            <th>pin-code</th>
            <th>mobile</th>
            <th>action</th>

        </tr>

         @foreach ($OrderDetails as $address)
            <tr>
                <td>{{ $address->id }}</td>
                <td>{{ $address->name }}</td>
                <td>{{ $address->address }}</td>
                <td>{{ $address->state }}</td>
                <td>{{ $address->city }}</td>
                    <td>{{ $address['pin-code']}}</td>
                <td>{{ $address->mobile	 }}</td>
               
                <td>

                   
                    <a href="{{route('edit-address',$address->id)}}">Change Address </a><br>

                </td>
        @endforeach
        </tr>

    </table>




</body>

</html>
