<x-app-layout>
    @section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Personal Information</h2>

        <table class="table-auto w-full border-collapse border border-gray-300">
            <tr>
                <th class="border px-4 py-2">Name</th>
                <td class="border px-4 py-2">{{ $user->name }}</td>
            </tr>
            <tr>
                <th class="border px-4 py-2">Gender</th>
                <td class="border px-4 py-2">{{ $user->gender }}</td>
            </tr>
            <tr>
                <th class="border px-4 py-2">Birthdate</th>
                <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($user->birthdate)->format('F j, Y') }}</td>

            </tr>
            <tr>
                <th class="border px-4 py-2">Penalty</th>
                <td class="border px-4 py-2">
                    @if($user->penalty > 0)
                        ₱{{ number_format($user->penalty, 2) }}
                    @else
                        No Penalty
                    @endif
                </td>
                
            </tr>
            
        </table>
    </div>
    @endsection
</x-app-layout>
