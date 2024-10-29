@extends('layouts.app')

@section('content')
<div class="grid w-full gap-6 p-20 ml-40 pl-28 mx-auto font-nunito">
<div class="container">
    <h2>Add New Student</h2>
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" name="address" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Add Student</button>
    </form>
</div>
@endsection
