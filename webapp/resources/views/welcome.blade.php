<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Make PHP APIs {{ $action }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <div>
        <h1>API request time: <b>{{ $duration }}</b></h1>

        @if(Session::has('user-status'))
            <div class="alert alert-danger" role="alert">{{ Session::get('user-status') }}</div>
        @endif
        @if(Session::has('article-status'))
            <div class="alert alert-warning" role="alert">{{ Session::get('article-status') }}</div>
        @endif
        @if(Session::has('proposal-status'))
            <div class="alert alert-warning" role="alert">{{ Session::get('proposal-status') }}</div>
        @endif
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-8">

            @if ($users)
                <h2>Users</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>E-Mail</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->firstname }}</td>
                            <td>{{ $user->lastname }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="col-xs-4">

            @if ($articles)
                <h2>Blog</h2>
                @foreach ($articles as $article)
                    <div class="row blog-article">
                        <div class="col-xs-3">
                            <img class="img-responsive" src="{{ $article->image }}">
                        </div>
                        <div class="col-xs-9">
                            <b>{{ $article->title }}</b><br>
                            {{ $article->snippet }}
                        </div>
                    </div>
                @endforeach
            @endif

            @if ($proposals)
                <h2>Proposals</h2>
                <ul>
                @foreach ($proposals as $proposal)
                    <li>{{ $proposal->title }}</li>
                @endforeach
            @endif
            </ul>
        </div>
    </div>
</div>
</body>
</html>
