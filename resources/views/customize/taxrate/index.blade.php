@extends('adminlte::page')

@section('title', __('TaxRate'))

@section('content_header')
    <h1>{{__('TaxRate')}}</h1>
    <div class="text-right flex text-sm">
        <a href="{{route('taxrate.create')}}">
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

        <table class="ztable fixed-2">
            <thead class="text-center">
                <tr>
                    <th>{{__('tax_code')}}</th>
                    <th>{{__('start_date')}}</th>
                    <th>{{__('end_date')}}</th>
                    <th>{{__('tax_rate')}}</th>
                    <th>{{__('normal_rate_flg')}}</th>
                    <th>{{__('text')}}</th>
                    <th>{{__('created_at')}}</th>
                    <th>{{__('updated_at')}}</th>
                    <th colspan=2>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($taxRates as $taxRate)
                <tr>
                    <td>{{$taxRate->tax_code}}</td>
                    <td>{{$taxRate->start_date}}</td>
                    <td>{{$taxRate->end_date}}</td>
                    <td class="text-right">{{number_format($taxRate->tax_rate,1)}}</td>
                    <!-- flg="1"はチェックONにする
                         inputタグのdisabledは入力不可にする -->
                    <td class="text-center">
                        <input type="checkbox" name="is_normal" value="1" disabled="disabled" <?php echo ($taxRate->normal_rate_flg == 1) ? 'checked' : ''; ?>>
                    </td>
                    <td>{{$taxRate->text}}</td>
                    <td>{{$taxRate->created_at}}</td>
                    <td>{{$taxRate->updated_at}}</td>
                    <td class="text-center">
                        <a href="{{route('taxrate.edit',$taxRate)}}">
                            <button class="btn btn-outline-primary">
                                <span class="fas fa-pen"></span>
                                &nbsp{{__('change')}}
                            </button>
                        </a>
                    </td>
                    <td class="text-center">
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
    <link rel="stylesheet" href="{{asset('css/admin_custom.css')}}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop