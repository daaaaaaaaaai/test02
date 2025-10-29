@extends('adminlte::page')

@section('title', __('Color'))

@section('content_header')
    <h1>{{__('Color')}}</h1>
    <div class="text-right flex text-sm">
        <a href="{{route('color.create')}}">
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
                    <th>{{__('color_code')}}</th>
                    <th>{{__('color_name1')}}</th>
                    <th>{{__('color_name2')}}</th>
                    <th>{{__('created_at')}}</th>
                    <th>{{__('updated_at')}}</th>
                    <th colspan=2>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($colors as $color)
                <tr>
                    <td>{{$color->color_code}}</td>
                    <td>{{$color->color_name1}}</td>
                    <td>{{$color->color_name2}}</td>
                    <td>{{$color->created_at}}</td>
                    <td>{{$color->updated_at}}</td>
                    <td class="text-center">
                        <a href="{{route('color.edit',$color)}}">
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-pen"></span>
                                &nbsp{{__('change')}}
                            </button>
                        </a>
                    </td>
                    <td class="text-center">
                        <form method="post" action="{{route('color.destroy',$color)}}">
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
                    {{ $colors->links() }}
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