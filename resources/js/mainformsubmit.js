// Tab switch: enable inputs in active pane, disable in inactive pane
// so FormData only picks up the active tab's links
$('#linkModeTabs button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
    const $activePane = $($(e.target).attr('data-bs-target'));
    const $prevPane = $($(e.relatedTarget).attr('data-bs-target'));
    $activePane.find('input[name="links[]"]').prop('disabled', false);
    $prevPane.find('input[name="links[]"]').prop('disabled', true);
});

// Add another link row (minimum 2 always present)
$('#addLinkBtn').on('click', function () {
    const count = $('#linksContainer .link-row').length + 1;
    const newRow = `
        <div class="link-row mb-2">
            <div class="input-group">
                <input type="text" class="form-control formInput" placeholder="Paste link ${count} here." name="links[]">
                <button type="button" class="btn btn-outline-danger remove-link-btn px-3">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        </div>
    `;
    $('#linksContainer').append(newRow);
});

// Remove a link row — minimum 2 rows enforced
$(document).on('click', '.remove-link-btn', function () {
    if ($('#linksContainer .link-row').length > 2) {
        $(this).closest('.link-row').remove();
    }
});

// Form submission
$('#mainForm').on('submit', function (e) {
    e.preventDefault();

    $.ajax({
        url: '/shorten',
        method: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (response) {
            if (!response.success) {
                $('#submissionError').text(response.message).fadeIn().delay(3000).fadeOut();
                $('#shortLinkOutput').val('');
                return;
            }

            $('#shortLinkOutput').val(response.shortened_url);
            $('#expiration_date').text('Expires: ' + response.expirationDate);
            $('#qrCodeImg').attr('src', response.qrCodeUrl).show();
            $('.qrCodeSection').show();

            if (response.link_type === 'multi') {
                $('#linkTypeInfo')
                    .html('<i class="bi bi-collection me-1"></i> Visitors will see a landing page listing all your links.')
                    .show();
            } else {
                $('#linkTypeInfo')
                    .html('<i class="bi bi-arrow-right-circle me-1"></i> Visitors will be redirected after a 5-second countdown.')
                    .show();
            }
        },
        error: function () {
            $('#submissionError').text('Server Error! Try again later.').fadeIn().delay(3000).fadeOut();
            $('#shortLinkOutput').val('');
        },
    });
});

// Copy shortened URL to clipboard
$('#copyBtn').on('click', function () {
    this.style.transition = 'transform 0.2s ease';
    this.style.transform = 'scale(1.2)';
    setTimeout(() => {
        this.style.transform = 'scale(1)';
    }, 200);

    const shortLink = $('#shortLinkOutput').val();
    if (shortLink) {
        navigator.clipboard.writeText(shortLink).then(
            () => $('#copySuccessMessage').text('Shortened URL copied to clipboard!').fadeIn().delay(2000).fadeOut(),
            () => console.error('Could not copy text.')
        );
    } else {
        $('#copySuccessMessage').text('No shortened URL to copy!').fadeIn().delay(2000).fadeOut();
    }
});

// Download QR code image
$('#downloadQR').on('click', function () {
    const qrSrc = $('#qrCodeImg').attr('src');
    if (qrSrc) {
        const a = document.createElement('a');
        a.href = qrSrc;
        a.download = 'wurl-qrcode.png';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }
});

// Sync QR image into magnify modal before it opens
$('#magnifyModal').on('show.bs.modal', function () {
    $('#magnifiedQR').attr('src', $('#qrCodeImg').attr('src'));
});
