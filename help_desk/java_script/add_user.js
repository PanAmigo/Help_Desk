$(document).ready(function() {
    var saveButton = $('#saveButton');

    saveButton.click(function() {
        var name = $('#name').val();
        var login = $('#login').val();
        var permissions = $('#permissions_new').val();
        var client = $('#client_new').val();
        console.log(name);
        console.log(login);
        console.log(permissions);
        console.log(client);
 
        $.ajax({
            type: 'POST',
            url: '../Query/add_user.php', 
            data: {
                name: name,
                login: login,
                permissions_new: permissions,
                client_new: client
            },
            success: function(response) {
                $('#user_passwordText').text(response.password);
                $('#passwordModal_new_user').modal('show');
            },
            error: function() {
                console.error('Error sending AJAX request.');
            }
        });
    });
});