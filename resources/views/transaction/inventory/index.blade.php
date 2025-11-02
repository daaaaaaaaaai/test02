@extends('adminlte::page')

@section('title', __('Inventory'))

@section('content_header')
    <h1>{{__('Inventory')}}</h1>
    <div class="text-right flex text-sm">
        <a href="{{route('inventory.create')}}">
            <button class="btn btn-primary">
                <span class="fas fa-solid fa-plus"></span>
                &nbsp{{__('create')}}
            </button>
        </a>
    </div>
@stop

@section('content')
    <div class="mx-auto px-6 text-sm">
        {{-- メッセージがあれば表示 --}}
        <!-- これもコメント -->
        <x-message :message="session('message')" />

        <table class="ztable fixed-2">
            <thead class="text-center">
                <tr>
                    <th>{{__('material_code')}}</th>
                    <th>{{__('material_name')}}</th>
                    <th>{{__('model')}}</th>
                    <th>{{__('color_code')}}</th>
                    <th>{{__('color_name1')}}</th>
                    <th>{{__('color_name2')}}</th>
                    <th>{{__('body_number')}}</th>
                    <th>{{__('doc_date')}}</th>
                    <th>{{__('quantity')}}</th>
                    <th>{{__('unit')}}</th>
                    <th>{{__('maker_price')}}</th>
                    <th>{{__('gross_price')}}</th>
                    <th>{{__('type_dlv')}}</th>
                    <th>{{__('type_cali')}}</th>
                    <th>{{__('type_theft')}}</th>
                    <th>{{__('type_cr1_1')}}</th>
                    <th>{{__('type_cr1_2')}}</th>
                    <th>{{__('type_zr_ext')}}</th>
                    <th>{{__('type_zr_moto')}}</th>
                    <th>{{__('text_inv')}}</th>
                    <th>{{__('status_inv')}}</th>
                    <th>{{__('mat_doc_no')}}</th>
                    <th>{{__('item_number')}}</th>
                    <th>{{__('created_at')}}</th>
                    <th>{{__('updated_at')}}</th>
                    <th>{{__('deleted_at')}}</th>
                    <th colspan=2>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventories as $inventory)
                <tr>
                    <td>{{$inventory->material_code}}</td>
                    <td>{{$inventory->material_name}}</td>
                    <td>{{$inventory->model}}</td>
                    <td>{{$inventory->color_code}}</td>
                    <td>{{$inventory->color_name1}}</td>
                    <td>{{$inventory->color_name2}}</td>
                    <td>{{$inventory->body_number}}</td>
                    <td>{{$inventory->doc_date}}</td>
                    <td class="text-right">{{number_format($inventory->quantity)}}</td>
                    <td>{{$unit[$inventory->unit] ?? ''}}</td>
                    <td class="text-right">{{number_format($inventory->maker_price)}}</td>
                    <td class="text-right">{{number_format($inventory->gross_price)}}</td>
                    <td>{{$dlv[$inventory->type_dlv] ?? ''}}</td>
                    <td>{{$cali[$inventory->type_cali] ?? ''}}</td>
                    <td>{{$theft[$inventory->type_theft] ?? ''}}</td>
                    <td>{{$cr1_1[$inventory->type_cr1_1] ?? ''}}</td>
                    <td>{{$cr1_2[$inventory->type_cr1_2] ?? ''}}</td>
                    <td>{{$zr_ext[$inventory->type_zr_ext] ?? ''}}</td>
                    <td>{{$zr_moto[$inventory->type_zr_moto] ?? ''}}</td>
                    <td>{{$inventory->text_inv}}</td>
                    <td>{{$st_inv[$inventory->status_inv] ?? ''}}</td>
                    <td>{{$inventory->mat_doc_no}}</td>
                    <td>{{$inventory->item_number}}</td>
                    <td>{{$inventory->created_at}}</td>
                    <td>{{$inventory->updated_at}}</td>
                    <td>{{$inventory->deleted_at}}</td>
                    <td class="text-center">
                        <a href="{{route('inventory.edit',$inventory)}}">
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-pen"></span>
                                &nbsp{{__('change')}}
                            </button>
                        </a>
                    </td>
                    <td class="text-center">
                        <form method="post" action="{{route('inventory.destroy',$inventory)}}">
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
                <div class="mb-4">
                    {{ $inventories->links() }}
                </div>
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