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
                        @foreach ($classes as $class)
                            <option value="{{$class->class_code}}"
                                        {{old('class_code',$material->class_code)===$class->class_code ? 'selected' : ''}}>
                                {{$class->class_name}}
                            </option>
                        @endforeach
                    </select>
                    @error('class_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
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
            </tr>
            <tr>
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
                <!-- 数量単位 -->
                <th class="border border-gray-400">{{__('unit')}}</th>
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
            </tr>
            <tr>
                <!-- 納準種別 -->
                <th class="border border-gray-400">{{__('payment_type')}}</th>
                <td class="border border-gray-400">
                    <select name="payment_type" class="form-control">
                        <option value="">{{__('select value')}}</option>
                        @foreach ($payment_types as $payment_type)
                            <option value="{{$payment_type->value}}"
                                        {{old('payment_type',$material->payment_type)===$payment_type->value ? 'selected' : ''}}>
                                {{$payment_type->text}}
                            </option>
                        @endforeach
                    </select>
                </td>
                <!-- 自賠責種別 -->
                <th class="border border-gray-400">{{__('cali_type')}}</th>
                <td class="border border-gray-400">
                    <select name="cali_type" class="form-control">
                        <option value="">{{__('select value')}}</option>
                        @foreach ($cali_types as $cali_type)
                            <option value="{{$cali_type->value}}"
                                        {{old('cali_type',$material->cali_type)===$cali_type->value ? 'selected' : ''}}>
                                {{$cali_type->text}}
                            </option>
                        @endforeach
                    </select>
                </td>
                <!-- 盗難種別 -->
                <th class="border border-gray-400">{{__('theft_type')}}</th>
                <td class="border border-gray-400">
                    <select name="theft_type" class="form-control">
                        <option value="">{{__('select value')}}</option>
                        @foreach ($theft_types as $theft_type)
                            <option value="{{$theft_type->value}}"
                                        {{old('theft_type',$material->theft_type)===$theft_type->value ? 'selected' : ''}}>
                                {{$theft_type->text}}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <!-- CR1種別① -->
                <th class="border border-gray-400">{{__('cr1_type1')}}</th>
                <td class="border border-gray-400">
                    <select name="cr1_type1" class="form-control">
                        <option value="">{{__('select value')}}</option>
                        @foreach ($cr1_types1 as $cr1_type1)
                            <option value="{{$cr1_type1->value}}"
                                        {{old('cr1_type1',$material->cr1_type1)===$cr1_type1->value ? 'selected' : ''}}>
                                {{$cr1_type1->text}}
                            </option>
                        @endforeach
                    </select>
                </td>
                <!-- CR1種別② -->
                <th class="border border-gray-400">{{__('cr1_type2')}}</th>
                <td class="border border-gray-400">
                    <select name="cr1_type2" class="form-control">
                        <option value="">{{__('select value')}}</option>
                        @foreach ($cr1_types2 as $cr1_type2)
                            <option value="{{$cr1_type2->value}}"
                                        {{old('cr1_type2',$material->cr1_type2)===$cr1_type2->value ? 'selected' : ''}}>
                                {{$cr1_type2->text}}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <!-- ZR延長種別 -->
                <th class="border border-gray-400">{{__('zrex_type')}}</th>
                <td class="border border-gray-400">
                    <select name="zrex_type" class="form-control">
                        <option value="">{{__('select value')}}</option>
                        @foreach ($zrex_types as $zrex_type)
                            <option value="{{$zrex_type->value}}"
                                        {{old('zrex_type',$material->zrex_type)===$zrex_type->value ? 'selected' : ''}}>
                                {{$zrex_type->text}}
                            </option>
                        @endforeach
                    </select>
                </td>
                <!-- ZR車両種別 -->
                <th class="border border-gray-400">{{__('zrmt_type')}}</th>
                <td class="border border-gray-400">
                    <select name="zrmt_type" class="form-control">
                        <option value="">{{__('select value')}}</option>
                        @foreach ($zrmt_types as $zrmt_type)
                            <option value="{{$zrmt_type->value}}"
                                        {{old('zrmt_type',$material->zrmt_type)===$zrmt_type->value ? 'selected' : ''}}>
                                {{$zrmt_type->text}}
                            </option>
                        @endforeach
                    </select>
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

        <br>

        <!-- カラー -->
        <table class="zmente text-sm">
            <colgroup>
                <col width="20%"/>
                <col width="20%"/>
                <col width="20%"/>
                <col width="20%"/>
                <col width="20%"/>
            </colgroup>
            <!-- ヘッダ -->
            <tr>
                <th class="border border-gray-400">{{__('color_code01')}}</th>
                <th class="border border-gray-400">{{__('color_code02')}}</th>
                <th class="border border-gray-400">{{__('color_code03')}}</th>
                <th class="border border-gray-400">{{__('color_code04')}}</th>
                <th class="border border-gray-400">{{__('color_code05')}}</th>
            </tr>
            <!-- 色コード選択 -->
            <tr>
                <td class="border border-gray-400">
                    <select name="color_code01" class="form-control">
                        <option value="">{{__('select value')}}</option>
                        @foreach ($colors as $color)
                            <option value="{{$color->color_code}}"
                                        {{old('color_code01',$material->color_code01)===$color->color_code ? 'selected' : ''}}>
                                {{$color->color_code}} {{$color->color_name1}} ** {{$color->color_name2}}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td class="border border-gray-400">
                    <select name="color_code02" class="form-control">
                        <option value="">{{__('select value')}}</option>
                        @foreach ($colors as $color)
                            <option value="{{$color->color_code}}"
                                        {{old('color_code02',$material->color_code02)===$color->color_code ? 'selected' : ''}}>
                                {{$color->color_code}} {{$color->color_name1}} ** {{$color->color_name2}}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td class="border border-gray-400">
                    <select name="color_code03" class="form-control">
                        <option value="">{{__('select value')}}</option>
                        @foreach ($colors as $color)
                            <option value="{{$color->color_code}}"
                                        {{old('color_code03',$material->color_code03)===$color->color_code ? 'selected' : ''}}>
                                {{$color->color_code}} {{$color->color_name1}} ** {{$color->color_name2}}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td class="border border-gray-400">
                    <select name="color_code04" class="form-control">
                        <option value="">{{__('select value')}}</option>
                        @foreach ($colors as $color)
                            <option value="{{$color->color_code}}"
                                        {{old('color_code04',$material->color_code04)===$color->color_code ? 'selected' : ''}}>
                                {{$color->color_code}} {{$color->color_name1}} ** {{$color->color_name2}}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td class="border border-gray-400">
                    <select name="color_code05" class="form-control">
                        <option value="">{{__('select value')}}</option>
                        @foreach ($colors as $color)
                            <option value="{{$color->color_code}}"
                                        {{old('color_code05',$material->color_code05)===$color->color_code ? 'selected' : ''}}>
                                {{$color->color_code}} {{$color->color_name1}} ** {{$color->color_name2}}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <!-- 色コード -->
            <tr>
                <td class="border border-gray-400">
                    <input type="text" name="color_code01_txt"
                        class="form-control"
                        value="{{old('color_code01',$material->color_code01)}}"
                        readonly autofocus/>
                </td>
                <td class="border border-gray-400">
                    <input type="text" name="color_code02_txt"
                        class="form-control"
                        value="{{old('color_code02',$material->color_code02)}}"
                        readonly autofocus/>
                </td>
                <td class="border border-gray-400">
                    <input type="text" name="color_code03_txt"
                        class="form-control"
                        value="{{old('color_code03',$material->color_code03)}}"
                        readonly autofocus/>
                </td>
                <td class="border border-gray-400">
                    <input type="text" name="color_code04_txt"
                        class="form-control"
                        value="{{old('color_code04',$material->color_code04)}}"
                        readonly autofocus/>
                </td>
                <td class="border border-gray-400">
                    <input type="text" name="color_code05_txt"
                        class="form-control"
                        value="{{old('color_code05',$material->color_code05)}}"
                        readonly autofocus/>
                </td>
            </tr>
            <!-- 色名1 -->
            <tr>
                <td class="border border-gray-400">
                    <input type="text" name="color_name1_01"
                        class="form-control"
                        value="{{old('color_name1_01')}}"
                        readonly autofocus/>
                </td>
                <td class="border border-gray-400">
                    <input type="text" name="color_name1_02"
                        class="form-control"
                        value="{{old('color_name1_02')}}"
                        readonly autofocus/>
                </td>
                <td class="border border-gray-400">
                    <input type="text" name="color_name1_03"
                        class="form-control"
                        value="{{old('color_name1_03')}}"
                        readonly autofocus/>
                </td>
                <td class="border border-gray-400">
                    <input type="text" name="color_name1_04"
                        class="form-control"
                        value="{{old('color_name1_04')}}"
                        readonly autofocus/>
                </td>
                <td class="border border-gray-400">
                    <input type="text" name="color_name1_05"
                        class="form-control"
                        value="{{old('color_name1_05')}}"
                        readonly autofocus/>
                </td>
            </tr>
            <!-- 色名2 -->
            <tr>
                <td class="border border-gray-400">
                    <input type="text" name="color_name2_01"
                        class="form-control"
                        value="{{old('color_name2_01')}}"
                        readonly autofocus/>
                </td>
                <td class="border border-gray-400">
                    <input type="text" name="color_name2_02"
                        class="form-control"
                        value="{{old('color_name2_02')}}"
                        readonly autofocus/>
                </td>
                <td class="border border-gray-400">
                    <input type="text" name="color_name2_03"
                        class="form-control"
                        value="{{old('color_name2_03')}}"
                        readonly autofocus/>
                </td>
                <td class="border border-gray-400">
                    <input type="text" name="color_name2_04"
                        class="form-control"
                        value="{{old('color_name2_04')}}"
                        readonly autofocus/>
                </td>
                <td class="border border-gray-400">
                    <input type="text" name="color_name2_05"
                        class="form-control"
                        value="{{old('color_name2_05')}}"
                        readonly autofocus/>
                </td>
            </tr>
        </table>

        <br>

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
            ['#engine_display']
                .forEach(id => NumberFormat.init(id));
        });
    </script>
@stop
