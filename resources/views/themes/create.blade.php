<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>DrawOne</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=M+PLUS+1:wght@100..900&family=Murecho:wght@100..900&family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/css/drawone.css" >
    </head>
    <body>
        <div class="header">
            <a href = "/" class = "drawone"><img src = "{{ asset('drawone_logo.png') }}" alt = "" ></a>
        </div>
        <div class="middle">
            <h2 class="hedding">お題入力</h2>
            <form action="/themes" class="form" method="POST">
                @csrf
                <div class = "theme">
                    <input type="text" name="theme[title]" class="input" placeholder="お題を入力してください"/>
                    <p class="title__error" style="color:red">{{ $errors->first('theme.title') }}</p>
                </div>
                <button type="submit" class="button">保存</button>
            </form>
            <p>※最大50文字まで</p>
        </div>
        <div class = "footer">
            <div class ="button-back">
                <a href = "/" class="back">戻る</a>
            </div>
        </div>
    </body>
</html>