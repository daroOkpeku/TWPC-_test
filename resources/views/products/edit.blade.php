@extends('layouts.app')

@section('content')
<div class="px-4 py-6 sm:px-0">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Product</h1>
        <p class="mt-1 text-sm text-gray-600">Update product information.</p>
    </div>

    <div class="bg-white shadow-sm rounded-lg">
        <form action="{{ route('products.update', $product) }}" method="POST" class="space-y-6 p-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">
                    Product Name
                </label>
                <div class="mt-1">
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name', $product->name) }}"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('name') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                        placeholder="Enter product name"
                    >
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">
                    Description
                </label>
                <div class="mt-1">
                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('description') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                        placeholder="Enter product description"
                    >{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">
                    Price
                </label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">$</span>
                    </div>
                    <input
                        type="number"
                        name="price"
                        id="price"
                        value="{{ old('price', $product->price) }}"
                        step="0.01"
                        min="0"
                        class="block w-full pl-7 pr-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('price') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                        placeholder="0.00"
                    >
                </div>
                @error('price')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('products.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-400">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
