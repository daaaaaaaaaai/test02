/**
 * setupCalculatorInMaterial
 * ----------------------------
 * 商品マスタ計算フォーム共通関数
 * 税抜額・税込額・マージン・仕切価格・税額を自動計算
 * display/hidden input を自動判定して反映
 *
 * @param {Object} config
 * @param {string} config.unitPriceInput    - 定価(税抜)の display input セレクタ
 * @param {string} config.unitTaxOutput     - 税額出力用 input セレクタ
 * @param {string} config.unitAmountOutput  - 定価(税込)出力用 input セレクタ
 * @param {string} config.bcmarginOutput    - 基本マージン出力用 input セレクタ
 * @param {string} config.spmarginInput     - 特別マージン入力用 display input セレクタ
 * @param {string} config.cr1Input          - CR1入力用 display input セレクタ
 * @param {string} config.cr2Input          - CR2入力用 display input セレクタ
 * @param {string} config.grossPriceOutput  - 仕切価格(税抜)出力用 input セレクタ
 * @param {string} config.grossTaxOutput    - 仕切税額出力用 input セレクタ
 * @param {string} config.grossAmountOutut  - 仕切価格(税込)出力用 input セレクタ
 * @param {string} config.basePriceOutput   - 車体価格(税抜)出力用 input セレクタ
 * @param {string} config.baseTaxOutput     - 車体税額出力用 input セレクタ
 * @param {string} config.baseAmountInput   - 車体価格(税込)入力用 display input セレクタ
 * @param {string} config.rOutput           - R出力用 input セレクタ
 * @param {function} config.getTaxRate      - 税率取得関数 (例: () => parseFloat(selected.dataset.taxRate))
 * @param {function} config.getResRate      - レス率取得関数 (例: () => parseFloat(selected.dataset.resRate))
 * @param {Object} config.decimals          - 小数点桁数設定 { base:0, tax:0, total:0, bcmgn:0, spmgn:0, cr1:0, cr2:0 }
 * @returns {function} calculate            - 計算関数。必要に応じてイベントで呼べる
 */
function setupCalculatorInMaterial({
    unitPriceInput,
    unitTaxOutput,
    unitAmountOutput,
    bcmarginOutput,
    spmarginInput,
    cr1Input,
    cr2Input,
    grossPriceOutput,
    grossTaxOutput,
    grossAmountOutut,
    basePriceOutput,
    baseTaxOutput,
    baseAmountInput,
    rOutput,
    getTaxRate,
    getResRate,
    decimals = { base:0, tax:0, total:0, bcmgn:0, spmgn:0, cr1:0, cr2:0 }
}) {
    const upbase = document.querySelector(unitPriceInput);
    const uptax = document.querySelector(unitTaxOutput);
    const uptotal = document.querySelector(unitAmountOutput);
    const bcmgn = document.querySelector(bcmarginOutput);
    const spmgn = document.querySelector(spmarginInput);
    const cr1 = document.querySelector(cr1Input);
    const cr2 = document.querySelector(cr2Input);
    const grbase = document.querySelector(grossPriceOutput);
    const grtax = document.querySelector(grossTaxOutput);
    const grtotal = document.querySelector(grossAmountOutut);
    const bcbase = document.querySelector(basePriceOutput);
    const bctax = document.querySelector(baseTaxOutput);
    const bctotal = document.querySelector(baseAmountInput);
    const r = document.querySelector(rOutput);
    const upHidden = document.querySelector('#unit_price_hidden');

    function isDisplay(input){ return input && input.type!=='hidden'; }
    function readValue(input){ 
        if(!input) return 0;
        let val = input.value || '0';
        if(isDisplay(input)) val = val.replace(/,/g,'');
        return parseFloat(val) || 0; 
    }
    function writeValue(input,value,decimal){
        if(!input) return;
        if(isDisplay(input)){
            input.value = value.toLocaleString('en-US',{minimumFractionDigits:decimal,maximumFractionDigits:decimal});
        } else { input.value = value; }
    }

    function calculate(){
        const taxRate = parseFloat(getTaxRate()) || 0;
        const resRate = parseFloat(getResRate()) || 0;
        const upbaseVal = readValue(upbase);
        const spmgnVal = readValue(spmgn);
        const cr1Val = readValue(cr1);
        const cr2Val = readValue(cr2);
        const bctotalVal = readValue(bctotal);
        const bcmgnVal = upbaseVal*resRate;
        const rVal = readValue(r);

        // 定価計算
        const computedupTax = Math.round(upbaseVal*taxRate);
        const computedupTotal = Math.round(upbaseVal + computedupTax);

        // 仕切計算
        const computedgrBase = upbaseVal - bcmgnVal - spmgnVal - cr1Val - cr2Val;
        const computedgrTax = Math.round(computedgrBase*taxRate);
        const computedgrTotal = Math.round(computedgrBase + computedgrTax);

        // 車体価格計算
        const computedbcBase = Math.round(bctotalVal/(1+taxRate));
        const computedbcTax = Math.round(bctotalVal - computedbcBase);

        // 出力
        writeValue(uptax,computedupTax,decimals.tax);
        writeValue(uptotal,computedupTotal,decimals.total);
        writeValue(bcmgn,bcmgnVal,decimals.bcmgn);
        writeValue(spmgn,spmgnVal,decimals.spmgn);
        writeValue(cr1,cr1Val,decimals.cr1);
        writeValue(cr2,cr2Val,decimals.cr2);
        writeValue(grbase,computedgrBase,decimals.base);
        writeValue(grtax,computedgrTax,decimals.tax);
        writeValue(grtotal,computedgrTotal,decimals.total);
        writeValue(bcbase,computedbcBase,decimals.base);
        writeValue(bctax,computedbcTax,decimals.tax);
        writeValue(r,rVal,decimals.base);

        // hidden同期（required対応）
        writeValue(upHidden,upbaseVal,0);
    }

    // blur & inputで再計算
    [upbase,spmgn,cr1,cr2,bctotal].forEach(el=>{
        if(el && isDisplay(el)){
            el.addEventListener('blur',calculate);
            el.addEventListener('input',calculate);
        }
    });

    // 初期計算
    calculate();
    return calculate;
}
