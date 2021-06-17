<div>
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
            <a href="/admin-area/information/add" class="btn btn-primary">New</a>
            <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
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
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Title</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Content</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">User</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                        <tr>
                            <td class="border-b whitespace-nowrap">{{ ++$no }}</td>
                            <td class="border-b whitespace-nowrap">{{ $row->title }}</td>
                            <td class="border-b whitespace-nowrap">{!! $row->content !!}</td>
                            <td class="border-b whitespace-nowrap">{{ $row->user->username }}</td>
                            <td class="border-b whitespace-nowrap text-right">
                                @if((int)$key===$row->getKey())
                                <button class="btn btn-primary mt-1" wire:click="delete()">Yes</button>
                                <a wire:click="cancel()" href="javascript:;" class="btn btn-success">Cancel</a>
                                @else
                                <a href="javascript:;" wire:click="setKey({{ $row->getKey() }})" class="btn btn-danger">Delete</a>
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
