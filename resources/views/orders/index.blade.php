<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Order</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Tailwind CSS for styling -->
</head>
<body class="bg-gray-100">
    @include('layouts.customerNavbar')

    <div class="container mx-auto p-8">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Your Orders</h2>

        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
            @endif
            @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif
        <!-- If there are orders -->
        @if($orders->count() > 0)
            @foreach($orders as $order)
                <div class="bg-white shadow-md rounded-lg mb-6">
                    <!-- Order Summary -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-gray-700">Order #{{ $order->id }}</h3>
                        <p class="text-gray-600 mb-2">Placed on: {{ $order->created_at->format('F j, Y') }}</p>
                        <p class="text-gray-600 mb-2">Order Status: <strong>{{ ucfirst($order->status) }}</strong></p>
                        <p class="text-gray-600 mb-2">Total Amount: <strong>${{ $order->total_amount }}</strong></p>
                        
                        <!-- Payment Status -->
                        <p class="text-gray-600 mb-2">
                            Payment Status: 
                            @if($order->payment->status == 'paid')
                                <span class="text-green-500 font-bold">Paid</span>
                            @else
                                <span class="text-red-500 font-bold">Pending</span> 
                                <!-- Add button for pending payment -->
                                {{-- <a href="{{ route('stripe.checkout', ['order_id' => $order->id]) }}" class="text-blue-500 hover:underline">Pay Now</a> --}}
                            @endif
                        </p>
                        
                        <!-- Delivery method -->
                        <p class="text-gray-600">Delivery Method: 
                            {{ $order->payment->method == 'COD' ? 'Cash on Delivery' : 'Online Payment' }}
                        </p>
                    </div>

                    <!-- Order Items -->
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-200 text-gray-600 text-sm uppercase font-semibold">
                            <tr>
                                <th class="px-4 py-3 text-left">Product</th>
                                <th class="px-4 py-3 text-center">Quantity</th>
                                <th class="px-4 py-3 text-center">Unit Price</th>
                                <th class="px-4 py-3 text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach($order->orderItems as $item)
                            <tr class="border-t border-gray-200">
                                <td class="px-4 py-4">{{ $products[$item->product_id]->pname }}</td> <!-- Access pname -->
                                <td class="px-4 py-4 text-center">{{ $item->quantity }}</td>
                                <td class="px-4 py-4 text-center">${{ $item->price }}</td>
                                <td class="px-4 py-4 text-center">${{ $item->price * $item->quantity }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- Order Actions -->
                    <div class="flex justify-end p-4">
                        @if($order->status == 'pending')
                            <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Cancel Order</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <!-- No Orders Found -->
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <p class="text-xl text-gray-800 font-semibold">You have no orders yet!</p>
                <a href="/" class="mt-4 inline-block px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Shop Now</a>
            </div>
        @endif
    </div>

    @include('layouts.footerLayout')
</body>
</html>
