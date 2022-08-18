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
                <div class="col-md-4">
                    <div>
                        @csrf
                        <input class="form-control" type="submit" value="Minimize"/>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
