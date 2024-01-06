/** ボタンが押されたら指定されたパスに遷移
 * @param {string} formClassName フォームのクラス名
 * @param {string} btnClassName ボタンのクラス名
 * @param {string} route パス
*/
function buttonRoute(formClassName, btnClassName, route) {
    const form = document.querySelector(`.${formClassName}`);
    const btn = document.querySelector(`.${btnClassName}`);

    if (!form || !btn) {
        console.error('buttonRoute: form or btn is null');
    }

    if (!route) {
        console.error('buttonRoute: formRoute is null');
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
