@extends('adminlte::page')

@section('title', __('SuzukiData'))

@section('content_header')
    <h1>{{__('SuzukiData')}}</h1>
    <div class="text-right flex text-sm">
        <a href="{{route('suzukidata.create')}}">
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
                    <th>{{__('start_date')}}</th>
                    <th>{{__('created_at')}}</th>
                    <th>{{__('updated_at')}}</th>
                    <th>{{__('deleted_at')}}</th>
                    <th colspan=3>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
                <tr>
                    <td>{{$data->start_date}}</td>
                    <td>{{$data->created_at}}</td>
                    <td>{{$data->updated_at}}</td>
                    <td>{{$data->deleted_at}}</td>
                    <td class="text-center">
                        <a href="{{route('suzukidata.edit',$data)}}">
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-pen"></span>
                                &nbsp{{__('change')}}
                            </button>
                        </a>
                    </td>
                    <td class="text-center">
                        <form method="post" action="{{route('suzukidata.destroy',$data->start_date)}}">
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
                    {{ $datas->links() }}
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