function confirmPageLeave(event) {
    event.returnValue = 'メッセージ';
}

window.addEventListener('beforeunload', confirmPageLeave);

const submitForm = document.querySelector('.edit_form');

submitForm.addEventListener('submit', ()=> {
    window.removeEventListener('beforeunload', confirmPageLeave);
});
