<div>
    <div class="intro-y box mt-5">
        <div class="p-5 overflow-x-auto" id="responsive-table">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Time</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Description</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Debit</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Credit</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Balance</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $row)
                        @php
                            $balance += $row->credit - $row->debit;
                        @endphp
                        <tr>
                            <td class="border-b whitespace-nowrap">{{ ++$no }}</td>
                            <td class="border-b whitespace-nowrap">{{ $row->created_at }}</td>
                            <td class="border-b whitespace-nowrap">{{ $row->description }}</td>
                            <td class="border-b whitespace-nowrap text-righr">{{ number_format($row->debit, 2) }}</td>
                            <td class="border-b whitespace-nowrap text-right">{{ number_format($row->credit, 2) }}</td>
                            <td class="border-b whitespace-nowrap text-right">{{ number_format($balance, 2) }}</td>
                            <td class="border-b whitespace-nowrap">{{ $row->type }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
