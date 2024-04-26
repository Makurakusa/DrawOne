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
        <div class="time">
            <div id="timer">00:00:00</div>
        </div>
        <div class="middle">
            <div class="theme">
                <h2>あなたのお題は「{{ $theme -> title }}」です！</h2>
            </div>
            <form action="/pictures" method="POST" class="form-picture" enctype="multipart/form-data">
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
                <div class = "title">
                    <input type="text" name="picture[title]" class="input" placeholder="タイトルを入力してください"/>
                    <p class="title__error" style="color:red">{{ $errors->first('picture.title') }}</p>
                </div>
                <button type="submit" class="button">保存</button>
            </form>
        </div>
        <div class = "footer">
            <div class ="button-back">
                <a href = "/" class="back">戻る</a>
            </div>
        </div>
        <script>
             //即時関数
                (function () {
                    var timer = document.getElementById('timer');
                    const theme = @json($theme);
                    const themetime = new Date(theme.created_at);
                    console.log(themetime.toLocaleString());
                    console.log(theme);
                    // スタートタイムを押した時の時間を入れる変数
                    var startTime;
                
                    // 残り時間を計算するための変数
                    var timeLeft;
                
                    // 現在時刻と表示形式を合わせるために * 1000
                    var timeToCountDown = 0;
                
                    // clearTimeoutメソッドを使いたいので、その時用に変数定義
                    var timerId;
                
                    // カウントダウンの状態を管理できるようにする
                    var isRunning = false;
                
                    // 残り時間を表示するために、ミリ秒を渡すと、分や秒に直してくれる関数
                    function updateTimer(t) {
                
                        // 引数として渡されたtでデータオブジェクトを作りたいので変数dという変数名で作ってみる
                        var d = new Date(t);
                        var h = d.getHours()-9;
                        var m = d.getMinutes();
                        var s = d.getSeconds();
                        h = ('0' + h).slice(-2);
                        m = ('0' + m).slice(-2);
                        s = ('0' + s).slice(-2);
                        timer.textContent = h + ':' + m + ':' + s;
                        
                        // タイマーをタブにも表示する
                        var title = timer.textContent = h + ':' + m + ':' + s;;
                        document.title = title;
                
                    }
                
                
                    function countDown() {
                
                        // 10ミリ秒後に実行する
                        timerId = setTimeout(function () {
                
                            // 残り時間 = カウントされる時間 - 現在時刻
                            timeLeft = timeToCountDown - (Date.now() - startTime);
                
                            // 残り時間が0になった時の処理
                            if (timeLeft < 0) {
                                isRunning = false;
                                clearTimeout(timerId);
                                timeLeft = 0;
                
                                timeToCountDown = 0;
                
                                updateTimer(timeLeft);
                                
                                window.location.href = '/pictures/extend?id={{$theme->id}}';
                
                                return;
                            }
                
                            // countDownを再帰的に呼び出すために記述
                            updateTimer(timeLeft)
                            countDown();
                
                        }, 10);
                    }
                
                    // 入室したときの処理
                    window.onload = function () {
                
                        if (isRunning === false) {
                            isRunning = true;
                            timeToCountDown += 10 * 1000;
                            timeToCountDown += 60 * 60 * 1000;
                            updateTimer(timeToCountDown);
                            startTime = themetime;
                
                            // カウントダウンの機能は再帰的に実行
                            countDown();
                        } 
                    };
                })();
        </script>
        <script>
            document.addEventListener('dragover',function(e){
                  e.preventDefault();
                });
                document.addEventListener('drop',function(e){
                  e.preventDefault();
                });
                
                var target = document.getElementById('preview-area');
                
                target.addEventListener('drop', function (e) {
                  document.querySelector("[name='picture[image]']").files =     
                  e.dataTransfer.files;
                  
                  var reader = new FileReader();
                
                  reader.onload = function (e) {
                    target.src = e.target.result;
                  }
                  reader.readAsDataURL(e.dataTransfer.files[0]);

                });
        </script>
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