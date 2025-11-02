@extends('adminlte::page')

@if ($mode==='create')
    @section('title', __('Create'))
@else
    @section('title', __('Change'))
@endif

@section('content_header')
    @if($mode==='create')
        <h1>{{__('Create')}}</h1>
    @else
        <h1>{{__('Change')}}</h1>
    @endif
@stop

@section('content')
    <form method="post"
          action="{{ $mode==='edit'
                        ? route('salesorder.update',$header->order_number)
                        : route('salesorder.store') }}">
        @csrf
        @if($mode==='edit') @method('patch') @endif

        <table class="zmente text-sm">
            <colgroup>
                <col width="13%"/>
                <col width="20%"/>
                <col width="13%"/>
                <col width="20%"/>
                <col width="14%"/>
                <col width="20%"/>
            </colgroup>
            <tr>
                <!-- 伝票番号 -->
                <th class="border border-gray-400">{{__('order_number')}}<div class="label-required float-right">必須</div></th>
                <td>
                    <input type="text" name="order_number"
                        placeholder="未入力時は自動採番"
                        class="form-control @error('order_number') is-invalid @enderror"
                        value="{{old('order_number',$header->formatNumber($header->order_number))}}"
                        @if($mode==='edit') readonly @endif autofocus/>
                    @error('order_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <!-- 顧客コード -->
                <th class="border border-gray-400">{{__('cust_code')}}</th>
                <td>
                    <input type="text" name="cust_code"
                        class="form-control @error('cust_code') is-invalid @enderror"
                        value="{{old('cust_code',$header->cust_code)}}" autofocus/>
                    @error('cust_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                <td>
                    <button class="btn btn-outline-primary">顧客情報入力</button>
                </td>
            </tr>
            <tr>
                <!-- 姓 -->
                <th class="border border-gray-400">{{__('name_last')}}<div class="label-required float-right">必須</div></th>
                <td>
                    <input type="text" name="name_last"
                        class="form-control @error('name_last') is-invalid @enderror"
                        value="{{old('name_last',$customer->name_last)}}" autofocus/>
                    @error('name_last')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <!-- 名 -->
                <th class="border border-gray-400">{{__('name_first')}}</th>
                <td>
                    <input type="text" name="name_first"
                        class="form-control @error('name_first') is-invalid @enderror"
                        value="{{old('name_first',$customer->name_first)}}" autofocus/>
                    @error('name_first')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </tr>
        </table>
        <br>
        <table class="zmente text-sm">
            <colgroup>
                <col width="13%"/>
                <col width="20%"/>
                <col width="13%"/>
                <col width="20%"/>
                <col width="14%"/>
                <col width="20%"/>
            </colgroup>
            <tr>
                <!-- 機種名 -->
                <th class="border border-gray-400">{{__('material_name')}}<div class="label-required float-right">必須</div></th>
                <td>
                    <input type="text" name="material_name"
                        class="form-control @error('material_name') is-invalid @enderror"
                        value="{{old('material_name',$items->material_name)}}" autofocus/>
                    @error('material_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <!-- 車体色 -->
                <th class="border border-gray-400">{{__('color')}}</th>
                <td>
                    <input type="text" name="color"
                        class="form-control @error('color') is-invalid @enderror"
                        value="{{old('color',$items->color)}}" autofocus/>
                    @error('color')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <!-- モデル -->
                <th class="border border-gray-400">{{__('model')}}</th>
                <td>
                    <input type="text" name="model"
                        class="form-control @error('model') is-invalid @enderror"
                        value="{{old('model',$items->model)}}" autofocus/>
                    @error('model')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </tr>
            <tr>
                <!-- メーカー希望小売価格 -->
                <th class="border border-gray-400">{{__('maker_price')}}</th>
                <td>
                    <input type="text" name="maker_price"
                        class="form-control @error('maker_price') is-invalid @enderror"
                        value="{{old('maker_price',$items->maker_price)}}" autofocus/>
                    @error('maker_price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <!-- 販売価格 -->
                <th class="border border-gray-400">{{__('unit_price')}}</th>
                <td>
                    <input type="text" name="unit_price"
                        class="form-control @error('unit_price') is-invalid @enderror"
                        value="{{old('unit_price',$items->unit_price)}}" autofocus/>
                    @error('unit_price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </tr>
                <!-- 値引 -->
                <th class="border border-gray-400">{{__('discount')}}</th>
                <td>
                    <input type="text" name="discount"
                        class="form-control @error('discount') is-invalid @enderror"
                        value="{{old('discount',$items->discount)}}" autofocus/>
                    @error('discount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <!-- 粗利 -->
                <th class="border border-gray-400">{{__('margin')}}</th>
                <td>
                    <input type="text" name="margin"
                        class="form-control @error('margin') is-invalid @enderror"
                        value="{{old('margin',$items->margin)}}" autofocus/>
                    @error('margin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <!-- 粗利率 -->
                <th class="border border-gray-400">{{__('margin_rate')}}</th>
                <td>
                    <input type="text" name="margin_rate"
                        class="form-control @error('margin_rate') is-invalid @enderror"
                        value="{{old('margin_rate',$items->margin_rate)}}" autofocus/>
                    @error('marmargin_rategin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </tr>
            <tr>
                <!-- 追加値引 -->
                <th class="border border-gray-400">{{__('discount_add')}}</th>
                <td>
                    <input type="text" name="discount_add"
                        class="form-control @error('discount_add') is-invalid @enderror"
                        value="{{old('discount_add',$items->discount_add)}}" autofocus/>
                    @error('discount_add')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <!-- 追加粗利 -->
                <th class="border border-gray-400">{{__('margin_add')}}</th>
                <td>
                    <input type="text" name="margin_add"
                        class="form-control @error('margin_add') is-invalid @enderror"
                        value="{{old('margin_add',$items->margin_add)}}" autofocus/>
                    @error('margin_add')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <!-- 追加粗利率 -->
                <th class="border border-gray-400">{{__('margin_rate_add')}}</th>
                <td>
                    <input type="text" name="margin_rate_add"
                        class="form-control @error('margin_rate_add') is-invalid @enderror"
                        value="{{old('margin_rate_add',$items->margin_rate_add)}}" autofocus/>
                    @error('margin_rate_add')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </tr>
            <tr>
            </tr>
            <tr>
            </tr>
            <tr>
            </tr>
            <tr>
            </tr>
            <tr>
            </tr>
            <tr>
            </tr>
            <tr>
            </tr>
        </table>

        <div class="flex space-x-4">
            <a href="{{route('salesorder.index')}}">
                <button type="button" class="btn btn-primary text-sm">
                    <span class="fas fa-solid fa-arrow-left"></span>
                    &nbsp{{__('back')}}
                </button>
            </a>

            <button class="btn btn-primary text-sm">
                <span class="fas fa-solid fa-save"></span>
                &nbsp{{__('save')}}
            </button>
        </div>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/admin_custom.css')}}">
@stop

@section('js')
    <script type="text/javascript" src="{{asset('js/number-format.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/calculator.js')}"></script>
    <script>
        /**
         * 選択された <select> 要素の data-* 属性から数値を取得する共通関数
         *
         * @param {string} selectName   - selectタグのname属性
         * @param {string} dataAttr     - data属性名（例: "taxRate", "resRate"）
         * @param {number} defaultValue - 該当がなかった場合のデフォルト値
         * @returns {number} 数値に変換された値
         */
        function getSelectedData(selectName, dataAttr, defaultValue = 0) {
            const select = document.querySelector(`[name="${selectName}"]`);
            if (!select) return defaultValue;
            const selected = select.options[select.selectedIndex];
            if (!selected) return defaultValue;

            // dataset の値を確認（デバッグ用）
            //console.log(`DEBUG getSelectedData: name=${selectName}, attr=${dataAttr}, value=`, selected.dataset[dataAttr]);

            return parseFloat(selected.dataset[dataAttr]) || defaultValue;
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // NumberFormat 初期化
            ['#engine_display','#special_margin_display','#cr1_display','#cr2_display','#unit_price_display','#base_amount_display']
                .forEach(id => NumberFormat.init(id));

            // 計算セットアップ
            const calcUnit = setupCalculatorInMaterial({
                unitPriceInput:'#unit_price_display',
                unitTaxOutput:'#unit_tax',
                unitAmountOutput:'#unit_amount',
                bcmarginOutput:'#basic_margin',
                spmarginInput:'#special_margin_display',
                cr1Input:'#cr1_display',
                cr2Input:'#cr2_display',
                grossPriceOutput:'#gross_price',
                grossTaxOutput:'#gross_tax',
                grossAmountOutut:'#gross_amount',
                basePriceOutput:'#base_price',
                baseTaxOutput:'#base_tax',
                baseAmountInput:'#base_amount_display',
                // 共通関数を利用して税率・レス率を取得
                getTaxRate: () => getSelectedData("tax_code", "taxrate", 0.1),
                getResRate: () => getSelectedData("response_code", "resrate", 0),
            });

            // イベント登録(率変更時に再計算)
            const taxSelect = document.querySelector('[name="tax_code"]');
            if (taxSelect) {
                taxSelect.addEventListener('change', () => {
                    console.log("税率変更:", taxSelect.value, "→", getSelectedData("tax_code", "taxrate"));
                    calcUnit();
                });
            }
            const resSelect = document.querySelector('[name="response_code"]');
            if (resSelect) {
                resSelect.addEventListener('change', () => {
                    //console.log("レス率変更:", resSelect.value, "→", getSelectedData("response_code", "resrate"));
                    calcUnit();
                });
            }
        });
    </script>
@stop
