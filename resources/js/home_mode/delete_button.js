const deleteButton = document.querySelector('.delete_btn');

deleteButton.addEventListener('click', (event) => {
    const inputValue = window.confirm('削除しますか？');
    if (inputValue === false) {
        // 遷移をキャンセルする
        event.preventDefault();
    }
});
