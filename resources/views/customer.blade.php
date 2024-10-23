<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <title>Landing Page</title>
</head>
<body>
    @include('layouts.customerNavbar')

    <section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-12">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
          <!-- Heading & Filters -->
  
            <div class="flex items-center space-x-4">
              <form action="" method="GET" class="flex items-center space-x-4">
                <div>
                    <label for="category" class="block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2">Category</label>
                    <select name="category_id" id="category" class="block appearance-none w-full bg-gray-200 border border-gray-500 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white" onchange="this.form.submit()" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="brand" class="block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2">Brand</label>
                    <select name="brand_id" id="brand" class="block appearance-none w-full bg-gray-200 border border-gray-500 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white" onchange="this.form.submit()" required>
                        <option value="">Select Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
            
            
              <div id="dropdownSort1" class="z-50 hidden w-40 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700" data-popper-placement="bottom">
                <ul class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400" aria-labelledby="sortDropdownButton">
                  <li>
                    <a href="#" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"> The most popular </a>
                  </li>
                  <li>
                    <a href="#" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"> Newest </a>
                  </li>
                  <li>
                    <a href="#" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"> Increasing price </a>
                  </li>
                  <li>
                    <a href="#" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"> Decreasing price </a>
                  </li>
                  <li>
                    <a href="#" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"> No. reviews </a>
                  </li>
                  <li>
                    <a href="#" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"> Discount % </a>
                  </li>
                </ul>
              </div>
            </div>
            <br>
            <div class="mb-4 grid gap-4 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 md:mb-8">
              @foreach ($products as $product)
                  <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                      <div class="h-56 w-full">
                          <a href="#">
                              <img class="mx-auto h-full dark:hidden" src="{{ asset('storage/' . $product->image) }}" alt="" />
                              <img class="mx-auto hidden h-full dark:block" src="{{ asset('storage/' . $product->image) }}" alt="" />
                          </a>
                      </div>
                      <div class="pt-6">
                          <div class="mb-4 flex items-center justify-between gap-4">
                              <div class="flex items-center justify-end gap-1">
                                  <button type="button" data-tooltip-target="tooltip-quick-look" class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                      <span class="sr-only"> Quick look </span>
                                      <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                          <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                          <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                      </svg>
                                  </button>
                                  <div id="tooltip-quick-look" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700" data-popper-placement="top">
                                      Quick look
                                      <div class="tooltip-arrow" data-popper-arrow=""></div>
                                  </div>
          
                                  <button type="button" data-tooltip-target="tooltip-add-to-favorites" class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                      <span class="sr-only"> Add to Favorites </span>
                                      <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z" />
                                      </svg>
                                  </button>
                                  <div id="tooltip-add-to-favorites" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700" data-popper-placement="top">
                                      Add to favorites
                                      <div class="tooltip-arrow" data-popper-arrow=""></div>
                                  </div>
                              </div>
                          </div>
          
                          <a href="#" class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{{$product->pname}}</a>
                          <p class="text-sm font-medium text-gray-900 dark:text-white">5.0</p>
                          <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$product->Status}}</p>
          
                          <ul class="mt-2 flex items-center gap-4">
                              <li class="flex items-center gap-2">
                                  <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                                  </svg>
                                  <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Fast Delivery</p>
                              </li>
          
                              <li class="flex items-center gap-2">
                                  <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                      <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M8 7V6c0-.6.4-1 1-1h11c.6 0 1 .4 1 1v7c0 .6-.4 1-1 1h-1M3 18v-7c0-.6.4-1 1-1h11c.6 0 1 .4 1 1v7c0 .6-.4 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                  </svg>
                                  <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Best Price</p>
                              </li>
                          </ul>
          
                          <div class="mt-4 flex items-center justify-between gap-4">
                              <p class="text-2xl font-extrabold leading-tight text-gray-900 dark:text-white">{{$product->price}}</p>
                          </div>
                          <div class="mt-4 flex items-center justify-center gap-4">
                              <form action="{{ route('cart.add') }}" method="POST">
                                  @csrf
                                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                                  <button type="submit" class="inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                      <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                      </svg>
                                      Add to cart
                                  </button>
                              </form>
                        </div>
                      </div>
                  </div>
              @endforeach
          </div>
        
      </section>

    @include('layouts.footerLayout')
</body>
</html>

