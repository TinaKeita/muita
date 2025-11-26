<x-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow p-4 border-b border-gray-200 font-semibold text-gray-900">
            Case Management Dashboard
        </header>

        <!-- Galvena sadala-->
        <main class="flex-grow max-w-7xl mx-auto p-6 w-full">

            <!-- Cases table -->
            <div class="relative overflow-x-auto bg-white shadow rounded-lg border border-gray-200 mb-10">
                <table class="w-full text-sm text-left text-gray-700 table-auto">
                    <thead class="bg-gray-100 text-gray-900 font-semibold border-b border-gray-300">
                        <tr>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">ID</th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">Status</th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">Priority</th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">Documents</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cases as $case)
                            <tr class="bg-white hover:bg-gray-50 border-b border-gray-200">
                                <td class="px-6 py-4 align-middle whitespace-nowrap font-medium">{{ $case->id }}</td>
                                <td class="px-6 py-4 align-middle whitespace-nowrap">{{ $case->status }}</td>
                                <td class="px-6 py-4 align-middle whitespace-nowrap">{{ $case->priority }}</td>
                                <td class="px-6 py-4 align-middle whitespace-nowrap">
                                    @if ($case->documents->count())
                                        <ul class="list-disc list-inside text-xs text-gray-600">
                                            @foreach ($case->documents as $document)
                                                <li>{{ $document->filename }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        No Documents
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $cases->links() }}
            </div>
        </main>
    </div>
</x-layout>
