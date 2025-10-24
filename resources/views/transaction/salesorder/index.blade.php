@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1>{{$title}}</h1>
    <div class="text-right flex text-sm">
        <a href="{{route('salesorder.create')}}">
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
                    <th class="p-2 border border-gray-300">{{__('order_number')}}</th>
                    <th class="p-2 border border-gray-300">{{__('order_date')}}</th>
                    <th class="p-2 border border-gray-300">{{__('cust_code')}}</th>
                    <th class="p-2 border border-gray-300">{{__('staff_id')}}</th>
                    <th class="p-2 border border-gray-300">{{__('tax_code')}}</th>
                    <th class="p-2 border border-gray-300">{{__('gross_price')}}</th>
                    <th class="p-2 border border-gray-300">{{__('gross_tax')}}</th>
                    <th class="p-2 border border-gray-300">{{__('gross_amount')}}</th>
                    <th class="p-2 border border-gray-300">{{__('text_header')}}</th>
                    <th class="p-2 border border-gray-300">{{__('remarks_header')}}</th>
                    <th class="p-2 border border-gray-300">{{__('order_type')}}</th>
                    <th class="p-2 border border-gray-300">{{__('order_status')}}</th>
                    <th class="p-2 border border-gray-300">{{__('created_at')}}</th>
                    <th class="p-2 border border-gray-300">{{__('updated_at')}}</th>
                    <th class="p-2 border border-gray-300">{{__('deleted_at')}}</th>
                    <th class="p-2 border border-gray-300" colspan=3>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($headers as $header)
                <tr>
                    <td class="p-2 border border-gray-300">{{$header->order_number}}</td>
                    <td class="p-2 border border-gray-300">{{$header->order_date}}</td>
                    <td class="p-2 border border-gray-300">{{$header->cust_code}}</td>
                    <td class="p-2 border border-gray-300">{{$header->staff_id}}</td>
                    <td class="p-2 border border-gray-300">{{$header->tax_code}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($header->gross_price,0)}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($header->gross_tax,0)}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($header->gross_amount,0)}}</td>
                    <td class="p-2 border border-gray-300">{{$header->text_header}}</td>
                    <td class="p-2 border border-gray-300">{{$header->remarks_header}}</td>
                    <td class="p-2 border border-gray-300">{{$header->order_type}}</td>
                    <td class="p-2 border border-gray-300">{{$header->order_status}}</td>
                    <td class="p-2 border border-gray-300">{{$header->created_at}}</td>
                    <td class="p-2 border border-gray-300">{{$header->updated_at}}</td>
                    <td class="p-2 border border-gray-300">{{$header->deleted_at}}</td>
                    <td class="p-2 border border-gray-300">
                        <a href="{{route('salesorder.edit',$header)}}">
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-pen"></span>
                                &nbsp{{__('change')}}
                            </button>
                        </a>
                    </td>
                    <td class="p-2 border border-gray-300">
                        <form method="post" action="{{route('salesorder.destroy',$header)}}">
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
                    {{ $headers->links() }}
                </div>
            </tbody>
        </table>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('/css/admin_custom.css')}}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop