/* textareaの高さを自動調整する */

function autosizing(className) {
    const textarea = document.querySelector(`.${className}`);

    if (!textarea) {
        console.error(`textarea_autosizing.js: ${className} is not found.`);
    }

    // デフォルトで高さを自動調整
    textarea.style.height = 'auto';
    textarea.style.height = (textarea.scrollHeight) + 'px';

    // 入力があったら高さを自動調整
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
}

export default autosizing;
