@extends('adminlte::page')

@if ($mode==='create')
    @section('title', __('LisencePlateCost Create'))
@else
    @section('title', __('LisencePlateCost Change'))
@endif

@section('content_header')
    @if($mode==='create')
        <h1>{{__('LisencePlateCost Create')}}</h1>
    @else
        <h1>{{__('LisencePlateCost Change')}}</h1>
    @endif
@stop

@section('content')
    <form method="post"
          action="{{ $mode==='edit'
                        ? route('lisenceplatecost.update',$cost)
                        : route('lisenceplatecost.store') }}">
        @csrf
        @if($mode==='edit') @method('patch') @endif

        <table class="zmente text-sm">
            <colgroup>
                <col width="23%"/>
                <col width="27%"/>
                <col width="23%"/>
                <col width="27%"/>
            </colgroup>
            <tr>
                <!-- 都道府県 -->
                <th class="border border-gray-400">{{__('prefecture')}}<div class="label-required float-right">必須</div></th>
                <td class="border border-gray-400">
                    <select name="prefecture" id="prefecture"
                            class="form-control @error('prefecture') is-invalid @enderror"
                            @if($mode==='edit') readonly @endif autofocus>
                        <option value="">{{__('select value')}}</option>
                        @foreach($prefs as $pref)
                            <option value="{{ $pref->prefecture }}"
                                    {{ old('prefecture',$cost->prefecture)===$pref->prefecture ? 'selected' : '' }}>
                                {{ $pref->text }}
                            </option>
                        @endforeach
                    </select>
                    @error('prefecture')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                <!-- その他 -->
                <th class="border border-gray-400">{{__('pref_etc')}}</th>
                <td class="border border-gray-400">
                    <input type="text" name="pref_etc"
                        placeholder="その他の場合必須"
                        class="form-control @error('pref_etc') is-invalid @enderror"
                        value="{{old('pref_etc',$cost->pref_etc)}}"
                        @if($mode==='edit') readonly @endif autofocus/>
                    @error('pref_etc')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <!-- 仕入価格 -->
                <th class="border border-gray-400">{{__('purchase_price')}}<div class="label-required float-right">必須</div></th>
                <td class="border border-gray-400">
                    {{-- 表示用 --}}
                    <input type="text" name="purchase_price_display" id="purchase_price_display" data-decimal="false"
                        class="form-control text-right @error('purchase_price') is-invalid @enderror"
                        value="{{old('purchase_price',number_format($cost->purchase_price ?? 0))}}"
                        autofocus/>
                    {{-- 送信用 --}}
                    <input type="hidden" name="purchase_price" id="purchase_price_hidden"
                        value="{{ old('purchase_price', $material->purchase_price ?? 0) }}">
                    @error('purchase_price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </tr>
            <tr>
                <!-- 販売価格 -->
                <th class="border border-gray-400">{{__('sales_price')}}<div class="label-required float-right">必須</div></th>
                <td class="border border-gray-400">
                    {{-- 表示用 --}}
                    <input type="text" name="sales_price_display" id="sales_price_display" data-decimal="false"
                        class="form-control text-right @error('sales_price') is-invalid @enderror"
                        value="{{old('sales_price',number_format($cost->sales_price ?? 0))}}"
                        autofocus/>
                    {{-- 送信用 --}}
                    <input type="hidden" name="sales_price" id="sales_price_hidden"
                        value="{{ old('sales_price', $material->sales_price ?? 0) }}">
                    @error('sales_price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </tr>
        </table>

        <div class="flex space-x-4">
            <a href="{{route('lisenceplatecost.index')}}">
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
    <script> console.log('Hi!'); </script>
    <script type="text/javascript" src="/js/number-format.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // NumberFormat 初期化
            ['#purchase_price_display','#sales_price_display']
                .forEach(id => NumberFormat.init(id));
        });
    </script>
@stop
