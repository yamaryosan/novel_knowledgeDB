const dropAreaElement = document.querySelector('.drop_area');
const fileIconElement = document.getElementById('importFileIcon');
const inputElement = document.getElementById('fileInput');

// フォームにファイルがセットされた時の処理
function setFile() {
    // 揺れ動くファイルアイコンの動きを止める
    fileIconElement.classList.remove('dragover');
    dropAreaElement.classList.add('drop');
    fileIconElement.classList.add('drop');

    // ファイル名を表示
    const fileNameElement = document.createElement('p');
    let textContent = '';
    console.log(inputElement.files);
    for (const file of inputElement.files) {
        textContent += file.name + ' ';
    }
    console.log(textContent);
    fileNameElement.textContent = textContent;
    dropAreaElement.appendChild(fileNameElement);
}

// フォームクリック時の処理
fileIconElement.addEventListener('click', function() {
    inputElement.click();

    // フォームにファイルがセットされるとchangeイベントが発火する
    inputElement.addEventListener('change', setFile);
});

fileIconElement.addEventListener('keydown', (event)=> {
    if (!fileIconElement.isEqualNode(event.target)) {
        return;
    }

    if (event.code === 'Space' || event.code === 'Enter') {
        inputElement.click();
    }
});

fileIconElement.addEventListener('dragover', (event)=> {
    event.preventDefault();
    fileIconElement.classList.add('dragover');
});

fileIconElement.addEventListener('dragleave', ()=> {
    fileIconElement.classList.remove('dragover');
});

// ドロップした時の処理
fileIconElement.addEventListener('drop', (event)=> {
    event.preventDefault();
    fileIconElement.classList.remove('dragover');

    // ファイルを取得
    const files = event.dataTransfer.files;

    if (files.length === 0) {
        return;
    }

    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(files[0]);

    // input要素にファイルをセット
    inputElement.files = dataTransfer.files;

    // フォームにファイルがセットされるとchangeイベントが発火する
    setFile();
});
