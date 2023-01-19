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

    </div>
    <table border="1">
        <tr>
            <th>product_id</th>
            <th>name</th>
            <th>description</th>
            <th>image </th>
            <th>quantity</th>
            <th>total_price</th>
            <th>Action</th>
        </tr>

        {{-- {{$viewCartCheck}} --}}

        @foreach ($viewCart as $productData)
            <tr>

                {{-- <td>{{ $productData}}</td> --}}
                <td>{{ $productData->product_id }}</td>
                <td>{{ $productData->name }}</td>
                <td>{{ $productData->description }}</td>
                <td>{{ $productData->image }}</td>
                <td>{{ $productData->quantity }}</td>
                <td>{{ $productData->total_price }}</td>
                <td>

                    <form action="{{ route('remove-cart', $productData->product_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <button class="btn btn-outline-success">remove</button>
                    </form>

                    <form action="{{ route('edit-cart', $productData->product_id) }}" method="GET"
                        enctype="multipart/form-data">

                        @csrf
                        {{-- <input type="hidden" name="product_id" value="{{ $productData->product_id }}"> --}}

                        <button class="btn btn-outline-success"> update</button>
                    </form>
                </td>
        @endforeach
        </tr>

    </table>

    <h6>Total Items : {{$totalData[0]->id}}</h6>
    <h6>Toal Amount: {{ $totalData[0]->total }}
    </h6>


</body>

</html>
