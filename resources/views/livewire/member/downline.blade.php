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
                        <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12">
                            <div class="intro-x flex items-center h-10">
                                <h2 class="text-lg text-white font-medium truncate mr-5">
                                    Left
                                </h2>
                            </div>
                            <hr class="text-white">
                            <div class="mt-5">
                                @if ($data->left_child)
                                @foreach ($data->left_child as $item)
                                <div class="intro-x">
                                    <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                        <div class="ml-4 mr-auto">
                                            <div class="font-medium">
                                                <a href="/downline?key={{ $item->username }}">{{ $item->username }}</a>
                                            </div>
                                            <div class="text-gray-600 text-xs mt-0.5">$ {!! number_format($item->contract_price) !!}</div>
                                        </div>
                                        <div class="text-theme-6">
                                            {{ number_format($item->left_turnover - $item->invalid_left_turnover->sum('amount')) }} | {{ number_format($item->right_turnover - $item->invalid_right_turnover->sum('amount')) }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                {{-- <a href="" class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">View More</a> --}}
                            </div>
                        </div>
                        <h3 class="text-white mt-4 font-medium">Total : $ {{ number_format($data->left_turnover - $data->invalid_left_turnover->sum('amount')) }}</h3>
                    </div>
                </div>
                <div class="intro-y col-span-12 lg:col-span-6">
                    <div class="intro-y box p-5 bg-theme-9">
                        <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12">
                            <div class="intro-x flex items-center h-10">
                                <h2 class="text-lg text-white font-medium truncate mr-5">
                                    Right
                                </h2>
                            </div>
                            <hr class="text-white">
                            <div class="mt-5">
                                @if ($data->right_child)
                                @foreach ($data->right_child as $item)
                                <div class="intro-x">
                                    <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                        <div class="ml-4 mr-auto">
                                            <div class="font-medium">
                                                <a href="/downline?key={{ $item->username }}">{{ $item->username }}</a>
                                            </div>
                                            <div class="text-gray-600 text-xs mt-0.5">$ {!! number_format($item->contract_price) !!}</div>
                                        </div>
                                        <div class="text-theme-6">
                                            {{ number_format($item->left_turnover - $item->invalid_left_turnover->sum('amount')) }} | {{ number_format($item->right_turnover - $item->invalid_right_turnover->sum('amount')) }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                {{-- <a href="" class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">View More</a> --}}
                            </div>
                        </div>
                        <h3 class="text-white mt-4 font-medium">Total : $ {{ number_format($data->right_turnover - $data->invalid_right_turnover->sum('amount')) }}</h3>
                    </div>
                </div>
                @else
                <div class="text-center box bg-theme-12">
                    <h4>Member Data not found</h4>
                </div>
                @endif
            </div>
        </div>
        <!-- END: Content -->
    </div>
</div>
