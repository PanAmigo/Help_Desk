$(document).ready(function() {
    $('.client-edit-btn').click(function() {
        var clientId = $(this).data('client_id');
        console.log("ID klienta do usunięcia:", clientId);
        $.ajax({
            type: 'POST',
            url: '../Query/save_client_id.php',
            data: { client_id: clientId },
            dataType: 'json', 
            success: function(response) {
                if (response.success) {
                    console.log(response.message);
                } else {
                    console.error(response.message);
                }
            },
            error: function() {
                console.error('Error sending AJAX request.');
            }
        });
        $('#client_edit_modal').data('client-id', clientId);
    });
});


$(document).ready(function() {
    $('#delete-client-btn').click(function() {
        $('#delete-confirm-modal').modal('show');
    });
});


$(document).ready(function() {
    $('#delete_confirm').click(function() {
        $.post('../Query/delete_client.php', function(response) {
            var data = JSON.parse(response);
            if (data.success) {
                location.reload();
            } else {
                $('#error-modal-body').html(data.message);
                $('#error-modal').modal('show');
            }
        });
    });
});