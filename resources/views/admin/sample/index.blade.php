@extends('layouts.app')

@section('content')
<div class="grid w-full gap-6 p-20 ml-40 pl-28 mx-auto font-nunito">
    <div class="container">
        <h2 class="text-2xl font-bold mb-6">All Forms</h2>
        <div class="flex gap-4 mb-6">
            <a href="{{ route('iar.index') }}" class="btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">IAR Form</a>
            <a href="{{ route('stock.index') }}" class="btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Stock Card</a>
            <a href="{{ route('ris.index') }}" class="btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">RIS</a>
            <a href="{{ route('property.index') }}" class="btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Property Card</a>
            <a href="{{ route('wmr.index') }}" class="btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Semi-Property Card</a>
        </div>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white border rounded-lg shadow">
            <thead>
                <tr class="bg-gray-100 text-gray-800 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Form Name</th>
                    <th class="py-3 px-6 text-left">Description</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm font-light">
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6">IAR Form</td>
                    <td class="py-3 px-6">Inspection and Acceptance Report Form</td>
                    <td class="py-3 px-6 text-center">
                        <a href="{{ route('iar.index') }}" class="text-blue-500 hover:underline">View</a>
                    </td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6">Stock Card</td>
                    <td class="py-3 px-6">Inventory Management Stock Card</td>
                    <td class="py-3 px-6 text-center">
                        <a href="{{ route('stock.index') }}" class="text-blue-500 hover:underline">View</a>
                    </td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6">RIS</td>
                    <td class="py-3 px-6">Requisition and Issue Slip</td>
                    <td class="py-3 px-6 text-center">
                        <a href="{{ route('ris.index') }}" class="text-blue-500 hover:underline">View</a>
                    </td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6">Property Card</td>
                    <td class="py-3 px-6">Records Property Details</td>
                    <td class="py-3 px-6 text-center">
                        <a href="{{ route('property.index') }}" class="text-blue-500 hover:underline">View</a>
                    </td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6">Semi-Property Card</td>
                    <td class="py-3 px-6">Details Semi-Durable Property</td>
                    <td class="py-3 px-6 text-center">
                        <a href="{{ route('wmr.index') }}" class="text-blue-500 hover:underline">View</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
