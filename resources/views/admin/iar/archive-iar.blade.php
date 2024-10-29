@extends('layouts.app')

@section('title', 'View Archived IAR Forms')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="grid w-full gap-6 p-20 ml-36 pl-24 mx-auto font-nunito">
    <h1 class="text-3xl font-bold mb-6">Restorable IAR Forms</h1>

    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6">
        @php
            $reversedIars = array_reverse($softDeletedItem->toArray());
        @endphp

        @foreach($reversedIars as $data)
            <div class="w-full md:w-1/2 border-t-4 border-blue-900 bg-white p-6 rounded-md shadow-lg">
                <div class="card-header mb-4">
                    <h2 class="text-2xl font-semibold mb-2">
                        IAR Form #{{ $data['iar_number'] }}
                    </h2>
                </div>
                <div class="card-body">
                    <p class="text-lg mb-2">
                        <strong>{{ $data['iar_entityname'] }}</strong>
                    </p>
                    <p class="text-lg mb-2">
                        <strong>Fund Cluster:</strong> {{ $data['iar_fundcluster'] }}
                    </p>
                    <p class="text-lg mb-2">
                        <strong>Supplier:</strong> {{ $data['iar_supplier'] }}
                    </p>

                    <div class="action-column mt-4">
                        <a class="btn btn-success bg-[#67b868] text-white border-[#67b868] rounded px-4 py-2 hover:bg-[#218838] hover:border-[#218838]" 
                           href="{{ route('restore.iar', ['iar_id' => $data['iar_id']]) }}">
                           Restore
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
