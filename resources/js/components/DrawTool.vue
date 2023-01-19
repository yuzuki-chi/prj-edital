<template>
    <div id="canvas-area">
        <canvas id="myCanvas" v-bind:class="{ eraser: canvasMode === 'eraser' }" v-bind="attrs" @mousedown="dragStart"
            @mouseup="dragEnd" @mousemove="draw" @touchstart="dragStart" @touchmove="draw" @touchend="dragEnd"
            @touchcancel="dragEnd">
        </canvas>
    </div>
    <div id="tool-area">
        ページ番号<input type="number" name="page-num" id="page-num" min="1" max="100" v-model="pageNum"
            @change="onChangeOfPageNum($event.target.value)">
        <button @click="changePage(this.pageNum-1)">前のページ</button>
        <button @click="changePage(this.pageNum+1)">次のページ</button>
        <button id="pen-black-button" @click="penBlack">ペン（黒）</button>
        <button id="pen-red-button" @click="penRed">ペン（赤）</button>
        <button id="pen-blue-button" @click="penBlue">ペン（青）</button>
        <button id="eraser-button" @click="eraser">消しゴム</button>
        ペンの太さ
        <input type="range" name="pen-size-slider" id="pen-size-slider" min="1" max="100" step="1"
            v-model="toolSizeValue" @change="penSize($event.target.value)">
        <!-- <button id="clear-button" @click="clear">クリア</button> -->
        <!-- <button id="download-button" @click="download">ダウンロード</button> -->
        <input type="number" name="studentId" id="studentId" v-bind:value="studentId">
        <button id="submit" @click="send">送信</button>
    </div>
</template>
   
<script>
import axios from 'axios';
export default {
    name: "DrawTool",
    data() {
        return {
            canvasMode: 'penBlack',
            canvas: null,
            context: null,
            isDrag: false,
            attrs: {
                // window size (Doesn't support changing screen size)
                width: window.innerWidth,
                height: window.innerHeight - 50,
            },
            param: [],
            params: [],
            toolSize: {
                'pen': 1,
                'eraser': 30,
            },
            toolSizeValue: 1,
            pageNum: 1,
            drawFlag: false,
            //URLのGETパラメータ sid をユーザIDとして設定する
            studentId: new URL(location.href).searchParams.get('sid'),
        };
    },
    created() {
        this.timer = setInterval(() => {
            if( this.drawFlag == true ) {
                this.send();
                console.log('更新');
                this.drawFlag = false;
            } else {
                console.log('送信しませんでしたよ');
            }
        }, 5000);
    },
    beforeUnmount() {
        clearInterval(this.timer);
    },
    mounted() {
        // document.getElementById('studentId').value = new URL(location.href).searchParams.get('sid');
        // Initialize
        this.canvas = document.querySelector('#myCanvas');
        this.context = this.canvas.getContext('2d');
        // White Rect 
        this.context.fillStyle = "rgb(255, 255, 255)";
        this.context.fillRect(0, 0, window.innerWidth, window.innerHeight - 50);
        // Pen Style
        this.context.lineCap = 'round';
        this.context.lineJoin = 'round';
        this.context.lineWidth = 1;
        this.context.strokeStyle = '#000000';
        // ページIDを復元する
        // document.getElementById('studentId').value = 0;

        if( this.getPage(1) ) {
            console.log('1ページ目を復元しました。');
        } else {
            console.log('1ページ目は存在しませんでした。');
        }
    },
    methods: {
        getPage: async function (num) {
            console.log(num + 'ページ目の書き込みを復元します...');
            const studentId = document.getElementById('studentId').value;
            this.clear();
            
            var logs;
            var state = true;
            await axios.get('https://takaya.hattori-lab.cs.teu.ac.jp/api/trylog/' + studentId + '/' + num).then(res => {
                console.log(res);
                if(res.status == 200) {
                    state = true;
                    logs = JSON.parse(res.data[0].strokes);
                } else {
                    state = false;
                }
            }).catch(err => {
                console.log(err)
            })

            if(state) {
                for (let i = 0; i < logs.length; i++) {
                    // console.log("logs[" + i + "]");
                    this.context.beginPath();
                    // console.log(logs[i])
                    for (let j = 0; j < logs[i].length; j++) {
                        //TODO: xy以外の値も反映していく必要がある
                        // console.log(logs[i][j]);
                        this.drawLog(logs[i][j].x, logs[i][j].y, logs[i][j].penSize, logs[i][j].penColor, logs[i][j].penShape);
                    }
                }
            }
            
            return state;
        },
        changePage: function(page) {
            this.pageNum = page;
            this.onChangeOfPageNum(page);
        },

        drawLog: function (x, y, size, color, shape) {
            this.penSize(size);
            this.penColor(color);
            this.penShape(shape);

            this.context.lineTo(x, y);
            this.context.stroke();
        },

        // ペンモード
        pen: function () {
            // カーソル変更
            this.canvasMode = 'pen'
            // 描画設定
            this.context.lineCap = 'round';
            this.context.lineJoin = 'round';
            this.context.lineWidth = this.toolSize['pen'];
            this.context.strokeStyle = '#000000';
        },
        // 消しゴムモード
        eraser: function () {
            // カーソル変更
            this.canvasMode = 'eraser'
            // 描画設定
            this.penSize(this.toolSize['eraser'])
            this.penShape('square');
            this.penColor('#FFFFFF');
        },

        // ペンモード（黒）
        penBlack: function () {
            // カーソル変更
            this.canvasMode = 'penBlack';
            // 描画設定
            this.penSize(this.toolSize['pen']);
            this.penShape('round');
            this.penColor('#000000');
        },
        // ペンモード（赤）
        penRed: function () {
            // カーソル変更
            this.canvasMode = 'penRed';
            // 描画設定
            this.penSize(this.toolSize['pen']);
            this.penShape('round');
            this.penColor('#FF0000');
        },
        // ペンモード（青）
        penBlue: function () {
            // カーソル変更
            this.canvasMode = 'penBlue';
            this.penSize(this.toolSize['pen']);
            this.penShape('round');
            this.penColor('#0000FF');
        },

        /**
         * ペンの色を変更する
         * @param String color 'e.g. #FFFFFF'
         */
        penColor: function (color) {
            this.context.strokeStyle = color;
        },
        getPenColor: function () {
            return this.context.strokeStyle;
        },


        /**
         * ペンの太さを変更する
         * @param int size
         */
        penSize: function (size) {
            console.log(size);
            this.context.lineWidth = size;

            // pen/eraserごとにサイズを記憶
            if (this.canvasMode == 'eraser') {
                this.toolSize['eraser'] = size;
                this.toolSizeValue = size;
            } else {
                this.toolSize['pen'] = size;
                this.toolSizeValue = size;
            }
        },
        getPenSize: function () {
            return this.context.lineWidth;
        },


        /**
         * ペンの形状を変更する
         * @param String shape {round | square}
         */
        penShape: function (shape) {
            this.context.lineCap = shape;
            this.context.lineJoin = shape;
        },
        getPenShape: function () {
            return this.context.lineCap;
        },
        /**
         * 現在時刻を特定の書式で返す
         * @return YYYY-MM-YY HH:MM:SS
         */
        getNow: function(){ 
          const date = new Date();
          return date.getFullYear() + "-" + (date.getMonth()+1) + "-" + date.getDate() + " " + date.toLocaleTimeString();
        },
        /** 
         * ページ番号の変更
         */
        onChangeOfPageNum: function (num) {
            //paramの初期化
            this.params = [];
            this.pram = [];

            this.pageNum = num;
            console.log("ページ番号が" + num + "になりました。")
            if( this.getPage(num) )
                console.log('ページが反映されました');
            else 
                console.log('ページデータが存在しませんでした');
        },

        // 画像ダウンロード
        download: function () {
            let link = document.createElement("a");
            link.href = this.canvas.toDataURL("image/png");
            link.download = 'canvas-' + new Date().getTime() + '.png';
            link.click();
        },

        /**
         * イベントオブジェクト：メンバー
         * ----------------------------------------------
         * target       イベント発生元の要素
         * type         イベントの種類（click, focusなど）
         * timeStamp    イベントの作成日時を取得
         * clientX      イベントの発生時のブラウザ上でのX座標
         * clientY      イベントの発生時のブラウザ上でのY座標
         * screenX      イベントの発生時のスクリーン上でのX座標
         * screenY      イベントの発生時のスクリーン上でのX座標
         * pageX        イベントの発生時のページ上でのX座標
         * pageY        イベントの発生時のページ上でのY座標
         * offsetX      イベントの発生時の要素上でのX座標
         * offsetY      イベントの発生時の要素上でのY座標
         * stopPropagenation()  イベントの親要素への伝播を中止
         * preventDefault()     イベント規定の動作をキャンセル
         * ----------------------------------------------
         */


        // 描画開始（mousedown）
        dragStart: function (e) {
            //スクロール禁止
            document.addEventListener("mousewheel", e.preventDefault(), { passive: false, });
            document.addEventListener("touchmove", e.preventDefault(), { passive: false, });
            document.removeEventListener("mousewheel", e.preventDefault(), { passive: false, });
            document.removeEventListener("touchmove", e.preventDefault(), { passive: false, });

            var x, y = 0;
            if (e.type.includes('mouse')) {
                x = e.offsetX;
                y = e.offsetY;
            } else if (e.type.includes('touch')) {
                x = e.touches[0].clientX;
                // y = e.touches[0].clientY;
                y = e.changedTouches[0].pageY;
            }

            this.context.beginPath();
            this.context.lineTo(x, y);
            this.context.stroke();

            this.param.push({
                x: x,
                y: y,
                time: this.getNow(),
                penSize: this.getPenSize(),
                penColor: this.getPenColor(),
                penShape: this.getPenShape(),
            });

            this.isDrag = true;
        },
        // 描画
        draw: function (e) {
            var x, y = 0;
            if (e.type.includes('mouse')) {
                x = e.offsetX;
                y = e.offsetY;
            } else if (e.type.includes('touch')) {
                x = e.touches[0].clientX;
                // y = e.touches[0].clientY;
                y = e.changedTouches[0].pageY;
            }

            if (!this.isDrag) {
                return;
            }

            this.context.lineTo(x, y);
            this.context.stroke();

            this.param.push({
                x: x,
                y: y,
                time: this.getNow(),
                penSize: this.getPenSize(),
                penColor: this.getPenColor(),
                penShape: this.getPenShape(),
            });
        },
        // 描画終了（mouseup, mouseout）
        dragEnd: function () {
            this.context.closePath();
            this.isDrag = false;

            /**
             * TODO: API server へ 座標, 時間を送信する
             * {{x, y, time, penSize, penColor, penShape},{...}...}
             */
            console.log(this.param);
            this.params.push(this.param);
            this.param = [];
            console.log(this.params);
            
            //前回の送信から変化がある場合にtrueになる
            this.drawFlag = true;

            // this.postParam();
        },
        clear: function () {
            this.param = [];
            this.params = [];
            this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
        },
        // postParam
        postParam: function () {
            axios
                .post('https://takaya.hattori-lab.cs.teu.ac.jp/api/trylog', {
                    student_id: document.getElementById('studentId').value,
                    page_num: this.pageNum,
                    strokes: this.param,
                })
                .then((res) => {
                    console.log(res);
                    this.posts = res.data.posts;
                })
                .catch((err) => {
                    // [Too Many Requests] 対策を行う必要がある (だいたい47秒)
                    console.log(err);
                    console.log(err.response.headers['retry-after']);
                });
        },
        send: function () {
            var binary = this.canvas.toDataURL("image/png");
            axios
                .post('https://takaya.hattori-lab.cs.teu.ac.jp/api/trylog/', {
                    student_id: document.getElementById('studentId').value,
                    page_num: this.pageNum,
                    strokes: this.params, 
                    binary: binary,
                })
                .then((res) => {
                    console.log(res);
                })
                .catch((err) => {
                    // [Too Many Requests] 対策を行う必要がある (だいたい47秒)
                    console.log(err);
                    console.log(err.response.headers['retry-after'] + "秒待ってね.");
                    alert(err.response.headers['retry-after'] + "秒待ってね.");
                });
        }
    }
};
</script>
   
<style>
#myCanvas {
    border: 1px solid #000000;
}

#tool-area {
    border: 1px solid #000000;

    display: flex;
    flex-direction: row;
    justify-content: space-between;
}
</style>