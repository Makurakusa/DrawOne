<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>DrawOne</title>
    </head>
    <body>
        <h1>DrawOne!</h1>
        <form action="/pictures" method="POST">
            @csrf
            <div class = "image">
                <textarea name="picture[image]" placeholder="本来なら画像を入れる場所です。"></textarea>
            </div>
            <div class = "title">
                <input type="text" name="picture[title]" placeholder="タイトルを入力してください"/>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class = "footer">
            <a href = "/">戻る</a>
        </div>
    </body>
</html>