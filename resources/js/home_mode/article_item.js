const triviumUnits = document.querySelectorAll('.trivium_unit');

// 記事のリンクがクリックされた場合、記事詳細ページへ遷移
triviumUnits.forEach(function(triviumUnit) {
    triviumUnit.addEventListener('click', function(event) {
        const triviumLink = triviumUnit.querySelector('.trivium_link');
        // 編集ボタンがクリックされた場合、何もしない
        if (event.target.closest('.edit_btn')) {
            return;
        }

        // 記事のリンクがクリックされた場合、記事詳細ページへ遷移
        window.location.href = triviumLink.getAttribute('href');
        console.log(triviumLink.getAttribute('href'));
        event.preventDefault();
    });
});
