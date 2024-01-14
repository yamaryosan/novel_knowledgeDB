const exportButton = document.querySelector('.export');

exportButton.addEventListener('click', (event)=> {
    // プログレスバーを表示
    const progressBar = document.getElementById('progressBar');
    // エクスポートするか確認
    const link = exportButton.dataset.export;
    if (window.confirm('エクスポートしますか？') === true) {
        window.location.href = link;
    } else {
        return false;
    }
});

// 一定間隔で進捗をチェック
setInterval(updateProgress, 10);

function updateProgress() {
    const exportButton = document.querySelector('.export');
    const progressBar = document.getElementById('progressBar');
    // 進捗が100%の時はプログレスバーを非表示
    if (progressBar.value === 100) {
        progressBar.style.display = 'none';
        return false;
    } else {
        progressBar.style.display = 'block';
    }
    // 進捗を取得
    fetch('/progress')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const progress = data;
            // プログレスバーの更新 (プログレスバーはprogress要素で実装)
            progressBar.value = progress;
            // ボタンを無効化
            exportButton.disabled = true;
            exportButton.style.backgroundColor = '#ccc';
            exportButton.style.boxShadow = 'none';
            exportButton.style.top = '0';
            exportButton.style.cursor = 'not-allowed';
            // テーブル最終行を無効化
            const lastRow = document.querySelectorAll('table tbody tr:last-child');
            lastRow[0].style.backgroundColor = '#666';
            lastRow[0].style.color = '#fff';
            lastRow[0].style.fontWeight = 'bold';
            lastRow[0].style.textShadow = 'none';
            // テーブル最終行のボタンを無効化
            const lastButtons = document.querySelectorAll('table tbody tr:last-child a');
            lastButtons.forEach((lastButton) => {
                lastButton.style.color = '#fff';
                lastButton.style.textShadow = 'none';
                lastButton.style.pointerEvents = 'none';
            });
            // プログレスバーの値が100%になったらボタンを有効化
            if (progressBar.value === 100) {
                exportButton.disabled = false;
                exportButton.style.backgroundColor = '#ade8e6';
                exportButton.style.boxShadow = '0 0 10px #999';
                exportButton.style.top = '6px';
            }
            // プログレスバーの値が100%になったらテーブル最終行を有効化
            if (progressBar.value === 100) {
                lastRow[0].style.backgroundColor = '#fff';
                lastRow[0].style.color = '#666';
                lastRow[0].style.fontWeight = 'normal';
            }
            // プログレスバーの値が100%になったらテーブル最終行のボタンを有効化
            if (progressBar.value === 100) {
                lastButtons.forEach((lastButton) => {
                    lastButton.style.color = '#666';
                    lastButton.style.cursor = 'pointer';
                    lastButton.style.pointerEvents = 'auto';
                });
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });
    // 進捗が100%になったらプログレスバーを非表示
    if (progressBar.value === 100) {
        progressBar.style.display = 'none';
    }
}

