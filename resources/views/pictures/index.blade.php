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
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $pictures->links() }}
        </div>
        <a href='/themes/create'>ワンドロする！</a>
    </body>
</html>