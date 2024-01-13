const deleteButtons = document.querySelectorAll('.delete_btn');

deleteButtons.forEach((deleteButton) => {
    deleteButton.addEventListener('click', (event) => {
        const inputValue = window.confirm('削除しますか？');
        if (inputValue === false) {
            // 遷移をキャンセルする
            event.preventDefault();
        }
    });
});
