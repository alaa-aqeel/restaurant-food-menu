<table class="table text-sm  text-left text-gray-400 w-full border-separate border-spacing-y-2">
    <thead class="text-xs relative px-0 uppercase bg-gray-700 text-gray-300 ">
        <tr >
            @foreach($cols as $col)
                <th scope="col" class="px-6 py-3">
                    {{ $col['text'] }}
                </th>
            @endforeach
            <th scope="col" class="px-6 py-3">
                Actions
            </th>
        </tr>
    </thead>
    <tbody class="px-2 bg-gray-100">
        @foreach ($rows as $row)
            <tr class="bg-white shadow hover:shadow-lg rounded-lg">
                @foreach($cols as $col)
                    <td class="px-6 py-4 text-left ">
                        {{ $row[$col['name']] }}
                    </td>
                @endforeach
                <td class="px-6 py-4 text-left flex gap-1">
                    <a href="{{ route("$action.edit", [$id => $row['id']]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    <form method="POST" action="{{ route("$action.destroy", [$id => $row['id']]) }}">
                        @csrf
                        @method('delete')
                        <button class="font-medium text-red-600 dark:text-red-500 hover:underline"> 
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        @if(!sizeof($rows))
            <tr class="bg-white shadow rounded-lg ">
                <td colspan="{{ sizeof($cols) }}" class="px-6 py-4 text-center">
                    NO DATA
                </td>
            </tr>
        @endif
    </tbody>
</table>