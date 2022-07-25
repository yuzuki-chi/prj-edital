// const postData = {
//     "sid": 1,
//     "qid": 102,
// };

const url = "https://takaya-develop-api.hattori-lab.cs.teu.ac.jp/api/trylog?sid="+sid+"&qid="+qid;
fetch(url, {
    method: "GET",
}).then(response => response.text())
    .then(text => {
        console.log(text);
    });