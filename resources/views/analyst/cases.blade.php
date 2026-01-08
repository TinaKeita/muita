<x-layout>
    <x-slot:title>Analyst Cases</x-slot:title>

    {{--galvenais konteineris --}}
    <div class="max-w-6xl mx-auto p-6">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 border-b pb-4 mb-2">Cases – Risk Overview</h1>
            
            {{-- visas cases --}}
            <div class="text-xl text-gray-600 font-semibold">
                <i class="fas fa-list mr-2"></i> Total: {{ $cases->total() }} cases <br>
                <i class="fas fa-list mr-2"></i> In page: New: {{ $cases->where('status', 'new')->count() }} | 
                                                          Screening: {{ $cases->where('status', 'screening')->count() }} | 
                                                          In inspection: {{ $cases->where('status', 'in_inspection')->count() }} |
                                                          On hold: {{ $cases->where('status', 'on_hold')->count() }} |
                                                          Closed: {{ $cases->where('status', 'closed')->count() }}

            </div>
        </div>
        
        
        {{-- tabulas konteineris --}}
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
            <div class="overflow-x-auto">
                {{-- tabula --}}
                <table class="w-full">
                    {{-- pirmā rindiņa --}}
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold text-sm">Case ID</th>
                            <th class="px-6 py-4 text-left font-semibold text-sm">Status</th>
                            <th class="px-6 py-4 text-left font-semibold text-sm">Risk Level</th>
                            <th class="px-6 py-4 text-left font-semibold text-sm">Risk Score</th>
                            <th class="px-6 py-4 text-left font-semibold text-sm">Action</th>
                        </tr>
                    </thead>
                    
                    {{-- pārējas rindas --}}
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($cases as $case)
                        {{-- krasa pec riska līmeņiem rindai --}}
                        <tr
                            onclick="toggle('{{ $case->id }}')"
                            class="cursor-pointer hover:bg-gray-50 transition-colors
                                @if($case->risk_level === 'low') bg-green-50
                                @elseif($case->risk_level === 'medium') bg-yellow-50
                                @elseif($case->risk_level === 'high') bg-red-50
                                @else bg-white
                                @endif"
                        >
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $case->id }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $case->status }}</td>
                            <td class="px-6 py-4">

                                {{-- riska līmeņa krāsa --}}
                                @if($case->risk_level === 'high')
                                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">HIGH</span>
                                @elseif($case->risk_level === 'medium')
                                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">MEDIUM</span>
                                @else
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">LOW</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-2xl font-mono text-gray-900">{{ $case->risk_score ?? '-' }}</td>
                            <td class="px-6 py-4">
                                {{-- run risk poga --}}
                                <form method="POST" action="/analyst/risk/{{ $case->id }}" class="inline">
                                    @csrf
                                    <button
                                        onclick="event.stopPropagation()"
                                        class="bg-gray-700 hover:bg-gray-300 text-white hover:text-black px-6 py-2 rounded-lg font-semibold text-sm shadow-md transition-all">
                                        Run Risk
                                    </button>
                                </form>
                            </td>
                        </tr>

                        {{-- rinda ar detaļām --}}
                        <tr id="details-{{ $case->id }}" class="hidden bg-gray-50">
                            <td colspan="5" class="px-8 py-6">
                                {{-- rindas detaļas --}}
                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 text-sm text-gray-700">
                                    <div><span class="font-semibold text-gray-900">Origin:</span> {{ $case->origin_country }}</div>
                                    <div><span class="font-semibold text-gray-900">Destination:</span> {{ $case->destination_country }}</div>
                                    <div><span class="font-semibold text-gray-900">Vehicle:</span> {{ $case->vehicle_id }}</div>
                                    <div><span class="font-semibold text-gray-900">Declarant:</span> {{ $case->declarant_id }}</div>
                                    <div><span class="font-semibold text-gray-900">Priority:</span> {{ $case->priority }}</div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- pagination apaksa --}}
        <div class="mt-8">
            {{ $cases->links() }}
        </div>
    </div>

    {{-- js ar rindu atvērsanu --}}
    <script>
    function toggle(id) {
        document.getElementById('details-' + id).classList.toggle('hidden');
    }
    </script>
</x-layout>
