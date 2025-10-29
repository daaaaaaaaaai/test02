@extends('adminlte::page')

@section('title', __('NumberRange'))

@section('content_header')
    <h1>{{__('NumberRange')}}</h1>
    <div class="text-right flex text-sm">
        <a href="{{route('numberrange.create')}}">
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

        <table class="ztable fixed-1">
            <thead class="text-center">
                <tr>
                    <th>{{__('number_range')}}</th>
                    <th>{{__('number_from')}}</th>
                    <th>{{__('number_to')}}</th>
                    <th>{{__('number_current')}}</th>
                    <th>{{__('text')}}</th>
                    <th>{{__('created_at')}}</th>
                    <th>{{__('updated_at')}}</th>
                    <th colspan=2>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($numberRanges as $numberRange)
                <tr>
                    <td>{{$numberRange->number_range}}</td>
                    <td>{{$numberRange->number_from}}</td>
                    <td>{{$numberRange->number_to}}</td>
                    <td>{{$numberRange->number_current}}</td>
                    <td>{{$numberRange->text}}</td>
                    <td>{{$numberRange->created_at}}</td>
                    <td>{{$numberRange->updated_at}}</td>
                    <td class="text-center">
                        <a href="{{route('numberrange.edit',$numberRange)}}">
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-pen"></span>
                                &nbsp{{__('change')}}
                            </button>
                        </a>
                    </td>
                    <td class="text-center">
                        <form method="post" action="{{route('numberrange.destroy',$numberRange)}}">
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
                    {{ $numberRanges->links() }}
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