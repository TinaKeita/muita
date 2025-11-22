<x-layout>
    <table border="1" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Dokuments</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cases as $case)
                <tr>
                    <td>{{ $case->id }}</td>
                    <td>{{ $case->status }}</td>
                    <td>{{ $case->priority }}</td>
                    <td>
                        @if ($case->documents->count())
                            <ul>
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

    <div style="margin-top: 20px; width: fit-content;">
        {{ $cases->links() }} 
    </div>
</x-layout>