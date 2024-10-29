@extends('layouts.app')

@section('title', 'Create BFAR Office')
@vite(['resources/css/app.css', 'resources/js/app.js'])
@section('content')
<div class="grid w-screen gap-6 p-20 ml-40  mx-auto font-nunito">
  



  <!-- Update Excel Form -->
  <div class="w-full md:w-1/2 border-t-4 border-blue-900 bg-white p-6 rounded-md shadow-lg">
    <h2 class="text-xl font-bold mb-4">Update Excel</h2>
    @if(session('success'))
      <div class="bg-green-500 text-white p-4 rounded-md mb-4">
        {{ session('success') }}
      </div>
    @endif
    <form action="{{ route('update.excel') }}" method="POST">
      @csrf
      <div class="mb-4">
        <label for="updated_value" class="block text-gray-700 font-bold mb-2">OIC, Property & Supply Officer:</label>
        <input type="text" name="updated_value" id="updated_value" class="w-full border-gray-300 rounded-md uppercase focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
  
      <div class="col-md-6">
        <div class="settings-form">
          <h2>Update Excel</h2>
  
          @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif
  
          <form action="{{ route('update.excel') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="updated_value">OIC, Property & Supply Officer:</label>
              <input type="text" name="updated_value" class="form-control" style="text-transform: uppercase;">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="settings-form">
          <h2>Add a Category</h2>
  
          @if(session('success-category'))
            <div class="alert alert-success">
              {{ session('success-category') }}
            </div>
          @endif
  
          <form action="{{ route('category.insert') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="category">Inventory Category:</label>
              <input type="text" name="category" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Insert</button>
          </form>
        </div>
      </div>
      
      <div class="mb-4">
        <label for="rcc" class="block text-gray-700 font-bold mb-2">RCC:</label>
        <input type="text" name="rcc" id="rcc" class="w-full border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 active:bg-blue-800">Submit</button>
    </form>
  </div>
</div>
@endsection
