@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 mt-8 ml-48 lg:p-12 font-nunito">
    <header class="mb-8">
        <div class="flex space-x-4 mb-4">
            <button class="bg-red-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500" onclick="window.history.back()">← Back</button>
        </div>
    </header>

    @if($pcEntry) <!-- Check if pcEntry is not null -->
        <div class="bg-white border-t-4 border-blue-900 shadow-lg rounded-lg p-8 mb-8">
            <h2 class="text-xl font-semibold mb-4">PROPERTY CARD</h2>
            
            <!-- Displaying Property Item details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-gray-700 font-semibold"><strong>Entity Name:</strong> {{ $pcEntry->iar_entityname }}</p>
                    <p class="text-gray-700 font-semibold"><strong>Property, Plant and Equipment:</strong> {{ $pcEntry->property_name }}</p>
                    <p class="text-gray-700 font-semibold"><strong>Description:</strong> {{ $pcEntry->description }}</p>
                </div>
                <div> 
                    <p class="text-gray-700 font-semibold"><strong>Fund Cluster:</strong> {{ $pcEntry->iar_fundcluster }}</p> 
                    <p class="text-gray-700 font-semibold"><strong>Property, Plant and Equipment:</strong> {{ $pcEntry->property_name }}</p>
                    <p class="text-gray-700 font-semibold"><strong>Property No.:</strong>{{ $pcEntry->id }}</p> 
                </div>
            </div>
        </div>

        <!-- Optional section for additional property entry details -->
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
                            <th>Amount</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $pcEntry->date }}</td>
                            <td>{{ $pcEntry->reference }}</td>
                            <td>{{ $pcEntry->receipt_qty }}</td>
                            <td>{{ $pcEntry->issue_qty }}</td>
                            <td>{{ $pcEntry->issue_office }}</td>
                            <td>{{ $pcEntry->balance_qty }}</td>
                            <td>{{ $pcEntry->amount }}</td>
                            <td>{{ $pcEntry->remarks }}</td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    @else
        <p class="text-red-500">No property entry found.</p>
    @endif
</div>
@endsection
