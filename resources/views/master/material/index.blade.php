@extends('adminlte::page')

@section('title', __('Material Control'))

@section('content_header')
    <h1>{{__('Material Control')}}</h1>
    <div class="text-right flex text-sm">
        <a href="{{route('material.create')}}">
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
        <x-message :message="session('message')" class="text-sm" />

        <table class="ztable border-separate border border-gray-400">
            <thead class="text-center">
                <tr>
                    <th class="p-2 border border-gray-300">{{__('material_code')}}</th>
                    <th class="p-2 border border-gray-300">{{__('material_name')}}</th>
                    <th class="p-2 border border-gray-300">{{__('class_code')}}</th>
                    <th class="p-2 border border-gray-300">{{__('model')}}</th>
                    <th class="p-2 border border-gray-300">{{__('engine')}}</th>
                    <th class="p-2 border border-gray-300">{{__('coo')}}</th>
                    <th class="p-2 border border-gray-300">{{__('unit')}}</th>
                    <th class="p-2 border border-gray-300">{{__('type_dlv')}}</th>
                    <th class="p-2 border border-gray-300">{{__('type_cali')}}</th>
                    <th class="p-2 border border-gray-300">{{__('type_theft')}}</th>
                    <th class="p-2 border border-gray-300">{{__('type_cr1_1')}}</th>
                    <th class="p-2 border border-gray-300">{{__('type_cr1_2')}}</th>
                    <th class="p-2 border border-gray-300">{{__('type_zr_ex')}}</th>
                    <th class="p-2 border border-gray-300">{{__('type_zr_moto')}}</th>
                    <th class="p-2 border border-gray-300">{{__('color01')}}</th>
                    <th class="p-2 border border-gray-300">{{__('color02')}}</th>
                    <th class="p-2 border border-gray-300">{{__('color03')}}</th>
                    <th class="p-2 border border-gray-300">{{__('color04')}}</th>
                    <th class="p-2 border border-gray-300">{{__('color05')}}</th>
                    <th class="p-2 border border-gray-300">{{__('base_amount')}}</th>
                    <th class="p-2 border border-gray-300">{{__('text_material')}}</th>
                    <th class="p-2 border border-gray-300">{{__('created_at')}}</th>
                    <th class="p-2 border border-gray-300">{{__('updated_at')}}</th>
                    <th class="p-2 border border-gray-300">{{__('deleted_at')}}</th>
                    <th class="p-2 border border-gray-300" colspan=3>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materials as $material)
                <tr>
                    <td class="p-2 border border-gray-300">{{$material->formatNumber($material->material_code)}}</td>
                    <td class="p-2 border border-gray-300">{{$material->material_name}}</td>
                    <td class="p-2 border border-gray-300">{{$material->class_code}}</td>
                    <td class="p-2 border border-gray-300">{{$material->model}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($material->engine)}}</td>
                    <td class="p-2 border border-gray-300">{{$material->coo}}</td>
                    <td class="p-2 border border-gray-300">{{$material->unit}}</td>
                    <td class="p-2 border border-gray-300">{{$material->payment_type}}</td>
                    <td class="p-2 border border-gray-300">{{$material->type_cali}}</td>
                    <td class="p-2 border border-gray-300">{{$material->type_theft}}</td>
                    <td class="p-2 border border-gray-300">{{$material->type_cr1_1}}</td>
                    <td class="p-2 border border-gray-300">{{$material->type_cr1_2}}</td>
                    <td class="p-2 border border-gray-300">{{$material->type_zr_ex}}</td>
                    <td class="p-2 border border-gray-300">{{$material->type_zr_moto}}</td>
                    <td class="p-2 border border-gray-300">{{$material->color01}}</td>
                    <td class="p-2 border border-gray-300">{{$material->color02}}</td>
                    <td class="p-2 border border-gray-300">{{$material->color03}}</td>
                    <td class="p-2 border border-gray-300">{{$material->color04}}</td>
                    <td class="p-2 border border-gray-300">{{$material->color05}}</td>
                    <td class="p-2 border border-gray-300">{{$material->text_material}}</td>
                    <td class="p-2 border border-gray-300">{{$material->created_at}}</td>
                    <td class="p-2 border border-gray-300">{{$material->updated_at}}</td>
                    <td class="p-2 border border-gray-300">{{$material->deleted_at}}</td>
                    <td class="p-2 border border-gray-300">
                        @if($material->deleted_at===null)
                            <a href="{{route('material.edit',$material)}}">
                                <button class="btn btn-outline-primary">
                                    <span class="fas fa-pen"></span>
                                    &nbsp{{__('change')}}
                                </button>
                            </a>
                        @endif
                    </td>
                    <td class="p-2 border border-gray-300">
                        <form method="post" action="{{route('material.destroy',$material->material_code)}}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-primary">
                                <span class="fas fa-trash"></span>
                                &nbsp{{ $material->trashed() ? __('restore') : __('delete') }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- ページネーション --}}
        <div class="mb-4">
            {{ $materials->links() }}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/admin_custom.css')}}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
