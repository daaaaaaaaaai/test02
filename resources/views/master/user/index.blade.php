@extends('adminlte::page')

@section('title', __('User Control'))

@section('content_header')
    <h1>{{__('User Control')}}</h1>
    <div class="text-right flex text-sm">
        <a href="{{route('user.create')}}" class="text-right flex">
            <button class="btn btn-primary">
                <span class="fas fa-solid fa-plus"></span>
                &nbsp{{__('create')}}
            </button>
        </a>
    </div>
@stop

@section('content')
    <div class="mx-auto px-6 text-sm">
        <x-message :message="session('message')" />

        <table class="ztable border-separate border border-gray-400">
            <thead class="text-center">
                <tr>
                    <th class="p-2 border border-gray-300">{{__('user_id')}}</th>
                    <th class="p-2 border border-gray-300">{{__('user_name')}}</th>
                    <th class="p-2 border border-gray-300">{{__('authority')}}</th>
                    <th class="p-2 border border-gray-300">{{__('email')}}</th>
                    <th class="p-2 border border-gray-300">{{__('created_at')}}</th>
                    <th class="p-2 border border-gray-300">{{__('updated_at')}}</th>
                    <th class="p-2 border border-gray-300">{{__('deleted_at')}}</th>
                    <th class="p-2 border border-gray-300" colspan=3>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="p-2 border border-gray-300">{{$user->user_id}}</td>
                    <td class="p-2 border border-gray-300">{{$user->name}}</td>
                    <td class="p-2 border border-gray-300">{{$user->authority}}</td>
                    <td class="p-2 border border-gray-300">{{$user->email}}</td>
                    <td class="p-2 border border-gray-300">{{$user->created_at}}</td>
                    <td class="p-2 border border-gray-300">{{$user->updated_at}}</td>
                    <td class="p-2 border border-gray-300">{{$user->deleted_at}}</td>
                    <td class="p-2 border border-gray-300">
                        <a href="{{route('user.edit',$user)}}">
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-pen"></span>
                                &nbsp{{__('change')}}
                            </button>
                        </a>
                    </td>
                    <td class="p-2 border border-gray-300">
                        <form method="post" action="{{route('user.destroy',$user)}}">
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
                    {{ $users->links() }}
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