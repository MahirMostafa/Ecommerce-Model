<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <title>Add Address</title>
    <style>
        .primary-bg {
            background-color: #4F46E5; /* Customize the primary color */
        }
        .primary-bg:hover {
            background-color: #4338CA; /* Darker hover color */
        }
        .primary-text {
            color: #4F46E5;
        }
    </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900">
    @include("layouts.customerNavbar")

    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-lg bg-white rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 p-8">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6 text-center">
                Add Your Address
            </h1>

            <!-- Display session messages -->
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

            <!-- Form -->
            <form class="space-y-6" method="POST" action="{{ route('addresses.store') }}">
                @csrf

                <!-- Address Line 1 -->
                <div>
                    <label for="address_line_1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                    <input type="text" name="address_line_1" id="address_line_1" class="bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="123 Main St" required>
                    @error('address_line_1')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address Line 2 -->
                <div>
                    <label for="address_line_2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">House/Road</label>
                    <input type="text" name="address_line_2" id="address_line_2" class="bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Apt, suite, etc. (optional)">
                    @error('address_line_2')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- City -->
                <div>
                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                    <input type="text" name="city" id="city" class="bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="City" required>
                    @error('city')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- State -->
                <div>
                    <label for="state" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">State</label>
                    <input type="text" name="state" id="state" class="bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="State" required>
                    @error('state')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Postal Code -->
                <div>
                    <label for="postal_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Postal Code</label>
                    <input type="text" name="postal_code" id="postal_code" class="bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Postal Code" required>
                    @error('postal_code')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Country -->
                <div>
                    <label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                    <input type="text" name="country" id="country" class="bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Country" required>
                    @error('country')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-3 text-center shadow-lg primary-bg">
                    Add Address
                </button>
            </form>
        </div>
    </div>
</body>

</html>
