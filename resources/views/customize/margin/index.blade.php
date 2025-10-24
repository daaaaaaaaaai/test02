@extends('adminlte::page')

@section('title', __('Margin'))

@section('content_header')
    <h1>{{__('Margin')}}</h1>
    <div class="text-right flex text-sm">
        <a href="{{route('margin.create')}}">
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
                    <th class="p-2 border border-gray-300">{{__('rate_m')}}</th>
                    <th class="p-2 border border-gray-300">{{__('created_at')}}</th>
                    <th class="p-2 border border-gray-300">{{__('updated_at')}}</th>
                    <th class="p-2 border border-gray-300" colspan=3>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($margins as $margin)
                <tr>
                    <td class="p-2 border border-gray-300">{{$margin->type}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($margin->rate,2)}}</td>
                    <td class="p-2 border border-gray-300">{{$margin->created_at}}</td>
                    <td class="p-2 border border-gray-300">{{$margin->updated_at}}</td>
                    <td class="p-2 border border-gray-300">
                        <a href="{{route('margin.edit',$margin)}}">
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-pen"></span>
                                &nbsp{{__('change')}}
                            </button>
                        </a>
                    </td>
                    <td class="p-2 border border-gray-300">
                        <form method="post" action="{{route('margin.destroy',$margin)}}">
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
                    {{ $margins->links() }}
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