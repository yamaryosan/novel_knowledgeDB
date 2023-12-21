// containerをクリックしたらinputをアクティブにする

function activateInput(containerName) {
    const container = document.querySelector(`.${containerName}`);

    if (!container) {
        console.error(`activate_textarea.js: ${containerName} is not found.`);
    }

    const input = container.querySelector('input');
    container.addEventListener('click', function() {
        input.focus();
    });
}

export default activateInput;
