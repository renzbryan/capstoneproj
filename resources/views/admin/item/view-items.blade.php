@extends('layouts.app')

@section('title', 'Items View')
@vite(['resources/css/app.css', 'resources/js/app.js'])

<script>
document.addEventListener('DOMContentLoaded', function () {
    const stockBtn = document.getElementById('Stockbtn'); 
    const propertyBtn = document.getElementById('Propertybtn'); 
    const wmrBtn = document.getElementById('WMRbtn'); 
    const itemCheckbox = document.getElementsByName('item_checkbox[]'); 

    // Function to handle stock update
    function updateStock() {
        const transferData = getTransferData();
        sendTransferRequest('/update-items-stock', transferData, 'Stock');
    }

    // Function to handle property card update
    function updatePropertyCard() {
        const transferData = getTransferData();
        sendTransferRequest('/update-items-property', transferData, 'Property Card');
    }

    // Function to handle WMR update
    function updateWMR() {
        const transferData = getTransferData();
        sendTransferRequest('/update-items-wmr', transferData, 'WMR');
    }

    // Function to get transfer data from the form
    function getTransferData() {
        const transferData = [];
        itemCheckbox.forEach(checkbox => {
            if (checkbox.checked) {
                const row = checkbox.closest('tr');
                const quantity = row.querySelector('input[name="transfer_quantity[]"]').value;
                transferData.push({
                    item_id: checkbox.value,
                    quantity: quantity
                });
            }
        });
        return transferData;
    }

    // Function to send transfer request
    function sendTransferRequest(url, transferData, actionName) {
        if (transferData.length > 0) {
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ transfer_data: transferData }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(`${actionName} updated successfully!`);
                } else {
                    alert(`Failed to update ${actionName}. Please try again.`);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        } else {
            alert('Please select at least one item.');
        }
    }

    // Event listeners for buttons
    stockBtn.addEventListener('click', updateStock);
    propertyBtn.addEventListener('click', updatePropertyCard);
    wmrBtn.addEventListener('click', updateWMR);
});
</script>

@section('content')
<div class="container mx-auto p-4 mt-8 ml-48 lg:p-12 font-nunito">
    @foreach($iars as $iar)
    <header>
    <div class="header-buttons">
        <button class="cancel-btn" onclick="window.history.back()">< Back</button>
        <button id="Stockbtn" class="custom-btn">Stock Card</button>
        <button id="Propertybtn">Property Card</button>
        <button id="WMRbtn">WMR</button>
        <a class="add-item-btn" href="/iar/{{ $iar->iar_id }}/create-items">+ New Item</a>
    </div>
</header>

    <div class="bg-white border-t-4 border-blue-900 shadow-lg rounded-lg p-8 mb-8">
        <h2 class="text-xl font-semibold mb-4">INSPECTION AND ACCEPTANCE REPORT</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-gray-700 font-semibold"><strong>Entity Name:</strong> {{ $iar->iar_entityname }}</p>
                <p class="text-gray-700 font-semibold"><strong>Supplier:</strong> {{ $iar->iar_supplier }}</p>
                <p class="text-gray-700 font-semibold"><strong>PO No/Date:</strong> {{ $iar->iar_Podate }}</p>
                <p class="text-gray-700 font-semibold"><strong>Requisitioning Office/Dept.:</strong> {{ $iar->iar_rod }}</p>
                <p class="text-gray-700 font-semibold"><strong>Responsibility Center Code:</strong> {{ $iar->iar_rcc }}</p>
            </div>
            <div>
                <p class="text-gray-700 font-semibold"><strong>Fund Cluster:</strong> {{ $iar->iar_fundcluster }}</p>
                <p class="text-gray-700 font-semibold"><strong>IAR No.:</strong> {{ $iar->iar_id }}</p>
                <p class="text-gray-700 font-semibold"><strong>Date:</strong> {{ $iar->iar_date }}</p>
                <p class="text-gray-700 font-semibold"><strong>Invoice No.:</strong> {{ $iar->iar_id }}</p>
                <p class="text-gray-700 font-semibold"><strong>Invoice Date:</strong> {{ $iar->iar_invoice_d }}</p>
            </div>
        </div>
        @endforeach

        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Unit</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($items as $data) 
            <tr> 
                <td><input type="checkbox" name="item_checkbox[]" value="{{ $data->item_id }}"></td> 
                <td>{{ $data->item_name }}</td> 
                <td>{{ $data->item_desc }}</td> 
                <td>{{ $data->item_unit }}</td> 
                <td>{{ $data->item_quantity }}</td> 
                <td> 
                    <!-- Add any action buttons or links here if needed --> 
                    {{-- Example: --}} 
                    <a href="#">Edit</a> 
                    <a href="#">Delete</a> 
                </td> 
            </tr> 
        @endforeach
            </tbody>
        </table>
    </div>

    <footer>
        <div class="footer-dropdown">
            <span>Menu</span>
            <div class="dropdown-content">
                <a class="dropdown-item" href="#">Privacy Policy</a>
                <a class="dropdown-item" href="#">Terms of Service</a>
                <a class="dropdown-item" href="#">Contact Us</a>
                <a class="dropdown-item" href="{{ route('export.excel', ['iar_id' => $iar['iar_id']]) }}">Print</a>
            </div>
        </div>
    </footer>

</body>

</html>
