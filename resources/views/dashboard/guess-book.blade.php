@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
      <div class="card-header">
        Download your book
      </div>
      <div class="card-body p-4">
        You created a book as guess.
        You can download your book clicking here
        <a href="{{ $book->pdf ?? $book->ppt }}" class="btn btn-success">
          <span class="oi oi-cloud-download"></span> Download
        </a>
        <br>
        You also can manage and edit your book in your <a href="{{ route('dashboard') }}">Dashboard</a>
        <br>
        Thanks for using <strong>Bookstrap</strong>
      </div>
    </div>
</div>
@endsection
