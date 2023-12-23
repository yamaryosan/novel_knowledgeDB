const body = document.querySelector('body');
const importErrorContainer = document.querySelector('.import_error_container');
const importErrorMessage = importErrorContainer.querySelector('.message');

// 画面のどこかがクリックされたらエラーを非表示にする
body.addEventListener('click', function() {
    importErrorContainer.classList.add('hidden');
});
