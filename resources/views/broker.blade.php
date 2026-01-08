<x-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow p-4 border-b border-gray-200 font-semibold text-gray-900 pl-32">
            Case Management Dashboard
        </header>

        <!-- Galvena sadala-->
        <main class="flex-grow max-w-7xl mx-auto p-6 w-full">
            <div class="bg-white p-6 rounded-lg shadow border border-gray-200 mb-6">

                {{-- Upload document forma --}}
                <h2 class="font-semibold mb-4">Upload document</h2>

                <form method="POST" action="{{ route('documents.upload') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf

                    <!-- kurs case -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Case</label>
                        <select name="case_id" class="w-full border rounded px-3 py-2">
                            @foreach($cases as $case)
                                <option value="{{ $case->id }}">{{ $case->id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- faila nosaukums -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Filename</label>
                        <input type="text" name="filename" placeholder="doc_10.pdf"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    <!-- kategorija -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Category</label>
                        <select name="category" class="w-full border rounded px-3 py-2">
                            <option value="coo">COO</option>
                            <option value="invoice">Invoice</option>
                            <option value="packing_list">Packing list</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- lapu skaits -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Pages</label>
                        <input type="number" name="pages"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    <!-- iesniegt -->
                    <div class="md:col-span-2">
                        <button class="bg-yellow-100 text-black px-4 py-2 rounded hover:bg-yellow-200">
                            Upload
                        </button>
                    </div>
                </form>
            </div>

            {{-- meklēšanas forma --}}
            <form method="GET" action="/broker" class="bg-white p-4 rounded-lg shadow mb-6 flex space-x-4 items-center">
                <p>Search Cases:</p>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search case id..."
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">

                <select name="status" class="px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                    <option value="">All status</option>
                    <option value="new" {{ request('status')=='new'?'selected':'' }}>New</option>
                    <option value="in_inspection" {{ request('status')=='in_inspection'?'selected':'' }}>In Inspection</option>
                    <option value="on_hold" {{ request('status')=='on_hold'?'selected':'' }}>On Hold</option>
                    <option value="screening" {{ request('status')=='screening'?'selected':'' }}>Screening</option>
                    <option value="released" {{ request('status')=='released'?'selected':'' }}>Released</option>
                    <option value="closed" {{ request('status')=='closed'?'selected':'' }}>Closed</option>
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
            <!-- Cases tabula -->
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
                                {{-- dokumenti ir clickable --}}
                                <td class="px-6 py-4 align-middle whitespace-nowrap">
                                    @if ($case->documents->count())
                                        <ul class="list-disc list-inside text-xs text-gray-600">
                                            @foreach ($case->documents as $document)
                                                <li>
                                                    <a href="{{ route('broker.document.show', $document->id) }}"
                                                    class="text-blue-600 hover:underline">
                                                        {{ $document->filename }}
                                                    </a>
                                                </li>
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
