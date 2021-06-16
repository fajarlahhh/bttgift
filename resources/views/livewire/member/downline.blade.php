<div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        @if ($data)
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="alert alert-dark show intro-y">
                <div class="flex items-center">
                    <div class="font-medium text-lg"> LEFT</div>
                </div>
                <hr class="mt-1">
                <div class="mt-2">
                    @if ($data->left_child)
                    @foreach ($data->left_child as $item)
                    <div class="intro-x">
                        <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                            <div class="mr-auto">
                                <div class="font-medium">
                                    <a href="/downline?key={{ $item->username }}" class="text-gray-700">{{ $item->username }}</a>
                                </div>
                                <div class="text-gray-600 text-xs mt-0.5">$ {!! number_format($item->contract_price) !!}</div>
                            </div>
                            <div class="text-gray-700">
                                {{ number_format($item->left_turnover - $item->invalid_left_turnover->sum('amount')) }} | {{ number_format($item->right_turnover - $item->invalid_right_turnover->sum('amount')) }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    {{-- <a href="" class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">View More</a> --}}
                </div>
                <h3 class="text-white mt-2 font-medium">Total : $ {{ number_format($data->left_turnover - $data->invalid_left_turnover->sum('amount')) }}</h3>
            </div>
        </div>
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="alert alert-dark-soft show intro-y">
                <div class="flex items-center">
                    <div class="font-medium text-lg"> RIGHT</div>
                </div>
                <hr class="mt-1">
                <div class="mt-2">
                    @if ($data->right_child)
                    @foreach ($data->right_child as $item)
                    <div class="intro-x">
                        <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                            <div class="mr-auto">
                                <div class="font-medium">
                                    <a href="/downline?key={{ $item->username }}" >{{ $item->username }}</a>
                                </div>
                                <div class="text-gray-700 text-xs mt-0.5">$ {!! number_format($item->contract_price) !!}</div>
                            </div>
                            <div >
                                {{ number_format($item->right_turnover - $item->invalid_right_turnover->sum('amount')) }} | {{ number_format($item->right_turnover - $item->invalid_right_turnover->sum('amount')) }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    {{-- <a href="" class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">View More</a> --}}
                </div>
                <h3 class="mt-2 font-medium">Total : $ {{ number_format($data->right_turnover - $data->invalid_right_turnover->sum('amount')) }}</h3>
            </div>
        </div>
        @else
        <div class="text-center box bg-theme-12">
            <h4>Member Data not found</h4>
        </div>
        @endif
    </div>
</div>
