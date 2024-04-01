<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>DrawOne</title>
    </head>
    <body>
        <h1>DrawOne!</h1>
        <form action="/themes" method="POST">
            @csrf
            <div class = "theme">
                <input type="text" name="theme[title]" placeholder="お題を入力してください"/>
                <p class="title__error" style="color:red">{{ $errors->first('theme.title') }}</p>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class = "footer">
            <a href = "/">戻る</a>
        </div>
    </body>
</html>