@extends('layouts.common')

@section('content')
<div class="card mainCard text-center py-4">
    <i class="bi bi-clock-history" style="font-size: 3rem; color: #dc3545;"></i>
    <h2 class="mt-3 fw-semibold">This link has expired</h2>
    <p class="text-muted mb-4">
        This short link expired on {{ $shortLink->expiration_date->format('d F, Y') }}
        and is no longer active.
    </p>
    <a href="{{ route('index') }}" class="btn buttonHere px-4 mx-auto" style="width: fit-content;">
        <i class="bi bi-plus-circle me-1"></i> Create a New Short Link
    </a>
</div>
@endsection
