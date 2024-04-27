<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Picture</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=M+PLUS+1:wght@100..900&family=Murecho:wght@100..900&family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="https://kit.fontawesome.com/0dff1c35da.js" crossorigin="anonymous"></script>
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
            <h2 class="heading">ドロワンの使い方</h2>
            <p>このページではドロワンの各仕様について用途別に説明いたします！</p>
            <p>説明に使われるボタンやフォームを押すことでページがジャンプしたり、画像が投稿されたりすることはありません！</p>
            <p><b>お試し入力用</b>としてご活用ください！</p>
        </div>
        <div class="middle">
            <h2 class="heading">絵を描く</h2>
            <div class="flex">
                <div class = 'btn btn--draw'>
                    <a class = "btn--draw--text">ワンドロする！</a>
                </div>
                <p style="margin-left:10px;">ボタンを押した後の流れは以下の通りです。</p>
            </div>
            
            <div class="flow">
                <div class="flow-child">
                    <p>1. お題を決める</p>
                    <div class = "theme">
                        <input type="text" name="theme[title]" class="input" placeholder="お題を入力してください"/>
                        <p class="title__error" style="color:red">{{ $errors->first('theme.title') }}</p>
                    </div>
                </div>
                <div class="flow-child">
                    <div class="flex">
                        <p>2. </p>
                        <button class="button">保存</button>
                        <p style="margin-left:10px;">ボタンを押す</p>
                    </div>
                </div>
                <div class="flow-child">
                    <p>3. 画像ファイルを作成して、タイトルを入力する。</p>
                    <div class="flow">
                        <p>残り時間</p>
                        <div class="time">
                            <div id="timer">00:43:29</div>
                        </div>
                    </div>
                    <div id="drag-drop-area">
                        <div class="upload-area">
                            <p class="drag-drop-info">ここにファイルをドロップ</p>
                            <p>または</p>
                            <p class="drag-drop-buttons">
                                <input type="file" accept="image/*" name="picture[image]" id="images" onChange="photoPreview(event)">
                            </p>
                            <p class ="file-introduction">指定形式：JPEG / JPG / PNG</p>
                            <p class ="file-introduction">32MBまで（2MB以内推奨）</p>
                            <div id="preview-area"></div>
                        </div>
                    </div>
                    <div class = "title-create">
                        <input type="text" name="picture[title]" class="input" placeholder="タイトルを入力してください"/>
                        <p class="title__error" style="color:red">{{ $errors->first('picture.title') }}</p>
                    </div>
                </div>
                <div class="flow-child">
                    <div class="flex">
                        <p>4. </p>
                        <button class="button">保存</button>
                        <p style="margin-left:10px;">ボタンを押す</p>
                    </div>
                </div>
                <div class="flow-child">
                    <p>5. 投稿完了！</p>
                </div>
            </div>
            <p>タイトルの編集は<b>投稿した後からでもできます</b>。</p>
            <p>また、残り時間を超過しても<b>投稿することができます！</b></p>
            <p>ただし、タイトルの隣に「延長」という文字が<b>自動的に追加</b>されます。</p>
            <p>なお、タイマーの計測時間は<b>63分</b>です。（完成から投稿までのタイムラグを考慮して）</p>
            <p>大きいファイルサイズの作品は投稿処理に時間がかかるため</p>
            <p>時間に余裕を持って投稿することを推奨いたします。</p>
        </div>
        <div class="middle">
            <h2 class="heading">絵を調べる</h2>
            <p>検索ボックスでキーワードを入力すると</p>
            <p>「ユーザー名」「作品タイトル」「お題」</p>
            <p>のいずれかに部分一致した作品が表示されます。</p>
            <p>また<b>「{{ $user->name }}さんの『ネコ』というタイトルの作品が見たい！」</b>というときは</p>
            <div class="form-sample">
                <p class="form-sample-input">{{ $user->name }}　ネコ</p>
                <button aria-label="検索" class="form-sample-button"></button>
            </div>
            <p>と検索することで絞り込むことができます。</p>
            <p>（スペースは全角半角どちらでも問題ございません。）</p>
        </div>
        <div class = "footer">
            <div class = 'btn btn--draw'>
                <a href='/themes/create' class = "btn--draw--text">ワンドロする！</a>
            </div>
            <div class ="button-back">
                <a href = "/" class="back">戻る</a>
            </div>
        </div>
        <!--`form_${id}`-->
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