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

    .sold-out {
        text-decoration: line-through;
    }
</style>

<body>
    <div>
        {{-- <a href="{{route('view.detail')}}">View Order Address</a><br> --}}
        {{-- <a href="{{ route('view-cart') }}">CartView</a><br> --}}
    </div>
    <table>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>description</th>
         
            <th>Termes & Condition</th>
          

        </tr>

      
            <tr>
                <td>{{ $singleView->id }}</td>
                 <td>{{ $singleView->name }}</td>
                <td>{{ $singleView->description }}</td> 
                <td>{{ $singleView->tc }}</td> 
             

            
            
               
      
        </tr>

    </table>

</body>

</html>

    