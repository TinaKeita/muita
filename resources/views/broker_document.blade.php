<x-layout>
    {{-- dokumentu detaļu popup --}}
    <div class="max-w-3xl mx-auto bg-gray-100 p-6 rounded-lg shadow mt-10">
        <h1 class="text-2xl font-bold mb-4">{{ $document->filename }}</h1>

        <div class="text-gray-700 space-y-2">
            <p><strong>Category:</strong> {{ $document->category }}</p>
            <p><strong>Case id:</strong> {{ $document->case_id }}</p>
            <p><strong>Pages:</strong> {{ $document->pages }}</p>
            <p><strong>Uploaded by:</strong> {{ $document->uploaded_by }}</p>
            <p><strong>Uploaded at:</strong> {{ $document->created_at }}</p>
        </div>

        <div class="mt-6">
            <a href="{{ url()->previous() }}" class="text-blue-600 hover:underline">
                ← Back to cases
            </a>
        </div>
    </div>
</x-layout>
