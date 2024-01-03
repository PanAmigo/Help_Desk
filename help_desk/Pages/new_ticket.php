<?php 
include (__DIR__.'/../Includes/Header.php');
include (__DIR__.'/../Query/insert_new_ticket.php');
?>

<div class="card mt-5">
    <form id="TicketForm" class="form-horizontal" role="form" method="POST" action="">
        <div class="card-body">
            <div class="text-center">
                <div class="mt-3">
                    <div class="form-floating">
                        <textarea type="text" class="form-control" id="Ticket" name="Ticket" placeholder="Twoje zgłoszenie" required></textarea>
                        <label for="Ticket">Twoje zgłoszenie</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer pt-4">
            <div class="d-grid col-4 mx-auto pb-3">
                <button type="submit" class="btn btn-outline-primary">Zaakceptuj zgłoszenie</button>
            </div>
            <?php 
                if ($errorMessage != '') { ?>
                <div class="mt-5">
                    <div id="ticket-alert" class="alert alert-danger col-sm-12"><?php echo $errorMessage; ?></div>                            
                </div>
            <?php } ?>
        </div>
    </form>
</div>