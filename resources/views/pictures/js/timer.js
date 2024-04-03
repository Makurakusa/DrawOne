process.stdin.resume();
process.stdin.setEncoding('utf8');
// Your code here!
//即時関数
// 「スタート」が押された時の処理

 //即時関数
(function () {
    var timer = document.getElementById('timer');

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
            timeToCountDown += 20 * 1000;
            updateTimer(timeToCountDown);
            startTime = Date.now();

            // カウントダウンの機能は再帰的に実行
            countDown();
        } 
    };
})();

window.onbeforeunload = function () {
  return "リロード禁止です！";
};

const theme = @json($theme);
            const themetime = new Date(theme.created_at);
            console.log(themetime.toLocaleString());
            console.log(theme);