@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 mt-8 ml-48 lg:p-12 font-nunito">
    <div class="bg-white border-t-4 border-blue-900 shadow-lg rounded-lg p-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Create New RIS</h2>

        <form action="{{ route('ris.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-2">
                <!-- Entity Name Field -->
                <div class="mb-4">
                    <label for="entity_name" class="block text-gray-700 font-semibold mb-2">Entity Name</label>
                    <input type="text" name="entity_name" id="entity_name" 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           value="{{ old('entity_name') }}" required>
                </div>

                <!-- Fund Cluster Field -->
                <div class="mb-4">
                    <label for="fundcluster" class="block text-gray-700 font-semibold mb-2">Fund Cluster</label>
                    <input type="text" name="fundcluster" id="fundcluster" 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           value="{{ old('fundcluster') }}" required>
                </div>

                <!-- Division Field -->
                <div class="mb-4">
                    <label for="division" class="block text-gray-700 font-semibold mb-2">Division</label>
                    <input type="text" name="division" id="division" 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           value="{{ old('division') }}" required>
                </div>

                <!-- Office Field -->
                <div class="mb-4">
                    <label for="office" class="block text-gray-700 font-semibold mb-2">Office</label>
                    <input type="text" name="office" id="office" 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           value="{{ old('office') }}" required>
                </div>

                <!-- RCC Field -->
                <div class="mb-4">
                    <label for="rcc" class="block text-gray-700 font-semibold mb-2">RCC</label>
                    <input type="text" name="rcc" id="rcc" 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           value="{{ old('rcc') }}" required>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-between">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Submit
                </button>
                <button type="button" class="bg-red-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500" 
                        onclick="window.history.back()">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
