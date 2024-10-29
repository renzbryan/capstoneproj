@extends('layouts.app')

@section('title', 'View Stock')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="grid w-full gap-6 p-20 ml-36 pl-24  mx-auto font-nunito">
  
<div class="flex gap-2">
    <a href="{{ route('archive.iar') }}" class="w-fit bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 active:bg-red-800">Archived IAR Forms</a>
    <!-- You can add more navigation links here -->
</div>
    <h1 class="text-3xl font-bold mb-6">Wasted Material Report</h1>
    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6">
        @foreach($wmrEntries as $item)
        <div class="w-full  md:w-1/2 border-t-4 border-blue-900 bg-white p-6 rounded-md shadow-lg">
            <div class="card-header mb-4">
            <h2 class="text-2xl font-semibold mb-2"><strong>{{ $item->name }}</strong></h2>
            </div>
            <div class="card-body">
            <p class="text-lg mb-2"><strong>Description:</strong> {{ $item->description }}</p>
              <p class="text-lg mb-2"><strong>Quantity:</strong> {{ $item->quantity }}</p>
              <p class="text-lg"><strong>Unit:</strong> {{ $item->unit }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
