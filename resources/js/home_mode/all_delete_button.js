const allDeleteButton = document.querySelector('.all_delete');

allDeleteButton.addEventListener('click', (event)=> {
    const link = allDeleteButton.getAttribute('href');
    event.preventDefault();
    let userInput = prompt('全項目を削除するには、"delete"と入力してください。');
    if (userInput === 'delete') {
        window.location.href = link;
    }
    return false;
});
