function updateData(dataArr){
    let result = '';
    for (let word in dataArr) {
        result += word + ' - ' + dataArr[word] + '<br>';
    }

    document.getElementById('result').innerHTML = result;
}

function updateError(text) {
    document.getElementById('error').innerHTML = text;
}
function clearError(){
    document.getElementById('error').innerHTML = '';
}

document.getElementById('wordCounterForm').addEventListener('submit', function (e) {
    e.preventDefault();
    clearError();

    let text = document.getElementById('inputText').value;
    let data = JSON.stringify(text);

    let xhr = new XMLHttpRequest();

    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4) {
            switch (this.status){
                case 200:
                    let parseJsonArr = JSON.parse(this.responseText);
                    updateData(parseJsonArr)
                    console.debug(parseJsonArr);
                    break;
                case 400:
                    updateError(JSON.parse(this.responseText));
                    break;
                default:
                    alert('Ошибка ' + this.status + ': ' + this.statusText);
            }
        }
    });

    xhr.addEventListener("error", function() {
        alert('Произошла ошибка соединения');
    });

    xhr.open("POST", "http://localhost:8000");
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(data);
});

