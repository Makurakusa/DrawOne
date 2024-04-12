<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>DrawOne</title>
        <script src="https://kit.fontawesome.com/0dff1c35da.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <h1>DrawOne!</h1>
        <div id="timer">00:00:00</div>
        <div class="theme">
                <h2>あなたのお題は「{{ $theme -> title }}」です！</h2>
        </div>
        <form action="/pictures" method="POST" enctype="multipart/form-data">
            @csrf
            <div class = "theme_id">
                <input type= "hidden" name="picture[theme_id]" value = "{{ $theme->id }}">
            </div>
            <div class="upload-area">
                <i class="fa-solid fa-cloud"></i>
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
                                
                                window.location.href = '/';
                
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
                            timeToCountDown += 60 * 1000;
                            updateTimer(timeToCountDown);
                            startTime = themetime;
                
                            // カウントダウンの機能は再帰的に実行
                            countDown();
                        } 
                    };
                })();
        </script>
    </body>
</html>