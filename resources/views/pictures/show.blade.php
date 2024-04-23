<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pictures</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/show.css" >
    </head>
    <body>
        <h1>DrawOne!</h1>
        <div class ="image">
            <img src="{{ asset($picture->path) }}"
        </div>
        <h1 class = "title">
            {{ $picture -> title }}
        </h1>
        <div class = "content">
            <h2>お題</h2>
            <p class = "themeName">{{ $picture->theme->title }}</p>
            <h2>作者</h2>
            <a href="/users/{{ $picture->user->id }}">{{ $picture->user->name }}</a>
            <p class = "tag">タグ</p>
        </div>
        <div class = "likes">
         @if($picture->is_liked_by_auth_user())
            <a href="/pictures/unlike?id={{$picture->id}}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $picture->likes->count() }}</span></a>
         @else
            <a href="/pictures/like?id={{$picture->id}}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $picture->likes->count() }}</span></a>
         @endif
        </div>
        @if (Auth::user()->id == $picture->user_id)
            <div class="edit"><a href="/pictures/{{ $picture->id }}/edit">タイトル編集</a></div>
            <form action="/pictures/{{ $picture->id }}" id="form_{{ $picture->id }}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deletePicture({{ $picture->id }})">作品削除</button> 
            </form>
        @endif
        
        <div class = "commentCounts">
            @if ($picture->comments->count())
            </div><h2>コメント<span>{{ $picture->comments->count() }}</span>件</h2>
            @else
            <h2>コメントはまだありません。</h2>
            @endif
        </div>
        @foreach ($picture->comments as $comment)
                <div class='comment'>
                    <a href="/users/{{ $comment->user->id }}">{{ $comment->user->name }}</a>
                    <p class = "comments">{{ $comment->body }}</p>
                    <div id = "replies" class = "hidden">
                        @foreach ($comment->replies as $reply)
                            <div class='comment'>
                                <a href="/users/{{ $reply->user->id }}">{{ $reply->user->name }}</a>
                                <p class = "comments">{{ $reply->body }}</p>
                                @if (Auth::user()->id == $reply->user_id)
                                    <form action="/pictures/{{ $picture->id }}/{{ $comment->id }}/{{ $reply->id }}" id="form_{{ $reply->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="deleteReply({{ $reply->id }})">返信を削除</button> 
                                    </form>
                                @endif
                            </div>
                        @endforeach
                        <form action="/pictures/{{ $picture->id }}/{{$comment->id}}" method="POST">
                            @csrf
                            <div class = "make_reply">
                                <div class = "comment_id">
                                    <input type= "hidden" name="reply[comment_id]" value = "{{ $comment->id }}">
                                </div>
                                <input type="text" name="reply[body]" placeholder="返信を入力してください"/>
                                <p class="title__error" style="color:red">{{ $errors->first('reply.body') }}</p>
                            </div>
                            <input type="submit" value="返信を送信"/>
                        </form>
                    </div>
                    <!--<button class = "showForm" type = "button" id = "open" class = "box" onclick="changeDisplay()">返信</button>-->
                    <!--<button class = "showForm" type = "button" id = "close" class = "hidden" onclick="changeDisplay()">閉じる</button>-->
                    @if (Auth::user()->id == $comment->user_id)
                        <form action="/pictures/{{ $picture->id }}/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deleteComment({{ $comment->id }})">コメント削除</button> 
                        </form>
                    @endif
                </div>
            @endforeach

        
        <form action="/pictures/{{ $picture->id }}" method="POST">
            @csrf
            <div class = "make_comment">
                <h2>コメントする</h2>
                <div class = "picture_id">
                    <input type= "hidden" name="comment[picture_id]" value = "{{ $picture->id }}">
                </div>
                <input type="text" name="comment[body]" placeholder="コメントを入力してください"/>
                <p class="title__error" style="color:red">{{ $errors->first('comment.body') }}</p>
            </div>
            <input type="submit" value="コメント送信"/>
        </form>
        
        <div class = "footer">
            <a href = "/">戻る</a>
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
        
        
        function changeDisplay(){
                var reply = document.getElementById('replies');
                var open = document.getElementById('open');
                var open = document.getElementById('close');
                if (reply.style.display == 'none'){
                    reply.style.display = 'block';
                }else{
                    reply.style.display = 'none';
                }
                if (open.style.display == 'none'){
                    open.style.display = 'block';
                }else{
                    open.style.display = 'none';
                }
                if (close.style.display == 'none'){
                    close.style.display = 'block';
                }else{
                    close.style.display = 'none';
                }
            }
        
        </script>
    </body>
</html>