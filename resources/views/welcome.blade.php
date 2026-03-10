@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                <span class="block">Manage Your</span>
                <span class="block text-blue-600">Product Inventory</span>
            </h1>
            <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                A simple and elegant solution to manage your products. Create, edit, and organize your inventory with ease.
            </p>
            <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
                <div class="rounded-md shadow">
                    <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10">
                        Get Started
                    </a>
                </div>
                <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                    <a href="{{ route('login') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                        Sign In
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-16">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white mb-4">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Create Products</h3>
                    <p class="text-gray-600">Easily add new products to your inventory with detailed information including name, description, and price.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white mb-4">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Edit Products</h3>
                    <p class="text-gray-600">Update product information anytime. Keep your inventory current with latest details and pricing.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-red-500 text-white mb-4">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Delete Products</h3>
                    <p class="text-gray-600">Remove products from your inventory with a simple click. Keep your product list clean and organized.</p>
                </div>
            </div>
        </div>

        <div class="mt-16 bg-white rounded-lg shadow-lg p-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-4">Secure & Private</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Your data is secure with user authentication. Only you can view and manage your own products. 
                    Each user has their own private inventory that's completely isolated from others.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
