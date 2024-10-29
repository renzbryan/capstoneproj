<td>
    <a href="{{ route('students.show', $student->id) }}" class="btn btn-info">View</a>
    <form action="{{ route('students.restore', $student->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-success">Restore</button>
    </form>
</td>
