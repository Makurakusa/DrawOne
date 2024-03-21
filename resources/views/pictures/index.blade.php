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
                    <h2 class='title'>{{ $picture->title }}</h2>
                    <p class='image'>{{ $picture->image }}</p>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $pictures->links() }}
        </div>
    </body>
</html>