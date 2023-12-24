const body = document.querySelector('body');
const importSucceedContainer = document.querySelector('.import_succeed_container');
const importSucceedMessage = importSucceedContainer.querySelector('.message');

// 画面のどこかがクリックされたらメッセージを非表示にする
body.addEventListener('click', function() {
    importSucceedContainer.classList.add('hidden');
});
