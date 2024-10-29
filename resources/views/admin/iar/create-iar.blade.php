@extends('layouts.app')

@section('title', 'Create BFAR Office')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="container mx-auto p-4 mt-8 ml-48 lg:p-12 font-nunito">
    <div class="bg-white border-t-4 border-blue-900 shadow-lg rounded-lg p-8">
        <form action="{{ route('iar.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($taskId))
                <input type="hidden" name="task_id" value="{{ $taskId }}">
            @endif

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-2">
                <div>
                    <div class="mb-4">
                        <label for="iar_entityname" class="block text-gray-700 font-semibold mb-2">Entity Name:</label>
                        <input type="text" name="iar_entityname" id="iar_entityname" 
                               class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               required>
                    </div>

                    <div class="mb-4">
                        <label for="iar_fundcluster" class="block text-gray-700 font-semibold mb-2">Fund Cluster:</label>
                        <input type="number" name="iar_fundcluster" id="iar_fundcluster" 
                               class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               required>
                    </div>

                    <div class="mb-4">
                        <label for="iar_supplier" class="block text-gray-700 font-semibold mb-2">Supplier:</label>
                        <select name="iar_supplier" id="iar_supplier" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                required>
                            <option value="office 1">Hatulan Engineering Works & Machine Shop</option>
                            <option value="office 2">Calapan Water</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="iar_Podate" class="block text-gray-700 font-semibold mb-2">PO No/Date:</label>
                        <input type="date" name="iar_Podate" id="iar_Podate" 
                               class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               required>
                    </div>

                    <div class="mb-4">
                        <label for="iar_rod" class="block text-gray-700 font-semibold mb-2">Requisitioning Office/Dept.:</label>
                        <select name="iar_rod" id="iar_rod" 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="" disabled selected>Select the Office</option>
                            @foreach ($officeOptions as $key => $office)
                                <option value="{{ $key }}">{{ $office }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <div class="mb-4">
                        <label for="iar_rcc" class="block text-gray-700 font-semibold mb-2">Responsibility Center Code:</label>
                        <input type="text" name="iar_rcc" id="iar_rcc" 
                               class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               readonly>
                    </div>

                    <div class="mb-4">
                        <label for="iar_number" class="block text-gray-700 font-semibold mb-2">IAR No.:</label>
                        <input type="text" name="iar_number" id="iar_number" value="{{ $iarNumber }}" 
                               class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               required readonly>
                    </div>

                    <div class="mb-4">
                        <label for="iar_date" class="block text-gray-700 font-semibold mb-2">Date:</label>
                        <input type="date" name="iar_date" id="iar_date" 
                               class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               required>
                    </div>

                    <div class="mb-4">
                        <label for="iar_invoice_d" class="block text-gray-700 font-semibold mb-2">Invoice Date:</label>
                        <input type="date" name="iar_invoice_d" id="iar_invoice_d" 
                               class="w-full border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               required>
                    </div>

                    <div class="flex justify-between">
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Save
                        </button>
                        <button type="button" class="bg-red-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500" 
                                onclick="window.history.back()">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>

            <script>
                // Set the date to today
                document.getElementById('iar_date').valueAsDate = new Date();
            </script>
        </form>
    </div>
</div>

<script>
$(document).ready(function () {
    $('#iar_rod').change(function () {
        var selectedOfficeId = $(this).val();

        $.ajax({
            url: '/get-office-code/' + selectedOfficeId,
            type: 'GET',
            success: function (data) {
                $('#iar_rcc').val(data.officeCode);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
@endsection
