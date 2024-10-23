<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <title>Update Brand</title>
</head>
<body class="flex flex-col min-h-screen">
    @include("layouts.adminNavbar")
    <main class="flex-grow flex items-center justify-center">
        <form class="w-full max-w-lg bg-white p-6 rounded shadow-md" method="POST" enctype="multipart/form-data" action="{{route('updatebrand',$fetchedbrand->id)}}">
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
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                        Brand Name
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="name" name="name" type="text" placeholder="Enter category name" required value="{{$fetchedbrand->name}}">
                    @error('name')
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
