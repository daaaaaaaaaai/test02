@extends('adminlte::page')

@section('title', __('StatusValue'))

@section('content_header')
    <h1>{{__('StatusValue')}}</h1>
    <div class="text-right flex text-sm">
        <a href="{{route('statusvalue.create')}}">
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
                    <th>{{__('status')}}</th>
                    <th>{{__('value')}}</th>
                    <th>{{__('text')}}</th>
                    <th>{{__('created_at')}}</th>
                    <th>{{__('updated_at')}}</th>
                    <th colspan=2>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($values as $value)
                <tr>
                    <td>{{$stats[$value->status] ?? ''}}</td>
                    <td>{{$value->value}}</td>
                    <td>{{$value->text}}</td>
                    <td>{{$value->created_at}}</td>
                    <td>{{$value->updated_at}}</td>
                    <td class="text-center">
                        <a href="{{route('statusvalue.edit',$value)}}">
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-pen"></span>
                                &nbsp{{__('change')}}
                            </button>
                        </a>
                    </td>
                    <td class="text-center">
                        <form method="post" action="{{route('statusvalue.destroy',$value)}}">
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