$('#mainForm').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: "/shorten",
        method: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(response) {
            console.log(response.success);
        },
        error: function(xhr) {
            // Handle validation errors or server issues
            let errors = xhr.responseJSON.errors;
            console.log(errors);
        }
    });
});