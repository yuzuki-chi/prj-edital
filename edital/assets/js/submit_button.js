function submit(e) {
    alert('提出します。');
}

const submitButton = document.getElementById('submit');
submitButton.addEventListener('click', submit, false);

/**
 * TODO: 提出した後にstudentのstateを0にする
 */