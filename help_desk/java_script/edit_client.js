$(document).ready(function() {
    $("#edit_client_btn").click(function() {
        var newClientName = $("#New_client_name").val();
        console.log("ID klienta do usunięcia:", newClientName);
        $.ajax({
            type: "POST",
            url: "../Query/update_client.php",
            data: { newClientName: newClientName },
            success: function(response) {
              location.reload();
            },
            error: function() {
                alert("Wystąpił błąd podczas aktualizacji klienta.");
            }
        });
    });
});