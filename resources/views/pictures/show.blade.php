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
        <script src="https://kit.fontawesome.com/0dff1c35da.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/show.css" >
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
            <p>画像をクリックするとオリジナル画質表示ができます。</p>
            <div class ="image">
                <a href = "/pictures/{{ $picture->id }}/original"><img src="{{ asset($picture->resized_path) }}"></a>
            </div>
            <h1 class = "title-show">
                {{ $picture -> title }}@if($picture->is_extended == true)<span style = "color:#888888;">（延長）</span>@endif
            </h1>
            <div class = "content">
                <p class = "theme-title">お題：<span>{{ $picture->theme->title }}</span></p>
                <a href="/users/{{ $picture->user->id }}">{{ $picture->user->name }}</a>
            </div>
            <div class = "likes">
                 @if($picture->is_liked_by_auth_user())
                    <a href="/pictures/unlike?id={{$picture->id}}" class="btn btn-success btn-sm"><i class="fa-solid fa-heart"></i> <span class="badge">{{ $picture->likes->count() }}</span></a>
                 @else
                    <a href="/pictures/like?id={{$picture->id}}" class="btn btn-secondary btn-sm"><i class="fa-regular fa-heart"></i> <span class="badge">{{ $picture->likes->count() }}</span></a>
                 @endif
            </div>
            <p class="created-at">投稿日時：{{\Carbon\Carbon::parse($picture->created_at)->format("Y年m月d日 H:i")}}</p>
            @if (Auth::user()->id == $picture->user_id)
            <div class="buttons">
                <div class="edit" style="margin-right:1%;"><a href="/pictures/{{ $picture->id }}/edit">タイトル編集</a></div>
                <form action="/pictures/{{ $picture->id }}" id="form_{{ $picture->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="button-delete" onclick="deletePicture({{ $picture->id }})">作品削除</button> 
                </form>
            </div>
            @endif
        </div>
        <div class="middle">
            <div class = "commentCounts">
                @if ($picture->comments->count())
                <h2>コメント<span>{{ $picture->comments->count() }}</span>件</h2>
                @else
                <h2>コメントはまだありません。</h2>
                @endif
            </div>
            <div class = "comment-area">
                @foreach ($picture->comments as $comment)
                    <div class='comment'>
                        <div class="comment-unit">
                            <a href="/users/{{ $comment->user->id }}">{{ $comment->user->name }}</a>
                            <p class = "comment-body">{{ $comment->body }}</p>
                            <div class="comment-box">
                                <p class="created-at">{{\Carbon\Carbon::parse($comment->created_at)->format("Y-m-d H:i")}}</p>
                                @if (Auth::user()->id == $comment->user_id)
                                    <form action="/pictures/{{ $picture->id }}/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="button-delete" onclick="deleteComment({{ $comment->id }})">コメント削除</button> 
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div id = "replies" class = "hidden">
                            @foreach ($comment->replies as $reply)
                                <div class='comment-unit'>
                                    <a href="/users/{{ $reply->user->id }}">{{ $reply->user->name }}</a>
                                    <p class = "reply-body">{{ $reply->body }}</p>
                                    <div class = "comment-box">
                                        <p class="created-at">{{\Carbon\Carbon::parse($reply->created_at)->format("Y-m-d H:i")}}</p>
                                        @if (Auth::user()->id == $reply->user_id)
                                            <form action="/pictures/{{ $picture->id }}/{{ $comment->id }}/{{ $reply->id }}" id="form_{{ $reply->id }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="button-delete" onclick="deleteReply({{ $reply->id }})">返信削除</button> 
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <div class="display-reply-form">
                                <input type="checkbox" id="change" class="accordion" />
                                <label class="reply-label">返信する</label>
                                <ul id="reply-form">
                                    <li>
                                        <form action="/pictures/{{ $picture->id }}/{{$comment->id}}" class="form-reply" method="POST">
                                            @csrf
                                            <div class = "make_reply">
                                                <div class = "comment_id">
                                                    <input type= "hidden" name="reply[comment_id]" value = "{{ $comment->id }}">
                                                </div>
                                                <textarea name="reply[body]" class="input-comment" wrap="soft" placeholder="返信を入力してください"></textarea>
                                                <p class="title__error" style="color:red">{{ $errors->first('reply.body') }}</p>
                                            </div>
                                            <button type="submit" class="button">返信を送信</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--<button class = "showForm" type = "button" id = "open" class = "box" onclick="changeDisplay()">返信</button>-->
                        <!--<button class = "showForm" type = "button" id = "close" class = "hidden" onclick="changeDisplay()">閉じる</button>-->
                    </div>
                @endforeach
            </div>
            <form action="/pictures/{{ $picture->id }}" class="form-comment" method="POST">
                @csrf
                <div class = "make_comment">
                    <p class="comment-suru">コメントする</p>
                    <div class = "picture_id">
                        <input type= "hidden" name="comment[picture_id]" value = "{{ $picture->id }}">
                    </div>
                    <textarea name="comment[body]" class="input-comment" wrap="soft" placeholder="コメントを入力してください"></textarea>
                    <p class="title__error" style="color:red">{{ $errors->first('comment.body') }}</p>
                </div>
                <button type="submit" class="button">コメントを送信</button>
            </form>
        </div>
        <div class = "footer">
            <div class ="button-back">
                <a href = "/" class="back">戻る</a>
            </div>
        </div>
        <script>
        function deletePicture(id) {
                'use strict'

                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        
        function deleteComment(id) {
                'use strict'

                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
            
        function deleteReply(id) {
                'use strict'

                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
        <script>
            
        </script>
    </body>
</html>