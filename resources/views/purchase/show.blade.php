<!-- resources/views/medications/purchase_show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>{{ $medication->name }}</h1>
    <p>{{ $medication->description }}</p>

    <form action="{{ route('medications.purchase.store', $medication->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="quantity">الكمية</label>
            <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">شراء</button>
    </form>
@endsection