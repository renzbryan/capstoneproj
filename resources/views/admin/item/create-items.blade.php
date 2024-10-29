@extends('layouts.app')

@section('title', 'Create BFAR Office')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="container mx-auto p-4 mt-8 ml-48 lg:p-12 font-nunito">
    <div class="bg-white shadow-lg rounded-lg p-8">
        <form action="{{ route('items.store', ['iar_id' => $iar_id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-2">
                <div>
                    <div class="mb-4">
                        <label for="item_name" class="block text-gray-700 font-semibold mb-2">Name:</label>
                        <input type="text" name="item_name" id="item_name" class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="item_desc" class="block text-gray-700 font-semibold mb-2">Description:</label>
                        <input type="text" name="item_desc" id="item_desc" class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="category" class="block text-gray-700 font-semibold mb-2">Category:</label>
                        <select name="category" id="category" class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div>
                    <div class="mb-4">
                        <label for="item_unit" class="block text-gray-700 font-semibold mb-2">Unit:</label>
                        <select name="item_unit" id="item_unit" class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="set">set</option>
                            <option value="bundle">bundle</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="item_quantity" class="block text-gray-700 font-semibold mb-2">Quantity:</label>
                        <input type="text" name="item_quantity" id="item_quantity" class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="flex justify-between">
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Save</button>
                        <button type="button" class="bg-red-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500" onclick="window.history.back()">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

    @endsection
