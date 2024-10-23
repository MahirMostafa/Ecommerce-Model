<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <title>Payment</title>
</head>
<body>
    @include('layouts.customerNavbar')

<div class="container mx-auto p-8">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Payment for Order #{{ $order->id }}</h2>

    <p class="text-xl mb-4">Total Amount: ${{ $order->total_amount }}</p>

    <form action="{{ route('payment.store', $order->id) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="method" class="block mb-2 text-lg">Select Payment Method:</label>
            <select name="method" id="method" class="block w-full px-4 py-2 border rounded">
                <option value="COD">Cash on Delivery</option>
                <option value="online">Online Payment</option>
            </select>
        </div>
        <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600">Confirm Payment</button>
    </form>
</div>

</body>
</html>