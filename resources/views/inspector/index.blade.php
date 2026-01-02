<x-layout>
    <h1 class="text-2xl font-bold mb-4">Assigned Inspections</h1>

    <table class="w-full bg-white shadow border rounded">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-3 py-2 text-left">Case</th>
                <th class="px-3 py-2 text-left">Inspection Type</th>
                <th class="px-3 py-2 text-left">Risk Flags</th>
                <th class="px-3 py-2 text-left">Route</th>
                <th class="px-3 py-2 text-left">Priority</th>
                <th class="px-3 py-2 text-left">Status</th>
                <th class="px-3 py-2">Action</th>
            </tr>
        </thead>

        <tbody class="divide-y">
            @forelse ($inspections as $ins)
                <tr class="hover:bg-gray-50">
                    <td class="px-3 py-2">{{ $ins->case->id }}</td>
                    <td class="px-3 py-2">{{ ucfirst($ins->type) }}</td>

                    <td class="px-3 py-2">
                        @if (!empty($ins->case->risk_flags))
                            {{ implode(', ', $ins->case->risk_flags) }}
                        @else
                            -
                        @endif
                    </td>

                    <td class="px-3 py-2">
                        {{ $ins->case->origin_country }} → {{ $ins->case->destination_country }}
                    </td>

                    <td class="px-3 py-2">
                        {{ $ins->case->priority ?? '-' }}
                    </td>

                     <td class="px-3 py-2">
                        {{ $ins->case->status ?? '-' }}
                    </td>

                    <td class="px-3 py-2 space-x-1 text-center">
                        <form class="inline" action="/inspector/decision/{{ $ins->id }}" method="POST">
                            @csrf
                            <input type="hidden" name="decision" value="released">
                            <button class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                Release
                            </button>
                        </form>

                        <form class="inline" action="/inspector/decision/{{ $ins->id }}" method="POST">
                            @csrf
                            <input type="hidden" name="decision" value="hold">
                            <button class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                Hold
                            </button>
                        </form>

                        <form class="inline" action="/inspector/decision/{{ $ins->id }}" method="POST">
                            @csrf
                            <input type="hidden" name="decision" value="reject">
                            <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                Reject
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="px-3 py-3 text-center text-gray-600" colspan="6">
                        No assigned inspections 🎉
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-layout>
