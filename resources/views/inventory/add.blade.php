<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <title>Add Inventory</title>
</head>
<body class="bg-gray-100">

    @include('layouts.adminNavbar')

    <div class="max-w-4xl mx-auto py-10">
        <div class="bg-white p-8 shadow-md rounded-lg">

            <h1 class="text-2xl font-semibold text-gray-700 mb-6">Add Product to Inventory</h1>

            <!-- Success message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('inventory.add') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Product selection -->
                <div>
                    <label for="product_id" class="block text-sm font-medium text-gray-700">Select Product:</label>
                    <select name="product_id" id="product_id" class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <option value="" disabled selected>Select a product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                {{ $product->pname }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Validation error for product_id -->
                    @error('product_id')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Quantity input -->
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" min="1" class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('quantity') }}" required>

                    <!-- Validation error for quantity -->
                    @error('quantity')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buying price input -->
                <div>
                    <label for="buying_price" class="block text-sm font-medium text-gray-700">Buying Price:</label>
                    <input type="number" name="buying_price" id="buying_price" step="0.01" class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('buying_price') }}" required>

                    <!-- Validation error for buying_price -->
                    @error('buying_price')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Selling price input -->
                <div>
                    <label for="selling_price" class="block text-sm font-medium text-gray-700">Selling Price:</label>
                    <input type="number" name="selling_price" id="selling_price" step="0.01" class="block w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('selling_price') }}" required>

                    <!-- Validation error for selling_price -->
                    @error('selling_price')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit button -->
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Add to Inventory
                    </button>
                </div>
            </form>

            <!-- Validation Errors (Overall Form Validation) -->
            @if ($errors->any())
                <div class="mt-6">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">There were some errors:</strong>
                        <ul class="mt-1 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @include('layouts.footerLayout')
</body>
</html>
