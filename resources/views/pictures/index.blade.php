<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>DrawOne</title>
        <script src="https://kit.fontawesome.com/0dff1c35da.js" crossorigin="anonymous"></script>
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=M+PLUS+1:wght@100..900&family=Murecho:wght@100..900&family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/css/drawone.css" >
        <link rel="stylesheet" href="{{ '/css/app.css'}}">
    </head>
    <body>
        <div class="header">
            <a class="thumb" href = "/" class = "drawone"><img src = "{{ asset('drawone_logo.png') }}" alt = "" ></a>
            <div div class="headbox">
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
            <h2 class = 'heading'>最近のワンドロ作品</h2>
        <div class="box-parent">
            @foreach ($pictures as $picture)
                <div class='pictures'>
                    <div class='picture'>
                        <a href = "/pictures/{{ $picture->id }}"><img src="{{$picture->thumb_path}}" alt=""></a>
                        <div class="title-and-likes">
                            <h2 class='title'>
                                <div class="title">
                                    <a href = "/pictures/{{ $picture->id }}">
                                        <p class="index-letter">{{ $picture->title }}@if($picture->is_extended == true)
                                        <span style = "color:#888888;">（延長）</span>@endif</p>
                                    </a>
                                </div>
                            </h2>
                            <div class = "likes">
                              @if($picture->is_liked_by_auth_user())
                                <a href="/pictures/unlike?id={{$picture->id}}" class="btn btn-success btn-sm"><i class="fa-solid fa-heart"></i> <span class="badge">{{ $picture->likes->count() }}</span></a>
                              @else
                                <a href="/pictures/like?id={{$picture->id}}" class="btn btn-secondary btn-sm"><i class="fa-regular fa-heart"></i> <span class="badge">{{ $picture->likes->count() }}</span></a>
                              @endif
                            </div>
                        </div>
                        <a href="/users/{{ $picture->user->id }}"><p class="index-letter">{{ $picture->user->name }}</p></a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $pictures->links('vendor.pagination.bootstrap-4') }}
        </div>
        </div>
        <div class="middle">
            <h2 class="heading">ワンドロとは</h2>
            <p>ワンドロとは1時間で絵を描くことです！</p>
            <p>お題に沿ってやることが多く、SNSでは共通のお題でワンドロを行うイベントもあります。</p>
            <p>本サイトはワンドロを行うことに特化した画像投稿SNSです。</p>
            <a href="/explanation">このサイトの詳しい使い方はコチラ</a>
        </div>
        <div class ="footer">
            <div class = 'btn btn--draw'>
                <a href='/themes/create' class = "btn--draw--text">ワンドロする！</a>
            </div>
        </div>
        <script>
        function deletePicture(id) {
                'use strict'

                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
        <!--`form_${id}`-->
    </body>
</html>