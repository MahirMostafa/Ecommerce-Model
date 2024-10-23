<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Tailwind CDN -->
</head>
<body class="bg-gray-100">
    {{-- Include the user navbar only if the user is logged in --}}
    @if(Auth::check())
        @include('layouts.customerNavbar') <!-- Adjust the path as necessary -->
    @else
        @include('layouts.appLayout') <!-- Include a guest navbar or layout -->
    @endif

    <div class="container mx-auto p-8">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Shopping Cart</h2>

        <!-- Display Error Messages -->
        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if(session('cart') && count(session('cart')) > 0)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200 text-gray-600 text-sm uppercase font-semibold">
                        <tr>
                            <th class="w-2/5 px-4 py-3 text-left">Product</th>
                            <th class="w-1/5 px-4 py-3 text-center">Quantity</th>
                            <th class="w-1/5 px-4 py-3 text-center">Price</th>
                            <th class="w-1/5 px-4 py-3 text-center">Total</th>
                            <th class="w-1/5 px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach(session('cart') as $id => $details)
                            <tr class="border-t border-gray-200">
                                <td class="px-4 py-4 flex items-center">
                                    <img src="{{ asset('storage/' . $details['image']) }}" class="w-16 h-16 object-cover rounded mr-4" alt="{{ $details['name'] }}">
                                    <span class="text-lg">{{ $details['name'] }}</span>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center justify-center">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="w-16 text-center border border-gray-300 rounded py-1">
                                        <button type="submit" class="ml-2 px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Update</button>
                                    </form>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <span class="text-lg font-semibold">${{ $details['price'] }}</span>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <span class="text-lg font-semibold">${{ $details['price'] * $details['quantity'] }}</span>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex justify-between items-center px-6 py-4 bg-gray-100 border-t border-gray-200">
                    <strong class="text-xl text-gray-900">Total: ${{ array_sum(array_map(function($item) {
                        return $item['price'] * $item['quantity'];
                    }, session('cart'))) }}</strong>
                    <form action="{{ route('cart.placeOrder') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600">Place Order</button>
                    </form>
                </div>
            </div>
        @else
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <p class="text-xl text-gray-800 font-semibold">Your cart is empty!</p>
                <a href="/" class="mt-4 inline-block px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Continue Shopping</a>
            </div>
        @endif
    </div>

    @include('layouts.footerLayout')
</body>
</html>
