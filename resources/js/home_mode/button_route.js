/** ボタンが押されたら指定されたパスに遷移
 * @param {string} formClassName フォームのクラス名
 * @param {string} btnClassName ボタンのクラス名
 * @param {string} route パス
 * @param {boolean} isValidate バリデーションを行うかどうか
*/
function buttonRoute(formClassName, btnClassName, route, isValidate) {
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
        if (!isValidate) {
            form.action = route;
            form.submit();
            return;
        }
        if (!form.reportValidity()) {
            return;
        }
        form.action = route;
        form.submit();
    });
}

export default buttonRoute;
