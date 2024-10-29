@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])
@section('content')
<div class="container mx-auto p-8 mt-12 ml-48 max-w-2xl bg-white rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Create SC Item</h2>
    
    <form action="{{ route('scitems.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Hidden input for stocks_id -->
        <input type="hidden" name="stocks_id" value="{{ $stockItem->id }}">

        <!-- Date Field -->
        <div>
            <label for="date" class="block text-lg font-medium text-gray-600">Date</label>
            <input type="date" name="date" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-300" value="{{ old('date') }}" required>
        </div>

        <!-- Reorder Point Field -->
        <div>
            <label for="reorder_point" class="block text-lg font-medium text-gray-600">Reorder Point</label>
            <input type="text" name="reorder_point" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-300" value="{{ old('reorder_point') }}" required>
        </div>

        <!-- Reference Field -->
        <div>
            <label for="reference" class="block text-lg font-medium text-gray-600">Reference</label>
            <input type="text" name="reference" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-300" value="{{ old('reference') }}" required>
        </div>

        <!-- Receipt Qty Field -->
        <div>
            <label for="receipt_qty" class="block text-lg font-medium text-gray-600">Receipt Quantity</label>
            <input type="number" name="receipt_qty" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-300" value="{{ old('receipt_qty') }}" required>
        </div>

        <!-- Issue Qty Field -->
        <div>
            <label for="issue_qty" class="block text-lg font-medium text-gray-600">Issue Quantity</label>
            <input type="number" name="issue_qty" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-300" value="{{ old('issue_qty') }}" required>
        </div>

        <!-- Issue Office Field -->
        <div>
            <label for="issue_office" class="block text-lg font-medium text-gray-600">Issue Office</label>
            <input type="text" name="issue_office" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-300" value="{{ old('issue_office') }}" required>
        </div>

        <!-- Balance Qty Field -->
        <div>
            <label for="balance_qty" class="block text-lg font-medium text-gray-600">Balance Quantity</label>
            <input type="number" name="balance_qty" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-300" value="{{ old('balance_qty') }}" required>
        </div>

        <!-- Consume Field -->
        <div>
            <label for="consume" class="block text-lg font-medium text-gray-600">No. of days to Consume</label>
            <input type="number" name="consume" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-300" value="{{ old('consume') }}" required>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="w-full py-3 bg-green-500 hover:bg-green-600 text-white text-lg font-semibold rounded-md shadow-md focus:outline-none focus:ring-4 focus:ring-green-300">
                Create SC Item
            </button>
        </div>
    </form>
</div>
@endsection
