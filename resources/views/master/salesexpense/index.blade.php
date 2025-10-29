@extends('adminlte::page')

@section('title', __('SalesExpense'))

@section('content_header')
    <h1>{{__('SalesExpense')}}</h1>
    <div class="text-right flex text-sm">
        <a href="{{route('salesexpense.create')}}">
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

        <table class="ztable border-separate border border-gray-400">
            <thead class="text-center">
                <tr>
                    <th class="p-2 border border-gray-300">{{__('type')}}</th>
                    <th class="p-2 border border-gray-300">{{__('start_date')}}</th>
                    <th class="p-2 border border-gray-300">{{__('dlv_pre')}}</th>
                    <th class="p-2 border border-gray-300">{{__('weight_tax')}}</th>
                    <th class="p-2 border border-gray-300">{{__('reg_stamp')}}</th>
                    <th class="p-2 border border-gray-300">{{__('license_plate')}}</th>
                    <th class="p-2 border border-gray-300">{{__('license_plate_cost')}}</th>
                    <th class="p-2 border border-gray-300">{{__('setup_cost')}}</th>
                    <th class="p-2 border border-gray-300">{{__('created_at')}}</th>
                    <th class="p-2 border border-gray-300">{{__('updated_at')}}</th>
                    <th class="p-2 border border-gray-300">{{__('deleted_at')}}</th>
                    <th class="p-2 border border-gray-300" colspan=3>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($exps as $exp)
                <tr>
                    <td class="p-2 border border-gray-300">{{$vals03[$exp->type ?? '']}}</td>
                    <td class="p-2 border border-gray-300">{{$exp->start_date}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($exp->dlv_pre)}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($exp->weight_tax)}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($exp->reg_stamp)}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($exp->license_plate)}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($exp->license_plate_cost)}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($exp->setup_cost)}}</td>
                    <td class="p-2 border border-gray-300">{{$exp->created_at}}</td>
                    <td class="p-2 border border-gray-300">{{$exp->updated_at}}</td>
                    <td class="p-2 border border-gray-300">{{$exp->deleted_at}}</td>
                    <td class="p-2 border border-gray-300">
                        <a href="{{route('salesexpense.edit',$exp)}}">
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-pen"></span>
                                &nbsp{{__('change')}}
                            </button>
                        </a>
                    </td>
                    <td class="p-2 border border-gray-300">
                        <form method="post" action="{{route('salesexpense.destroy',$exp)}}">
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
                    {{ $exps->links() }}
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