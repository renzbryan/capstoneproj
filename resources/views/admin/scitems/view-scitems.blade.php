@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 mt-8 ml-48 lg:p-12 font-nunito">
    <header class="mb-8">
        <div class="flex space-x-4 mb-4">
            <button class="bg-red-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500" onclick="window.history.back()">← Back</button>
        </div>
    </header>

    @if($stockEntry) <!-- Check if stockEntry is not null -->
        <div class="bg-white border-t-4 border-blue-900 shadow-lg rounded-lg p-8 mb-8">
            <h2 class="text-xl font-semibold mb-4">STOCK CARD</h2>
            
            <!-- Displaying details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-gray-700 font-semibold"><strong>Entity Name:</strong> {{ $stockEntry->iar_entityname }}</p>
                    <p class="text-gray-700 font-semibold"><strong>Stock Name:</strong> {{ $stockEntry->stock_name }}</p>
                    <p class="text-gray-700 font-semibold"><strong>Quantity:</strong> {{ $stockEntry->quantity }}</p>
                    <p class="text-gray-700 font-semibold"><strong>Description:</strong> {{ $stockEntry->description }}</p>
                    <p class="text-gray-700 font-semibold"><strong>Unit of Measurement:</strong> {{ $stockEntry->unit }}</p>
                </div>
                <div>
                    <p class="text-gray-700 font-semibold"><strong>Fund Cluster:</strong> {{ $stockEntry->iar_fundcluster }}</p>   
                    <p class="text-gray-700 font-semibold"><strong>Stock No.:</strong> {{ $stockEntry->stocks_id }}</p> 
                    <p class="text-gray-700 font-semibold"><strong>Reorder Point:</strong> {{ $stockEntry->reorder_point }}</p> 
                </div>
            </div>
        </div>

        <!-- Optional section for additional stock entry details -->
        <div class="bg-white border-t-4 border-blue-900 shadow-lg rounded-lg p-8">
            <h2 class="text-xl font-semibold mb-4">Transaction History</h2>
            <form id="transferForm">
                <table class="min-w-full bg-white border border-gray-300 rounded-md">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th>Date</th>
                            <th>Reference</th>
                            <th>Receipt Qty</th>
                            <th>Issue Qty</th>
                            <th>Issue Office</th>
                            <th>Balance Qty</th>
                            <th>No. of days to Consume</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $stockEntry->date }}</td>
                            <td>{{ $stockEntry->reference }}</td>
                            <td>{{ $stockEntry->receipt_qty }}</td>
                            <td>{{ $stockEntry->issue_qty }}</td>
                            <td>{{ $stockEntry->issue_office }}</td>
                            <td>{{ $stockEntry->balance_qty }}</td>
                            <td>{{ $stockEntry->consume }}</td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    @else
        <p class="text-red-500">No stock entry found.</p>
    @endif
</div>
@endsection
