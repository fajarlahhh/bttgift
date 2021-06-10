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
            <div class="intro-y box mt-5">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                    <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                        <select data-placeholder="Contract" wire:model="proccess" class="form-select w-full">
                            <option value="0" selected>Not Processed</option>
                            <option value="1" selected>Processed</option>
                        </select>
                    </div>
                </div>
                <div class="p-5" id="responsive-table">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead>
                                <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Username</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Requisite</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Method</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Amount</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">To Address</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Time</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Proof Of Payment</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                <tr>
                                    <td class="border-b whitespace-nowrap">{{ ++$no }}</td>
                                    <td class="border-b whitespace-nowrap">{{ $row->member->username }}</td>
                                    <td class="border-b whitespace-nowrap">{{ $row->requisite }}</td>
                                    <td class="border-b whitespace-nowrap">{{ $row->coin_name }}</td>
                                    <th class="border-b whitespace-nowrap">{{ number_format($row->amount, 5) }}</th>
                                    <td class="border-b whitespace-nowrap">{{ $row->wallet }}</td>
                                    <td class="border-b whitespace-nowrap">{{ $row->created_at }}</td>
                                    <td class="border-b">
                                        <a href="{{ Storage::url($row->file) }}" target="_blank" class="btn btn-warning">File</a><br>
                                        {{ $row->information }}
                                    </td>
                                    <td class="border-b whitespace-nowrap">
                                        @if((int)$key===$row->getKey())
                                        <a href="javascript:;" wire:click="proccess()" class="btn btn-danger">Yes, Proccess</a>
                                        <a wire:click="cancel()" href="javascript:;" class="btn btn-success">Cancel</a>
                                        @else
                                        <a href="javascript:;" wire:click="setKey({{ $row->getKey() }})" class="btn btn-danger">Proccess</a>
                                        @endif
                                    </td>
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
        <!-- END: Content -->
    </div>
</div>