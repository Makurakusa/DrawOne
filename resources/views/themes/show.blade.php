<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pictures</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=M+PLUS+1:wght@100..900&family=Murecho:wght@100..900&family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/drawone.css" >
    </head>
    <body onLoad=setTimeout("location.href='/pictures/create?id={{$theme->id}}'",2000)>
        <div class="header">
            <a href = "/" class = "drawone"><img src = "{{ asset('drawone_logo.png') }}" alt = "" ></a>
        </div>
        <div class="middle">
            <div class="theme">
                <h2>あなたのお題は「{{ $theme -> title }}」です！</h2>
            </div>
            <div class = 'btn btn--draw'>
                <a href='/pictures/create?id={{ $theme->id }}' class = "btn--draw--text">描く</a>
            </div>
        </div>
    </body>
</html>