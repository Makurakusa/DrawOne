<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>DrawOne</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=M+PLUS+1:wght@100..900&family=Murecho:wght@100..900&family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/0dff1c35da.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="/css/drawone.css" >
    </head>
    <body>
        <div class="header">
            <a href = "/" class = "drawone"><img src = "{{ asset('drawone_logo.png') }}" alt = "" ></a>
        </div>
        <div class="time-parent">
            <p>残り時間</p>
            <div class="time">
                <div id="timer">00:00:00</div>
            </div>
        </div>
        <div class="middle">
            <div class="theme">
                <h2>あなたのお題は「{{ $theme -> title }}」です！</h2>
            </div>
            <p>まだ作品を投稿できます！</p>
            <p>※タイトル名に”（延長）”がつきます</p>
            <form action="/pictures/extend" method="POST" class="form-picture" enctype="multipart/form-data">
                @csrf
                <div class = "theme_id">
                    <input type= "hidden" name="picture[theme_id]" value = "{{ $theme->id }}">
                </div>
                <div id="drag-drop-area">
                    <div class="upload-area">
                        <p class="drag-drop-info">ここにファイルをドロップ</p>
                        <p>または</p>
                        <p class="drag-drop-buttons">
                            <input type="file" accept="image/*" name="picture[image]" id="images" onChange="photoPreview(event)">
                        </p>
                        <div id="preview-area"></div>
                    </div>
                </div>
                <div class = "title-create">
                    <input type="text" name="picture[title]" class="input" placeholder="タイトルを入力してください"/>
                    <p class="title__error" style="color:red">{{ $errors->first('picture.title') }}</p>
                </div>
                <button type="submit" class="button">保存</button>
            </form>
            <p>※最大50文字まで</p>
            <p>タイトルは投稿後にも変更できます！</p>
        </div>
        <div class = "footer">
            <div class ="button-back">
                <a href = "/" class="back">戻る</a>
            </div>
        </div>
        <script>
            var fileArea = document.getElementById('drag-drop-area');
            var fileInput = document.getElementById('images');
            fileArea.addEventListener('dragover', function(evt){
              evt.preventDefault();
              fileArea.classList.add('dragover');
            });
            fileArea.addEventListener('dragleave', function(evt){
                evt.preventDefault();
                fileArea.classList.remove('dragover');
            });
            fileArea.addEventListener('drop', function(evt){
                evt.preventDefault();
                fileArea.classList.remove('dragenter');
                var files = evt.dataTransfer.files;
                console.log("DRAG & DROP");
                console.table(files);
                fileInput.files = files;
                photoPreview('onChenge',files[0]);
            });
            function photoPreview(event, f = null) {
              var file = f;
              if(file === null){
                  file = event.target.files[0];
              }
              var reader = new FileReader();
              var preview = document.getElementById("preview-area");
              var previewImage = document.getElementById("previewImage");
            
              if(previewImage != null) {
                preview.removeChild(previewImage);
              }
              reader.onload = function(event) {
                var img = document.createElement("img");
                img.setAttribute("src", reader.result);
                img.setAttribute("id", "previewImage");
                preview.appendChild(img);
              };
            
              reader.readAsDataURL(file);
            }
        </script>
    </body>
</html>