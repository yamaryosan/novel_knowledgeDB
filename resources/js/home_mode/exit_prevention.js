function confirmPageLeave(event) {
    event.returnValue = 'メッセージ';
}

window.addEventListener('beforeunload', confirmPageLeave);


// フォーム送信の際は離脱防止メッセージを表示しない
const submitButton = document.querySelector('.submit_btn');
const saveButton = document.querySelector('.save_btn');
submitButton.addEventListener('click', ()=> {
    window.removeEventListener('beforeunload', confirmPageLeave);
});

saveButton.addEventListener('click', ()=> {
    window.removeEventListener('beforeunload', confirmPageLeave);
});
