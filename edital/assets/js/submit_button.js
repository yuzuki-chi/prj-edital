function submit(e) {
    var xhr= new XMLHttpRequest();
    var txt= "";

    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4){
            alert(xhr.responseText);
            document.location = "/student";
        }
    }
    xhr.open('POST', './submit.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(txt);
}

const submitButton = document.getElementById('submit');
submitButton.addEventListener('click', submit, false);