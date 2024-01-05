const form = document.querySelector('.submit_form');
const save_btn = document.querySelector('.save_btn');
const submit_btn = document.querySelector('.submit_btn');

save_btn.addEventListener('click', function() {
    form.action = form.dataset.tempSaveRoute;
    form.submit();
});

/*
document.getElementById('submitForm').addEventListener('click', function() {
    var form = document.getElementById('myForm');
    form.action = form.getAttribute('data-submit-route');
    form.submit();
});

*/
