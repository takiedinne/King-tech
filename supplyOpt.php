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
    <!-- ======= New Sale Section ======= -->
    <section id="supply_section" class="contact sections-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h2>Supply operation history</h2>
                <p>Here you can see the history of your supply operations</p>
            </div>

            <!-- Filter Hero Section -->
            <div class="row gx-lg-0 gy-4">

                <div class="col-lg-12  php-email-form">

                    <div class="row">

                        <div class="col-sm-6 form-group">
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <h5> Item :</h5>
                                </div>
                                <div class="col-sm-8 form-group mt-3 mt-md-0">
                                    <input id="search_item_number" type="text" class="form-control"
                                        name="item_search_id" onchange="on_change_search()">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <h5> Invoice N° :</h5>
                                </div>
                                <div class="col-sm-8 form-group mt-3 mt-md-0">
                                    <input id="search_invoice_number" type="text" class="form-control"
                                        name="invoice_search_id" onchange="on_change_search()">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-6 form-group">
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <h5> Supplyer name :</h5>
                                </div>
                                <div class="col-sm-8 form-group mt-3 mt-md-0">
                                    <input id="search_supplyer_number" type="text" class="form-control"
                                        name="invoice_supplyer_id" onchange="on_changer_search()">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3 form-group">
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <h5> Date :</h5>
                                </div>
                                <div class="col-sm-8 form-group mt-3 mt-md-0">
                                    <input id="search_date" type="text" class="form-control" name="date_search_id"
                                        onchange="on_change_search()">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3 align-items-center">

                            <div class="row align-items-center">
                                <div class="col-sm-2 d-flex align-items-center">
                                    <input class="form-check-input" type="checkbox" value="" id="NotPaidCheckBox">
                                </div>

                                <div class="col-sm-10 d-flex align-items-center">
                                    <h5 class="mb-0">Only not paid</h5>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <div class="row gx-lg-0 gy-4">

                <div class="col-lg-12  php-email-form">

                    <div class="row">
                        <table id="AlSupplyInvoicesTable"
                            class="table table-hover table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Supply reference</th>
                                    <th>Supplier</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                </tr>

                            </thead>
                            <tbody id="AlSupplyInvoicesTbody">

                            </tbody>
                        </table>
                    </div>
                </div><!-- End Contact Form -->

            </div>

        </div>
    </section><!-- End New sale Section -->
</main><!-- End #main -->

<!-- Modal -->
<div class="modal fade" id="supplyInvoiceModal" tabindex="-1" aria-labelledby="supplyInvoiceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <!-- wide modal -->
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="supplyInvoiceModalLabel">Supply Invoice Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- General Information -->
                <div class="mb-4 border-bottom pb-3">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <strong>Supplier:</strong> <span id="modalSupplierName">---</span>
                        </div>
                        <div class="col-md-3 mb-2">
                            <strong>Date:</strong> <span id="modalInvoiceDate">---</span>
                        </div>
                        <div class="col-md-3 mb-2">
                            <strong>Total:</strong> <span id="modalTotal">0.00</span>DZA
                        </div>
                        <div class="col-md-3 mb-2">
                            <strong>Total Payment:</strong> <span id="modalTotalPayment">0.00</span>DZA
                        </div>
                    </div>
                </div>

                <!-- Two Widgets Side-by-Side -->
                <div class="row">
                    <!-- Items Table -->
                    <div class="col-md-6">
                        <h6>Items</h6>
                        <table class="table table-bordered table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                </tr>
                            </thead>
                            <tbody id="modalItemsTableBody">
                                <!-- Dynamic rows go here -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Payments Table -->
                    <div class="col-md-6">
                        <h6>Payments</h6>
                        <table class="table table-bordered table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="modalPaymentsTableBody">
                                <!-- Dynamic rows go here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Edit Invoice -->
<?php require_once './includes/footer.php'; ?>


<script type="text/javascript">
$(document).ready(function() {
    var date_limit = new Date();
    date_limit.setDate(date_limit.getDate() - 100);
    var day = date_limit.getDate();
    var month = date_limit.getMonth() + 1;
    var year = date_limit.getFullYear();
    date_limit_as_string = year + "-" + month + "-" + day;

    var not_paid = false;
    var supplyer = "";
    var invoice_id = null;
    $.ajax({
        url: "includes/affichage_supplyOpt.php",
        type: "POST",
        data: {
            getSupplyInvoices: "1",
            date_limit: date_limit_as_string,
            supplyer_name: supplyer,
            invoice_id: invoice_id,
            only_not_paid: not_paid
        },

        success: function(data) {
            $("tbody#AlSupplyInvoicesTbody").html(data);
            $("#AlSupplyInvoicesTable").DataTable();

        },
        error: function(resultat, statut, erreur) {
            create_toast("Error", "Erreur Serveur!");
        }
    });
});

function showSupplyModal(invoice_id) {
    const modalElement = document.getElementById('supplyInvoiceModal');
    const modal = new bootstrap.Modal(modalElement);
    modal.show();
    /*  $.ajax({
         url: 'include/affichage_supplyOpt.php', // Laravel route URL
         type: 'POST',
         data: {
             id: GetSupplyInvoice
         },
         dataType: 'json',
         success: function(response) {

         },
         error: function(xhr, status, error) {
             console.error('AJAX Error:', status, error);
             alert('Failed to load invoice data.');
         }
     }); */
}
</script>