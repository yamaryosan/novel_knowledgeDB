const fileIconElement = document.getElementById('importFileIcon');
const inputElement = document.getElementById('fileInput');

fileIconElement.addEventListener('click', function() {
    inputElement.click();
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
});
