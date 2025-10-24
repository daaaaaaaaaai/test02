@extends('adminlte::page')

@if ($mode==='create')
    @section('title', __('Customer Create'))
@else
    @section('title', __('Customer Change'))
@endif

@section('content_header')
    @if($mode==='create')
        <h1>{{__('Customer Create')}}</h1>
    @else
        <h1>{{__('Customer Change')}}</h1>
    @endif
@stop

@section('content')
    <form method="post"
          action="{{ $mode==='edit'
                        ? route('customer.update',$customer->cust_code)
                        : route('customer.store') }}">
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
                <!-- 顧客コード -->
                <th class="border border-gray-400">{{__('cust_code')}}</th>
                <td class="border border-gray-400">
                    <input type="text" name="cust_code"
                        placeholder="未入力時は自動採番"
                        class="form-control @error('cust_code') is-invalid @enderror"
                        value="{{old('cust_code',$customer->formatNumber($customer->cust_code))}}"
                        @if($mode==='edit') readonly @endif autofocus/>
                    @error('cust_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <!-- 姓 -->
                <th class="border border-gray-400">{{__('name_last')}}<div class="label-required float-right">必須</div></th>
                <td class="border border-gray-400">
                    <input type="text" name="name_last"
                        placeholder="山田"
                        class="form-control @error('name_last') is-invalid @enderror"
                        value="{{old('name_last',$customer->name_last)}}" autofocus/>
                    @error('name_last')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                <!-- 名 -->
                <th class="border border-gray-400">{{__('name_first')}}</th>
                <td class="border border-gray-400">
                    <input type="text" name="name_first"
                        placeholder="太郎"
                        class="form-control @error('name_first') is-invalid @enderror"
                        value="{{old('name_first',$customer->name_first)}}" autofocus/>
                    @error('name_first')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <!-- 姓(カナ) -->
                <th class="border border-gray-400">{{__('name_last_kana')}}<div class="label-required float-right">必須</div></th>
                <td class="border border-gray-400">
                    <input type="text" name="name_last_kana"
                        placeholder="ヤマダ"
                        class="form-control @error('name_last_kana') is-invalid @enderror"
                        value="{{old('name_last_kana',$customer->name_last_kana)}}" autofocus/>
                    @error('name_last_kana')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                <!-- 名(カナ) -->
                <th class="border border-gray-400">{{__('name_first_kana')}}</th>
                <td class="border border-gray-400">
                    <input type="text" name="name_first_kana"
                        placeholder="タロウ"
                        class="form-control @error('name_first_kana') is-invalid @enderror"
                        value="{{old('name_first_kana',$customer->name_first_kana)}}" autofocus/>
                    @error('name_first_kana')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
        </table>
        <br>
        <table class="zmente text-sm">
            <colgroup>
                <col width="23%"/>
                <col width="27%"/>
                <col width="23%"/>
                <col width="27%"/>
            </colgroup>
            <tr>
                <!-- 郵便番号 -->
                <th class="border border-gray-400">{{__('zipcode')}}</th>
                <td class="border border-gray-400">
                    <input type="text" name="zipcode" id="zipcode" maxlength="7"
                        placeholder="0010001"
                        class="form-control @error('zipcode') is-invalid @enderror"
                        value="{{old('zipcode',$customer->zipcode)}}" autofocus/>
                    @error('zipcode')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                <td>
                    <button type="button" id="searchZip" class="btn outline-primary text-sm">住所検索</button>
                </td>
            </tr>
                <!-- 都道府県 -->
                <th class="border border-gray-400">{{__('prefecture')}}</th>
                <td class="border border-gray-400">
                    <select name="prefecture" id="prefecture"
                            class="form-control @error('prefecture') is-invalid @enderror">
                        <option value="">{{__('select value')}}</option>
                        @foreach($prefectures as $pref)
                            <option value="{{ $pref->prefecture }}">{{ $pref->text }}</option>
                        @endforeach
                    </select>
                </td>
            <tr>
                <!-- 市区町村・番地 -->
                <th class="border border-gray-400">{{__('city')}}</th>
                <td class="border border-gray-400" colspan=3>
                    <input type="text" name="city" id="city"
                        placeholder="市区町村・番地"
                        class="form-control @error('city') is-invalid @enderror"
                        value="{{old('city',$customer->city)}}" autofocus/>
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
                <!-- 建物名・部屋番号など -->
                <th class="border border-gray-400">{{__('address')}}</th>
                <td class="border border-gray-400" colspan=3>
                    <input type="text" name="address" id="address"
                        placeholder="建物名・部屋番号など"
                        class="form-control @error('address') is-invalid @enderror"
                        value="{{old('address',$customer->address)}}" autofocus/>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            <tr>
                <!-- 電話番号1 -->
                <th class="border border-gray-400">{{__('tel1')}}</th>
                <td class="border border-gray-400">
                    <input type="text" name="tel1"
                        placeholder="0699991234"
                        class="form-control @error('tel1') is-invalid @enderror"
                        value="{{old('tel1',$customer->tel1)}}" autofocus/>
                    @error('tel1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                <!-- 電話番号2 -->
                <th class="border border-gray-400">{{__('tel2')}}</th>
                <td class="border border-gray-400">
                    <input type="text" name="tel2"
                        placeholder="09099991234"
                        class="form-control @error('tel2') is-invalid @enderror"
                        value="{{old('tel2',$customer->tel2)}}" autofocus/>
                    @error('tel2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <!-- メールアドレス -->
                <th class="border border-gray-400">{{__('email')}}</th>
                <td class="border border-gray-400">
                    <input type="text" name="email"
                        placeholder="yamada@hoge.com"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{old('email',$customer->email)}}" autofocus/>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <!-- LINE登録 -->
                <th class="border border-gray-400">{{__('line')}}</th>
                {{-- flg="1"はチェックONにする --}}
                <td class="p-2">
                    <input type="checkbox" name="is_line" value="1" <?php echo ($customer->line == 1) ? 'checked' : ''; ?>>
                </td>
                @error('line')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </tr>
        </table>

        <div class="flex space-x-4">
            <a href="{{route('customer.index')}}">
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
    <link rel="stylesheet" href="css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script type="text/javascript" src="js/search_zip.js"></script>
@stop
