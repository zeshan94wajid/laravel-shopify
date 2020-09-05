<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
<main role="main">
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Zee Shopify Store</h1>
            <p class="lead text-muted">
                This is my first ever time using Shopify!
            </p>

            {{ Form::open(array('route' => 'customers-update', 'method' => 'PUT', 'class'=>'col-md-12')) }}
                <input class="btn btn-primary my-2" type="submit" value="Update Customers" />
            {{ Form::close() }}

            {{ Form::open(array('route' => 'products-update', 'method' => 'PUT', 'class'=>'col-md-12')) }}
                <input class="btn btn-primary my-2" type="submit" value="Update Products" />
            {{ Form::close() }}

            {{ Form::open(array('route' => 'orders-update', 'method' => 'PUT', 'class'=>'col-md-12')) }}
                <input class="btn btn-primary my-2" type="submit" value="Update Orders" />
            {{ Form::close() }}
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            @if ($products->isEmpty())
                <div class="alert alert-danger">Please synchronize your Shopify products.</div>
            @endif

            @if ($customers->isEmpty())
                <div class="alert alert-danger">Please synchronize your Shopify customers.</div>
            @endif

            @if ($orders->isEmpty())
                <div class="alert alert-danger">Please synchronize your Shopify orders.</div>
            @endif

            @if (!$products->isEmpty() && !$customers->isEmpty() && !$orders->isEmpty())
                <div class="row">
                    <div class="col-lg-5">
                        <h5>Get the average order value</h5>
                        <a href="{{route('get-average-order-for-all')}}" class="btn btn-secondary my-2 align-content-center">Get average</a>
                    </div>

                    <div class="col-lg-5">
                        <h5>Get average order value for a customer</h5>
                        {{ Form::open(array('route' => 'get-customer-average-order-value', 'method' => 'POST')) }}
                        <div class="form-group">
                            <label for="customers">Select a customers</label>
                            <select class="form-control" name="customer">
                                @foreach($customers as $c)
                                    <option value="{{$c->id}}">{{$c->shopify_id . ' - ' . $c->firstname . ' ' . $c->lastname}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        {{ Form::close() }}
                    </div>
                </div>

            @endif
        </div>
    </div>

</main>
</body>
</html>
