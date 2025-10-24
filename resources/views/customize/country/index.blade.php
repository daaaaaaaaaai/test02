@extends('adminlte::page')

@section('title', __('Country'))

@section('content_header')
    <h1>{{__('Country')}}</h1>
    <div class="text-right flex text-sm">
        <a href="{{route('country.create')}}">
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
                    <th class="p-2 border border-gray-300">{{__('country_code')}}</th>
                    <th class="p-2 border border-gray-300">{{__('country_name_j')}}</th>
                    <th class="p-2 border border-gray-300">{{__('country_name_e')}}</th>
                    <th class="p-2 border border-gray-300">{{__('country_code_a3')}}</th>
                    <th class="p-2 border border-gray-300">{{__('country_code_n3')}}</th>
                    <th class="p-2 border border-gray-300">{{__('created_at')}}</th>
                    <th class="p-2 border border-gray-300">{{__('updated_at')}}</th>
                    <th class="p-2 border border-gray-300" colspan=3>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($countries as $country)
                <tr>
                    <td class="p-2 border border-gray-300">{{$country->country_code}}</td>
                    <td class="p-2 border border-gray-300">{{$country->country_name_j}}</td>
                    <td class="p-2 border border-gray-300">{{$country->country_name_e}}</td>
                    <td class="p-2 border border-gray-300">{{$country->country_code_a3}}</td>
                    <td class="p-2 border border-gray-300">{{$country->country_code_n3}}</td>
                    <td class="p-2 border border-gray-300">{{$country->created_at}}</td>
                    <td class="p-2 border border-gray-300">{{$country->updated_at}}</td>
                    <td class="p-2 border border-gray-300">
                        <a href="{{route('country.edit',$country)}}">
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-pen"></span>
                                &nbsp{{__('change')}}
                            </button>
                        </a>
                    </td>
                    <td class="p-2 border border-gray-300">
                        <form method="post" action="{{route('country.destroy',$country)}}">
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
        {{-- ページネーション --}}
        <div class="mb-4">
            {{ $countries->links() }}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/admin_custom.css')}}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop