@extends('adminlte::page')

@section('title', __('CompulsoryAutomobileLiabilityInsurance'))

@section('content_header')
    <h1>{{__('CompulsoryAutomobileLiabilityInsurance')}}</h1>
    <div class="text-right flex text-sm">
        <a href="{{route('cali.create')}}">
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
                    <th class="p-2 border border-gray-300">{{__('month_00')}}</th>
                    <th class="p-2 border border-gray-300">{{__('month_12')}}</th>
                    <th class="p-2 border border-gray-300">{{__('month_24')}}</th>
                    <th class="p-2 border border-gray-300">{{__('month_25')}}</th>
                    <th class="p-2 border border-gray-300">{{__('month_36')}}</th>
                    <th class="p-2 border border-gray-300">{{__('month_37')}}</th>
                    <th class="p-2 border border-gray-300">{{__('month_48')}}</th>
                    <th class="p-2 border border-gray-300">{{__('month_60')}}</th>
                    <th class="p-2 border border-gray-300">{{__('month_99')}}</th>
                    <th class="p-2 border border-gray-300">{{__('receipt_fee')}}</th>
                    <th class="p-2 border border-gray-300">{{__('created_at')}}</th>
                    <th class="p-2 border border-gray-300">{{__('updated_at')}}</th>
                    <th class="p-2 border border-gray-300" colspan=3>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($calis as $cali)
                <tr>
                    <td class="p-2 border border-gray-300">{{$cali->type}}</td>
                    <td class="p-2 border border-gray-300">{{$cali->start_date}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($cali->month_00)}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($cali->month_12)}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($cali->month_24)}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($cali->month_25)}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($cali->month_36)}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($cali->month_37)}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($cali->month_48)}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($cali->month_60)}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($cali->month_99)}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($cali->receipt_fee)}}</td>
                    <td class="p-2 border border-gray-300">{{$cali->created_at}}</td>
                    <td class="p-2 border border-gray-300">{{$cali->updated_at}}</td>
                    <td class="p-2 border border-gray-300">
                        <a href="{{route('cali.edit',$cali)}}">
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-pen"></span>
                                &nbsp{{__('change')}}
                            </button>
                        </a>
                    </td>
                    <td class="p-2 border border-gray-300">
                        <form method="post" action="{{route('cali.destroy',$cali)}}">
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
                    {{ $calis->links() }}
                </div>
            </tbody>
        </table>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop