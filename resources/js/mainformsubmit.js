$('#mainForm').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: "/shorten",
        method: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(response) {
            if(!response.success) {
                $('#submissionError').text(response.message).fadeIn().delay(3000).fadeOut();
                $('#shortLinkOutput').val('');
                return;
            }
            
            $('#shortLinkOutput').val(response.shortened_url);
            $('#qrCodeImg').attr('src', response.qrCodeUrl).show();
            $('.qrCodeSection').show();
        },
        error: function(xhr) {
            // Handle validation errors or server issues
            let errors = xhr.responseJSON.errors;
            $('#submissionError').text("Server Error! Try Again later.").fadeIn().delay(3000).fadeOut();
            $('#shortLinkOutput').val('');
        }
    });
});


$('#copyBtn').on('click', function() {
    this.transition = 'transform 0.2s ease';
    this.style.transform = 'scale(1.2)';
    setTimeout(() => {
        this.style.transform = 'scale(1)';
    }, 200);

    let shortLink = $('#shortLinkOutput').val();
    if(shortLink) {
        navigator.clipboard.writeText(shortLink).then(function() {
            $('#copySuccessMessage').text('Shortened URL copied to clipboard!').fadeIn().delay(2000).fadeOut();
        }, function(err) {
            console.error('Could not copy text: ', err);
        });
    } else {
        $('#copySuccessMessage').text('No shortened URL to copy!').fadeIn().delay(2000).fadeOut();
    }
});