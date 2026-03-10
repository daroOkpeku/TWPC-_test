@extends('layouts.app')

@section('content')
<div class="px-4 py-6 sm:px-0">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
        <p class="mt-1 text-sm text-gray-600">Product details and information.</p>
    </div>

    <div class="bg-white shadow-sm rounded-lg">
        <div class="p-6">
            <div class="space-y-6">
                <div>
                    <h2 class="text-lg font-medium text-gray-900 mb-2">Product Information</h2>
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Product Name</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $product->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Price</dt>
                            <dd class="mt-1 text-sm text-gray-900">${{ number_format($product->price, 2) }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Description</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $product->description }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Created By</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $product->user->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Created At</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $product->created_at->format('M d, Y \a\t h:i A') }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="border-t pt-6">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-500">
                            Product ID: #{{ $product->id }}
                        </div>
                        <div class="space-x-3">
                            @if($product->user_id === auth()->id())
                                <a href="{{ route('products.edit', $product) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700">
                                    Edit Product
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-red-700" onclick="return confirm('Are you sure you want to delete this product?')">
                                        Delete Product
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('products.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-400">
                                Back to Products
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
