
// canvas
const cnvs = document.getElementById('canvas');
cnvs.width = window.outerWidth;
cnvs.height = window.innerHeight;
/* ここでcanvasサイズを変えると、書いた文字が消える
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
cnvs.addEventListener('mousedown', draw_start, false);
cnvs.addEventListener('mousemove', draw_move, false);
cnvs.addEventListener('mouseup', draw_end, false);
// スマホ・タブレット
cnvs.addEventListener('touchstart', touch_start, false);
cnvs.addEventListener('touchmove', touch_move, false);
cnvs.addEventListener('touchend', touch_end, false);
//鉛筆・消しゴム切り替えボタン
ctx_strokeStyle = '#333'
mode = 'pen';
var btn_pen = document.getElementById('mode_pen');
var btn_erase = document.getElementById('mode_erase');
btn_pen.addEventListener('click', mode_pen_, false);
btn_erase.addEventListener('click', mode_erase_, false);

function mode_pen_(e) {
    ctx_strokeStyle = '#333';
    mode = 'pen';
    pen_mode = 1;
}

function mode_erase_(e) {
    ctx_strokeStyle = '#FFF';
    mode = 'erase';
    pen_mode = 2;
}

function draw_start(e) {
    clickFlg = true;
    e.preventDefault();
    ctx.beginPath();
    ctx.lineWidth = 2;
    ctx.strokeStyle = ctx_strokeStyle;
    ctx.lineCap = 'round';
    ctx.moveTo(e.offsetX, e.offsetY);
    ctx.stroke();
    inputData.push({
        'x': e.offsetX,
        'y': e.offsetY,
        // 'status': 'start',
        // 'mode': mode,
        // 'time': new Date().getTime()
    });
    var ds = new Date();
    stroke_start = ds.getFullYear() + "-" + (ds.getMonth() + 1) + "-" + ds.getDate() + " " + ds.getHours() + ":" + ds.getMinutes() + ":" + ds.getSeconds();
}

function draw_move(e) {
    if (clickFlg == false) return false;
    ctx.lineTo(e.offsetX, e.offsetY);
    ctx.stroke();
    inputData.push({
        'x': e.offsetX,
        'y': e.offsetY,
        // 'status': 'move'
    });
}

function draw_end(e) {
    clickFlg = false;
    ctx.lineTo(e.offsetX, e.offsetY);
    ctx.stroke();
    inputData.push({
        'x': e.offsetX,
        'y': e.offsetY,
        // 'status': 'end'
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

function touch_start(e) {
    clickFlg = true;
    e.preventDefault();
    var touch_x = e.touches[0].clientX - window.pageXOffset - e.target.getBoundingClientRect().left;
    var touch_y = e.touches[0].clientY - window.pageYOffset - e.target.getBoundingClientRect().top + 5;

    ctx.beginPath();
    ctx.lineWidth = 2;
    ctx.strokeStyle = ctx_strokeStyle;
    ctx.lineCap = 'round';
    ctx.moveTo(touch_x, touch_y);
    ctx.stroke();
    console.log(e.offsetX, e.offsetY);
    inputData.push({
        'x': touch_x,
        'y': touch_y,
        // 'status': 'start',
        // 'mode': mode,
        // 'time': new Date().getTime()
    });
    var ds = new Date();
    stroke_start = ds.getFullYear() + "-" + (ds.getMonth() + 1) + "-" + ds.getDate() + " " + ds.getHours() + ":" + ds.getMinutes() + ":" + ds.getSeconds();
}

function touch_move(e) {
    var touch_x = e.touches[0].clientX - window.pageXOffset - e.target.getBoundingClientRect().left;
    var touch_y = e.touches[0].clientY - window.pageYOffset - e.target.getBoundingClientRect().top + 5;

    if (clickFlg == false) return false;
    ctx.lineTo(touch_x, touch_y);
    ctx.stroke();
    inputData.push({
        'x': touch_x,
        'y': touch_y,
        // 'status': 'move'
    });
}

function touch_end(e) {
    // var touch_x = e.touches[0].clientX - window.pageXOffset - e.target.getBoundingClientRect().left;
    // var touch_y = e.touches[0].clientY - window.pageYOffset - e.target.getBoundingClientRect().top;
    var touch_x = inputData[inputData.length - 1].x;
    var touch_y = inputData[inputData.length - 1].y;

    clickFlg = false;
    ctx.lineTo(touch_x, touch_y);
    ctx.stroke();
    inputData.push({
        'x': touch_x,
        'y': touch_y,
        // 'status': 'end'
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

    // alert(JSON.stringify(postData));
    inputData = [];
}