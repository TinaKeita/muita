<x-layout>
    <x-slot:title>Analyst Cases</x-slot:title>

    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Cases – Risk Overview</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Case ID</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Risk Level</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Risk Score</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($cases as $case)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $case->id }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $case->status }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $case->risk_level ?? '-' }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $case->risk_score ?? '-' }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">
                                <form method="POST" action="/analyst/risk/{{ $case->id }}">
                                    @csrf
                                    <button type="submit" 
                                        class="bg-blue-200 text-black px-3 py-1 rounded hover:bg-blue-700 transition">
                                        Run Risk Analysis
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $cases->links() }}
        </div>
    </div>
</x-layout>
