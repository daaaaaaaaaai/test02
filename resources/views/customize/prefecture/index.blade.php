@extends('adminlte::page')

@section('title', __('Prefecture'))

@section('content_header')
    <h1>{{__('Prefecture')}}</h1>
    <div class="text-right flex text-sm">
        <a href="{{route('city.create')}}">
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
                    <th class="p-2 border border-gray-300">{{__('prefecture')}}</th>
                    <th class="p-2 border border-gray-300">{{__('text')}}</th>
                    <th class="p-2 border border-gray-300">{{__('created_at')}}</th>
                    <th class="p-2 border border-gray-300">{{__('updated_at')}}</th>
                    <th class="p-2 border border-gray-300" colspan=3>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prefectures as $prefecture)
                <tr>
                    <td class="p-2 border border-gray-300">{{$prefecture->prefecture}}</td>
                    <td class="p-2 border border-gray-300">{{$prefecture->text}}</td>
                    <td class="p-2 border border-gray-300">{{$prefecture->created_at}}</td>
                    <td class="p-2 border border-gray-300">{{$prefecture->updated_at}}</td>
                    <td class="p-2 border border-gray-300">
                        <a href="{{route('prefecture.edit',$prefecture)}}">
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-pen"></span>
                                &nbsp{{__('change')}}
                            </button>
                        </a>
                    </td>
                    <td class="p-2 border border-gray-300">
                        <form method="post" action="{{route('prefecture.destroy',$prefecture)}}">
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
                    {{ $prefectures->links() }}
                </div>
            </tbody>
        </table>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop