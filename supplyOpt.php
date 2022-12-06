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

            <div class="row gx-lg-0 gy-4">

                <div class="col-lg-12  php-email-form">

                    <div class="row">
                        <table id="AlSupplyInvoicesTable" class="table table-hover table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Supply reference</th>
                                    <th>Supplier</th>
                                    <th>Item</th>
                                    <th>Date</th>
                                    <th>Quantity</th>
                                    <th>Unit price</th>
                                    <th>ACTIONS</th>
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

<!-- Edit Invoice -->
<?php require_once './includes/footer.php'; ?>


<script type="text/javascript">
    $(document).ready(function () {
        var date_limit = new Date();
        date_limit.setDate(date_limit.getDate() - 100);
        var day = date_limit.getDate();
        var month = date_limit.getMonth() + 1;
        var year = date_limit.getFullYear();
        date_limit_as_string = year + "-" +month +"-"+day;
        
        $.ajax({
            url: "includes/affichage_supplyOpt.php",
            type: "POST",
            data: {
                getAllISupplyInvoices: "1",
                date_limit: date_limit_as_string
            },

            success: function (data) {
                $("tbody#AlSupplyInvoicesTbody").html(data);
                $("#AlSupplyInvoicesTable").DataTable();
                $("#AllInvoicesTable_filter").append("<span>   </span>");
                $("#AllInvoicesTable_filter").append("<input id='invoice_date_limit' type='date' onchange='on_change_date_limit(this.value)'></input>");
            },
            error: function (resultat, statut, erreur) {
                create_toast("Error", "Erreur Serveur!");
            }
        });
    });
    // on change for the date limit input
    function on_change_date_limit(){
        date_limit =$("input#affichage_supplyOpt").val();
        $.ajax({
            url: "includes/affichage_invoices.php",
            type: "POST",
            data: {
                getAllIInvoices: "1",
                date_limit: date_limit
            },
            success: function (data) {
                $("tbody#AlSupplyInvoicesTbody").html(data);
            },
            error: function (resultat, statut, erreur) {
                create_toast("Error", "Erreur Serveur!");
            }
        });
                    
    }
    function deleteSupplyOpt(invoice_id, item_id) {

            popover = bootstrap.Popover.getOrCreateInstance('#popover_delete_' + invoice_id +'_'+item_id, {
                container: 'body',
                title: '<h4 class="custom-title"><i class="fas fa-warning"></i> Are you sure ?<button  > xxxx </button> </h4>',
                content: '<div class="popover-content text-center">' +
                    '<div class="btn-group">' +
                    '<a class="btn btn-sm btn-primary confirm_delete_supplyOpt" ><i class="fas fa-check"></i> Yes</a>' +
                    '<a class="btn btn-sm btn-danger cancel_delete_supplyOpt"><i class="fas fa-times"></i> No</a>' +
                    '</div>' +
                    '</div>',
                html: true,

            });  // Returns a Bootstrap popover instance
            popover.show();

            $(".confirm_delete_supplyOpt").click(function () {
                $.ajax({
                    url: "actions/__delete_supplyOptModel.php",
                    type: "POST",
                    data: {
                        delete_supplrOpt: "1",
                        item_id: item_id, 
                        supply_invoice_id : invoice_id
                    },
                    success: function (data) {
                        if (data == 0) {
                            //delete the row from the data table
                            table = $("#AlSupplyInvoicesTable").DataTable();
                            table.row($("#supplyOpt_" + invoice_id +"_"+item_id)).remove().draw();
                            popover.dispose();
                            create_toast("Info", "The supply operation has been deleted succefully!")
                        } else {
                            create_toast("Error", "Cannot delete this supply operation Error server!");
                        }

                    },
                    error: function (resultat, statut, erreur) {
                        // show an error message
                        create_toast("Error", "Error server!")
                    }
                });
            });

            $(".cancel_delete_supplyOpt").click(function () {
                popover.hide();
            })

        }

    
</script>