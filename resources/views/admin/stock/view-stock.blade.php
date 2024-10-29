@extends('layouts.app')

@section('title', 'View Stock')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="grid w-full gap-6 p-20 ml-36 pl-24 mx-auto font-nunito">
    <div class="flex gap-2">
        <a class="w-fit bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 active:bg-blue-800" href="{{ route('ris.create') }}">Create RIS</a>
        <a class="w-fit bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 active:bg-green-800" href="{{ route('iar.index') }}">Go to IAR</a>
    </div>

    <div class="mb-4">
        <input type="text" id="searchInput" class="form-control p-2 border rounded" placeholder="Search Stock...">
    </div>

    <h1 class="text-3xl font-bold mb-6">Stock Card</h1>

    @php
        $reversedStockEntries = array_reverse($stockEntries->toArray());
    @endphp

    <div class="grid grid-cols-1 gap-8">
        @foreach($reversedStockEntries as $item)
        <div class="w-full md:w-1/2 border-t-4 border-blue-900 bg-white p-6 rounded-md shadow-lg card">
            <div class="card-body p-4">
                @if($item['iar']) <!-- Check if IAR relationship exists -->
                    <p class="text-2xl font-semibold mb-2"><strong>{{ $item['iar']['iar_entityname'] }}</strong></p>
                    <p class="text-lg mb-2"><strong>Fund Cluster:</strong> {{ $item['iar']['iar_fundcluster'] }}</p>
                @else
                    <p class="text-2xl font-semibold mb-2 text-red-500">No IAR Data Available</p>
                @endif
                <p class="text-2xl font-semibold mb-2"><strong>{{ $item['name'] }}</strong></p>

                <!-- Action buttons -->
                <div class="action-column mt-4">
                    <a class="btn btn-primary bg-[#3a5998] text-white border-[#3a5998] rounded px-4 py-2 hover:bg-[#0056b3] hover:border-[#0056b3]" href="{{ route('scitems.show', $item['id']) }}">View</a>
                    <a class="btn btn-warning bg-[#ffc107] text-white border-[#ffc107] rounded px-4 py-2 hover:bg-[#e0a800] hover:border-[#e0a800]" href="{{ route('scitems.edit', $item['id']) }}">Edit</a>
                    <button class="btn btn-success bg-[#67b868] text-white border-[#67b868] rounded px-4 py-2 hover:bg-[#218838] hover:border-[#218838] print-preview-btn" data-stock-id="{{ $item['id'] }}">Print</button>
                    <a class="btn btn-danger bg-[#ff5ca1] text-white border-[#ff5ca1] rounded px-4 py-2 hover:bg-[#c82333] hover:border-[#c82333]" href="">Delete</a>
                </div>

                <div class="comments-section mt-4">
                    <h5 class="text-xl font-semibold mb-2">Comments</h5>
                    @if(empty($item['comments']))
                        <p>No comments yet.</p>
                    @else
                        @foreach($item['comments'] as $comment)
                            <div class="comment mb-2">
                                <p><strong>{{ $comment['user']['name'] }}:</strong> {{ $comment['content'] }}</p>
                            </div>
                        @endforeach
                    @endif

                    @if(auth()->user()->is_admin)
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="commentable_id" value="{{ $item['id'] }}">
                            <input type="hidden" name="commentable_type" value="App\Models\StockItem">
                            <div class="form-group">
                                <textarea name="content" class="form-control p-2 border rounded" placeholder="Add a comment" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary bg-[#3a5998] text-white border-[#3a5998] rounded px-4 py-2 mt-2 hover:bg-[#0056b3] hover:border-[#0056b3]">Add Comment</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const stockCards = document.querySelectorAll('.card');

        searchInput.addEventListener('input', function () {
            const query = searchInput.value.toLowerCase();

            stockCards.forEach(function (card) {
                const cardText = card.innerText.toLowerCase();
                const isVisible = cardText.includes(query);
                card.style.display = isVisible ? 'block' : 'none';
            });
        });

        document.querySelectorAll('.print-preview-btn').forEach(button => {
            button.addEventListener('click', function() {
                const stockId = button.getAttribute('data-stock-id');
                window.open("{{ route('print.preview.excel', '') }}/" + stockId, '_blank');
            });
        });
    });
</script>
@endsection
