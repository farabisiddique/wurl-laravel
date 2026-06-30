@extends('layouts.common')

@section('content')
<div class="card mainCard">
    <div class="text-center mb-4">
        <a href="{{ route('index') }}">
            <img src="{{ asset('img/wurl-white.png') }}" alt="Wurl Logo" width="70"
                 style="filter: invert(1) sepia(1) saturate(3) hue-rotate(5deg);">
        </a>
        <h2 class="mt-3 fw-semibold">Link Collection</h2>
        <p class="text-muted">
            <i class="bi bi-collection me-1"></i>
            {{ $links->count() }} {{ Str::plural('link', $links->count()) }} available
        </p>
    </div>

    <div class="d-flex flex-column gap-3">
        @foreach ($links as $index => $link)
            <a href="{{ $link->long_link }}"
               class="btn buttonHere d-flex align-items-center gap-2 py-3 px-4 text-start"
               rel="noopener noreferrer">
                <span class="badge bg-dark rounded-circle flex-shrink-0" style="width:26px; height:26px; line-height:18px;">
                    {{ $index + 1 }}
                </span>
                <span class="text-truncate small fw-medium">{{ $link->long_link }}</span>
                <i class="bi bi-box-arrow-up-right ms-auto flex-shrink-0"></i>
            </a>
        @endforeach
    </div>

    <div class="text-center mt-4 pt-3 border-top">
        <p class="text-muted small mb-2">
            <i class="bi bi-clock me-1"></i>
            Links expire on {{ $shortLink->expiration_date->format('d F, Y') }}
        </p>
        <a href="{{ route('index') }}" class="text-muted small fw-semibold text-decoration-none">
            Create your own Wurl →
        </a>
    </div>
</div>
@endsection
