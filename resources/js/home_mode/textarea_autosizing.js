/* textareaの高さを自動調整する */

function autosizing(className) {
    if (className === undefined) {
        console.error('className is undefined');
    }

    const textarea = document.getElementById(className);
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });
}
