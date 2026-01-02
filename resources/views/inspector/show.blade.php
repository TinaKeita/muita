<x-layout>
    <h1 class="text-xl font-bold mb-4">Case: {{ $case->id }}</h1>

    <div class="bg-white shadow p-4 rounded mb-4">
        <p><strong>Risk Score:</strong> {{ $case->risk_score ?? 'N/A' }}</p>
        <p><strong>Risk Level:</strong> {{ ucfirst($case->risk_level) }}</p>

        <p><strong>Risk Flags:</strong></p>
        <ul class="list-disc ml-6">
            @foreach(($case->risk_flags ?? []) as $flag)
                <li>{{ $flag }}</li>
            @endforeach
        </ul>

        <p><strong>Assigned Inspection Type:</strong> {{ $case->inspection_type ?? 'N/A' }}</p>
    </div>

    <div class="flex gap-4">
        <form method="POST" action="/inspector/case/{{ $case->id }}/release">
            @csrf
            <button class="bg-green-600 text-white px-4 py-2 rounded">
                Release
            </button>
        </form>

        <form method="POST" action="/inspector/case/{{ $case->id }}/hold">
            @csrf
            <button class="bg-yellow-500 text-white px-4 py-2 rounded">
                Hold
            </button>
        </form>

        <form method="POST" action="/inspector/case/{{ $case->id }}/reject">
            @csrf
            <button class="bg-red-600 text-white px-4 py-2 rounded">
                Reject
            </button>
        </form>
    </div>
</x-layout>
