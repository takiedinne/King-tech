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
    <!-- ======= Supplier Section ======= -->
    <section id="supplier_section" class="contact sections-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Suppliers manager</h2>
                <p>Here you can manage your suppliers, their contacts and their products</p>                    
            </div>

            <div class="row gx-lg-0 gy-4">

                <div class="col-lg-12  php-email-form">

                    <div class="row">
                        <table id="AllSuppliersTable" class="table table-hover table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>NAME</th>
                                    <th>ADDRESS</th>
                                    <th>TELEPHONE</th>
                                    <th>EMAIL</th>
                                    <th>ACTIONS</th>
                                </tr>

                            </thead>
                            <tbody id="AllSuppliersTbody">

                            </tbody>
                        </table>
                    </div>
                </div><!-- End Contact Form -->

            </div>

        </div>
    </section><!-- End New sale Section -->


</main><!-- End #main -->

<!-- Edit -->
<div class="modal fade php-email-form" id="Edit_supplier" tabindex="-1" aria-labelledby="EditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="./actions/__edit_supplierModel.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditLabel">Edit Supplier Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="edit_supplier_form" class="container-fluid">
                        <div class='mb-3 row'>
                            <div class="col-sm-6">
                                <input type="hidden" name="supplier_id" id="Edit_supplier_id">
                                <label for="supplier_firstname" class="form-label">First name:</label>
                                <input type='text' class='form-control' name='supplier_firstname' id="Edit_supplier_firstname">
                            </div>
                            <div class='col-sm-6'>
                                <label for="supplier_surname" class="form-label">Surname:</label>
                                <input type='text' class='form-control' name='supplier_surname' id='Edit_supplier_surname'>
                            </div>
                        </div>
                        <div class='mb-3'>
                            <label for="supplier_address" class="form-label">Address:</label>
                            <input type='text' class='form-control' name='supplier_address' id="Edit_supplier_address">
                        </div>
                        <div class='mb-3 '>
                            <label for="supplier_telephone" class="form-label">Telephone:</label>
                            <input type='tel' class='form-control' name='supplier_telephone' id="Edit_supplier_telephone">
                        </div>
                        <div class="mb-3">
                            <label for="supplier_email" class="form-label">E-mail:</label>
                            <input type='email' class='form-control' name='supplier_email' id="Edit_supplier_email">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span
                            class="fas fa-times"></span> Cancel</button>
                    <button type="submit" name="edit" class="btn btn-success"><span
                            class="fas fa-check"></span> Update</a>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- new -->
<div class="modal fade php-email-form" id="new_supplier" tabindex="-1" aria-labelledby="newLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="./actions/__add_supplierModel.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditLabel">Add New Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="new_supplier_form" class="container-fluid">
                        <div class='mb-3 row'>
                            <div class="col-sm-6">
                                <label for="supplier_firstname" class="form-label">First name:</label>
                                <input type='text' class='form-control' name='supplier_firstname' id="supplier_firstname" required>
                            </div>
                            <div class='col-sm-6'>
                                <label for="supplier_surname" class="form-label">Surname:</label>
                                <input type='text' class='form-control' name='supplier_surname' id='supplier_surname' required>
                            </div>
                        </div>
                        
                        <div class='mb-3'>
                            <label for="supplier_address" class="form-label">Address:</label>
                            <input type='text' class='form-control' name='supplier_address' id="supplier_address">
                        </div>
                        <div class='mb-3'>
                            
                                <label for="supplier_telephone" class="form-label">Telephone:</label>
                                <input type='tel' class='form-control' name='supplier_telephone' id="supplier_telephone">
                        </div>
                        <div class="mb-3">
                            <label for="supplier_email" class="form-label">E-mail:</label>
                            <input type='email' class='form-control' name='supplier_email' id="supplier_email">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span
                            class="fas fa-times"></span> Cancel</button>
                    <button type="submit" name="edit" class="btn btn-success"><span
                            class="fas fa-check"></span> Add</a>
                </div>
            </form>

        </div>
    </div>
</div>

<?php require_once './includes/footer.php'; ?>


<script type="text/javascript">

    function delete_supplier_click(supplier_id) {
        
        popover = bootstrap.Popover.getOrCreateInstance('#popover_delete_'+supplier_id, {
            container : 'body',
            title: '<h4 class="custom-title"><i class="fas fa-warning"></i> Are you sure ?<button  > xxxx </button> </h4>',
            content: '<div class="popover-content text-center">' +
                        '<div class="btn-group">'+
                            '<a class="btn btn-sm btn-primary confirm_delete_supplier" ><i class="fas fa-check"></i> Yes</a>'+
                            '<a class="btn btn-sm btn-danger cancel_delete_supplier"><i class="fas fa-times"></i> No</a>'+
                        '</div>'+
                    '</div>',
            html: true,
            
        });  // Returns a Bootstrap popover instance
        popover.show();
        
        $(".confirm_delete_supplier").click(function(){
            $.ajax({
                url: "actions/__delete_supplierModel.php",
                type: "POST",
                data: {
                    delete_supplier: "1",
                    supplier_id : supplier_id
            },
                success: function (data) {
                    if (data == 0){
                        //delete the row from the data table
                        table = $("#AllSuppliersTable").DataTable();
                        var i = supplier_id;
                        table.row($("#supplier_"+i)).remove().draw();
                        popover.dispose();
                        
                        create_toast("Info", "The supplier has been deleted succefully!");
                    }
                    else{
                        create_toast("Error", "Cannot delete supplier because there supplying operations!");
                    }
                    
                },
                error: function (resultat, statut, erreur) {
                    // show an error message
                    create_toast("Error", "Error server!");
                }
            });
        });
        
        $(".cancel_delete_supplier").click(function(){
            popover.hide();
        });
        
    }
    
    function get_all_supplier(){
        $.ajax({
            url: "includes/affichage_supplier.php",
            type: "POST",
            data: {
                getAllSuppliers: "1"
            },

            success: function (data) {
                $("tbody#AllSuppliersTbody").html(data);
                $("#AllSuppliersTable").DataTable();
                $("#AllSuppliersTable_filter").append("<span>   </span>");
                $("#AllSuppliersTable_filter").append("<button  class=\"btn btn-danger\"  data-bs-toggle=\"modal\" data-bs-target=\"#new_supplier\" ><i class=\"fas fa-plus pr-2\"aria-hidden=\"true\"></i> New supplier</button>");
                
            },
            error: function (resultat, statut, erreur) {
                $("#AllSuppliersTable").html("error");
            }
        });
    }
    $(document).ready(function () {
        get_all_supplier();
    });

    function edit_supplier(supplier_id) {
        $.ajax({
            url: "includes/affichage_supplier.php",
            type: "POST",
            data: {
                get_edit_supplier_div: "1",
                supplier_id: supplier_id
            },
            dataType: 'json',

            success: function (data) {
                $("input#Edit_supplier_id").val(supplier_id);
                $("input#Edit_supplier_firstname").val(data[0]);
                $("#Edit_supplier_surname").val(data[1]);
                $("input#Edit_supplier_address").val(data[2]);
                $("input#Edit_supplier_telephone").val(data[3]);
                $("input#Edit_supplier_email").val(data[4]);
                
            },
            error: function (resultat, statut, erreur) {
                $("#edit_supplier_form").html("error");
            }
        });

    }
</script>