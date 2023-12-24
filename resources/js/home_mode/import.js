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
    // 末尾のカンマとスペースを削除
    textContent = textContent.slice(0, -2);

    fileNameElement.textContent = textContent;
    dropAreaElement.appendChild(fileNameElement);
}

// フォームクリック時の処理
fileIconElement.addEventListener('click', function() {

    // ファイルが既にアップロードされている場合、ファイルを削除
    if (inputElement.files.length > 0) {
        inputElement.value = '';
    }

    inputElement.click();

    // 2度目のクリック時の場合、ファイル名の表示やアニメーションを削除
    if (dropAreaElement.lastChild) {
        dropAreaElement.classList.remove('drop');
        fileIconElement.classList.remove('drop');
        dropAreaElement.removeChild(dropAreaElement.lastChild);
        dropAreaElement.appendChild(inputElement);
    }

    // フォームにファイルがセットされるとchangeイベントが発火する
    inputElement.addEventListener('change', setFile);
});

// キー押下時の処理
fileIconElement.addEventListener('keydown', (event)=> {

    if (event.code === 'Space' || event.code === 'Enter') {

        // ファイルが既にアップロードされている場合、ファイルを削除
        if (inputElement.files.length > 0) {
            inputElement.value = '';
        }

        inputElement.click();

        // 2度目のクリック時の場合、ファイル名を表示している要素や動的クラスを削除
        if (dropAreaElement.lastChild) {
            dropAreaElement.classList.remove('drop');
            fileIconElement.classList.remove('drop');
            dropAreaElement.removeChild(dropAreaElement.lastChild);
        }

        // フォームにファイルがセットされるとchangeイベントが発火する
        inputElement.addEventListener('change', setFile);
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

    // 2度目のドロップ時の場合、ファイル名を表示している要素を削除
    if (dropAreaElement.lastChild) {
        dropAreaElement.removeChild(dropAreaElement.lastChild);
    }

    // input要素にファイルをセット
    inputElement.files = event.dataTransfer.files;

    // フォームにファイルがセットされるとchangeイベントが発火する
    setFile();
});
