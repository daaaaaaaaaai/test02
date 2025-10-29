@extends('adminlte::page')

@section('title', __('SuzukiData'))

@section('content_header')
    <h1>{{__('SuzukiData')}}</h1>
@stop

@section('content')
    <div class="mx-auto px-6 text-sm">
        {{-- メッセージがあれば表示 --}}
        <!-- これもコメント -->
        <x-message :message="session('message')" />

        <table class="ztable fixed-2">
            <thead class="text-center">
                <tr>
                    <th>{{__('type')}}</th>
                    <th>{{__('material_code')}}</th>
                    <th>{{__('material_name')}}</th>
                    <th>{{__('maker_price')}}</th>
                    <th>{{__('response_rate')}}</th>
                    <th>{{__('basic_margin')}}</th>
                    <th>{{__('special_margin')}}</th>
                    <th>{{__('gross_price')}}</th>
                    <th>{{__('gross_amount')}}</th>
                    <th>{{__('unit_price')}}</th>
                    <th>{{__('dlv_pre')}}</th>
                    <th>{{__('weight_tax')}}</th>
                    <th>{{__('reg_stamp')}}</th>
                    <th>{{__('license_plate')}}</th>
                    <th>{{__('cali')}}</th>
                    <th>{{__('starting_price')}}</th>
                    <th>{{__('profit')}}</th>
                    <th>{{__('profit_rate')}}</th>
                    <th>{{__('moto_cost_incl_tax')}}</th>
                    <th>{{__('int_weight_tax')}}</th>
                    <th>{{__('int_reg_stamp')}}</th>
                    <th>{{__('int_license_plate')}}</th>
                    <th>{{__('int_cali')}}</th>
                    <th>{{__('cost_amount')}}</th>
                    <th>{{__('type_dlv')}}</th>
                    <th>{{__('type_cali')}}</th>
                    <th>{{__('type_theft')}}</th>
                    <th>{{__('type_cr1_1')}}</th>
                    <th>{{__('type_cr1_2')}}</th>
                    <th>{{__('type_zr_ext')}}</th>
                    <th>{{__('type_zr_moto')}}</th>
                    <th>{{__('type_store')}}</th>
                    <th>{{__('color_code01')}}</th>
                    <th>{{__('color_code02')}}</th>
                    <th>{{__('color_code03')}}</th>
                    <th>{{__('color_code04')}}</th>
                    <th>{{__('color_code05')}}</th>
                    <th>{{__('color_name01')}}</th>
                    <th>{{__('color_name02')}}</th>
                    <th>{{__('color_name03')}}</th>
                    <th>{{__('color_name04')}}</th>
                    <th>{{__('color_name05')}}</th>
                    <th>{{__('text_material')}}</th>
                    <th>{{__('response_code')}}</th>
                    <th>{{__('tax_code')}}</th>
                    <th colspan=3>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
                <tr>
                    <td>{{$data->type}}</td>
                    <td>{{$data->material_code}}</td>
                    <td>{{$data->material_name}}</td>
                    <td>{{$data->maker_price}}</td>
                    <td>{{$data->response_rate}}</td>
                    <td>{{$data->basic_margin}}</td>
                    <td>{{$data->special_margin}}</td>
                    <td>{{$data->gross_price}}</td>
                    <td>{{$data->gross_amount}}</td>
                    <td>{{$data->unit_price}}</td>
                    <td>{{$data->dlv_pre}}</td>
                    <td>{{$data->weight_tax}}</td>
                    <td>{{$data->reg_stamp}}</td>
                    <td>{{$data->license_plate}}</td>
                    <td>{{$data->cali}}</td>
                    <td>{{$data->starting_price}}</td>
                    <td>{{$data->profit}}</td>
                    <td>{{$data->profit_rate}}</td>
                    <td>{{$data->moto_cost_incl_tax}}</td>
                    <td>{{$data->int_weight_tax}}</td>
                    <td>{{$data->int_reg_stamp}}</td>
                    <td>{{$data->int_license_plate}}</td>
                    <td>{{$data->int_cali}}</td>
                    <td>{{$data->cost_amount}}</td>
                    <td>{{$data->type_dlv}}</td>
                    <td>{{$data->type_cali}}</td>
                    <td>{{$data->type_theft}}</td>
                    <td>{{$data->type_cr1_1}}</td>
                    <td>{{$data->type_cr1_2}}</td>
                    <td>{{$data->type_zr_ext}}</td>
                    <td>{{$data->type_zr_moto}}</td>
                    <td>{{$data->type_store}}</td>
                    <td>{{$data->color_code01}}</td>
                    <td>{{$data->color_code02}}</td>
                    <td>{{$data->color_code03}}</td>
                    <td>{{$data->color_code04}}</td>
                    <td>{{$data->color_code05}}</td>
                    <td>{{$data->color_name01}}</td>
                    <td>{{$data->color_name02}}</td>
                    <td>{{$data->color_name03}}</td>
                    <td>{{$data->color_name04}}</td>
                    <td>{{$data->color_name05}}</td>
                    <td>{{$data->text_material}}</td>
                    <td>{{$data->response_code}}</td>
                    <td>{{$data->tax_code}}</td>
                    <td class="text-center">
                        <form method="post" action="{{route('suzukidata.destroy',$data->start_date)}}">
                            @csrf
                            @method('delete')
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-trash"></span>
                                &nbsp{{__('delete')}}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/admin_custom.css')}}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop