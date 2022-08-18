@php
use \App\Http\Routes\WebRoutes;
@endphp
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Minimize your url</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUIyJ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <h1>Minimize your url</h1>
        @include('error-messages')
        @include('success-messages')
        <form action="{{ WebRoutes::home() }}" method="POST">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="url">Enter url to minimize:</label>
                        <input class="form-control" type="text" name="url" id="url"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="clicksCount">Enter max number of links clicking</label>
                        <input class="form-control" type="number" step="1" min="0" id="clicksCount" name="clicksCount"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div>
                        <label for="lifetime">Select lifetime in hours (max 24)</label>
                        <input class="form-control" type="number" step="1" min="1" max="24" id="lifetime" name="lifetime"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div>
                        @csrf
                        <input class="form-control" type="submit" value="Minimize" style="margin-top: 24px;"/>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
