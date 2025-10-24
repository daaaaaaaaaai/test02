@extends('adminlte::page')

@section('title', __('TaxRate'))

@section('content_header')
    <h1>{{__('TaxRate')}}</h1>
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
                    <th class="p-2 border border-gray-300">{{__('tax_code')}}</th>
                    <th class="p-2 border border-gray-300">{{__('start_date')}}</th>
                    <th class="p-2 border border-gray-300">{{__('end_date')}}</th>
                    <th class="p-2 border border-gray-300">{{__('tax_rate')}}</th>
                    <th class="p-2 border border-gray-300">{{__('normal_rate_flg')}}</th>
                    <th class="p-2 border border-gray-300">{{__('text')}}</th>
                    <th class="p-2 border border-gray-300">{{__('created_at')}}</th>
                    <th class="p-2 border border-gray-300">{{__('updated_at')}}</th>
                    <th class="p-2 border border-gray-300" colspan=3>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($taxRates as $taxRate)
                <tr>
                    <td class="p-2 border border-gray-300">{{$taxRate->tax_code}}</td>
                    <td class="p-2 border border-gray-300">{{$taxRate->start_date}}</td>
                    <td class="p-2 border border-gray-300">{{$taxRate->end_date}}</td>
                    <td class="p-2 border border-gray-300 text-right">{{number_format($taxRate->tax_rate,2)}}</td>
                    <!-- flg="1"はチェックONにする
                         inputタグのdisabledは入力不可にする -->
                    <td class="p-2 border border-gray-300 text-center">
                        <input type="checkbox" name="is_normal" value="1" disabled="disabled" <?php echo ($taxRate->normal_rate_flg == 1) ? 'checked' : ''; ?>>
                    </td>
                    <td class="p-2 border border-gray-300">{{$taxRate->text}}</td>
                    <td class="p-2 border border-gray-300">{{$taxRate->created_at}}</td>
                    <td class="p-2 border border-gray-300">{{$taxRate->updated_at}}</td>
                    <td class="p-2 border border-gray-300">
                        <a href="{{route('taxrate.edit',$taxRate)}}">
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-pen"></span>
                                &nbsp{{__('change')}}
                            </button>
                        </a>
                    </td>
                    <td class="p-2 border border-gray-300">
                        <form method="post" action="{{route('taxrate.destroy',$taxRate)}}">
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
                    {{ $taxRates->links() }}
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