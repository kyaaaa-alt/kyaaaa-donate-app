let fileInput = document.getElementById("file-upload-input");
let fileSelect = document.getElementsByClassName("file-upload-select")[0];
fileSelect.onclick = function() {
    fileInput.click();
}
fileInput.onchange = function() {
    let filename = fileInput.files[0].name;
    let selectName = document.getElementsByClassName("file-select-name")[0];
    selectName.innerText = filename;
}

let fileInput2 = document.getElementById("file-upload-input2");
let fileSelect2 = document.getElementsByClassName("file-upload-select2")[0];
fileSelect2.onclick = function() {
    fileInput2.click();
}
fileInput2.onchange = function() {
    let filename2 = fileInput2.files[0].name;
    let selectName2 = document.getElementsByClassName("file-select-name2")[0];
    selectName2.innerText = filename2;
}

function showProfile() {
    document.getElementById('profile').style.display = 'initial';
    document.getElementById('stream').style.display = 'none';
    document.getElementById('tripay').style.display = 'none';
    document.getElementById('pusher').style.display = 'none';
}
function showStream() {
    document.getElementById('profile').style.display = 'none';
    document.getElementById('stream').style.display = 'initial';
    document.getElementById('tripay').style.display = 'none';
    document.getElementById('pusher').style.display = 'none';
}

function showTripay() {
    document.getElementById('profile').style.display = 'none';
    document.getElementById('stream').style.display = 'none';
    document.getElementById('tripay').style.display = 'initial';
    document.getElementById('pusher').style.display = 'none';
}

function showPusher() {
    document.getElementById('profile').style.display = 'none';
    document.getElementById('stream').style.display = 'none';
    document.getElementById('tripay').style.display = 'none';
    document.getElementById('pusher').style.display = 'initial';
}