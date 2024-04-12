<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>DrawOne</title>
    </head>
    <body>
        <h1>DrawOne!</h1>
        <h1 class = "title">編集画面</h1>
        <div class = "content">
            <form action="/pictures/{{ $picture->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class = "content_title">
                    <h2>タイトル</h2>
                    <input type="text" name="picture[title]" value="{{ $picture->title }}"　placeholder="タイトルを入力してください"/>
                    <p class="title__error" style="color:red">{{ $errors->first('picture.title') }}</p>
                </div>
                <input type="submit" value="保存"/>
            </form>
        </div>
    </body>
</html>