;(function($) {

    'use strict';

    if (typeof $ !== 'function') {
        return;
    }

    $(function() {

        var $copyBox = $('.js-label-text'),
            $checkBox = $('.js-label'),
            defaultText = 'ラベルを選択後、「Copy Text」ボタンを押下し、JIRAで利用ください。',
            text = '';

        $copyBox.text(defaultText);

        $checkBox.on('change', function() {
            text = '';
            $('.js-label:checked').each(function() {
                text += ' ' + $(this).val();
            });

            if (text === '') {
                $copyBox.text(defaultText);
            } else {
                $copyBox.text(text);
            }
        });

        $('.js-clear').on('click', function() {
            text = '';

            $checkBox.prop('checked', false);
            $copyBox.text(defaultText);
        });

    });

    $(function() {
        var btn = document.getElementById('js-copy-btn'),
            $txtArea = $('#js-copy-text'),
            clip = new ZeroClipboard(btn);

        clip.on("ready", function() {
            clip.on("beforecopy", function() {
                btn.dataset.clipboardText = $txtArea.text();
                alert('クリップボードにコピーしました。');
            });
        });

    });

})(window.jQuery);