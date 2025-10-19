@extends('adminlte::page')

@section('title', __('RemoteCost'))

@section('content_header')
    <h1>{{__('RemoteCost')}}</h1>
    <div class="text-right flex text-sm">
        <a href="{{route('remotecost.create')}}">
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
                    <th class="p-2 border border-gray-300">{{__('distance')}}</th>
                    <th class="p-2 border border-gray-300">{{__('cost')}}</th>
                    <th class="p-2 border border-gray-300">{{__('created_at')}}</th>
                    <th class="p-2 border border-gray-300">{{__('updated_at')}}</th>
                    <th class="p-2 border border-gray-300" colspan=3>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rcosts as $rcost)
                <tr>
                    <td class="p-2 border border-gray-300">{{$rcost->distance}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($rcost->cost)}}</td>
                    <td class="p-2 border border-gray-300">{{$rcost->created_at}}</td>
                    <td class="p-2 border border-gray-300">{{$rcost->updated_at}}</td>
                    <td class="p-2 border border-gray-300">
                        <a href="{{route('remotecost.edit',$rcost)}}">
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-pen"></span>
                                &nbsp{{__('change')}}
                            </button>
                        </a>
                    </td>
                    <td class="p-2 border border-gray-300">
                        <form method="post" action="{{route('remotecost.destroy',$rcost)}}">
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
                    {{ $rcosts->links() }}
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