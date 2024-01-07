/** ボタンが押されたら指定されたパスに遷移
 * @param {string} formClassName フォームのクラス名
 * @param {string} btnClassName ボタンのクラス名
 * @param {string} route パス
*/
function buttonRoute(formClassName, btnClassName, route) {
    const form = document.querySelector(`.${formClassName}`);
    const btn = document.querySelector(`.${btnClassName}`);

    if (!form || !btn) {
        console.trace('buttonRoute: form or btn is null');
    }

    if (!route) {
        console.trace('buttonRoute: formRoute is null');
    }

    if (isValidate === undefined) {
        console.trace('buttonRoute: isValidate is undefined');
    }

    btn.addEventListener('click', ()=> {
        if (!form.reportValidity()) {
            return;
        }
        form.action = route;
        form.submit();
    });
}

export default buttonRoute;
