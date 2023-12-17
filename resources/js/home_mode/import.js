const dropAreaElement = document.querySelector('.drop_area');
const fileIconElement = document.getElementById('importFileIcon');
const inputElement = document.getElementById('fileInput');

// フォームにファイルがセットされた時の処理
function setFile() {
    // ドラッグオーバー時のスタイルを削除
    fileIconElement.classList.remove('dragover');
    // ドロップ時のスタイルを適用
    dropAreaElement.classList.add('drop');
    fileIconElement.classList.add('drop');

    // ファイル名を表示
    const fileNameElement = document.createElement('p');
    let textContent = 'アップロード成功: ';
    for (const file of inputElement.files) {
        textContent += `${file.name}, `;
    }
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

    const dataTransfer = new DataTransfer();
    for (const file of files) {
        dataTransfer.items.add(file);
    }

    // input要素にファイルをセット
    inputElement.files = dataTransfer.files;

    // フォームにファイルがセットされるとchangeイベントが発火する
    setFile();
});
