// containerをクリックしたらtextareaをアクティブにする

function activateTextarea(containerName) {
    const container = document.querySelector(`.${containerName}`);

    if (!container) {
        console.error(`activate_textarea.js: ${containerName} is not found.`);
    }

    const textarea = container.querySelector('textarea');
    container.addEventListener('click', function() {
        textarea.focus();
    });
}

export default activateTextarea;
