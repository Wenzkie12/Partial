
<x-app-layout>
    @section('content')
<table>
    <thead>
        <tr>
            <th>Amount</th>
            <th>Reference No</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $payment)
            <tr>
                <td>₱{{ number_format($payment->payment_amount, 2) }}</td>
                <td>{{ $payment->reference_number }}</td>
                <td>{{ $payment->payment_date }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
</x-app-layout>
