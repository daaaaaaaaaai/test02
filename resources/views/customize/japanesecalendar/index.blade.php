@extends('adminlte::page')

@section('title', __('JapaneseCalendar'))

@section('content_header')
    <h1>{{__('JapaneseCalendar')}}</h1>
    <div class="text-right flex text-sm">
        <a href="{{route('japanesecalendar.create')}}">
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
                    <th>{{__('end_date')}}</th>
                    <th>{{__('japanese_date')}}</th>
                    <th>{{__('created_at')}}</th>
                    <th>{{__('updated_at')}}</th>
                    <th colspan=2>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($japaneseCalendars as $japaneseCalendar)
                <tr>
                    <td>{{$japaneseCalendar->start_date}}</td>
                    <td>{{$japaneseCalendar->end_date}}</td>
                    <td>{{$japaneseCalendar->japanese_date}}</td>
                    <td>{{$japaneseCalendar->created_at}}</td>
                    <td>{{$japaneseCalendar->updated_at}}</td>
                    <td class="text-center">
                        <a href="{{route('japanesecalendar.edit',$japaneseCalendar)}}">
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-pen"></span>
                                &nbsp{{__('change')}}
                            </button>
                        </a>
                    </td>
                    <td class="text-center">
                        <form method="post" action="{{route('japanesecalendar.destroy',$japaneseCalendar)}}">
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
                    {{ $japaneseCalendars->links() }}
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