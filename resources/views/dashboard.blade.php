@extends('layouts.app')

@section('title', 'Homepage')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="grid w-full gap-6 p-20 mx-auto font-nunito">

    <!-- Cards Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-10 mx-40">
        <div class="bg-white border border-gray-300 rounded-lg p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M3 8h18m-7 4h7m-7 4h7M3 16h18M3 21h18" /></svg>
                <h1 class="text-xl font-bold mb-4">Stock Card</h1>
            </div>
            <p class="text-xl">Total Items: <span class="font-bold">{{ $inStockCount }}</span></p>
            <p class="text-lg">Available: <span class="font-bold text-teal-600">{{ $inStockCount }}</span></p>
        </div>

        <div class="bg-white border border-gray-300 rounded-lg p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4.414l2.586 2.586M12 20a8 8 0 100-16 8 8 0 000 16z" /></svg>
                <h1 class="text-xl font-bold mb-4">Property Card</h1>
            </div>
            <p class="text-xl">Total Properties: <span class="font-bold">{{ $inPropCount }}</span></p>
            <p class="text-lg">Available: <span class="font-bold text-purple-600">{{ $inPropCount }}</span></p>
        </div>

        <div class="bg-white border border-gray-300 rounded-lg p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12l2 2-4 4 4-4-2-2zm0-2V8M7 12l2 2-2-2z" /></svg>
                <h1 class="text-xl font-bold mb-4">Semi Property Card</h1>
            </div>
            <p class="text-xl">Total Semi Properties: <span class="font-bold">40</span></p>
            <p class="text-lg">Available: <span class="font-bold text-blue-600">30</span></p>
        </div>
    </div>

    <!-- Graphs Section -->
    <div class="mt-10 mx-60">
        <h1 class="text-xl font-bold mb-4 text-gray-800">Data Overview</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white border border-gray-300 rounded-lg p-5 shadow-lg">
                <canvas id="stockChart"></canvas>
            </div>

            <div class="bg-white border border-gray-300 rounded-lg p-5 shadow-lg">
                <canvas id="propertyChart"></canvas>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pass PHP variables to JavaScript
    const inStockCount = @json($inStockCount);
    const outOfStockCount = @json($outOfStockCount);

    const ctx1 = document.getElementById('stockChart').getContext('2d');
    const stockChart = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['In Stock', 'Out of Stock'],
            datasets: [{
                label: 'Item Availability Diagram',
                data: [inStockCount, outOfStockCount],
                backgroundColor: [
                    'rgba(0, 153, 153, 0.6)',  // Dark teal for In Stock
                    'rgba(255, 51, 51, 0.6)'    // Bright red for Out of Stock
                ],
                borderColor: [
                    'rgba(0, 153, 153, 1)',     // Dark teal for In Stock
                    'rgba(255, 51, 51, 1)'      // Bright red for Out of Stock
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#e0e0e0'
                    }
                },
                x: {
                    grid: {
                        color: '#e0e0e0'
                    }
                }
            }
        }
    });

    const ctx2 = document.getElementById('propertyChart').getContext('2d');
const propertyChart = new Chart(ctx2, {
    type: 'line',
    data: {
        labels: [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ],
        datasets: [
            {
                label: 'Stock',
                data: [10, 20, 15, 25, 30, 35, 40, 45, 50, 55, 60, 65], // Example data
                backgroundColor: 'rgba(0, 153, 153, 0.2)', // Light teal for Stock
                borderColor: 'rgba(0, 153, 153, 1)', // Dark teal for Stock
                borderWidth: 2,
                fill: true
            },
            {
                label: 'Property',
                data: [5, 10, 15, 20, 25, 30, 35, 30, 25, 20, 15, 10], // Example data
                backgroundColor: 'rgba(128, 0, 128, 0.2)', // Light purple for Property
                borderColor: 'rgba(128, 0, 128, 1)', // Dark purple for Property
                borderWidth: 2,
                fill: true
            },
            {
                label: 'Semi-Property',
                data: [0, 5, 10, 15, 20, 10, 5, 15, 20, 25, 30, 35], // Example data
                backgroundColor: 'rgba(255, 165, 0, 0.2)', // Light orange for Semi-Property
                borderColor: 'rgba(255, 165, 0, 1)', // Dark orange for Semi-Property
                borderWidth: 2,
                fill: true
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Property Overview'
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: '#e0e0e0'
                }
            },
            x: {
                grid: {
                    color: '#e0e0e0'
                }
            }
        }
    }
});

</script>
@endsection
