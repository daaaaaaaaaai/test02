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

        <table class="ztable fixed-1">
            <thead class="text-center">
                <tr>
                    <th>{{__('distance')}}</th>
                    <th>{{__('cost')}}</th>
                    <th>{{__('created_at')}}</th>
                    <th>{{__('updated_at')}}</th>
                    <th colspan=2>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rcosts as $rcost)
                <tr>
                    <td>{{$rcost->distance}}</td>
                    <td class="text-right">{{number_format($rcost->cost)}}</td>
                    <td>{{$rcost->created_at}}</td>
                    <td>{{$rcost->updated_at}}</td>
                    <td class="text-center">
                        <a href="{{route('remotecost.edit',$rcost)}}">
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-pen"></span>
                                &nbsp{{__('change')}}
                            </button>
                        </a>
                    </td>
                    <td class="text-center">
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
    <link rel="stylesheet" href="{{asset('css/admin_custom.css')}}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop