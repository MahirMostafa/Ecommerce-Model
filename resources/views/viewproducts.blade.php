<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <title>View Products</title>
</head>
<body>
    @include("layouts.adminNavbar")
    <div class="font-sans p-4 mx-auto lg:max-w-5xl md:max-w-3xl sm:max-w-full">
        <h2 class="text-4xl text-center font-bold text-gray-800 mb-12">Product List</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
            <div class="bg-white rounded overflow-hidden shadow-md cursor-pointer hover:scale-[1.02] transition-all">
                <div class="w-full aspect-w-16 aspect-h-8 lg:h-80">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="images" class="h-full w-full object-cover object-top" />
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-bold text-gray-800">{{$product->pname}}</h3>
                    <div class="mt-4 flex items-center flex-wrap gap-2">
                        <h3 class="text-lg font-font-sans text-gray-800">{{$product->price}}</h3>
                    </div>
                    <div class="mt-1">
                        <h3 class="text-sm font-font-sans text-gray-800">{{$product->Status}}</h3>
                    </div>
                    <div class="mt-1">
                        <h3 class="text-sm font-font-sans text-gray-800">{{$product->quantity}}</h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @include('layouts.footerLayout')
</body>
</html>
