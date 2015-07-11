<html>
<head>
    <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            color: #222;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 72px;
            margin-bottom: 40px;
        }
        p {
            font-size: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">

        <a href="{{ url() }}">
            <img src="{{ asset('img/nitya-logo.png') }}" alt="Nitya - Eternal Fashion" title="Nitya - Eternal Fashion" height="100" />
        </a>
        <div class="title">503 - Internal server error.</div>
        <p>Our servers seem to be down at the moment. We'll be back online soon.</p>
        <p>
            You can contact us at @include('partials.email'),<br/>
            or call us at @include('partials.phone').
        </p>
    </div>
</div>
</body>
</html>
