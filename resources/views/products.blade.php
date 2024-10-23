<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <title>Products</title>
</head>
<body class="flex flex-col min-h-screen">
    @include("layouts.adminNavbar")
    <main class="flex-grow flex items-center justify-center">
        <form class="w-full max-w-lg bg-white p-6 rounded shadow-md" method="POST" enctype="multipart/form-data" action="{{route('product-store')}}">
            <div>
                @if (@session('Success'))
                 <h2 class="text-green-600 align-middle">{{@session('Success')}}</h2>
                @endif
                @if (@session('fail'))
                <h2 class="text-red-600 align-middle">{{@session('fail')}}</h2>
               @endif
             </div>
              @csrf
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full mb-6 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product-name">
                        Product Name
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="product-name" name="product-name" type="text" placeholder="Enter product name" required value="{{old('product-name')}}">
                    @error('product-name')
                    <p class="text-red-600">{{$message}}
                @enderror
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full mb-6 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="quantity">
                        Quantity
                    </label>
                    <input 
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
                        id="quantity"
                        name="quantity" 
                        type="number" 
                        placeholder="Enter quantity" 
                        required 
                        min="1" 
                        value="{{old('quantity')}}"
                    >
                    @error('quantity')
                    <p class="text-red-600">{{$message}}
                @enderror
                </div>
                
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="buying-price">
                        Buying Price
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="buying-price" type="number" step="0.01" placeholder="Enter buying price" name="buying-price" required value="{{old('buying-price')}}">
                    @error('buying-price')
                    <p class="text-red-600">{{$message}}
                @enderror
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="selling-price">
                        Selling Price
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="selling-price" name="selling-price" type="number" step="0.01" placeholder="Enter selling price" required value="{{old('selling-price')}}">
                    @error('selling-price')
                    <p class="text-red-600">{{$message}}
                @enderror
                </div>
            </div>
        
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="file_input">Product Image</label>
            <input class="block w-full text-sm text-gray-200 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-800" id="file_input" name="file_input" type="file" value="{{old('file_input')}}">
            @error('file_input')
            <p class="text-red-600">{{$message}}
             @enderror
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
                        Description
                    </label>
                    <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="description" name="description" placeholder="Enter product description" required></textarea value="{{old('description')}}">
                    @error('description')
                    <p class="text-red-600">{{$message}}
                @enderror
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full mb-6 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="category">
                        Category
                    </label>
                    <select class="block appearance-none w-full bg-gray-200 border border-gray-500 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white" name="category_id" id="category" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
           <div class="w-full mb-6 px-3">
             <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="brand">
            Brand
           </label>
            <select class="block appearance-none w-full bg-gray-200 border border-gray-500 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white" name="brand_id" id="brand" required>
            <option value="">Select Brand</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
             </select>
             @error('brand_id')
            <p class="text-red-600">{{ $message }}</p>
            @enderror
            </div>
           </div>

            
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full mb-6 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="status">
                        Status
                    </label>
                    <select class="block appearance-none w-full bg-gray-200 border border-gray-500 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white" name="status" id="status" required value="{{old('status')}}">
                        <option value="">Select Status</option>
                        <option value="In Stock">Available</option>
                        <option value="Out of stock">Out of Stock</option>
                        <option value="Discontinued">Discontinued</option>
                    </select>
                    @error('status')
                    <p class="text-red-600">{{$message}}
                @enderror
                </div>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                    Submit
                </button>
            </div>
        </form>
    </main>

    @include('layouts.footerLayout')
</body>
</html>
