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
    <section id="Invoice_section" class="contact sections-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h2>Invoices manager</h2>
                <p>Here you can see the history of your invoices, return items and so on</p>                    
            </div>

            <div class="row gx-lg-0 gy-4">

                <div class="col-lg-12  php-email-form">

                    <div class="row">
                        <table id="AllInvoicesTable" class="table table-hover table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>reference</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>ACTIONS</th>
                                </tr>

                            </thead>
                            <tbody id="AllInvoicesTbody">

                            </tbody>
                        </table>
                    </div>
                </div><!-- End Contact Form -->

            </div>

        </div>
    </section><!-- End New sale Section -->
</main><!-- End #main -->

<!-- Edit Invoice -->
<div class="modal fade php-email-form" id="Edit_invoice_modal" tabindex="-1" aria-labelledby="Edit_invoiceLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditLabel">Edit Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <h5> Customer :</h1>
                            </div>
                            <div class="col-sm-8 form-group mt-3 mt-md-0">
                                <input id="customer_id" type="text" hidden="hidden" value=-1>
                                <input id="customer_name" type="text" class="form-control AutoCompleteCustomer" name="customer" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <h5> Date :</h1>
                            </div>
                            <div class="col-sm-4 form-group mt-3 mt-md-0">
                                <input id="Invoice_date" type="date" class="form-control AutoCompleteCustomer" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <table id="edit_invoice_table" class="table table-hover table-bordered table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th>ITEM</td>
                                        <th>QUANTITY</td>
                                        <th>UNIT PRICE</td>
                                        <th>ACTIONS</td>
                                    </tr>
                                </thead>
                                <tbody id="edit_invoice_tbody">

                                </tbody>
                            </table>
                        </div>
                       
                    </div>
                </div>

                <div class="modal-footer" id="Edit_invoice_footer">
                    <div class="alert alert-danger" role="alert" >
                        You need to retun to the customer <span id="invoice_return_amount"></span>DA
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


<?php require_once './includes/footer.php'; ?>


<script type="text/javascript">
    $(document).ready(function () {
        var date_limit = new Date();
        date_limit.setDate(date_limit.getDate() - 10 );
        var day = date_limit.getDate();
        var month = date_limit.getMonth() + 1;
        var year = date_limit.getFullYear();
        date_limit_as_string = year + "-" +month +"-"+day;
        
        $.ajax({
            url: "includes/affichage_invoices.php",
            type: "POST",
            data: {
                getAllIInvoices: "1",
                date_limit: date_limit_as_string
            },

            success: function (data) {
                $("tbody#AllInvoicesTbody").html(data);
                $("#AllInvoicesTable").DataTable();
                $("#AllInvoicesTable_filter").append("<span>   </span>");
                $("#AllInvoicesTable_filter").append("<input id='invoice_date_limit' type='date' onchange='on_change_date_limit(this.value)'></input>");
            },
            error: function (resultat, statut, erreur) {
                $("#AllInvoicesTable").html("error");
            }
        });
    });
    // on change for the date limit input
    function on_change_date_limit(){
        date_limit =$("input#invoice_date_limit").val();
        $.ajax({
            url: "includes/affichage_invoices.php",
            type: "POST",
            data: {
                getAllIInvoices: "1",
                date_limit: date_limit
            },
            success: function (data) {
                $("tbody#AllInvoicesTbody").html(data);
            },
            error: function (resultat, statut, erreur) {
                $("#AllInvoicesTable").html("error");
            }
        });
                    
    }

    function GetInvoice(invoice_id, customer_name, date){

        // set the general fields
        $("input#customer_name").val(customer_name);
        $("input#Invoice_date").val(date);

        $("div#Edit_invoice_footer").hide();

        $.ajax({
            url: "includes/affichage_invoices.php",
            type: "POST",
            data: {
                getInvoiceDetails: "1",
                invoice_id: invoice_id
            },
            success: function (data) {
                $("tbody#edit_invoice_tbody").html(data);
                var table = $("table#edit_invoice_table").dataTable();

            },
            error: function (resultat, statut, erreur) {
                $("#AllInvoicesTable").html("error");
            }
        });

    }

    function return_item(invoice_id, item_id, quantity, unit_price){
        //delete the item from the database
        popover = bootstrap.Popover.getOrCreateInstance('#popover_delete_'+item_id, {
            container : 'body',
            title: '<h4 class="custom-title"><i class="fas fa-warning"></i> Are you sure ?<button  > xxxx </button> </h4>',
            content: '<div class="popover-content text-center">' +
                        '<div class="btn-group">'+
                            '<a class="btn btn-sm btn-primary confirm_delete_item" ><i class="fas fa-check"></i> Yes</a>'+
                            '<a class="btn btn-sm btn-danger cancel_delete_item"><i class="fas fa-times"></i> No</a>'+
                        '</div>'+
                    '</div>',
            html: true,
            
        });  // Returns a Bootstrap popover instance
        popover.show();

        $(".confirm_delete_item").click(function(){
            $.ajax({
                url: "includes/invoice.php",
                type: "POST",
                data: {
                    edit_invoice: "1",
                    invoice_id: invoice_id,
                    item_id: item_id
                },
                success: function (data) {
                    //delet the item from the datatable
                    table = $("#edit_invoice_table").DataTable();
                    var i = item_id;
                    table.row($("#item_"+i)).remove().draw();
                    popover.dispose();

                    //show how much we need to return
                    var return_amount = quantity * unit_price;

                    $("div#Edit_invoice_footer").show();
                    $("span#invoice_return_amount").html(""+return_amount);
                },
                error: function (resultat, statut, erreur) {
                    $("#AllInvoicesTable").html("error");
                }
            });
        });
        
        $(".cancel_delete_item").click(function(){
            popover.hide();
        })
    }

    function delete_invoice_click(invoice_id, nbr_items) {
            var warning_nbr_items = ""
            if(nbr_items != 0) {
                warning_nbr_items = '<div class="alert alert-danger" role="alert">the invoice has '+nbr_items+' items </div> '
            }
            popover = bootstrap.Popover.getOrCreateInstance('#popover_delete_' + invoice_id, {
                container: 'body',
                title: '<h4 class="custom-title"><i class="fas fa-warning"></i> Are you sure ?<button  > xxxx </button> </h4>',
                content: '<div class="popover-content text-center">' +
                    warning_nbr_items +
                    '<div class="btn-group">' +
                    '<a class="btn btn-sm btn-primary confirm_delete_invoice" ><i class="fas fa-check"></i> Yes</a>' +
                    '<a class="btn btn-sm btn-danger cancel_delete_invoice"><i class="fas fa-times"></i> No</a>' +
                    '</div>' +
                    '</div>',
                html: true,

            });  // Returns a Bootstrap popover instance
            popover.show();

            $(".confirm_delete_invoice").click(function () {
                $.ajax({
                    url: "actions/__delete_invoiceModel.php",
                    type: "POST",
                    data: {
                        delete_invoice: "1",
                        invoice_id: invoice_id
                    },
                    success: function (data) {
                        if (data == 0) {
                            //delete the row from the data table
                            table = $("#AllInvoicesTable").DataTable();
                            table.row($("#invoice_" + invoice_id)).remove().draw();
                            popover.dispose();
                            create_toast("Info", "The invoice has been deleted succefully!")
                        } else {
                            create_toast("Error", "Error server!");
                        }

                    },
                    error: function (resultat, statut, erreur) {
                        // show an error message
                        create_toast("Error", "Error server!")
                    }
                });
            });

            $(".cancel_delete_invoice").click(function () {
                popover.hide();
            })

        }


    </script>