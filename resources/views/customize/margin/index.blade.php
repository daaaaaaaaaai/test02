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

        <table class="ztable fixed-1">
            <thead class="text-center">
                <tr>
                    <th>{{__('type')}}</th>
                    <th>{{__('rate_m')}}</th>
                    <th>{{__('created_at')}}</th>
                    <th>{{__('updated_at')}}</th>
                    <th colspan=2>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($margins as $margin)
                <tr>
                    <td>{{$margin->type}}</td>
                    <td class="text-right">{{number_format($margin->rate,2)}}</td>
                    <td>{{$margin->created_at}}</td>
                    <td>{{$margin->updated_at}}</td>
                    <td class="text-center">
                        <a href="{{route('margin.edit',$margin)}}">
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-pen"></span>
                                &nbsp{{__('change')}}
                            </button>
                        </a>
                    </td>
                    <td class="text-center">
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