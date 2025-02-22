<x-app-layout>
    @section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2>Payment Section - Users with Penalties</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Penalty Amount</th>
                    <th>Payment</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ number_format($user->penalty, 2) }} PHP</td>
                        <td>
                            <button onclick="showPaymentPopup({{ $user->id }}, '{{ $user->name }}', {{ $user->penalty }})">
                                Pay
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div id="paymentPopup" style="display: none;">
        <div>
            <h3>Payment for <span id="userName"></span></h3>
            <form id="paymentForm" method="POST">
                @csrf
                <input type="hidden" id="userId" name="user_id">
                <label for="paymentAmount">Enter Amount:</label>
                <input type="number" id="paymentAmount" name="payment_amount" min="1" required>
                <button type="submit">Confirm Payment</button>
                <button type="button" onclick="hidePaymentPopup()">Cancel</button>
            </form>
        </div>
    </div>
    
    <script>
    function showPaymentPopup(userId, userName, penaltyAmount) {
        document.getElementById('paymentPopup').style.display = 'block';
        document.getElementById('userName').innerText = userName;
        document.getElementById('userId').value = userId;
        document.getElementById('paymentForm').action = "/staff/payment/" + userId;
    }
    
    function hidePaymentPopup() {
        document.getElementById('paymentPopup').style.display = 'none';
    }
    </script>
    @endsection
    </x-app-layout>
    