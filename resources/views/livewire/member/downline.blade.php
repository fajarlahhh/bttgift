<div>
    @include('includes.mobile-menu')
    <div class="flex">
        @include('includes.side-menu')
        <!-- BEGIN: Content -->
        <div class="content">
            @include('includes.top-bar', [
                'menu' => $menu
            ])
            <div class="intro-y flex items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">
                    {{ ucfirst($menu) }}
                </h2>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-5">
                @if ($data)
                <div class="intro-y col-span-12 lg:col-span-6">
                    <div class="intro-y box p-5 bg-theme-6">
                        <h3 class="text-white text-1xl mb-2">Left</h3><hr>
                        <table class="table text-white table-bordered mt-4">
                            <tr>
                                <th class="border">Username</th>
                                <th class="border">Contract</th>
                                <th colspan="2" class="border whitespace-nowrap">
                                    Turnover <small>Left | Right</small>
                                </th>
                            </tr>
                            @if ($data->left_child)
                            @foreach ($data->left_child as $item)
                            <tr>
                                <td class="border text-nowrap"><a href="/downline?key={{ $item->username }}">{{ $item->username }}</a></td>
                                <td class="border text-right text-nowrap">{!! number_format($item->contract_price) !!}</td>
                                <td class="border text-right text-nowrap">{{ number_format($item->left_turnover - $item->invalid_left_turnover->sum('amount')) }}</td>
                                <td class="border text-right text-nowrap">{{ number_format($item->right_turnover - $item->invalid_right_turnover->sum('amount')) }}</td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                        <h3 class="text-white mt-4 ">Total : {{ number_format($data->left_turnover - $data->invalid_left_turnover->sum('amount')) }}</h3>
                    </div>
                </div>
                <div class="intro-y col-span-12 lg:col-span-6">
                    <div class="intro-y box p-5 bg-theme-9">
                        <h3 class="text-white text-1xl mb-2">Right</h3><hr>
                        <table class="table text-white mt-4">
                            <tr>
                                <th class="border">Username</th>
                                <th class="border">Contract</th>
                                <th colspan="2" class="border whitespace-nowrap">
                                    Turnover <small>Left | Right</small>
                                </th>
                            </tr>
                            @if ($data->right_child)
                            @foreach ($data->right_child as $item)
                            <tr>
                                <td class="border text-nowrap"><a href="/downline?key={{ $item->username }}">{{ $item->username }}</a></td>
                                <td class="border text-right text-nowrap">{!! number_format($item->contract_price) !!}</td>
                                <td class="border text-right text-nowrap">{{ number_format($item->left_turnover - $item->invalid_left_turnover->sum('amount')) }}</td>
                                <td class="border text-right text-nowrap">{{ number_format($item->right_turnover - $item->invalid_right_turnover->sum('amount')) }}</td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                        <h3 class="text-white mt-4 ">Total : {{ number_format($data->right_turnover - $data->invalid_right_turnover->sum('amount')) }}</h3>
                    </div>
                </div>
                @else
                <div class="text-center box bg-theme-12">
                    <h4>Member Data not found</h4>
                </div>
                @endif
                <div class="col-md-12 intro-y text-center">
                    <a href="/downline" class="btn btn-primary text-center">Reset</a>
                </div>
            </div>
        </div>
        <!-- END: Content -->
    </div>
</div>
