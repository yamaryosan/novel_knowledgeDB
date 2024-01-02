const body = document.querySelector('body');
const importSucceedContainer = document.querySelector('.import_succeed_container');

// 画面のどこかがクリックされたらメッセージを非表示にする
body.addEventListener('click', function() {
    if (importSucceedContainer === null) {
        return;
    }
    importSucceedContainer.classList.add('hidden');
});
