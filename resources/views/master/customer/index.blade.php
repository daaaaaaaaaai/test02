@extends('adminlte::page')

@section('title', __('Customer Control'))

@section('content_header')
    <h1>{{__('Customer Control')}}</h1>
    <div class="text-right flex text-sm">
        <a href="{{route('customer.create')}}">
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
                    <th class="p-2 border border-gray-300">{{__('cust_code')}}</th>
                    <th class="p-2 border border-gray-300">{{__('name_last')}}</th>
                    <th class="p-2 border border-gray-300">{{__('name_first')}}</th>
                    <th class="p-2 border border-gray-300">{{__('name_last_kana')}}</th>
                    <th class="p-2 border border-gray-300">{{__('name_first_kana')}}</th>
                    <th class="p-2 border border-gray-300">{{__('zipcode')}}</th>
                    <th class="p-2 border border-gray-300">{{__('prefecture')}}</th>
                    <th class="p-2 border border-gray-300">{{__('city')}}</th>
                    <th class="p-2 border border-gray-300">{{__('address')}}</th>
                    <th class="p-2 border border-gray-300">{{__('tel1')}}</th>
                    <th class="p-2 border border-gray-300">{{__('tel2')}}</th>
                    <th class="p-2 border border-gray-300">{{__('email')}}</th>
                    <th class="p-2 border border-gray-300">{{__('line')}}</th>
                    <th class="p-2 border border-gray-300">{{__('created_at')}}</th>
                    <th class="p-2 border border-gray-300">{{__('updated_at')}}</th>
                    <th class="p-2 border border-gray-300">{{__('deleted_at')}}</th>
                    <th class="p-2 border border-gray-300" colspan=3>{{__('operation')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td class="p-2 border border-gray-300">{{$customer->formatNumber($customer->cust_code)}}</td>
                    <td class="p-2 border border-gray-300">{{$customer->name_last}}</td>
                    <td class="p-2 border border-gray-300">{{$customer->name_first}}</td>
                    <td class="p-2 border border-gray-300">{{$customer->name_last_kana}}</td>
                    <td class="p-2 border border-gray-300">{{$customer->name_first_kana}}</td>
                    <td class="p-2 border border-gray-300">{{$customer->post_code}}</td>
                    <td class="p-2 border border-gray-300">{{$customer->address1}}</td>
                    <td class="p-2 border border-gray-300">{{$customer->address2}}</td>
                    <td class="p-2 border border-gray-300">{{$customer->address3}}</td>
                    <td class="p-2 border border-gray-300">{{$customer->tel1}}</td>
                    <td class="p-2 border border-gray-300">{{$customer->tel2}}</td>
                    <td class="p-2 border border-gray-300">{{$customer->email}}</td>
                    <!-- flg="1"はチェックONにする
                         inputタグのdisabledは入力不可にする -->
                    <td class="p-2 border border-gray-300 text-center">
                        <input type="checkbox" name="is_line" value="1" disabled="disabled" <?php echo ($customer->line == 1) ? 'checked' : ''; ?>>
                    </td>
                    <td class="p-2 border border-gray-300">{{$customer->created_at}}</td>
                    <td class="p-2 border border-gray-300">{{$customer->updated_at}}</td>
                    <td class="p-2 border border-gray-300">{{$customer->deleted_at}}</td>
                    <td class="p-2 border border-gray-300">
                        @if($customer->deleted_at===null)
                            <a href="{{route('customer.edit',$customer)}}">
                                <button class="btn btn-outline-primary">
                                    <span class="fas fa-pen"></span>
                                    &nbsp{{__('change')}}
                                </button>
                            </a>
                        @endif
                    </td>
                    <td class="p-2 border border-gray-300">
                        <form method="post" action="{{route('customer.destroy',$customer->cust_code)}}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-primary">
                                <span class="fas fa-trash"></span>
                                &nbsp{{ $customer->trashed() ? __('restore') : __('delete') }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- ページネーション --}}
        <div class="mb-4">
            {{ $customers->links() }}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop