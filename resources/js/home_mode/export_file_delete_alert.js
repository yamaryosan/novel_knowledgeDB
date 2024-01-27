const deleteButtons = document.querySelectorAll('table>tbody>tr>td:last-child');
console.log(deleteButtons);

deleteButtons.forEach((button) => {
    button.addEventListener('click', (e) => {
        const deleteAlert = confirm('本当に削除しますか？');
        if (!deleteAlert) {
            e.preventDefault();
        }
    });
});
