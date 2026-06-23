@extends('layouts.common')

@section('content')
@vite(['resources/js/mainformsubmit.js'])
    <h1 class="mb-4">Enhance Your Digital Engagement</h1>
    <p class="mb-4">Leverage Wurl's  advanced URL shortener with customizable link and QR Codes, 
        to captivate your audience and direct them to relevant content.</p>
    <div class="card mainCard">
      <h3>Shorten a long link</h3>
      <form  id="mainForm" class="mb-4">
              @csrf
        <div class="input-group mb-3">
            <input type="text" class="form-control formInput" placeholder="Paste your long link here." 
                aria-label="Paste your long link here." id="longLinkInput" name="longLinkInput" required>
            
        </div> 
        <p class="text-danger" id="longlinkError"></p>
        <h4>You can customize your link</h4>
        <div class="input-group mb-3">
            <span class="input-group-text">https://</span>
            <select class="form-select formInput" aria-label="Domain selection" id="domainSelect" name="domainSelect" >
                @foreach ($domains as $domain)
                    <option value="{{ $domain->id }}">{{ $domain->domain_name   }}</option>
                @endforeach
            </select>
            <span class="input-group-text">/</span>
            <input type="text" class="form-control formInput" placeholder="Custom text" aria-label="Custom text" id="customTextInput" name="customTextInput">
        </div>
        <p id="customTextAvailability"></p>
        <button type="submit" class="btn buttonHere w-100" id="getLnkBtn" name="submit">Get Your Link and QR Code</button>
        <p class="text-danger mt-2" id="submissionError"></p>
        <div class="input-group mt-3">
        <input type="text" class="form-control formInput outputlink" placeholder="Your shortened link will appear here" id="shortLinkOutput" readonly>
        <button class="copy-btn" type="button" id="copyBtn">
          <i class="bi bi-copy"></i>
        </button>
         
      </div>
      <p class="text-success mt-2" id="copySuccessMessage"></p> 
      <p class='mt-3 text-danger' id='expiration_date'></p>
      <div class="justify-content-center mt-3 qrCodeSection">
        <img src="" class="qr-code-img" alt="QR Code" id="qrCodeImg">
        <div class="d-flex flex-column justify-content-center btn-qr-actions">
          <button class="btn buttonHere mb-2" id="downloadQR">Download QR Code</button>
          <button class="btn buttonHere" data-bs-toggle="modal" data-bs-target="#magnifyModal">Magnify QR Code</button>
        </div>
      </div>
      <img src="{{ asset('img/wurl-bg-blue.png') }}" class="wurlbg-blue-small">

      </form>
    </div>
    
    @include('layouts.magnifyqr')

@endsection