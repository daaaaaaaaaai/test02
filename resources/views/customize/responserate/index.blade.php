@extends('adminlte::page')

@section('title', __('ResponseRate'))

@section('content_header')
    <h1>{{__('ResponseRate')}}</h1>
    <div class="text-right flex text-sm">
        <a href="{{route('responserate.create')}}">
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
                    <th class="p-2 border border-gray-300">{{__('response_code')}}</th>
                    <th class="p-2 border border-gray-300">{{__('start_date')}}</th>
                    <th class="p-2 border border-gray-300">{{__('end_date')}}</th>
                    <th class="p-2 border border-gray-300">{{__('response_rate')}}</th>
                    <th class="p-2 border border-gray-300">{{__('text')}}</th>
                    <th class="p-2 border border-gray-300">{{__('created_at')}}</th>
                    <th class="p-2 border border-gray-300">{{__('updated_at')}}</th>
                    <th class="p-2 border border-gray-300" colspan=3>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($responseRates as $responseRate)
                <tr>
                    <td class="p-2 border border-gray-300">{{$responseRate->response_code}}</td>
                    <td class="p-2 border border-gray-300">{{$responseRate->start_date}}</td>
                    <td class="p-2 border border-gray-300">{{$responseRate->end_date}}</td>
                    <td class="p-2 border border-gray-300">{{$responseRate->response_rate}}</td>
                    <td class="p-2 border border-gray-300">{{$responseRate->text}}</td>
                    <td class="p-2 border border-gray-300">{{$responseRate->created_at}}</td>
                    <td class="p-2 border border-gray-300">{{$responseRate->updated_at}}</td>
                    <td class="p-2 border border-gray-300">
                        <a href="{{route('responserate.edit',$responseRate)}}">
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-pen"></span>
                                &nbsp{{__('change')}}
                            </button>
                        </a>
                    </td>
                    <td class="p-2 border border-gray-300">
                        <form method="post" action="{{route('responserate.destroy',$responseRate)}}">
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
                    {{ $responseRates->links() }}
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