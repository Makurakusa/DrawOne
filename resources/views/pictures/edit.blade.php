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
            <div class="headbox">
              <form action="{{ route('pictures.search') }}"  class="search-form-5" method="GET">
                <label>
                    <input type="text" name="keyword" class="search-area" placeholder="キーワードを入力">
                </label>
                <button type="submit" aria-label="検索"></button>
              </form>
                <div class = 'btn btn--draw'>
                    <a href='/themes/create' class = "btn--draw--text">ワンドロする！</a>
                </div>
            </div>
        </div>
        <div class="middle">
            <h2 class = "title-edit">タイトル編集画面</h1>
            <div class = "content">
                <form action="/pictures/{{ $picture->id }}" class="form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class = "content_title">
                        <p>タイトル</p>
                        <input type="text" name="picture[title]" value="{{ $picture->title }}" class="input" placeholder="タイトルを入力してください"/>
                        <p class="title__error" style="color:red">{{ $errors->first('picture.title') }}</p>
                    </div>
                    <button type="submit" class="button">保存</button>
                </form>
                <p>※最大50文字まで</p>
            </div>
        </div>
        <div class="footer">
            <div class ="button-back">
                <a href = "/pictures/{{ $picture->id }}" class="back">戻る</a>
            </div>
        </div>
    </body>
</html>