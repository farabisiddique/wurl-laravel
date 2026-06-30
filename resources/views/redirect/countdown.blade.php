@extends('layouts.common')

@section('content')
<div class="card mainCard text-center py-4">
    <div class="mb-4">
        <i class="bi bi-link-45deg" style="font-size: 3rem; color: #FFC107;"></i>
        <h2 class="mt-3 fw-semibold">
            Redirecting in <span id="countdown" class="text-warning">5</span>…
        </h2>
        <p class="text-muted mb-3">You are being taken to:</p>
        <div class="bg-light border rounded-3 p-3 mb-4 text-start">
            <a href="{{ $longLink->long_link }}" class="text-break fw-medium text-decoration-none"
               style="color: #8B4513; word-break: break-all;">
                {{ $longLink->long_link }}
            </a>
        </div>
    </div>

    <div class="d-flex justify-content-center gap-3 flex-wrap">
        <a href="{{ $longLink->long_link }}" class="btn buttonHere px-4">
            <i class="bi bi-box-arrow-up-right me-1"></i> Go Now
        </a>
        <a href="{{ route('index') }}" class="btn btn-outline-secondary px-4">
            Create Your Own
        </a>
    </div>

    @if ($shortLink->domain)
        <p class="text-muted mt-4 small mb-0">
            <i class="bi bi-clock me-1"></i>
            This link expires on {{ $shortLink->expiration_date->format('d F, Y') }}
        </p>
    @endif
</div>

<script>
    const redirectUrl = @json($longLink->long_link);
    let timeLeft = 5;
    const countdownEl = document.getElementById('countdown');

    const timer = setInterval(() => {
        timeLeft--;
        countdownEl.textContent = timeLeft;
        if (timeLeft <= 0) {
            clearInterval(timer);
            window.location.href = redirectUrl;
        }
    }, 1000);
</script>
@endsection
