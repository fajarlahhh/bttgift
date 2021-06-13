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
            <div class="grid grid-cols-12 gap-6 mt-5 ">
                <div class="intro-y col-span-12 lg:col-span-8">
                    <div class="intro-y box p-5">
                        <div class="verflow-x-auto" id="responsive-table">
                            <div class="overflow-x-auto">
                                <table class="table">
                                    <thead>
                                        <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Time</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Achievement</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Reward</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $index => $row)
                                        <tr>
                                            <td class="border-b whitespace-nowrap">{{ ++$no }}</td>
                                            <td class="border-b whitespace-nowrap">{{ $row->created_at }}</td>
                                            <td class="border-b whitespace-nowrap text-right">{{ number_format($row->rating->min_turnover) }}</td>
                                            <td class="border-b whitespace-nowrap text-right">{{ number_format($row->rating_reward) }}</td>
                                            <td class="border-b whitespace-nowrap">{{ $row->processed_at?: "Waiting..." }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center mt-5">
                                <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                                    {{ $data->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-4">
                    <div class="alert alert-dark show intro-x">
                        <table class="table">
                            <tr>
                                <th>Rating</th>
                                <th>Min. Turnover</th>
                                <th>Reward</th>
                            </tr>
                            @foreach ($rating as $key => $row)
                            <tr>
                                <th>{{ $key+1 }}</th>
                                <th class="text-right">$ {{ number_format($row->min_turnover) }}</th>
                                <th class="text-right">$ {{ number_format($row->reward) }}</th>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Content -->
    </div>
</div>
