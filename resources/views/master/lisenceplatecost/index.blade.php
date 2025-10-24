@extends('adminlte::page')

@section('title', __('LisencePlateCost Control'))

@section('content_header')
    <h1>{{__('LisencePlateCost Control')}}</h1>
    <div class="text-right flex text-sm">
        <a href="{{route('lisenceplatecost.create')}}">
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
        <x-message :message="session('message')" class="text-sm" />

        <table class="ztable border-separate border border-gray-400">
            <thead class="text-center">
                <tr>
                    <th class="p-2 border border-gray-300">{{__('prefecture')}}</th>
                    <th class="p-2 border border-gray-300">{{__('pref_etc')}}</th>
                    <th class="p-2 border border-gray-300">{{__('purchase_price')}}</th>
                    <th class="p-2 border border-gray-300">{{__('sales_price')}}</th>
                    <th class="p-2 border border-gray-300">{{__('created_at')}}</th>
                    <th class="p-2 border border-gray-300">{{__('updated_at')}}</th>
                    <th class="p-2 border border-gray-300">{{__('deleted_at')}}</th>
                    <th class="p-2 border border-gray-300" colspan=3>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($costs as $cost)
                <tr>
                    <td class="p-2 border border-gray-300">{{$cost->prefecture}}</td>
                    <td class="p-2 border border-gray-300">{{$cost->pref_etc}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($cost->purchase_price)}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($cost->sales_price)}}</td>
                    <td class="p-2 border border-gray-300">{{$cost->created_at}}</td>
                    <td class="p-2 border border-gray-300">{{$cost->updated_at}}</td>
                    <td class="p-2 border border-gray-300">{{$cost->deleted_at}}</td>
                    <td class="p-2 border border-gray-300">
                        @if($cost->deleted_at===null)
                            <a href="{{route('lisenceplatecost.edit',$cost)}}">
                                <button class="btn btn-outline-primary">
                                    <span class="fas fa-pen"></span>
                                    &nbsp{{__('change')}}
                                </button>
                            </a>
                        @endif
                    </td>
                    <td class="p-2 border border-gray-300">
                        <form method="post" action="{{route('lisenceplatecost.destroy',$cost)}}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-primary">
                                <span class="fas fa-trash"></span>
                                &nbsp{{ $cost->trashed() ? __('restore') : __('delete') }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- ページネーション --}}
        {{--
        <div class="mb-4">
            {{ $costs->links() }}
        </div>
        --}}
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
