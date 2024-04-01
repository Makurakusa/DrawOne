<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Picture</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>DrawOne!</h1>
        <div class='pictures'>
            @foreach ($pictures as $picture)
                <div class='picture'>
                    <p class='image'>{{ $picture->image }}</p>
                    <h2 class='title'>
                        <a href = "/pictures/{{ $picture -> id }}">{{ $picture->title }}</a>
                    </h2>
                    <form action="/pictures/{{ $picture->id }}" id="form_{{ $picture->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePicture({{ $picture->id }})">削除</button> 
                    </form>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $pictures->links() }}
        </div>
        <a href='/themes/create'>ワンドロする！</a>
        <script>
        function deletePicture(id) {
                'use strict'

                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
        `form_${id}`
    </body>
</html>