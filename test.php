<?php
session_start();
if (isset($_SESSION['connected']) == false) {
    header('location: '.URLROOT.'/index.php');
    exit();
}
require_once 'includes/header.php';
require_once 'bootstrap.php';
require_once 'includes/main_header.php';
include_once('db.php');

?>
<main id="main">

     <section id="new_sale" class="contact sections-bg" >
        <div class="container" data-aos="fade-up">

            <div class="row gx-lg-0 gy-4">

                <div class="col-lg-12">
                    <div class="php-email-form">
                        <div class="row">
                            <div class="col-md-8" style="text-align: left;">
                                <h4><b>Total:
                                        <span class="label label-info" id="invoice_total">0,00 DA</span></b></h4>
                            </div>

                            <div class="col-md-4">
                                 <button type="button" id="print_invoice"><span class='fa-solid fa-print'></span> Print</a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Contact Form -->

            </div>

        </div>
    </section><!-- End New sale Section -->
</main>

<div class="modal fade" id="Confirm_invoice_modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditLabel">Confirm Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <div class="container-fluid">
                    
                    <div class="row form-group">
                        <h4><b>Total:
                            <span class="label label-info" id="invoice_total_confirm">0,00 DA</span></b></h4>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-4 form-group mt-3 mt-md-0">
                            <h4><b>Payment:</b></h4>
                        </div>
                        <div class="col-sm-8 form-group mt-3 mt-md-0">
                            <input type="number" class="form-control" id="payment" placeholder="Payment" required>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-primary button_green_per" id="clear_invoice"><span class='fa-solid fa-xmark'></span> Clear</button>
            </div>
            
        </div>
    </div>
</div>

<script>
    $("button#print_invoice").click(function () {
        
        $("#Confirm_invoice_modal").modal('show');
    });
</script>
