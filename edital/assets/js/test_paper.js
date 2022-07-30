// Initialized canvas
const cnvs = document.getElementById('canvas');
const wp = document.getElementById('whitepaper');
// cnvs.width = window.outerWidth;
// cnvs.height = window.innerHeight;
cnvs.width = wp.clientWidth;
cnvs.height = wp.clientHeight;

/* 
 * TODO: 
 * ウィンドウサイズを変更できるようにしたいが、
 * 単純にcanvasサイズを変えると、書いた文字が消える.（canvasの再生成が行われている？）

window.onresize = function() {
    cnvs.width = window.outerWidth;
    cnvs.height = window.outerHeight;
    console.log('canvas resized -> (' + cnvs.width + ' x ' + cnvs.height + ')');
}
*/

var ctx = cnvs.getContext('2d');
// クリックフラグ
var clickFlg = false;
var inputData = [];

// マウス
// cnvs.addEventListener('mousedown', draw_start, false);
cnvs.addEventListener('mousedown', {mode: 'mouse', handleEvent: draw_start}, false);
cnvs.addEventListener('mousemove', {mode: 'mouse', handleEvent: draw_move}, false);
cnvs.addEventListener('mouseup', {mode: 'mouse', handleEvent: draw_end}, false);
// スマホ・タブレット
cnvs.addEventListener('touchstart', {mode: 'touch', handleEvent: draw_start}, false);
cnvs.addEventListener('touchmove', {mode: 'touch', handleEvent: draw_move}, false);
cnvs.addEventListener('touchend', {mode: 'touch', handleEvent: draw_end}, false);
//鉛筆・消しゴム切り替えボタン
ctx_strokeStyle = '#333'
mode = 'pen';
var btn_pen = document.getElementById('mode_pen');
var btn_erase = document.getElementById('mode_erase');
btn_pen.addEventListener('click', mode_pen_, false);
btn_erase.addEventListener('click', mode_erase_, false);

/**
 * mode_pen
 * ペンモード
 */
function mode_pen_(e) {
    ctx_strokeStyle = '#333';
    mode = 'pen';
    pen_mode = 1;
}

/**
 * mode_erase
 * 消しゴムモード
 */
function mode_erase_(e) {
    ctx_strokeStyle = '#FFF';
    mode = 'erase';
    pen_mode = 2;
}

/**
 * draw_start
 * canvs要素に対して入力した際に最初に呼び出される関数
 */
function draw_start(e) {
    clickFlg = true;
    e.preventDefault();

    if ( this.mode == 'mouse' ) {
        var x = e.offsetX;
        var y = e.offsetY;
    } else if ( this.mode == 'touch' ) {
        var x = e.touches[0].clientX - window.pageXOffset - e.target.getBoundingClientRect().left;
        var y = e.touches[0].clientY - window.pageYOffset - e.target.getBoundingClientRect().top + 5;
    }

    ctx.beginPath();
    ctx.lineWidth = 2;
    ctx.strokeStyle = ctx_strokeStyle;
    ctx.lineCap = 'round';
    ctx.moveTo(x, y);
    ctx.stroke();
    inputData.push({
        'x': x,
        'y': y,
    });

    /* stroke_start: 0000-00-00 00:00:00 */
    var ds = new Date();
    stroke_start = ds.getFullYear() + "-" + (ds.getMonth() + 1) + "-" + ds.getDate() + " " + ds.getHours() + ":" + ds.getMinutes() + ":" + ds.getSeconds();
}

/**
 * draw_move
 * canvs要素に対して入力毎に呼び出される関数
 */
function draw_move(e) {
    if (clickFlg == false) return false;

    if ( this.mode == 'mouse' ) {
        var x = e.offsetX;
        var y = e.offsetY;
    } else if ( this.mode == 'touch' ) {
        var x = e.touches[0].clientX - window.pageXOffset - e.target.getBoundingClientRect().left;
        var y = e.touches[0].clientY - window.pageYOffset - e.target.getBoundingClientRect().top + 5;
    }

    ctx.lineTo(x, y);
    ctx.stroke();
    inputData.push({
        'x': x,
        'y': y,
    });
}

/**
 * draw_end
 * canvs要素に対して最後の入力があった場合に呼び出される関数
 */
function draw_end(e) {
    clickFlg = false;
    if ( this.mode == 'mouse' ) {
        var x = e.offsetX;
        var y = e.offsetY;
    } else if ( this.mode == 'touch' ) {
        // 厳密にはタップ後の指は離れている(座標0)ため、1つ前の座標を代入している. 
        var x = inputData[inputData.length - 1].x;
        var y = inputData[inputData.length - 1].y;
    }
    ctx.lineTo(x, y);
    ctx.stroke();
    inputData.push({
        'x': x,
        'y': y,
    });
    var json = JSON.stringify(inputData);
    console.log(json);
    var de = new Date();
    stroke_end = de.getFullYear() + "-" + (de.getMonth() + 1) + "-" + de.getDate() + " " + de.getHours() + ":" + de.getMinutes() + ":" + de.getSeconds();

    var postData = {
        'student_id': student_id,
        'test_id': test_id,
        'pen_mode': pen_mode,
        'pen_size': 1,
        'strokes': inputData,
        'stroke_start': stroke_start,
        'stroke_end': stroke_end,
    };
    const url = "https://takaya-develop-api.hattori-lab.cs.teu.ac.jp/api/trylog";
    fetch(url, {
        method: "POST",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(postData),
    }).then(response => response.text())
        .then(text => {
            console.log(text);
        });

    inputData = [];
}