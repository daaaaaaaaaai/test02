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

        <table class="ztable border-separate border border-gray-400">
            <thead class="text-center">
                <tr>
                    <th class="p-2 border border-gray-300">{{__('number_range')}}</th>
                    <th class="p-2 border border-gray-300">{{__('number_from')}}</th>
                    <th class="p-2 border border-gray-300">{{__('number_to')}}</th>
                    <th class="p-2 border border-gray-300">{{__('number_current')}}</th>
                    <th class="p-2 border border-gray-300">{{__('text')}}</th>
                    <th class="p-2 border border-gray-300">{{__('created_at')}}</th>
                    <th class="p-2 border border-gray-300">{{__('updated_at')}}</th>
                    <th class="p-2 border border-gray-300" colspan=3>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($numberRanges as $numberRange)
                <tr>
                    <td class="p-2 border border-gray-300">{{$numberRange->number_range}}</td>
                    <td class="p-2 border border-gray-300">{{$numberRange->number_from}}</td>
                    <td class="p-2 border border-gray-300">{{$numberRange->number_to}}</td>
                    <td class="p-2 border border-gray-300">{{$numberRange->number_current}}</td>
                    <td class="p-2 border border-gray-300">{{$numberRange->text}}</td>
                    <td class="p-2 border border-gray-300">{{$numberRange->created_at}}</td>
                    <td class="p-2 border border-gray-300">{{$numberRange->updated_at}}</td>
                    <td class="p-2 border border-gray-300">
                        <a href="{{route('numberrange.edit',$numberRange)}}">
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-pen"></span>
                                &nbsp{{__('change')}}
                            </button>
                        </a>
                    </td>
                    <td class="p-2 border border-gray-300">
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
    <link rel="stylesheet" href="css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop