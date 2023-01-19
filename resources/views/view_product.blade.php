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
        <a href="{{ route('view-cart') }}">CartView</a><br>
    </div>
    <table>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>description</th>
            <th>image </th>
            <th> price (₹)</th>
            <th>discount_price (₹) </th>
            <th>discount_percentage(%)</th>
            <th>tc</th>
            <th>action</th>

        </tr>

        @foreach ($product as $productData)
            <tr>
                <td>{{ $productData->id }}</td>
                <td>{{ $productData->name }}</td>
                <td>{{ $productData->description }}</td>
                <td>{{ $productData->image }}</td>


                @foreach ($discountPrice as $pd)
                    @if ($productData->id == $pd->product_id)
                        <td><del>{{ $productData->price }}</del></td>
                    @else
                        <td>{{ $productData->price }}</td>
                    @endif
                @endforeach
                <td>{{ $productData->discount_price }}</td>

                <td>{{ $productData->discount_percentage }}</td>
                <td>{{ $productData->tc }}</td>
                <td>


                    <form action="{{ route('store.cart') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="product_id" value="{{ $productData->id }}">

                        <button class="btn btn-outline-success">Add to Cart</button>
                    </form>

                    <form action="{{ route('store.order', $productData->id) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="product_id" value="{{ $productData->id }}">

                        <button class="btn btn-outline-success"> By Order</button>
                    </form>


                </td>
        @endforeach
        </tr>

    </table>

</body>

</html>

    