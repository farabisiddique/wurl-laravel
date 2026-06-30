@extends('layouts.common')

@section('content')
@vite(['resources/js/mainformsubmit.js'])
    <h1 class="mb-4">Enhance Your Digital Engagement</h1>
    <p class="mb-4">Leverage Wurl's advanced URL shortener with customizable links and QR Codes,
        to captivate your audience and direct them to relevant content.</p>
    <div class="card mainCard">
      <h3>Shorten your links</h3>
      <form id="mainForm" class="mb-4">
        @csrf

        {{-- Dynamic link inputs --}}
        <div id="linksContainer">
          <div class="link-row mb-2">
            <div class="input-group">
              <input type="text" class="form-control formInput" placeholder="Paste your long link here."
                  name="links[]" required>
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
          <button type="button" id="addLinkBtn" class="btn btn-sm btn-outline-light">
            <i class="bi bi-plus-circle me-1"></i> Add Another Link
          </button>
          <span id="multiLinkBadge" class="badge rounded-pill text-bg-warning" style="display:none;">
            <i class="bi bi-collection me-1"></i> Multi-Link Mode
          </span>
        </div>

        <p class="text-danger" id="longlinkError"></p>

        <h4>Customize your link</h4>
        <div class="input-group mb-3">
            <span class="input-group-text">https://</span>
            <select class="form-select formInput" aria-label="Domain selection" id="domainSelect" name="domainSelect">
                @foreach ($domains as $domain)
                    <option value="{{ $domain->id }}">{{ $domain->domain_name }}</option>
                @endforeach
            </select>
            <span class="input-group-text">/</span>
            <input type="text" class="form-control formInput" placeholder="Custom text (optional)"
                   aria-label="Custom text" id="customTextInput" name="customTextInput">
        </div>
        <p id="customTextAvailability"></p>
        <button type="submit" class="btn buttonHere w-100" id="getLnkBtn" name="submit">
          Get Your Link and QR Code
        </button>
        <p class="text-danger mt-2" id="submissionError"></p>

        <div class="input-group mt-3">
          <input type="text" class="form-control formInput outputlink"
                 placeholder="Your shortened link will appear here" id="shortLinkOutput" readonly>
          <button class="copy-btn" type="button" id="copyBtn">
            <i class="bi bi-copy"></i>
          </button>
        </div>
        <p class="text-success mt-2" id="copySuccessMessage"></p>
        <p class="mt-3 text-danger" id="expiration_date"></p>
        <p class="mt-2 text-muted small" id="linkTypeInfo" style="display:none;"></p>

        <div class="justify-content-center mt-3 qrCodeSection">
          <img src="" class="qr-code-img" alt="QR Code" id="qrCodeImg">
          <div class="d-flex flex-column justify-content-center btn-qr-actions">
            <button class="btn buttonHere mb-2" type="button" id="downloadQR">Download QR Code</button>
            <button class="btn buttonHere" type="button" data-bs-toggle="modal" data-bs-target="#magnifyModal">
              Magnify QR Code
            </button>
          </div>
        </div>
        <img src="{{ asset('img/wurl-bg-blue.png') }}" class="wurlbg-blue-small">
      </form>
    </div>

    @include('layouts.magnifyqr')
@endsection
