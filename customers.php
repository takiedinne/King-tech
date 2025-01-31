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
flash();
?>

<main id="main">
    <!-- ======= customer Section ======= -->
    <section id="customer_section" class="contact sections-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Customers manager</h2>
                <p>Here you can manage your customers, their contacts and their purchases</p>
            </div>

            <div class="row gx-lg-0 gy-4">

                <div class="col-lg-12  php-email-form">

                    <div class="row">
                        <table id="AllCustomerTable"
                            class="table table-hover table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>NAME</th>
                                    <th>ADDRESS</th>
                                    <th>TELEPHONE</th>
                                    <th>Depts</th>
                                    <th>ACTIONS</th>
                                </tr>

                            </thead>
                            <tbody id="AllCustomerTbody">

                            </tbody>
                        </table>
                    </div>
                </div><!-- End Contact Form -->

            </div>

        </div>
    </section><!-- End New sale Section -->


</main><!-- End #main -->

<!-- Edit -->
<div class="modal fade php-email-form" id="Edit_customer" tabindex="-1" aria-labelledby="EditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="EditLabel">Edit Customer Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="edit_customer_form" class="container-fluid">
                    <div class='mb-3 row'>
                        <div class="col-sm-6">
                            <input type="hidden" name="customer_id" id="Edit_customer_id">
                            <label for="customer_firstname" class="form-label">First name:</label>
                            <input type='text' class='form-control' name='customer_firstname'
                                id="Edit_customer_firstname">
                        </div>
                        <div class='col-sm-6'>
                            <label for="customer_surname" class="form-label">Surname:</label>
                            <input type='text' class='form-control' name='customer_surname' id='Edit_customer_surname'>
                        </div>
                    </div>
                    <div class='mb-3'>
                        <label for="customer_address" class="form-label">Address:</label>
                        <input type='text' class='form-control' name='customer_address' id="Edit_customer_address">
                    </div>
                    <div class='mb-3 '>
                        <label for="customer_telephone" class="form-label">Telephone:</label>
                        <input type='tel' class='form-control' name='customer_telephone' id="Edit_customer_telephone">
                    </div>
                    <div class="mb-3">
                        <label for="customer_email" class="form-label">E-mail:</label>
                        <input type='email' class='form-control' name='customer_email' id="Edit_customer_email">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fas fa-times"></span>
                    Cancel</button>
                <button id="update_customer_button" type="submit" name="edit" class="btn btn-success"><span
                        class="fas fa-check"></span> Update</a>
            </div>


        </div>
    </div>
</div>

<!-- new -->
<div class="modal fade php-email-form" id="new_customer" tabindex="-1" aria-labelledby="newLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="./actions/__add_customerModel.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditLabel">Add New Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="new_customer_form" class="container-fluid">
                        <div class='mb-3 row'>
                            <div class="col-sm-6">
                                <label for="customer_firstname" class="form-label">First name:</label>
                                <input type='text' class='form-control' name='firstname' id="firstname" required>
                            </div>
                            <div class='col-sm-6'>
                                <label for="customer_surname" class="form-label">Surname:</label>
                                <input type='text' class='form-control' name='surname' id='surname' required>
                            </div>
                        </div>

                        <div class='mb-3'>
                            <label for="customer_address" class="form-label">Address:</label>
                            <input type='text' class='form-control' name='address' id="address">
                        </div>
                        <div class='mb-3'>

                            <label for="customer_telephone" class="form-label">Telephone:</label>
                            <input type='tel' class='form-control' name='telephone' id="telephone">
                        </div>
                        <div class="mb-3">
                            <label for="customer_email" class="form-label">E-mail:</label>
                            <input type='email' class='form-control' name='email' id="email">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span
                            class="fas fa-times"></span> Cancel</button>
                    <button type="submit" name="edit" class="btn btn-success"><span class="fas fa-check"></span> Add</a>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade php-email-form" id="situation_customer_modal" tabindex="-1" aria-labelledby="newLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="EditLabel">Customer Situation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid ">
                    <div class='row'>
                        <div class="col-sm-12">
                            <label for="customer_firstname" class="form-label">Name:</label>
                            <span id="situation_customer"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <div data-coreui-locale="en-US" data-coreui-toggle="date-range-picker"></div>
                        </div>
                        <div class="col-sm-6">
                            <div data-coreui-start-date="2022/08/03" data-coreui-end-date="2022/08/17"
                                data-coreui-locale="en-US" data-coreui-toggle="date-range-picker">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fas fa-times"></span>
                    Cancel</button>
                <button type="submit" name="edit" class="btn btn-success"><span class="fas fa-check"></span>Print</a>
            </div>

        </div>
    </div>
</div>

<?php require_once './includes/footer.php'; ?>


<script type="text/javascript">
function delete_customer_click(customer_id) {

    popover = bootstrap.Popover.getOrCreateInstance('#popover_delete_' + customer_id, {
        container: 'body',
        title: '<h4 class="custom-title"><i class="fas fa-warning"></i> Are you sure ?<button  > xxxx </button> </h4>',
        content: '<div class="popover-content text-center">' +
            '<div class="btn-group">' +
            '<a class="btn btn-sm btn-primary confirm_delete_customer" ><i class="fas fa-check"></i> Yes</a>' +
            '<a class="btn btn-sm btn-danger cancel_delete_customer"><i class="fas fa-times"></i> No</a>' +
            '</div>' +
            '</div>',
        html: true,

    }); // Returns a Bootstrap popover instance
    popover.show();

    $(".confirm_delete_customer").click(function() {
        $.ajax({
            url: "actions/__delete_customerModel.php",
            type: "POST",
            data: {
                delete_customer: "1",
                customer_id: customer_id
            },
            success: function(data) {
                if (data == 0) {
                    //delete the row from the data table
                    table = $("#AllCustomerTable").DataTable();
                    var i = customer_id;
                    table.row($("#customer_" + i)).remove().draw();
                    popover.dispose();

                    create_toast("Info", "The customer has been deleted succefully!");
                } else {
                    create_toast("Error",
                        "Cannot delete customer because there invoices operations!");
                }

            },
            error: function(resultat, statut, erreur) {
                // show an error message
                create_toast("Error", "Error server!");
            }
        });
    });

    $(".cancel_delete_customer").click(function() {
        popover.hide();
    });

}

function get_all_customer() {
    $.ajax({
        url: "includes/affichage_customer.php",
        type: "POST",
        data: {
            getAllCustomer: "1"
        },

        success: function(data) {
            $("tbody#AllCustomerTbody").html(data);
            $("#AllCustomerTable").DataTable();
            $("#AllcustomerTable_filter").append("<span>   </span>");
            $("#AllcustomerTable_filter").append(
                "<button  class=\"btn btn-danger\"  data-bs-toggle=\"modal\" data-bs-target=\"#new_customer\" ><i class=\"fas fa-plus pr-2\"aria-hidden=\"true\"></i> New customer</button>"
            );

        },
        error: function(resultat, statut, erreur) {
            $("#AllCustomerTable").html("error");
        }
    });
}
$(document).ready(function() {
    get_all_customer();
});

function edit_customer(customer_id) {
    $.ajax({
        url: "includes/affichage_customer.php",
        type: "POST",
        data: {
            get_edit_customer_div: "1",
            customer_id: customer_id
        },
        dataType: 'json',

        success: function(data) {
            $("input#Edit_customer_id").val(customer_id);
            $("input#Edit_customer_firstname").val(data[0]);
            $("#Edit_customer_surname").val(data[1]);
            $("input#Edit_customer_address").val(data[2]);
            $("input#Edit_customer_telephone").val(data[3]);
            $("input#Edit_customer_email").val(data[4]);

        },
        error: function(resultat, statut, erreur) {
            $("#edit_customer_form").html("error");
        }
    });

}

$("button#update_customer_button").click(function() {
    $.ajax({
        url: "actions/__edit_customerModel.php",
        type: "POST",
        data: {
            customer_id: $("input#Edit_customer_id").val(),
            customer_firstname: $("input#Edit_customer_firstname").val(),
            customer_surname: $("input#Edit_customer_surname").val(),
            customer_address: $("input#Edit_customer_address").val(),
            customer_telephone: $("input#Edit_customer_telephone").val(),
            customer_email: $("input#Edit_customer_email").val()
        },
        success: function(data) {
            if (data == 1) {
                create_toast("Info", "The customer has been updated succefully!");
                $('#Edit_customer').modal('hide');
                //set the new values in the table
                var row = $("#customer_" + $("input#Edit_customer_id").val());
                row.find("td:eq(1)").text($("input#Edit_customer_firstname").val() + " " + $(
                    "input#Edit_customer_surname").val());
                row.find("td:eq(2)").text($("input#Edit_customer_address").val());
                row.find("td:eq(3)").text($("input#Edit_customer_telephone").val());
                row.find("td:eq(4)").text($("input#Edit_customer_email").val());

                /* row.toggleClass("bg-success").fadeOut(100, function() {
                        $(this).toggleClass("bg-success").fadeIn(300)
                }); */
                /* row.addClass('bg-success');
                setTimeout(function() {
                    row.removeClass('bg-success');
                }, 3000); // 3000 milliseconds = 3 seconds */

            } else {
                create_toast("Error", "Error while updating customer!");
            }
        },
        error: function(resultat, statut, erreur) {
            create_toast("Error", "Error server!");
        }
    });
});

function situation_customer(customer_id) {
    $("#situation_customer_modal").toggle();
}
</script>