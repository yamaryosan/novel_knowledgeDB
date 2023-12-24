// 検索キーワードが空の場合のエラー

const searchWindow = document.querySelector('.search_window');
const searchInput = searchWindow.querySelector('.input');
const searchButton = searchWindow.querySelector('.submit_btn');

searchButton.addEventListener('click', function(event) {
    if (searchInput.value.trim() === '') {
        alert('検索キーワードは必須です。');
        event.preventDefault();
    }
});
