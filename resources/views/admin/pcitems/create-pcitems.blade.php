@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 mt-8 ml-48 lg:p-12 font-nunito">
    <div class="bg-white border-t-4 border-blue-900 shadow-lg rounded-lg p-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Complete the PC Item Details</h2>

        <form action="{{ route('pcitems.store') }}" method="POST" class="space-y-6">
        @csrf

<!-- Hidden input for propertyItem iar_id -->
<input type="hidden" name="propertyItem_id" value="{{ $propertyItem->id }}">

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-2">
                <!-- Date Field -->
                <div class="mb-4">
                    <label for="date" class="block text-gray-700 font-semibold mb-2">Date</label>
                    <input type="date" name="date" id="date" 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           value="{{ old('date') }}" required>
                </div>

                <!-- Reference Field -->
                <div class="mb-4">
                    <label for="reference" class="block text-gray-700 font-semibold mb-2">Reference</label>
                    <input type="text" name="reference" id="reference" 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           value="{{ old('reference') }}" required>
                </div>

                <!-- Receipt Qty Field -->
                <div class="mb-4">
                    <label for="receipt_qty" class="block text-gray-700 font-semibold mb-2">Receipt Quantity</label>
                    <input type="number" name="receipt_qty" id="receipt_qty" 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           value="{{ old('receipt_qty') }}" required>
                </div>

                <!-- Issue Qty Field -->
                <div class="mb-4">
                    <label for="issue_qty" class="block text-gray-700 font-semibold mb-2">Issue Quantity</label>
                    <input type="number" name="issue_qty" id="issue_qty" 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           value="{{ old('issue_qty') }}" required>
                </div>

                <!-- Issue Office Field -->
                <div class="mb-4">
                    <label for="issue_office" class="block text-gray-700 font-semibold mb-2">Issue Office</label>
                    <input type="text" name="issue_office" id="issue_office" 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           value="{{ old('issue_office') }}" required>
                </div>

                <!-- Balance Qty Field -->
                <div class="mb-4">
                    <label for="balance_qty" class="block text-gray-700 font-semibold mb-2">Balance Quantity</label>
                    <input type="number" name="balance_qty" id="balance_qty" 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           value="{{ old('balance_qty') }}" required>
                </div>

                <div class="mb-4">
                    <label for="amount" class="block text-gray-700 font-semibold mb-2">Amount</label>
                    <input type="number" name="amount" id="amount" 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           value="{{ old('amount') }}" required>
                </div>

                <div class="mb-4">
                    <label for="remarks" class="block text-gray-700 font-semibold mb-2">Remarks</label>
                    <input type="text" name="remarks" id="remarks" 
                           class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           value="{{ old('remarks') }}" required>
                </div>
>
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


