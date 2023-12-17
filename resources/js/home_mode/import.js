const dropAreaElement = document.querySelector('.drop_area');
const fileIconElement = document.getElementById('importFileIcon');
const inputElement = document.getElementById('fileInput');

// ファイル選択時の処理
fileIconElement.addEventListener('click', function() {
    inputElement.click();

    inputElement.addEventListener('change', ()=> {
        const fileName = inputElement.files[0].name;
        dropAreaElement.innerText = `${fileName}を選択中`;
        dropAreaElement.classList.add('drop');
    });
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
    dropAreaElement.classList.add('drop');

    // ファイルを取得
    const files = event.dataTransfer.files;

    if (files.length === 0) {
        return;
    }

    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(files[0]);

    // input要素にファイルをセット
    inputElement.files = dataTransfer.files;

    // ファイル名を表示
    const fileName = files[0].name;
    dropAreaElement.innerText = fileName;
});
