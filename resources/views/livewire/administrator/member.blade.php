<div>
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
            <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                <select data-placeholder="Contract" wire:model="active" class="form-select w-full">
                    <option value="0">Not Actived</option>
                    <option value="1">Actived</option>
                </select>
            </div>
        </div>
        <div class="p-5 overflow-x-auto" id="responsive-table">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Username</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Email</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Name</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Contract</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Wallet</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Turnover</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Registered At</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Actived At</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                        @php
                            $now = new \Carbon\Carbon();
                            $registered = new \Carbon\Carbon($row->created_at);
                        @endphp
                        <tr
                        @if ($registered->diffInDays($now) > 2 && $active == 0)
                            class="bg-theme-6 text-white"
                        @endif>
                            <td class="border-b whitespace-nowrap">{{ ++$no }}</td>
                            <td class="border-b whitespace-nowrap">{{ $row->username }}</td>
                            <td class="border-b whitespace-nowrap">{{ $row->email }}</td>
                            <td class="border-b whitespace-nowrap">{{ $row->name }}</td>
                            <th class="border-b whitespace-nowrap">{{ number_format($row->contract_price) }}</th>
                            <td class="border-b whitespace-nowrap">{{ $row->wallet }}</td>
                            <td class="border-b whitespace-nowrap">
                                Left : $ {{ number_format($row->left_turnover) }}<br>
                                Right : $ {{ number_format($row->right_turnover) }}
                            </td>
                            <td class="border-b whitespace-nowrap">{{ $row->created_at }}</td>
                            <td class="border-b whitespace-nowrap">{{ $row->actived_at }}</td>
                            <td class="border-b whitespace-nowrap text-right">
                                @if (!$row->actived_at)
                                @if((int)$key===$row->getKey())
                                <a href="javascript:;" wire:click="delete()" class="btn btn-danger">Yes</a>
                                <a wire:click="cancel()" href="javascript:;" class="btn btn-warning">Cancel</a>
                                @else
                                <a href="javascript:;" wire:click="setKey({{ $row->getKey() }})" class="btn btn-warning">Delete {{ $row->username }}</a>
                                @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($error)
                <div class="alert alert-danger show mt-3 mb-2" role="alert">
                    {!! $error !!}
                </div>
                @endif
            </div>
            <div class="flex flex-col sm:flex-row items-center mt-5">
                <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
