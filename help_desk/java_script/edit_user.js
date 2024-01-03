$(document).ready(function() {
    $(document).on('click', '#user-edit-btn', function() {
        var userId = $(this).data('user_id');
        console.log("ID user'a do usunięcia:", userId);
        $.ajax({
            type: 'POST',
            url: '../Query/get_one_user.php',
            data: { userId: userId },
            dataType: 'json', 
            success: function(response) {
                if (response.success) {
                    console.log(response.message);
                    $('#user_name').val(response.user_name); 
                    $('#user_login').val(response.user_login); 
                    $('#user_permissions').val(response.user_permissions); 
                    $('#user_company').val(response.user_company); 

                    $('#user_edit_modal').modal('show'); 
                } else {
                    console.error(response.message);
                }
            },
            error: function() {
                console.error('Error sending AJAX request.');
            }
        });
    });
});

$(document).ready(function() {
    $('#user_update_btn').click(function() {
        var userId = $('#user-edit-btn').data('user_id'); 
        var userName = $('#user_name').val(); 
        var userLogin = $('#user_login').val(); 
        var userPermissions = $('#user_permissions').val(); 
        var userCompany = $('#user_company').val(); 
        console.log(userCompany);

        var data = {
            userId: userId,
            userName: userName,
            userLogin: userLogin,
            userPermissions: userPermissions,
            userCompany: userCompany
        };

        $.ajax({
            type: 'POST',
            url: '../Query/update_user.php', 
            data: data, 
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    console.log(response.message);
                    $('#user_edit_modal').modal('hide');
                    location.reload();
                } else {
                    console.error(response.message);
                }
            },
            error: function() {
                console.error('Error sending AJAX request.');
            }
        });
    });
});

$(document).ready(function() {
    $('#user_delete_btn').click(function() {
        $.ajax({
            type: 'POST',
            url: '../Query/delete_user.php',
            success: function(response) {
                console.log(response);
                location.reload();
            },
            error: function() {
                console.error('Error sending AJAX request.');
            }
        });
    });
});
 
$(document).ready(function() {
    $('#change_psswd_btn').click(function() {
        $.ajax({
            type: 'POST',
            url: '../Query/change_psswd.php',
            success: function(response) {
                $('#passwordText').text(response.password);
                $('#passwordModal').modal('show');
            },
            error: function() {
                console.error('Error sending AJAX request.');
            }
        });
    });
});