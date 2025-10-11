/**
 * NumberFormat モジュール（最新版）
 * ----------------------------
 * 表示用 input と送信用 hidden input の同期、全角数字の半角変換、
 * カンマ区切り表示などを管理する共通関数
 * 
 * 使い方:
 *   <input id="unit_price_display" data-decimal="true">
 *   <input type="hidden" id="unit_price_hidden">
 *   NumberFormat.init('#unit_price_display');
 */
window.NumberFormat = (() => {

    /**
     * 全角数字・全角ピリオドを半角に変換
     * @param {string|null|undefined} str - 入力値
     * @returns {string} 半角文字列
     */
    function toHalfWidth(str) {
        str = String(str ?? ''); // null/undefinedを空文字に変換
        return str.replace(/[０-９．]/g, s => String.fromCharCode(s.charCodeAt(0) - 0xFEE0));
    }

    /**
     * カンマ付き表示に整形
     * @param {string|number} value - 数値または文字列
     * @param {boolean} allowDecimal - 小数を表示するか
     * @returns {string} カンマ付き文字列
     */
    function formatNumber(value, allowDecimal) {
        if (value === '') return '';
        let num = parseFloat(toHalfWidth(value).replace(/,/g, '')); // 全角→半角 + カンマ削除
        if (isNaN(num) || num < 0) num = 0;
        if (allowDecimal) {
            return num.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        } else {
            return Math.floor(num).toLocaleString('en-US');
        }
    }

    /**
     * カンマを除去して数字のみ返す
     * @param {string|number} value - 入力値
     * @param {boolean} allowDecimal - 小数を許可するか
     * @returns {number} 数値
     */
    function stripComma(value, allowDecimal) {
        let numStr = String(value ?? '').trim();
        numStr = toHalfWidth(numStr).replace(/,/g, '');
        if (!allowDecimal) {
            numStr = Math.floor(parseFloat(numStr || 0));
        }
        return numStr === '' ? 0 : parseFloat(numStr);
    }

    /**
     * 指定 input にイベントを付与して初期化
     * @param {string} inputSelector - display用inputのセレクタ
     */
    function attach(inputSelector) {
        const display = document.querySelector(inputSelector);
        if (!display) return;

        // hidden input を取得（display id + "_hidden"）
        const hidden = document.getElementById(display.id.replace('_display', '_hidden'));
        if (!hidden) return;

        const allowDecimal = display.dataset.decimal === 'true';

        // 初期同期
        hidden.value = stripComma(display.value, allowDecimal);

        let isComposing = false;  // IME入力中フラグ

        // IME入力開始
        display.addEventListener('compositionstart', () => { isComposing = true; });
        // IME入力確定
        display.addEventListener('compositionend', (e) => {
            isComposing = false;
            formatAndSync(e.target);
        });

        // 入力中イベント
        display.addEventListener('input', function (e) {
            if (!isComposing) {
                formatAndSync(e.target);
            }
        });

        // フォーカス時：カンマ除去＆選択状態
        display.addEventListener('focus', function () {
            this.value = stripComma(this.value, allowDecimal);
            this.select();
        });

        // フォーカスアウト時：カンマ表示＆hidden同期
        display.addEventListener('blur', function () {
            formatAndSync(this);
        });

        /** フォーマット＆hidden同期処理 */
        function formatAndSync(el) {
            let clean = stripComma(el.value, allowDecimal);

            // 最大桁数制限（整数部＋小数部）
            if (clean.toString().length > 14) {
                clean = parseFloat(clean.toString().slice(0, 14));
            }

            el.value = formatNumber(clean, allowDecimal);
            hidden.value = clean;
        }
    }

    return {
        /**
         * 初期化関数
         * @param {string} selector - 対象 display input セレクタ
         */
        init: (selector) => attach(selector)
    };

})();
