@extends('layouts.app')

@section('title', 'Create BFAR Office')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="grid w-full gap-6 p-20 ml-40 pl-28 mx-auto font-nunito">
    <h1 class="text-4xl font-bold mb-10 text-center text-gray-800">All Forms</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-white border border-gray-300 rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow transform hover:scale-105">
            <div class="flex items-center mb-4">
                <svg class="w-8 h-8 text-blue-600 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0C5.372 0 0 5.372 0 12c0 6.627 5.372 12 12 12s12-5.373 12-12C24 5.372 18.628 0 12 0zm0 22c-5.486 0-10-4.514-10-10S6.514 2 12 2s10 4.514 10 10-4.514 10-10 10zm-2-15h4v8h-4zm0 10h4v2h-4z"/></svg>
                <h2 class="text-xl font-semibold text-gray-800">IAR Form</h2>
            </div>
            <p class="text-gray-600">Inventory Adjustment Request form for stock management.</p>
            <a href="{{ route('iar.index') }}" class="mt-4 inline-block bg-blue-600 text-white rounded-md py-2 px-4 hover:bg-blue-700 transition-colors">View Form</a>
        </div>

        <div class="bg-white border border-gray-300 rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow transform hover:scale-105">
            <div class="flex items-center mb-4">
                <svg class="w-8 h-8 text-green-600 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm0 22C6.478 22 2 17.522 2 12S6.478 2 12 2s10 4.478 10 10-4.478 10-10 10zm-1-15h2v8h-2zm0 10h2v2h-2z"/></svg>
                <h2 class="text-xl font-semibold text-gray-800">Stock Card</h2>
            </div>
            <p class="text-gray-600">Manage and track stock items efficiently.</p>
            <a href="{{ route('stock.index') }}" class="mt-4 inline-block bg-green-600 text-white rounded-md py-2 px-4 hover:bg-green-700 transition-colors">View Form</a>
        </div>

        <div class="bg-white border border-gray-300 rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow transform hover:scale-105">
            <div class="flex items-center mb-4">
                <svg class="w-8 h-8 text-yellow-600 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm0 22C6.478 22 2 17.522 2 12S6.478 2 12 2s10 4.478 10 10-4.478 10-10 10zm1-15h-2v8h2zm0 10h-2v2h2z"/></svg>
                <h2 class="text-xl font-semibold text-gray-800">RIS</h2>
            </div>
            <p class="text-gray-600">Requisition and Issue Slip for requisition requests.</p>
            <a href="{{ route('ris.index') }}" class="mt-4 inline-block bg-yellow-600 text-white rounded-md py-2 px-4 hover:bg-yellow-700 transition-colors">View Form</a>
        </div>

        <div class="bg-white border border-gray-300 rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow transform hover:scale-105">
            <div class="flex items-center mb-4">
                <svg class="w-8 h-8 text-purple-600 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm0 22C6.478 22 2 17.522 2 12S6.478 2 12 2s10 4.478 10 10-4.478 10-10 10zm-1-15h2v8h-2zm0 10h2v2h-2z"/></svg>
                <h2 class="text-xl font-semibold text-gray-800">Property Card</h2>
            </div>
            <p class="text-gray-600">Track properties and assets with property cards.</p>
            <a href="{{ route('property.index') }}" class="mt-4 inline-block bg-purple-600 text-white rounded-md py-2 px-4 hover:bg-purple-700 transition-colors">View Form</a>
        </div>

        <div class="bg-white border border-gray-300 rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow transform hover:scale-105">
            <div class="flex items-center mb-4">
                <svg class="w-8 h-8 text-red-600 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm0 22C6.478 22 2 17.522 2 12S6.478 2 12 2s10 4.478 10 10-4.478 10-10 10zm-1-15h2v8h-2zm0 10h2v2h-2z"/></svg>
                <h2 class="text-xl font-semibold text-gray-800">Semi-Property Card</h2>
            </div>
            <p class="text-gray-600">Maintain records for semi-property items.</p>
            <a href="{{ route('wmr.index') }}" class="mt-4 inline-block bg-red-600 text-white rounded-md py-2 px-4 hover:bg-red-700 transition-colors">View Form</a>
        </div>
    </div>
</div>
@endsection
