<div>
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
            <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                @if ($process == 1)
                <input type="text" class="form-control" wire:model.defer="search" placeholder="Search Processed">&nbsp;
                @endif
                <select data-placeholder="Contract" wire:model="process" class="form-select w-full">
                    <option value="0" selected>Not Processed</option>
                    <option value="1" selected>Processed</option>
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
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">BTT Wallet</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Min. Turnover</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Reward</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Accepted BTT</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Processed</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                        <tr>
                            <td class="border-b whitespace-nowrap">{{ ++$no }}</td>
                            <td class="border-b whitespace-nowrap">{{ $row->member->username }}</td>
                            <td class="border-b whitespace-nowrap">{{ $row->member->email }}</td>
                            <td class="border-b whitespace-nowrap">{{ $process == 0? $row->member->wallet: $row->member_wallet }}</td>
                            <td class="border-b whitespace-nowrap text-right">{{ number_format($row->rating->min_turnover) }}</td>
                            <td class="border-b whitespace-nowrap text-right">{{ number_format($row->rating_reward) }}</td>
                            <td class="border-b whitespace-nowrap text-right">{{ number_format($row->accepted_btt) }}</td>
                            <td class="border-b whitespace-nowrap">{{ $row->process_information," (".$row->btt_amount.") at ".$row->created_at }}</td>
                            <td class="border-b whitespace-nowrap">
                                @if((int)$key===$row->getKey())
                                <form wire:submit.prevent="send">
                                    @error('information')
                                    <div class="text-theme-6">This field is required</div>
                                    @enderror
                                    <input type="text" class="form-control" style="width: 300px" wire:model.defer="information" placeholder="Information"><br>
                                    <button class="btn btn-primary mt-1">Done</button>
                                    <a wire:click="cancel()" href="javascript:;" class="btn btn-success">Cancel</a>
                                </form>
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
