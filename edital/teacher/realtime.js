// const postData = {
//     "sid": 1,
//     "qid": 102,
// };

// const url = "https://takaya-develop-api.hattori-lab.cs.teu.ac.jp/api/trylog?sid="+sid+"&qid="+qid;
// fetch(url, {
//     method: "GET",
// }).then(response => response.text())
//     .then(text => {
//         console.log(text);
//     });

const hex = {
    0: '0',
    1: '1',
    2: '2',
    3: '3',
    4: '4',
    5: '5',
    6: '6',
    7: '7',
    8: '8',
    9: '9',
    10: 'A',
    11: 'B',
    12: 'C',
    13: 'D',
    14: 'E',
    15: 'F',
};
var bgColor = '000000';
var h = 0;

/**
 * 1秒ごとに最後の筆跡からの経過時間を取得している.
 */
setInterval(() => {
    const active_api_url = "https://takaya-develop-api.hattori-lab.cs.teu.ac.jp/api/student/active/class/1";
    fetch(active_api_url, {
        method: "GET",
    }).then(response => response.text())
        .then(text => {
            // console.log(text);
            var diff = JSON.parse(text);
            // console.log(diff[0].diff);
            for (let i = 0; i < diff.length; i++) {
                for (let i = 0; i < document.getElementsByTagName('li').length; i++) {
                    //席とIDが一致したら
                    if (diff[i].id == document.getElementsByTagName('li')[i].attributes['label'].value) {
                        /**
                         * TODO 
                         * 今は数値を出力しているが、本当は色を変更したい
                         */
                        // document.getElementsByTagName('li')[i].textContent = ""+diff[i].diff;
                        document.getElementsByTagName('li')[i].children[1].textContent = diff[i].diff + " 秒"

                        if (diff[i].diff <= 15) {
                            h = diff[i].diff
                            bgColor = hex[h] + hex[h] + hex[h] + hex[h] + hex[15] + hex[15];
                        } else if (diff[i].diff <= 30) {
                            h = 15 - (diff[i].diff - 15);
                            bgColor = hex[15] + hex[15] + hex[h] + hex[h] + hex[h] + hex[h];
                        } else {
                            h = 0;
                            bgColor = hex[15] + hex[15] + hex[h] + hex[h] + hex[h] + hex[h];
                        }
                        document.getElementsByTagName('li')[i].style.backgroundColor = '#' + bgColor;
                        continue;
                    }
                }
            }
        });
}, 1000);