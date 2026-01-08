<x-layout>
    @if(session('status'))
        <div id="popup" class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg">
            {{ session('status') }}
        </div>

        <script>
            setTimeout(function() {
                const popup = document.getElementById('popup');
                if(popup) popup.remove();
            }, 3000); // pec 3s pazudīs
        </script>
    @endif

    <!-- Header -->
    <header class="bg-white shadow p-4 border-b border-gray-200 font-semibold text-gray-900 pl-34">
        Assigned Inspections
    </header>

     {{-- meklēšanas forma --}}
        <form method="GET" action="/inspector" class="bg-white p-4 rounded-lg shadow mb-6 flex space-x-4 items-center pl-120">
            <p>Search Inspections:</p>

            <select name="type" class="px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                <option value="">All types</option>
                <option value="xray" {{ request('type')=='xray'?'selected':'' }}>X-Ray</option>
                <option value="physical" {{ request('type')=='physical'?'selected':'' }}>Physical</option>
                <option value="document" {{ request('type')=='document'?'selected':'' }}>Document</option>
            </select>

            <select name="priority" class="px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                <option value="">All priorities</option>
                <option value="low" {{ request('priority')=='low'?'selected':'' }}>Low</option>
                <option value="normal" {{ request('priority')=='normal'?'selected':'' }}>Normal</option>
                <option value="high" {{ request('priority')=='high'?'selected':'' }}>High</option>
            </select>

            <button class="px-5 py-2 bg-yellow-100 text-black rounded-md hover:bg-yellow-200">
                Search
            </button>
        </form>
        
    <!-- galvenais -->
    <main class="flex-grow max-w-8xl mx-auto p-6 w-full">

        <!-- tabula -->
        <div class="relative overflow-x-auto bg-white shadow rounded-lg border border-gray-200 mb-10">
            <table class="w-full text-sm text-left text-gray-700 table-auto">
                <thead class="bg-gray-100 text-gray-900 font-semibold border-b border-gray-300">
                    <tr>
                        <th class="px-6 py-3 whitespace-nowrap">Case</th>
                        <th class="px-6 py-3 whitespace-nowrap">Inspection Type</th>
                        <th class="px-6 py-3 whitespace-nowrap">Risk Flags</th>
                        <th class="px-6 py-3 whitespace-nowrap">Route</th>
                        <th class="px-6 py-3 whitespace-nowrap">Priority</th>
                        <th class="px-6 py-3 whitespace-nowrap">Status</th>
                        <th class="px-6 py-3 whitespace-nowrap text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($inspections as $ins)
                        <tr class="bg-white hover:bg-gray-50 border-b border-gray-200">
                            <td class="px-6 py-4 whitespace-nowrap font-medium">
                                {{ $ins->case->id }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ ucfirst($ins->type) }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                @if (!empty($ins->case->risk_flags))
                                    {{ implode(', ', $ins->case->risk_flags) }}
                                @else
                                    -
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $ins->case->origin_country }} → {{ $ins->case->destination_country }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $ins->case->priority ?? '-' }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $ins->case->status ?? '-' }}
                            </td>

                            <!-- pogas -->
                            <td class="px-6 py-4 whitespace-nowrap text-center space-x-2">

                                <form class="inline" action="/inspector/decision/{{ $ins->id }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="decision" value="released">
                                    <button
                                        class="px-3 py-1 bg-green-500 text-white rounded-md text-xs hover:bg-green-600 transition">
                                        Release
                                    </button>
                                </form>

                                <form class="inline" action="/inspector/decision/{{ $ins->id }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="decision" value="hold">
                                    <button
                                        class="px-3 py-1 bg-yellow-500 text-white rounded-md text-xs hover:bg-yellow-600 transition">
                                        Hold
                                    </button>
                                </form>

                                <form class="inline" action="/inspector/decision/{{ $ins->id }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="decision" value="reject">
                                    <button
                                        class="px-3 py-1 bg-red-500 text-white rounded-md text-xs hover:bg-red-600 transition">
                                        Reject
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-6 text-center text-gray-500">
                                No assigned inspections 
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>
</x-layout>
