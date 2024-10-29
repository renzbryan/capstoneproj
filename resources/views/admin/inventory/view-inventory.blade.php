@extends('layouts.app')

@section('title', 'BFAR Inventory')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="grid w-full gap-6 p-20 ml-40  mx-auto font-nunito">
    <h1 class="text-3xl font-bold mb-6">BFAR Inventory</h1>
    
      
    <div class="flex gap-4 mb-6">
        <div class="filter-container flex items-center gap-2">
            <label for="officeFilter" class="font-semibold">Filter by Office:</label>
            <select name="officeFilter" id="officeFilter" class="p-2 border rounded">
    <option value="">All Items</option> <!-- Option for all items -->
    @foreach ($officeOptions as $key => $office)
        <option value="{{ $key }}">{{ $office }}</option>
    @endforeach
</select>

        </div>
    </div>
    
    
    <div class="overflow-x-auto">
        <table class="w-full border-collapse bg-white shadow-lg rounded-md overflow-hidden">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="p-4 border-b">Item Name</th>
                    <th class="p-4 border-b">Category</th>
                    <th class="p-4 border-b">Quantity</th>
                    <th class="p-4 border-b">Unit</th>
                    <th class="p-4 border-b">Office</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($itemsWithIar as $item)
                <tr class="hover:bg-gray-100">
                    <td class="p-4 border-b">{{ $item->item_name }}</td>
                    <td class="p-4 border-b">{{ $item->category }}</td>
                    <td class="p-4 border-b">{{ $item->item_quantity }}</td>
                    <td class="p-4 border-b">{{ $item->item_unit }}</td>
                    <td class="p-4 border-b">{{ $item->iar->iar_rod ?? 'N/A' }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
      const officeFilter = document.getElementById('officeFilter');
      const rows = document.querySelectorAll('tbody tr');

      officeFilter.addEventListener('change', function () {
          const selectedOffice = this.value.toLowerCase();

          rows.forEach(row => {
              const officeInRow = row.querySelector('td:nth-child(5)').textContent.trim().toLowerCase();
              const normalizedOfficeInRow = officeInRow.replace(/\s+/g, ' ').toLowerCase();
              
              if (selectedOffice === '' || normalizedOfficeInRow === selectedOffice) {
                  row.style.display = ''; // Show the row
              } else {
                  row.style.display = 'none'; // Hide the row
              }
          });
      });

      // Trigger change event to apply initial filter
      officeFilter.dispatchEvent(new Event('change'));
  });
</script>



@endsection
