<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <title>Transaction History</title>
</head>

<body>
    @include('layouts.adminNavbar')

    <div class="container mx-auto mt-5 px-4">
        <h1 class="text-3xl font-bold mb-6 text-center">Search Transaction History by Product ID</h1>

        <!-- Form to input product ID -->
        <form action="{{ route('transactions.get') }}" method="GET" class="mb-8">
            <div class="flex flex-col items-center">
                <label for="product_id" class="block text-lg font-medium text-gray-700 mb-2">Enter Product ID:</label>
                <input type="number" name="product_id" id="product_id" required class="mt-1 p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent sm:text-sm w-80" placeholder="Product ID">
                <button type="submit" class="mt-4 px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 transition duration-300">Search</button>
            </div>
        </form>

        @if(isset($product))
            <h2 class="text-2xl font-semibold mb-4 text-center">Transaction History for {{ $product->pname }}</h2>

            @if($transactions->isEmpty())
                <p class="text-center text-gray-500">No transactions found for this product.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2 border text-left">Quantity</th>
                                <th class="px-4 py-2 border text-left">Buying Price</th>
                                <th class="px-4 py-2 border text-left">Selling Price</th>
                                <th class="px-4 py-2 border text-left">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-4 py-2 border">{{ $transaction->quantity }}</td>
                                    <td class="px-4 py-2 border">{{ number_format($transaction->buying_price, 2) }}</td>
                                    <td class="px-4 py-2 border">{{ number_format($transaction->selling_price, 2) }}</td>
                                    <td class="px-4 py-2 border">{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        
        @elseif(isset($noProductMessage))
        <div class="bg-red-500 text-center text-white p-4 rounded mb-4">

               {{ $noProductMessage }}       </div>
    @endif

    </div>

    @include('layouts.footerLayout')
</body>

</html>
