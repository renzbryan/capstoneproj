@extends('layouts.app')

@section('title', 'View RIS')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="grid w-full gap-6 p-20 ml-40 pl-28 mx-auto font-nunito">
    <a class="w-fit bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 active:bg-blue-800" href="{{ route('ris.create') }}">Create RIS</a>

    <div class="mb-4">
        <input type="text" id="searchInput" class="form-control p-2 border rounded" placeholder="Search RIS...">
    </div>

    <h1 class="text-3xl font-bold mb-6">RIS List</h1>

    <div class="grid grid-cols-1 gap-8"> <!-- Change made here -->
        @foreach($ris as $item)
        <div class="w-full md:w-1/2 border-t-4 border-blue-900 bg-white p-6 rounded-md shadow-lg card">
            <div class="card-body p-4">
                <p class="text-2xl font-semibold mb-2"><strong>{{ $item->entity_name }}</strong></p>
                <p class="text-lg mb-2"><strong>Fund Cluster:</strong> {{ $item->fundcluster }}</p>
                <p class="text-lg mb-2"><strong>Division:</strong> {{ $item->division }}</p>

                <!-- Action buttons -->
                <div class="action-column mt-4">
                    <a class="btn btn-primary bg-[#3a5998] text-white border-[#3a5998] rounded px-4 py-2 hover:bg-[#0056b3] hover:border-[#0056b3]" href="">View</a>
                    <button class="btn btn-success bg-[#67b868] text-white border-[#67b868] rounded px-4 py-2 hover:bg-[#218838] hover:border-[#218838] print-preview-btn">Print Preview</button>
                </div>

                <!-- Comments Section -->
                <div class="comments-section mt-4">
                    <h5 class="text-xl font-semibold mb-2">Comments</h5>
                    @if(empty($item->comments))
                        <p>No comments yet.</p>
                    @else
                        @foreach($item->comments as $comment)
                            <div class="comment mb-2">
                                <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}</p>
                            </div>
                        @endforeach
                    @endif

                    @if(auth()->user()->is_admin)
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="commentable_id" value="{{ $item->id }}">
                            <input type="hidden" name="commentable_type" value="App\Models\Ris">
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
        const risCards = document.querySelectorAll('.card');

        searchInput.addEventListener('input', function () {
            const query = searchInput.value.toLowerCase();

            risCards.forEach(function (card) {
                const cardText = card.innerText.toLowerCase();
                const isVisible = cardText.includes(query);
                card.style.display = isVisible ? 'block' : 'none';
            });
        });

    //     document.querySelectorAll('.print-preview-btn').forEach(button => {
    //         button.addEventListener('click', function() {
    //             const risId = button.getAttribute('data-ris-id');
    //             window.open("{{ route('print.preview.excel', '') }}/" + risId, '_blank');
    //         });
    //     });
    // });
</script>
@endsection
