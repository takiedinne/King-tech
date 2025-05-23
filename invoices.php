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

                        <div class="col-sm-6 form-group">
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <h5> Invoice N° :</h1>
                                </div>
                                <div class="col-sm-8 form-group mt-3 mt-md-0">
                                    <input id="search_invoice_number" type="text" class="form-control"
                                        name="invoice_search_id" onchange="on_change_invoice_search()">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <h5> Date limit :</h5>
                                </div>
                                <div class="col-sm-8 form-group mt-3 mt-md-0">
                                    <input id="invoice_date_limit" type="date" class="form-control"
                                        name="invoice_date_limit" onchange="on_change_date_limit()">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <h5> Customer Name :</h5>
                                </div>
                                <div class="col-sm-8 form-group mt-3 mt-md-0">
                                    <input id="customer_name" type="text" class="form-control AutoCompleteCustomer"
                                        name="customer_name">
                                    <input id="customer_id" type="text" hidden="hidden" value=-1>
                                    <div class="dropdown">
                                        <ul id="listeCustomer" class="dropdown-menu" aria-labelledby="customer_name"
                                            style="max-height: 250px;  display: none; position:absolute; margin:0px; width:100%; left:auto;">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 form-group">
                            <div class="row align-items-center">
                                <div class="col-sm-1 d-flex align-items-center">
                                    <input class="form-check-input" type="checkbox" value="" id="NotPaidCheckBox">
                                </div>

                                <div class="col-sm-4 d-flex align-items-center">
                                    <h5 class="mb-0">Only not paid</h5>
                                </div>
                                <div class="col-sm-7">
                                </div>
                            </div>

                        </div>
                    </div>
                </div><!-- End Contact Form -->

            </div>

            <br>

            <div class="row gx-lg-0 gy-4">

                <div class="col-lg-12  php-email-form">

                    <div class="row" id="depts_div" style="display: none;">
                        <div class="col-md-12" style="text-align: center;">
                            <h4><b>Total Depts:
                                    <span class="label label-info" id="invoice_total_depts">0,00 DA</span></b></h4>
                        </div>
                    </div>
                    <div class="row">
                        <table id="AllInvoicesTable"
                            class="table table-hover table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>reference</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Payment</th>
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
</main>
<!-- End #main -->

<!-- Edit Invoice -->
<div class="modal fade php-email-form" id="Edit_invoice_modal" tabindex="-1" aria-labelledby="Edit_invoiceLabel"
    aria-hidden="true">
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
                            <input id="customer_name" type="text" class="form-control AutoCompleteCustomer"
                                name="customer" disabled>
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
                        <table id="edit_invoice_table"
                            class="table table-hover table-bordered table-striped table-responsive">
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
                <div class="alert alert-danger" role="alert">
                    You need to retun to the customer <span id="invoice_return_amount"></span>DA
                </div>
            </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade php-email-form" id="Payments_modal" tabindex="-1" aria-labelledby="Edit_invoiceLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditLabel">Payments history</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <h5> Customer :</h5>
                        </div>
                        <div class="col-sm-8 form-group mt-3 mt-md-0">
                            <input id="customer_id" type="text" hidden="hidden" value=-1>
                            <input id="customer_name" type="text" class="form-control AutoCompleteCustomer"
                                name="customer" disabled>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <h5> Date :</h5>
                        </div>
                        <div class="col-sm-4 form-group mt-3 mt-md-0">
                            <input id="Invoice_date" type="date" class="form-control AutoCompleteCustomer" disabled>
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col-sm-6 form-group mt-3 mt-md-0">
                            <h5><b>Total:
                                    <span class="label label-info" id="invoice_total">0,00 DA</span></b></h5>
                        </div>
                        <div class="col-sm-6 form-group">
                            <h5><b>Payments:
                                    <span class="label label-info" id="invoice_payments">0,00</span>DA</b></h5>
                        </div>


                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6 form-group mt-3 mt-md-0">
                            <h5><b>Add payments:</b></h5>
                        </div>
                        <div class="col-sm-4 form-group">
                            <input id="payment_amount" type="number" class="form-control" name="payment_amount">
                            <input id="invoice_id_for_pay" type="number" hidden>
                        </div>
                        <div class="col-sm-2 form-group">
                            <button class="btn btn-success" id="add_payment"><i
                                    class="fa-solid fa-check-to-slot"></i></button>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <h4>Payments history</h4>
                        <table id="payments_table"
                            class="table table-hover table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>Date</td>
                                    <th>Time</td>
                                    <th>Payment</td>
                                    <th>ACTIONS</td>
                                </tr>
                            </thead>
                            <tbody id="payments_tbody">

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


<?php require_once './includes/footer.php'; ?>


<script type="text/javascript">
$(document).ready(function() {
    var date_limit = new Date();
    date_limit.setDate(date_limit.getDate() - 10);
    var day = date_limit.getDate();
    var month = date_limit.getMonth() + 1;
    var year = date_limit.getFullYear();
    date_limit_as_string = year + "-" + month + "-" + day;

    $.ajax({
        url: "includes/affichage_invoices.php",
        type: "POST",
        data: {
            getAllIInvoices: "1",
            date_limit: date_limit_as_string
        },

        success: function(data) {
            $("tbody#AllInvoicesTbody").html(data);
            $("#AllInvoicesTable").DataTable({
                "searching": false
            });
        },
        error: function(resultat, statut, erreur) {
            $("#AllInvoicesTable").html("error");
        }
    });
});


function GetInvoice(invoice_id, customer_name, date) {

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
        success: function(data) {
            $("tbody#edit_invoice_tbody").html(data);
            var table = $("table#edit_invoice_table").dataTable();

        },
        error: function(resultat, statut, erreur) {
            $("#AllInvoicesTable").html("error");
        }
    });

}

function return_item(invoice_id, item_id, quantity, unit_price) {
    //delete the item from the database
    popover = bootstrap.Popover.getOrCreateInstance('#popover_delete_' + item_id, {
        container: 'body',
        title: '<h4 class="custom-title"><i class="fas fa-warning"></i> Are you sure ?<button  > xxxx </button> </h4>',
        content: '<div class="popover-content text-center">' +
            '<div class="btn-group">' +
            '<a class="btn btn-sm btn-primary confirm_delete_item" ><i class="fas fa-check"></i> Yes</a>' +
            '<a class="btn btn-sm btn-danger cancel_delete_item"><i class="fas fa-times"></i> No</a>' +
            '</div>' +
            '</div>',
        html: true,

    }); // Returns a Bootstrap popover instance
    popover.show();

    $(".confirm_delete_item").click(function() {
        $.ajax({
            url: "includes/invoice.php",
            type: "POST",
            data: {
                edit_invoice: "1",
                invoice_id: invoice_id,
                item_id: item_id
            },
            success: function(data) {
                //delet the item from the datatable
                table = $("#edit_invoice_table").DataTable();
                var i = item_id;
                table.row($("#item_" + i)).remove().draw();
                popover.dispose();

                //show how much we need to return
                var return_amount = quantity * unit_price;

                $("div#Edit_invoice_footer").show();
                $("span#invoice_return_amount").html("" + return_amount);
            },
            error: function(resultat, statut, erreur) {
                $("#AllInvoicesTable").html("error");
            }
        });
    });

    $(".cancel_delete_item").click(function() {
        popover.hide();
    })
}

function delete_invoice_click(invoice_id, nbr_items) {
    var warning_nbr_items = ""
    if (nbr_items != 0) {
        warning_nbr_items = '<div class="alert alert-danger" role="alert">the invoice has ' + nbr_items +
            ' items </div> '
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

    }); // Returns a Bootstrap popover instance
    popover.show();

    $(".confirm_delete_invoice").click(function() {
        $.ajax({
            url: "actions/__delete_invoiceModel.php",
            type: "POST",
            data: {
                delete_invoice: "1",
                invoice_id: invoice_id
            },
            success: function(data) {
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
            error: function(resultat, statut, erreur) {
                // show an error message
                create_toast("Error", "Error server!")
            }
        });
    });

    $(".cancel_delete_invoice").click(function() {
        popover.hide();
    })

}

function GetPayments(invoice_id, customer_name, date, total, payment) {

    // set the general fields
    $("input#customer_name").val(customer_name);
    $("input#Invoice_date").val(date);
    $("span#invoice_total").html(total + " DA");
    $("span#invoice_payments").html(payment);
    $("input#invoice_id_for_pay").val(invoice_id);
    $.ajax({
        url: "includes/affichage_invoices.php",
        type: "POST",
        data: {
            getInvoicePayments: "1",
            invoice_id: invoice_id
        },
        success: function(data) {
            $("tbody#payments_tbody").html(data);
            var table = $("table#payments_table").DataTable();
            table.rows();
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
            });

            var sum = 1230;

            // Iterate over each row
            var sum = 0;
            var columnIndex = 2; // Change to your target column index

            table.data().each(function (rowData) {
                sum += parseFloat(rowData[columnIndex]) || 0; // Ensure numeric conversion
            });   
            $("span#invoice_payments").html(sum);


        },
        error: function(resultat, statut, erreur) {
            $("#AllInvoicesTable").html("error");
        }
    });

}
$("#add_payment").click(function() {
    var payment_amount = $("input#payment_amount").val();
    var invoice_id = $("input#invoice_id_for_pay").val();
    $.ajax({
        url: "includes/invoice.php",
        type: "POST",
        data: {
            add_payment: "1",
            invoice_id: invoice_id,
            payment_amount: payment_amount
        },
        success: function(data) {
            if (data == 1) {
                //add the payment to the table
                var table = $("table#payments_table").DataTable();
                var dt = new Date();
                var date = dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate();
                var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
                table.row.add([
                    dt,
                    time,
                    payment_amount,
                    "<button  class='btn btn-danger btn-sm' id='confirm_delete_payment_"+invoice_id+"_"+ date +"_"+time+" onclick='delete_payment(" + invoice_id +
                    ", " + date +", '"+time+"')'><span class='fas fa-undo'></span> return </button>"
                ]).draw();

                //update the total payment
                var total_payment = parseFloat($("span#invoice_payments").html().split(" ")[0]);
                total_payment += parseFloat(payment_amount);
                create_toast("Error", total_payment);
                $("span#invoice_payments").html(total_payment + " DA");
                //clear the input
                $("input#payment_amount").val("");

                //update the payment field in the main table
                $("tr#invoice_" + invoice_id + " td:nth-child(6)").html(total_payment);
            } else {
                create_toast("Error", "Error server!");
            }

        },
        error: function(resultat, statut, erreur) {
            // show an error message
            create_toast("Error", "Error server!")
        }
    });
});

function on_change_invoice_search() {
    invoice_id = $("input#search_invoice_number").val();
    $.ajax({
        url: "includes/affichage_invoices.php",
        type: "POST",
        data: {
            getIInvoices: "1",
            invoice_id: invoice_id
        },
        success: function(data) {
            $("tbody#AllInvoicesTbody").html(data);
            //table.draw();

        },
        error: function(resultat, statut, erreur) {
            $("#AllInvoicesTable").html("error");
        }
    });

}
$("input.AutoCompleteCustomer").on({
    keyup: function() {
        var min_long = 2;
        var motcle = $(this).val();
        if (motcle.length >= min_long) {
            var $ajaxData = {
                customer: motcle
            };
            $ajaxData.AutoCompleteCustomer = '1';
            $.ajax({
                url: "includes/affichage_customer.php",
                type: "POST",
                data: $ajaxData,
                success: function(data) {
                    $("ul#listeCustomer").show();
                    $("ul#listeCustomer").html(data);
                    // $("ul#listeElevesDossierScolaire").css("top", $("input#rechercheEleveDossierScolaire").prop("scrollTop")+28);

                },
                error: function(resultat, statut, erreur) {
                    toastr.error(
                        "Veuillez contacter le Centre de Ressources Informatiques pour v&eacute;rifier le serveur.",
                        "Erreur Serveur!");
                }
            });
        }else {
            $("ul#listeCustomer").hide();
            $("input#customer_id").val(-1);
            $("input#customer_type").val(-1);
            $("div#depts_div").fadeOut();

            if (motcle.length == 0) {
                on_change_date_limit();
            }
        }
    }
});

// on change for the date limit input
function on_change_date_limit() {

    var $ajaxData = {
        filterInvoices: "1",
        customerId: $("input#customer_id").val(),
        date_limit: $("input#invoice_date_limit").val()
    };
    $.ajax({
        url: "includes/affichage_invoices.php",
        type: "POST",
        data: $ajaxData,
        success: function(data) {
            table = $("#AllInvoicesTable").DataTable();
            table.destroy();

            $("tbody#AllInvoicesTbody").html(data);

            //reinitiate the datatable
            $("#AllInvoicesTable").DataTable();
        },
        error: function(resultat, statut, erreur) {
            toastr.error(
                "Veuillez contacter le Centre de Ressources Informatiques pour v&eacute;rifier le serveur.",
                "Erreur Serveur!");
        }
    });


}

function set_selection_customer(customer_name, customerId, customerType) {

    $("input#customer_name").val(customer_name);
    $("ul#listeCustomer").hide();
    $("input#customer_id").val(customerId);
    // get all the invoices of the customer 
    //create_toast("Info", "Customer id: " + customerId + " date:" + $("input#invoice_date_limit").val());
    var $ajaxData = {
        filterInvoices: "1",
        customerId: customerId,
        date_limit: $("input#invoice_date_limit").val()
    };
    $.ajax({
        url: "includes/affichage_invoices.php",
        type: "POST",
        data: $ajaxData,
        success: function(data) {
            table = $("#AllInvoicesTable").DataTable();
            table.destroy();

            $("tbody#AllInvoicesTbody").html(data);

            //reinitiate the datatable
            $("#AllInvoicesTable").DataTable();

            get_depts_for_customer(customerId);

        },
        error: function(resultat, statut, erreur) {
            toastr.error(
                "Veuillez contacter le Centre de Ressources Informatiques pour v&eacute;rifier le serveur.",
                "Erreur Serveur!");
        }
    });

}

function get_depts_for_customer(customerId) {
    $.ajax({
        url: "includes/affichage_invoices.php",
        type: "POST",
        data: {
            getDepts: "1",
            customerId: customerId
        },
        success: function(data) {
            $("#depts_div").toggle(500);
            var depts = parseFloat(data).toFixed(2);
            $("span#invoice_total_depts").html(depts + " DA");
        },
        error: function(resultat, statut, erreur) {
            $("#AllInvoicesTable").html("error");
        }
    });
}

function delete_payment(id, invoice_id, date, payment) {

    //delete the item from the database
    var $btn = $("#delete_payment_"+id /* + invoice_id + "_" + date + "_" + payment */);
      
    var popover = bootstrap.Popover.getOrCreateInstance($btn, {
        container: 'body',
        title: '<h4 class="custom-title"><i class="fas fa-warning"></i> Are you sure ?<button  > xxxx </button> </h4>',
        content: '<div class="popover-content text-center">' +
            '<div class="btn-group">' +
            '<a class="btn btn-sm btn-primary confirm_delete_payment" ><i class="fas fa-check"></i> Yes</a>' +
            '<a class="btn btn-sm btn-danger cancel_delete_payment"><i class="fas fa-times"></i> No</a>' +
            '</div>' +
            '</div>',
        html: true,
    });

    popover.show();

    $(".confirm_delete_payment").click(function() {
        var $row = $btn.closest("tr"); // Get the table row of the button
        
        $.ajax({
            url: "includes/invoice.php",
            type: "POST",
            data: {
                delete_payment: "1",
                invoice_id: invoice_id,
                payment: payment,
                date: date
            },
            success: function(data) {
                $row.remove();

                popover.dispose();
                // update the rest
                span_payments = $("#invoice_payments");
                old_payment = parseFloat(span_payments);
                new_payment = old_payment - payment;
                span_payments.html(new_payment);

            },
            error: function(resultat, statut, erreur) {
                $("#payments_table").html("error");
            }
        });
    });

    $(".cancel_delete_payment").click(function() {
        popover.hide();
    })

}

$("#NotPaidCheckBox").change(function() {
    $("#AllInvoicesTable").DataTable().draw();
});


$.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var total = parseFloat(data[4]) || 0; // Total column
            var paid = parseFloat(data[5]) || 0; // Paid column
            var checkBox = $('#NotPaidCheckBox').is(':checked'); // Checkbox state

            if (checkBox) {
                return paid < total;
            }
            return true;
        }
);
</script>