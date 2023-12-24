const importForm = document.querySelector('.import_form');
const fileInput = importForm.querySelector('.import_file_part');

importForm.addEventListener('submit', function(event) {
    if (fileInput.files.length === 0) {
        event.preventDefault();
        alert('ファイルを選択してください');
    }
});
