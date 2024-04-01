<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pictures</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div class ="image">
            <p>{{ $picture -> image }}</p>
        </div>
        <h1 class = "title">
            {{ $picture -> title }}
        </h1>
        <div class = "content">
            <h2>お題</h2>
            <p class = "tag">タグ</p>
        </div>
        <div class="edit"><a href="/pictures/{{ $picture->id }}/edit">タイトル編集</a></div>
        <div class = "footer">
            <a href = "/">戻る</a>
        </div>
    </body>
</html>