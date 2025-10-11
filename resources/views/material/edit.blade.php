@extends('adminlte::page')

@if ($mode==='create')
    @section('title', __('Material Create'))
@else
    @section('title', __('Material Change'))
@endif

@section('content_header')
    @if($mode==='create')
        <h1>{{__('Material Create')}}</h1>
    @else
        <h1>{{__('Material Change')}}</h1>
    @endif
@stop

@section('content')
    <form method="post"
          action="{{ $mode==='edit'
                        ? route('material.update',$material->material_code)
                        : route('material.store') }}">
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
                <!-- 商品コード -->
                <th class="border border-gray-400">{{__('material_code')}}<div class="label-required float-right">必須</div></th>
                <td class="border border-gray-400">
                    <input type="text" name="material_code"
                        placeholder="未入力時は自動採番"
                        class="form-control @error('material_code') is-invalid @enderror"
                        value="{{old('material_code',$material->formatNumber($material->material_code))}}"
                        @if($mode==='edit') readonly @endif autofocus/>
                    @error('material_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                <!-- 商品名 -->
                <th class="border border-gray-400">{{__('material_name')}}<div class="label-required float-right">必須</div></th>
                <td class="border border-gray-400" colspan="3">
                    <input type="text" name="material_name"
                        class="form-control @error('material_name') is-invalid @enderror"
                        value="{{old('material_name',$material->material_name)}}" autofocus/>
                    @error('material_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <!-- 分類 -->
                <th class="border border-gray-400">{{__('class_code')}}<div class="label-required float-right">必須</div></th>
                <td class="border border-gray-400">
                    <select name="class_code"
                            class="form-control @error('class_code') is-invalid @enderror">
                        <option value="">{{__('select value')}}</option>
                        @foreach ($classifications as $classification)
                            <option value="{{$classification->class_code}}"
                                        {{old('class_code',$material->class_code)===$classification->class_code ? 'selected' : ''}}>
                                {{$classification->class_name}}
                            </option>
                        @endforeach
                    </select>
                    @error('class_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                <!-- 機種名 -->
                <th class="border border-gray-400">{{__('model')}}</th>
                <td class="border border-gray-400">
                    <input type="text" name="model"
                        class="form-control @error('model') is-invalid @enderror"
                        value="{{old('model',$material->model)}}" autofocus/>
                    @error('model')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                <!-- カラー -->
                <th class="border border-gray-400">{{__('color')}}</th>
                <td class="border border-gray-400">
                    <input type="text" name="color"
                        class="form-control @error('color') is-invalid @enderror"
                        value="{{old('color',$material->color)}}" autofocus/>
                    @error('color')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <!-- 排気量 -->
                <th class="border border-gray-400">{{__('engine')}}</th>
                <td class="border border-gray-400">
                    {{-- 表示用 --}}
                    <input type="text" name="engine" id="engine_display" data-decimal="false"
                        class="form-control text-right @error('engine') is-invalid @enderror"
                        value="{{old('engine',number_format($material->engine ?? 0))}}"
                        autofocus/>
                    {{-- 送信用 --}}
                    <input type="hidden" name="engine" id="engine_hidden"
                        value="{{ old('engine', $material->engine ?? 0) }}">
                    @error('engine')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                <!-- 生産国 -->
                <th class="border border-gray-400">{{__('coo')}}</th>
                <td class="border border-gray-400">
                    <select name="coo" class="form-control @error('coo') is-invalid @enderror">
                        <option value="">{{__('select value')}}</option>
                        @foreach ($countries as $country)
                            <option value="{{$country->country_code}}"
                                        {{old('coo',$material->coo)===$country->country_code ? 'selected' : ''}}>
                                {{$country->country_name_j}}
                            </option>
                        @endforeach
                    </select>
                    @error('coo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <!-- 数量単位 -->
                <th class="border border-gray-400">{{__('unit')}}<div class="label-required float-right">必須</div></th>
                <td class="border border-gray-400">
                    <select name="unit" class="form-control @error('unit') is-invalid @enderror">
                        <option value="">{{__('select value')}}</option>
                        @foreach ($units as $unit)
                            <option value="{{$unit->unit}}"
                                        {{old('unit',$material->unit)===$unit->unit ? 'selected' : ''}}>
                                {{$unit->text}}
                            </option>
                        @endforeach
                    </select>
                    @error('unit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                <!-- 税コード -->
                <th class="border border-gray-400">{{__('tax_code')}}<div class="label-required float-right">必須</div></th>
                <td class="border border-gray-400">
                    <select name="tax_code" class="form-control @error('tax_code') is-invalid @enderror">
                        <option value="">{{__('select value')}}</option>
                        @foreach ($taxs as $tax)
                            <option value="{{$tax->tax_code}}"
                                    data-taxrate="{{$tax->tax_rate / 100}}"
                                    {{ old('tax_code',$material->tax_code)===$tax->tax_code ? 'selected' : '' }}>
                                {{$tax->text}}
                            </option>
                        @endforeach
                    </select>
                    @error('tax_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <!-- 基本マージン -->
                <th class="border border-gray-400">{{__('basic_margin')}}</th>
                <td class="border border-gray-400">
                    {{-- 表示用 --}}
                    <input type="text" name="basic_margin_display" id="basic_margin_display"
                        class="form-control text-right"
                        value="{{old('basic_margin',number_format($material->basic_margin ?? 0))}}"
                        readonly/>
                    {{-- 送信用 --}}
                    <input type="hidden" name="basic_margin" id="basic_margin_hidden"
                        value="{{ old('basic_margin', $material->basic_margin ?? 0) }}">
                </td>
                <!-- 特別マージン -->
                <th class="border border-gray-400">{{__('special_margin')}}</th>
                <td class="border border-gray-400">
                    {{-- 表示用 --}}
                    <input type="text" name="special_margin_display" id="special_margin_display" data-decimal="false"
                        class="form-control text-right @error('special_margin') is-invalid @enderror"
                        value="{{old('special_margin',number_format($material->special_margin ?? 0))}}"
                        autofocus/>
                    {{-- 送信用 --}}
                    <input type="hidden" name="special_margin" id="special_margin_hidden"
                        value="{{ old('special_margin', $material->special_margin ?? 0) }}">
                    @error('special_margin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                <!-- レス率 -->
                <th class="border border-gray-400">{{__('response_rate')}}</th>
                <td class="border border-gray-400">
                    <select name="response_code" class="form-control @error('response_code') is-invalid @enderror">
                        <option value="">{{__('select value')}}</option>
                        @foreach ($response_rates as $response_rate)
                            <option value="{{$response_rate->response_code}}"
                                    data-resrate="{{$response_rate->response_rate / 100}}"
                                    {{ old('response_code',$material->response_code)===$response_rate->response_code ? 'selected' : '' }}>
                                {{$response_rate->text}}
                            </option>
                        @endforeach
                    </select>
                    @error('response_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <!-- CR① -->
                <th class="border border-gray-400">{{__('cr1')}}</th>
                <td class="border border-gray-400">
                    {{-- 表示用 --}}
                    <input type="text" name="cr1_display" id="cr1_display" data-decimal="false"
                        class="form-control text-right @error('cr1') is-invalid @enderror"
                        value="{{old('cr1',number_format($material->cr1 ?? 0))}}"
                        autofocus/>
                    {{-- 送信用 --}}
                    <input type="hidden" name="cr1" id="cr1_hidden"
                        value="{{ old('cr1', $material->cr1 ?? 0) }}">
                    @error('cr1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                <!-- CR② -->
                <th class="border border-gray-400">{{__('cr2')}}</th>
                <td class="border border-gray-400">
                    {{-- 表示用 --}}
                    <input type="text" name="cr2_display" id="cr2_display" data-decimal="false"
                        class="form-control text-right @error('cr2') is-invalid @enderror"
                        value="{{old('cr2',number_format($material->cr2 ?? 0))}}" autofocus/>
                    {{-- 送信用 --}}
                    <input type="hidden" name="cr2" id="cr2_hidden"
                        value="{{ old('cr2', $material->cr2 ?? 0) }}">
                    @error('cr2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                <!-- R -->
                <th class="border border-gray-400">{{__('r')}}</th>
                <td class="border border-gray-400">
                    {{-- 表示用 --}}
                    <input type="text" name="r_display" id="r_display" data-decimal="false"
                        class="form-control input-sm text-right"
                        value="{{ old('r',number_format($material->r ?? 0)) }}"
                        readonly/>
                    {{-- 送信用 --}}
                    <input type="hidden" name="r" id="r_hidden"
                        value="{{ old('r', $material->r ?? 0) }}">
                </td>
            </tr>
            <tr>
                <!-- 定価税抜 -->
                <th class="border border-gray-400">{{__('unit_price')}}<div class="label-required float-right">必須</div></th>
                <td class="border border-gray-400">
                    {{-- 表示用 --}}
                    <input type="text" name="unit_price_display" id="unit_price_display" data-decimal="false"
                        class="form-control text-right @error('unit_price') is-invalid @enderror"
                        value="{{old('unit_price',number_format($material->unit_price ?? 0))}}"
                        autofocus/>
                    {{-- 送信用 --}}
                    <input type="hidden" name="unit_price" id="unit_price_hidden"
                        value="{{ old('unit_price', $material->unit_price ?? 0) }}">
                    @error('unit_price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                <!-- 税額 -->
                <th class="border border-gray-400">{{__('unit_tax')}}</th>
                <td class="border border-gray-400">
                    {{-- 表示用 --}}
                    <input type="text" name="unit_tax_diplay" id="unit_tax_display"
                        class="form-control input-sm text-right"
                        value="{{ old('unit_tax', $material->unit_tax ?? 0) }}"
                        readonly/>
                    {{-- 送信用 --}}
                    <input type="hidden" name="unit_tax" id="unit_tax_hidden"
                        value="{{ old('unit_tax', $material->unit_tax ?? 0) }}">
                </td>
                <!-- 定価税込 -->
                <th class="border border-gray-400">{{__('unit_amount')}}</th>
                <td class="border border-gray-400">
                    {{-- 表示用 --}}
                    <input type="text" name="unit_amount_display" id="unit_amount_display"
                        class="form-control input-sm text-right"
                        value="{{ old('unit_amount', $material->unit_amount ?? 0) }}"
                        readonly/>
                    {{-- 送信用 --}}
                    <input type="hidden" name="unit_amount" id="unit_amount_hidden"
                        value="{{ old('unit_amount', $material->unit_amount ?? 0) }}">
                </td>
            </tr>
            <tr>
                <!-- 仕切価格税抜 -->
                <th class="border border-gray-400">{{__('sikr_price')}}</th>
                <td class="border border-gray-400">
                    {{-- 表示用 --}}
                    <input type="text" name="sikr_price_display" id="sikr_price_display"
                        class="form-control input-sm text-right"
                        value="{{ old('sikr_price', $material->sikr_price ?? 0) }}"
                        readonly/>
                    {{-- 送信用 --}}
                    <input type="hidden" name="sikr_price" id="sikr_price_hidden"
                        value="{{ old('sikr_price', $material->sikr_price ?? 0) }}">
                </td>
                <!-- 税額 -->
                <th class="border border-gray-400">{{__('sikr_tax')}}</th>
                <td class="border border-gray-400">
                    {{-- 表示用 --}}
                    <input type="text" name="sikr_tax_display" id="sikr_tax_display"
                        class="form-control input-sm text-right"
                        value="{{ old('sikr_tax', $material->sikr_tax ?? 0) }}"
                        readonly/>
                    {{-- 送信用 --}}
                    <input type="hidden" name="sikr_tax" id="sikr_tax_hidden"
                        value="{{ old('sikr_tax', $material->sikr_tax ?? 0) }}">
                </td>
                <!-- 仕切価格税込 -->
                <th class="border border-gray-400">{{__('sikr_amount')}}</th>
                <td class="border border-gray-400">
                    {{-- 表示用 --}}
                    <input type="text" name="sikr_amount_display" id="sikr_amount_display"
                        class="form-control input-sm text-right"
                        value="{{ old('sikr_amount', $material->sikr_amount ?? 0) }}"
                        readonly/>
                    {{-- 送信用 --}}
                    <input type="hidden" name="sikr_amount" id="sikr_amount_hidden"
                        value="{{ old('sikr_amount', $material->sikr_amount ?? 0) }}">
                </td>
            </tr>
            <tr>
                <!-- 車体価格税抜 -->
                <th class="border border-gray-400">{{__('base_price')}}</th>
                <td class="border border-gray-400">
                    {{-- 表示用 --}}
                    <input type="text" name="base_price_display" id="base_price_display"
                        class="form-control input-sm text-right"
                        value="{{ old('base_price', $material->base_price ?? 0) }}"
                        readonly/>
                    {{-- 送信用 --}}
                    <input type="hidden" name="base_price" id="base_price_hidden"
                        value="{{ old('base_price', $material->base_price ?? 0) }}">
                </td>
                <!-- 税額 -->
                <th class="border border-gray-400">{{__('base_tax')}}</th>
                <td class="border border-gray-400">
                    {{-- 表示用 --}}
                    <input type="text" name="base_tax_display" id="base_tax_display"
                        class="form-control input-sm text-right"
                        value="{{ old('base_tax', $material->base_tax ?? 0) }}"
                        readonly/>
                    {{-- 送信用 --}}
                    <input type="hidden" name="base_tax" id="base_tax_hidden"
                        value="{{ old('base_tax', $material->base_tax ?? 0) }}">
                </td>
                <!-- 車体価格税込 -->
                <th class="border border-gray-400">{{__('base_amount')}}</th>
                <td class="border border-gray-400">
                    {{-- 表示用 --}}
                    <input type="text" name="base_amount_display" id="base_amount_display" data-decimal="false"
                        class="form-control text-right @error('base_amount') is-invalid @enderror"
                        value="{{old('base_amount',number_format($material->base_amount,0 ?? 0))}}"
                        autofocus/>
                    {{-- 送信用 --}}
                    <input type="hidden" name="base_amount" id="base_amount_hidden"
                        value="{{ old('base_amount', $material->base_amount ?? 0) }}">
                    @error('base_amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <!-- 商品テキスト -->
                <th class="border border-gray-400">{{__('text_material')}}</th>
                <td class="border border-gray-400" colspan="3">
                    <input type="text" name="text_material"
                        class="form-control @error('text_material') is-invalid @enderror"
                        value="{{old('text_material',$material->text_material)}}" autofocus/>
                    @error('text_material')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
        </table>

        <!-- 商品備考 -->
        <div calss="w-full flex flex-col">
            <label for="remarks_material" class="font-semibold mt-4">{{__('remarks_material')}}</label><br>
            <textarea name="remarks_material" id="remarks_material" cols="16" rows="3"
                      class="form-control @error('remarks_material') is-invalid @enderror">{{old('remarks_material',$material->remarks_material)}}
            </textarea>
        </div>

        <br>

        <div class="flex space-x-4">
            <a href="{{route('material.index')}}">
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
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script type="text/javascript" src="/js/number-format.js"></script>
    <script type="text/javascript" src="/js/calculator.js"></script>
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
            // NumberFormat 初期化(入力項目のみ)
            ['#engine_display','#special_margin_display','#cr1_display','#cr2_display','#unit_price_display','#base_amount_display']
                .forEach(id => NumberFormat.init(id));

            // 計算セットアップ
            const calcUnit = setupCalculatorInMaterial({
                unitPriceInput:'#unit_price_display',
                unitTaxOutput:'#unit_tax_display',
                unitAmountOutput:'#unit_amount_display',
                bcmarginOutput:'#basic_margin',
                spmarginInput:'#special_margin_display',
                cr1Input:'#cr1_display_display',
                cr2Input:'#cr2_display_display',
                grossPriceOutput:'#sikr_price_display',
                grossTaxOutput:'#sikr_tax_display',
                grossAmountOutut:'#sikr_amount_display',
                basePriceOutput:'#base_price_display',
                baseTaxOutput:'#base_tax_display',
                baseAmountInput:'#base_amount_display',
                rOutput:'#r',
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
