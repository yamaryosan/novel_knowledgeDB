const body = document.querySelector('body');
const errorContainer = document.querySelector('.error_container');

// 画面のどこかがクリックされたらエラーを非表示にする
body.addEventListener('click', function() {
    if (errorContainer === null) {
        return;
    }
    errorContainer.classList.add('hidden');
});
