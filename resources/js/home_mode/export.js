const button = document.querySelector('.export');

button.addEventListener('click', (event)=> {
    // エクスポートするか確認
    const link = button.dataset.export;
    if (window.confirm('エクスポートしますか？') === true) {
        window.location.href = link;
    } else {
        return false;
    }
});

// 進捗中のみプログレスバーを表示する
const progressBar = document.getElementById('progressBar');

function showProgressBar () {
    if (progressBar.value === 0 || progressBar.value === 100) {
        progressBar.style.display = 'none';
        return false;
    }
}

// 一定間隔で進捗をチェック
setInterval(updateProgress, 1000);

function updateProgress() {
    const exportButton = document.querySelector('.export');
    const progressBar = document.getElementById('progressBar');

    // 進捗を取得
    fetch('/progress')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // 進捗を取得
            const progress = data;
            console.log(progress);
            // 進捗が0%でも100%でもない場合はプログレスバーを表示し、ボタンを無効化
            if (progress > 0 && progress < 100) {
                progressBar.style.display = 'block';
                disableButton(exportButton);
            }
            // プログレスバーの更新 (プログレスバーはprogress要素で実装)
            progressBar.value = progress;
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });
    // 進捗が100%になったらプログレスバーを非表示
    if (progressBar.value === 100) {
        progressBar.style.display = 'none';
    }
}

// ボタンを無効化
function disableButton (button) {
    button.disabled = true;
    button.style.backgroundColor = '#ccc';
    button.style.boxShadow = 'none';
    button.style.top = '0';
    button.style.cursor = 'not-allowed';
}

// ボタンを有効化
function enableButton (button) {
    button.disabled = false;
    button.style.backgroundColor = '#ade8e6';
    button.style.boxShadow = '0 0 10px #999';
    button.style.top = '6px';
    button.style.cursor = 'pointer';
}
