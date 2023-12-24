const importForm = document.querySelector('.import_form');
const inputElement = document.getElementById('fileInput');

// アップロードフォームのアニメーション用要素
const dropAreaElement = document.querySelector('.drop_area');
const fileIconElement = document.getElementById('importFileIcon');

// エラー表示用
importForm.addEventListener('submit', function(event) {
    // ファイルが選択されていない場合のエラー
    if (inputElement.files.length === 0) {
        event.preventDefault();
        alert('ファイルを選択してください');
    }

    // ファイルの拡張子がtxtでない場合のエラー
    for(let i = 0; i < inputElement.files.length; i++) {
        const fileName = inputElement.files[i].name;
        const fileExtension = fileName.split('.').pop();
        if (fileExtension !== 'txt') {

            dropAreaElement.classList.remove('drop');
            fileIconElement.classList.remove('drop');
            dropAreaElement.removeChild(dropAreaElement.lastChild);
            dropAreaElement.appendChild(inputElement);

            event.preventDefault();
            alert('txtファイルを選択してください');
            break;
        }
    }

    // ファイルのサイズが20MBを超えている場合のエラー
    for (let i = 0; i < inputElement.files.length; i++) {
        const fileSize = inputElement.files[i].size;
        if (fileSize > 20000000) {

            dropAreaElement.classList.remove('drop');
            fileIconElement.classList.remove('drop');
            dropAreaElement.removeChild(dropAreaElement.lastChild);
            dropAreaElement.appendChild(inputElement);

            event.preventDefault();
            alert('20MB未満のファイルのみ可能です');
            break;
        }
    }
});
