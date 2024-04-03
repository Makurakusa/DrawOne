<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pictures</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body onLoad=setTimeout("location.href='/pictures/create?id={{$theme->id}}'",2000)>
         <h1>DrawOne!</h1>
        <div class="theme">
            <h2>あなたのお題は{{ $theme -> title }}です！</h2>
        </div>
        <a href="/pictures/create?id={{$theme->id}}">描く</a>
        <div class = "footer">
            <a href = "/">戻る</a>
        </div>
    </body>
</html>