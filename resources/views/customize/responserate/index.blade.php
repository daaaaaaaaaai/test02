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

        <table class="ztable fixed-2">
            <thead class="text-center">
                <tr>
                    <th>{{__('response_code')}}</th>
                    <th>{{__('start_date')}}</th>
                    <th>{{__('end_date')}}</th>
                    <th>{{__('response_rate')}}</th>
                    <th>{{__('text')}}</th>
                    <th>{{__('created_at')}}</th>
                    <th>{{__('updated_at')}}</th>
                    <th colspan=2>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($responseRates as $responseRate)
                <tr>
                    <td>{{$responseRate->response_code}}</td>
                    <td>{{$responseRate->start_date}}</td>
                    <td>{{$responseRate->end_date}}</td>
                    <td class="text-right">{{number_format($responseRate->response_rate,1)}}</td>
                    <td>{{$responseRate->text}}</td>
                    <td>{{$responseRate->created_at}}</td>
                    <td>{{$responseRate->updated_at}}</td>
                    <td class="text-center">
                        <a href="{{route('responserate.edit',$responseRate)}}">
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-pen"></span>
                                &nbsp{{__('change')}}
                            </button>
                        </a>
                    </td>
                    <td class="text-center">
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