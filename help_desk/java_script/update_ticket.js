$(document).ready(function() {
    $("#update_ticket_btn").click(function() {
        var newOperator_Id = $("#new_operator").val();
        var newStatus = $("#new_status").val();
        
        $.ajax({
            type: "POST",
            url: "../Query/update_ticket.php",
            data: { newOperator_Id: newOperator_Id, newStatus: newStatus  },
            success: function(response) {
                location.reload();
            },
            error: function() {
                alert("Wystąpił błąd podczas aktualizacji klienta.");
            }
        });
    });
});

$(document).ready(function() {
    $("#add_new_comment").click(function() {
        var comment = $("#new_coment").val();
        console.log(comment);
        
        $.ajax({
            type: "POST",
            url: "../Query/insert_new_comment.php",
            data: { comment: comment},
            success: function(response) {
                location.reload();
            },
            error: function() {
                alert("Wystąpił błąd podczas aktualizacji klienta.");
            }
        });
    });
});