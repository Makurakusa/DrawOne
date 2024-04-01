<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>DrawOne</title>
    </head>
    <body>
        <h1>DrawOne!</h1>
        <div id="timer">00:00:00</div>
        <form action="/pictures" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="theme">
                <h2>お題</h2>
                <select name="picture[theme_id]">
                    @foreach($themes as $theme)
                        <option value="{{ $theme->id }}">{{ $theme->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="upload-area">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>Drag and drop a file or click</p>
                <input type="file" name="picture[image]" id="images">
            </div>
            <div class = "title">
                <input type="text" name="picture[title]" placeholder="タイトルを入力してください"/>
                <p class="title__error" style="color:red">{{ $errors->first('picture.title') }}</p>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class = "footer">
            <a href = "/">戻る</a>
        </div>
        <script>
           
        </script>
    </body>
</html>