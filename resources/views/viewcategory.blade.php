<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <title>View Catagory</title>
</head>
<body class="bg-gray-100">
    @include("layouts.adminNavbar")
    <div class="font-sans p-6 mx-auto lg:max-w-5xl md:max-w-3xl sm:max-w-full bg-white rounded-lg shadow-md">
        <h2 class="text-4xl text-center font-bold text-gray-800 mb-8">Category List</h2>
        <div>
            @if (@session('Success'))
                <h2 class="text-green-600 text-center mb-4">{{ @session('Success') }}</h2>
            @endif
        </div>
        <div class="overflow-hidden rounded-lg shadow">
            <table class="min-w-full bg-white divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($categories as $category)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $category->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $category->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('editcategory', $category->id) }}" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2.5 me-2 mb-2 transition duration-200">
                                Edit
                            </a>
                            <form action="{{ route('deletecategory', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 transition duration-200">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('layouts.footerLayout')

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this category? This action cannot be undone.');
        }
    </script>
</body>
</html>
