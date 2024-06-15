<?php
session_start();
require_once 'bootstrap.php';
if (isset($_SESSION['connected']) == false) {
    header('location: ' . URLROOT . '/index.php');
    exit();
}
require_once 'includes/header.php';
require_once 'includes/main_header.php';
include_once('db.php');
flash();
?>

<style>
        .threshold-warning {
            background-color: #ffcc99 !important; /* Light red */
        }

        .threshold-danger {
            background-color: #ffcccc !important; /* Light red */
        }
</style>
<main id="main">
    <!-- ======= New Sale Section ======= -->
    <section id="Items_section" class="contact sections-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Items manager</h2>
                <p>Here you can manage your items, their inventory, their prices and have information about the
                    suppliers</p>
            </div>

            <div class="row gx-lg-0 gy-4">

                <div class="col-lg-12  php-email-form">
                    <!--div class="row"><button type="submit"> See suppliers</button></div-->

                    <div class="row">
                        <table id="AllItemsTable"
                            class="table table-hover table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>ITEM</th>
                                    <th>CATEGORY</th>
                                    <th>QUANTITY</th>
                                    <th>PURCHASE PRICE</th>
                                    <th>PRICE MAX</th>
                                    <th>PRICE MIN</th>
                                    <th>ACTIONS</th>
                                    <th>threshold</th>
                                </tr>

                            </thead>
                            <tbody id="AllItemsTbody">

                            </tbody>
                        </table>
                    </div>
                </div><!-- End Contact Form -->

            </div>

        </div>
    </section><!-- End New sale Section -->


</main><!-- End #main -->

<!-- Edit -->
<div class="modal fade php-email-form" id="Edit" tabindex="-1" aria-labelledby="EditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--form method="POST" action="./actions/__edit_itemModel.php"-->
                <div class="modal-header">
                    <h5 class="modal-title" id="EditLabel">Edit Item Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="edit_item_form" class="container-fluid">
                        <div class='mb-3'>
                            <input type="hidden" name="item_id" id="item_id">
                            <label for="item_name" class="form-label">ITEM:</label>
                            <input type='text' class='form-control' name='item_name' id="item_name">
                        </div>
                        <div class='mb-3 row'>
                            <div class="col-sm-6">
                                <label for="item_category" class="form-label">CATEGORY:</label>
                                <select class='form-control' aria-label='Default select example' id="item_category"
                                    name="item_category">
                                    <?php
                                        $cat_sql = 'SELECT * FROM item_category WHERE 1';
                                        $cat_query = $conn->query($cat_sql);

                                        while ($cat_row = $cat_query->fetch_assoc()) {
                                            echo "<option value='" . $cat_row['cat_id'] . "' >" . $cat_row['category_name'] . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="barrecode" class="form-label">Barre code:</label>
                                <input type='text' class='form-control' name='barrecode' id="barrecode">
                            </div>
                        </div>
                        <div class='mb-3 row'>
                            <div class="col-sm-6">
                                <label for="quantity" class="form-label">available quantity:</label>
                                <input type='number' class='form-control' name='quantity' id="quantity">
                            </div>
                            <div class="col-sm-6">
                                <label for="threshold" class="form-label">Notify After:</label>
                                <input type='text' class='form-control' name='threshold' id="threshold">
                            </div>
                            
                        </div>
                        <div class='mb-3 row'>
                            <div class="col-sm-6">
                                <label for="pricemin" class="form-label">price min:</label>
                                <input type='number' class='form-control' name='pricemin' id="pricemin">
                            </div>
                            <div class="col-sm-6">
                                <label for="pricemax" class="form-label">price max:</label>
                                <input type='number' class='form-control' name='pricemax' id="pricemax">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span
                            class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" name="validate_edit" id="validate_edit" class="btn btn-success"><span
                            class="glyphicon glyphicon-check"></span> Update</a>
                </div>
            <!--/form-->

        </div>
    </div>
</div>

<!-- new -->
<div class="modal fade php-email-form" id="new_item" tabindex="-1" aria-labelledby="NewItemLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="./actions/__add_itemModel.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditLabel">New Item Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="new_item_form" class="container-fluid">
                        <div class='mb-3'>
                            <label for="item_name" class="form-label">ITEM:</label>
                            <input type='text' class='form-control' name='item_name' id="item_name" required>
                        </div>
                        <div class='mb-3'>
                            <label for="item_category" class="form-label">CATEGORY:</label>
                            <select class='form-control' aria-label='Default select example' id="item_category"
                                name="item_category" required>
                                <?php
                    $cat_sql = 'SELECT * FROM item_category WHERE 1';
                    $cat_query = $conn->query($cat_sql);

                    while ($cat_row = $cat_query->fetch_assoc()) {
                        echo "<option value='" . $cat_row['cat_id'] . "' >" . $cat_row['category_name'] . "</option>";
                    }
                    ?>
                            </select>
                        </div>

                        <div class='mb-3'>
                            <label for="reference" class="form-label">REFERENCE:</label>
                            <input type='text' class='form-control' name='reference' id='reference'>

                        </div>
                        <div class='mb-3'>
                            <label for="quantity" class="form-label">available quantity:</label>
                            <input type='number' class='form-control' name='quantity' id="quantity">
                        </div>
                        <div class='mb-3 row'>
                            <div class="col-sm-6">
                                <label for="pricemin" class="form-label">price min:</label>
                                <input type='number' class='form-control' name='pricemin' id="pricemin">
                            </div>
                            <div class="col-sm-6">
                                <label for="pricemax" class="form-label">price max:</label>
                                <input type='number' class='form-control' name='pricemax' id="pricemax">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="fas fa-times"></i>
                        Cancel</button>
                    <button type="submit" name="new" class="btn btn-success"><i class="fas fa-check"></i>Add</a>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade php-email-form" id="SuppOpt" tabindex="-1" aria-labelledby="SuppOptLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditLabel">Supply Operations history</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <table id="suppHistory_table" class="table table-hover table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>SUPPLIER</td>
                                    <th>DATE</td>
                                    <th>UNIT PRICE</td>
                                    <th>QUANTITY</td>
                                </tr>
                            </thead>
                            <tbody id="suppHistory_tbody">
                
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span
                            class="glyphicon glyphicon-remove"></span> Close</button>
                </div>
        </div>
    </div>
</div>

<?php require_once './includes/footer.php'; ?>


<script type="text/javascript">

    $(document).ready(function () {

        $.ajax({
            url: "includes/affichage_item.php",
            type: "POST",
            data: {
                getAllItems: "1"
            },

            success: function (data) {
                $("tbody#AllItemsTbody").html(data);
                table = $("#AllItemsTable").DataTable({
                    "columnDefs": [
                        {
                            target: 8,
                            visible: false,
                            searchable: false
                        },
                        {
                            target: 7,
                            width: "20%"
                        }
                    ],
                    "rowCallback": function(row, data) {
                        // Replace 'column_index' with the index of the column you want to check
                        var columnValue = data[3]; // Get the value of the column for this row
                        var threshold = data[8]; 
                        // Add conditions to change row color based on column value
                        if (columnValue <= threshold && columnValue > 0) {
                            $(row).addClass('threshold-warning');
                        } else if (columnValue == 0) {
                            $(row).addClass('threshold-danger');
                        }
                        // Add more conditions as needed

                        // Replace 'color1' and 'color2' with your custom CSS class names for each color
                    }
                });
                $("#AllItemsTable_filter").append("<span>   </span>");
                $("#AllItemsTable_filter").append("<button  class=\"btn btn-danger\"  data-bs-toggle=\"modal\" data-bs-target=\"#new_item\" ><i class=\"fas fa-plus pr-2\"aria-hidden=\"true\"></i> New Item</button>");
                $("#AllItemsTable_filter").append("<span>   </span>");
                $("#AllItemsTable_filter").append("<button class=\"btn btn-primary\" onclick='printShooping()' > Print Shooping List</button>");
                
                $('.dataTables_filter input')
                    .off()
                    .on( 'keyup', function () {
                    console.log('event')
                        table.column(1).search( this.value ).draw();
                } );

            },
            error: function (resultat, statut, erreur) {
                $("#AllItemsTable").html("error");
            }
        });
    });

    function delete_item_click(item_id, item_name) {

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

        });  // Returns a Bootstrap popover instance
        popover.show();

        $(".confirm_delete_item").click(function () {
            $.ajax({
                url: "actions/__delete_itemModel.php",
                type: "POST",
                data: {
                    delete_item: "1",
                    item_id: item_id
                },
                success: function (data) {
                    if (data == 0) {
                        //delete the row from the data table
                        table = $("#AllItemsTable").DataTable();
                        var i = item_id;
                        table.row($("#item_" + i)).remove().draw();
                        popover.dispose();
                        create_toast("Info", "The item has been deleted succefully!")
                    } else {
                        create_toast("Error", "Cannot delete item because it is a part of supplying or selling operations!");
                    }

                },
                error: function (resultat, statut, erreur) {
                    // show an error message
                    create_toast("Error", "Error server!")
                }
            });
        });

        $(".cancel_delete_item").click(function () {
            popover.hide();
        })

    }

    function edit_item(item_id) {
        $.ajax({
            url: "includes/affichage_item.php",
            type: "POST",
            data: {
                get_edit_item_div: "1",
                item_id: item_id
            },
            dataType: 'json',

            success: function (data) {
                $("input#item_name").val(data[0]);
                $("#item_category").val(data[1]);
                
                $("input#quantity").val(data[3]);
                $("input#pricemin").val(data[4]);
                $("input#pricemax").val(data[5]);
                $("input#item_id").val(item_id);
                $("input#barrecode").val(data[6]);
                $("input#barrecode").removeClass("is-invalid");
                
                $("input#threshold").val(data[7]);
            },
            error: function (resultat, statut, erreur) {
                $("div#Edit").modal('hide');
                create_toast("Error", "Cannot charge Edit form somthing is wrong!");
                
            }
        });

    }
    function getSupOpt(item_id) {
        $.ajax({
            url: "includes/affichage_item.php",
            type: "POST",
            data: {
                get_History: "1",
                item_id: item_id
            },

            success: function (data) {
                if (data != -1) {
                    $("tbody#suppHistory_tbody").html(data);
                    $("#suppHistory_table").DataTable();
                }
            },
            error: function (resultat, statut, erreur) {
                $("div#Edit").modal('hide');
                create_toast("Error", "Cannot charge Edit form somthing is wrong!");
                
            }
        });

    }
    function getBarCode(item_id) {
        $.ajax({
            url: "actions/__BarCode.php",
            type: "POST",
            data: {
                BarCode: "1",
                item_id: item_id
            },

            success: function (data) {
              window.location = data;
            },
            error: function (resultat, statut, erreur) {
                $("div#Edit").modal('hide');
                create_toast("Error", "Cannot charge Edit form somthing is wrong!");
                
            }
        });

    }
    function printShooping() {
        $.ajax({
            url: "actions/__ShoopingList.php",
            type: "POST",
            data: {
                ShoopingList: "1"
            },

            success: function (data) {

              window.location = data;
            },
            error: function (resultat, statut, erreur) {
                $("div#Edit").modal('hide');
                create_toast("Error", "Cannot charge Edit form somthing is wrong!");
                
            }
        });

    }

    $("button#validate_edit").click(function(){
        //get all the data
        name  = $("input#item_name").val();
        category = $("#item_category").val();
        quantity = $("input#quantity").val();
        price_min = $("input#pricemin").val();
        price_max = $("input#pricemax").val();
        item_id = $("input#item_id").val();
        bar_code = $("input#barrecode").val();
        threshold = $("input#threshold").val();

        $.ajax({
            url: "actions/__edit_itemModel.php",
            type: "POST",
            data: {
                update_item: "1",
                item_id: item_id,
                item_name: name,
                item_category: category,
                quantity: quantity,
                pricemin: price_min,
                pricemax: price_max,
                barrecode: bar_code,
                threshold: threshold
            },

            success: function (data) {
                if(data == 0){
                    
                    $("div#Edit").modal('hide');

                    //update the row in the data table
                    //select the second td in tr with id = item_id

                    table = $("#AllItemsTable").DataTable();
                   
                    var row_index = table.row($("#item_" + item_id)).index();
                    table.cell(row_index, 1).data(name);
                    table.cell(row_index, 3).data(quantity);
                    table.cell(row_index, 6).data(price_min + " DA");
                    table.cell(row_index, 5).data(price_max + " DA");
                    create_toast("Info", "The item has been updated succefully!")
                    //create_toast("Info", row_index)
                    
                }
                else{
                    create_toast("Error", "Cannot update item check the bare code and try again!");
                    $("input#barrecode").addClass("is-invalid");
                }
            },
            error: function (resultat, statut, erreur) {
                create_toast("Error", "Error server!")
            }
        });
    });
</script>