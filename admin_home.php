<?php
session_start();
require_once 'bootstrap.php';

if (isset($_SESSION['connected']) == false) {
    header('location: '.URLROOT.'/index.php');
    exit();
}
require_once 'includes/header.php';


//flash();
?>
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero_edited">
    <div class="icon-boxes position-relative">
        <div class="container position-relative">
            <div class="row gy-4 mt-5">

                <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100" id="new_saleIcon">
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-easel"></i></div>
                        <h4 class="title"><a href="#new_sale" class="stretched-link">Selling</a></h4>
                    </div>
                </div>
                <!--End Icon Box -->

                <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="200" id="new_supplyIcon">
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-gem"></i></div>
                        <h4 class="title"><a href="#new_supply" class="stretched-link">Suppling</a></h4>
                    </div>
                </div>
                <!--End Icon Box -->

                <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-geo-alt"></i></div>
                        <h4 class="title"><a href="#" class="stretched-link">Phone Repair</a></h4>
                    </div>
                </div>
                <!--End Icon Box -->



            </div>
        </div>
    </div>
</section>
<!-- End Hero Section -->



<main id="main">
    <!-- ======= New Sale Section ======= -->
    <section id="new_sale" class="contact sections-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>New sale</h2>
                <p>Here you can perform a selling operations, print the invoice and so on</p>
            </div>

            <div class="row gx-lg-0 gy-4">

                <div class="col-lg-12">
                    <div class="php-email-form">
                        <div class="row" id="depts_div" style="display: none;">
                            <div class="col-md-12" style="text-align: center;">
                                <h4><b>Total Depts For This Customer:
                                        <span class="label label-info" id="invoice_total_depts">0,00 DA</span></b></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ">
                                <h4> Customer :</h1>
                            </div>
                            <div class="col-md-10  mt-3 mt-md-0">
                                <input id="customer_id" type="text" hidden="hidden" value=-1>
                                <input id="customer_type" type="text" hidden="hidden" value="-1">
                                <div class="input-group mb-3">
                                    <input id="customer_name" type="text" class="form-control AutoCompleteCustomer"
                                        name="customer" placeholder="Enter Customer name">

                                    <div class="input-group-append">
                                        <span class="input-group-text square_button" data-bs-toggle="modal"
                                            data-bs-target="#new_customer">New</span>
                                    </div>
                                </div>

                                <div class="dropdown">
                                    <ul id="listeCustomer" class="dropdown-menu" aria-labelledby="customer_name"
                                        style="max-height: 250px;  display: none; position:absolute; margin:0px; width:100%; left:auto;">

                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2 ">
                                <h4 class="control-label modal-label">ITEM:</h4>
                            </div>
                            <div class="col-md-4 ">
                                <input id="item_id" type="text" hidden="hidden">
                                <input id="item_name" type="text" class="form-control AutoCompleteItem mb-3" name="item"
                                    placeholder="Enter item name" required>
                                <div class="dropdown">
                                    <ul id="listeItem" class="dropdown-menu" aria-labelledby="item_name"
                                        style="max-height: 250px; overflow: scroll; display: none; position:absolute; margin:0px; width:100%; left:auto;">
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-2 ">
                                <h4 class="control-label modal-label">QUANTITY:</h4>
                            </div>
                            <div class="col-md-4 ">
                                <input id="item_quantity" type="number" class="form-control" placeholder="quantity"
                                    required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <h4 class="control-label modal-label">PRICE:</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <input id="item_price" type="number" class="form-control" placeholder="price"
                                        required>
                                    <div class="input-group-append">
                                        <span class="input-group-text square_span">DA</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">

                            </div>
                            <div class="col-md-4">
                                <button id="add_item_button" type="submit">Add Item</button>
                            </div>
                        </div>

                        <div class="row">
                            <table id="invoice_table"
                                class="table table-hover table-bordered table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th>ITEM</td>
                                        <th>QUANTITY</td>
                                        <th>UNIT PRICE</td>
                                        <th>ACTIONS</td>
                                    </tr>
                                </thead>
                                <tbody id="invoice_tbody">

                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-8" style="text-align: left;">
                                <h4><b>Total:
                                        <span class="label label-info" id="invoice_total">0,00 DA</span></b></h4>
                            </div>

                            <div class="col-md-4">
                                <button type="button" id="clear_invoice"><span class='fa-solid fa-xmark'></span>
                                    Clear</button>
                                <button type="button" id="print_invoice"><span class='fa-solid fa-print'></span>
                                    Print</a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Contact Form -->

            </div>

        </div>
    </section><!-- End New sale Section -->

    <!-- ======= New supply Section ======= -->
    <section id="new_supply" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>New supply</h2>
                <p>Here you can prform a suply operations whene you get new items</p>
            </div>

            <div class="row gx-lg-0 gy-4">

                <div class="col-lg-12">
                    <div class="php-email-form">
                        <div class="row">
                            <div class="col-md-2">
                                <h4> Supplier :</h1>
                            </div>
                            <div class="col-md-10 mt-3 mt-md-0">
                                <input id="supplier_id" type="text" hidden="hidden" value=-1>
                                <div class="input-group mb-3">
                                    <input id="supplier_name" type="text" class="form-control AutoCompleteSupplier"
                                        name="item" placeholder="Enter Supplier name">
                                    <div class="input-group-append">
                                        <span class="input-group-text square_button" data-bs-toggle="modal"
                                            data-bs-target="#new_supplier">New</span>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <ul id="listeSupplier" class="dropdown-menu" aria-labelledby="supplier_name"
                                        style="max-height: 250px;  display: none; position:absolute; margin:0px; width:100%; left:auto;">

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-2  mt-3 mt-md-0">
                                <h4 class="control-label modal-label">ITEM:</h4>
                            </div>
                            <div class="col-md-4 ">
                                <input id="purchase_item_id" type="text" hidden="hidden">
                                <div class="input-group mb-3">
                                    <input id="purchase_item_name" autocomplete="false" type="text"
                                        class="form-control AutoCompleteItemPurchase" name="item"
                                        placeholder="Enter item name" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text square_button" data-bs-toggle="modal"
                                            data-bs-target="#new_item">New</span>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <ul id="listeItemPurchase" class="dropdown-menu"
                                        aria-labelledby="purchase_item_name"
                                        style="max-height: 250px; overflow: scroll; display: none; position:absolute; margin:0px; width:100%; left:auto;">
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-2 ">
                                <h4 class="control-label modal-label">QUANTITY:</h4>
                            </div>
                            <div class="col-md-4 ">
                                <input id="item_quantity_purchase" type="number" class="form-control"
                                    placeholder="quantity" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <h4 class="control-label modal-label">PRICE:</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <input id="item_price_purchase" type="number" class="form-control"
                                        placeholder="price" required>
                                    <span class="input-group-text square_span">DA</span>
                                </div>
                            </div>

                            <div class="col-md-2">
                            </div>
                            <div class="col-md-4">
                                <button id="add_item_button_purchase" type="button">Add Item</button>
                            </div>
                        </div>
                        <div class="row">
                            <table id="purchase_table"
                                class="table table-hover table-bordered table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th>ITEM</td>
                                        <th>QUANTITY</td>
                                        <th>UNIT PRICE</td>
                                        <th>ACTIONS</td>
                                    </tr>
                                </thead>
                                <tbody id="purchase_tbody">

                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-8" style="text-align: left;">
                                <h4><b>Total:
                                        <span class="label label-info" id="purchase_total">0,00 DA</span></b></h4>
                            </div>

                            <div class="col-md-4">
                                <button type="button" id="clear_purchase"><span class='fa-solid fa-xmark'></span>
                                    Clear</button>
                                <button type="submit" id="submit_purchase"><span class='fa-solid fa-print'></span>
                                    Submit</a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Contact Form -->

            </div>

        </div>
    </section><!-- End New supply Section -->


    <!-- new Customer modal-->
    <div class="modal fade php-email-form" id="new_customer" tabindex="-1" aria-labelledby="newCustomerLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newCustomerLabel">Add New Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class='mb-3 row'>
                            <div class="col-md-6">
                                <label for="new_customer_firstname" class="form-label">First name:</label>
                                <input type='text' class='form-control' id="new_customer_firstname" required>
                            </div>
                            <div class='col-md-6'>
                                <label for="new_customer_surname" class="form-label">Surname:</label>
                                <input type='text' class='form-control' id='new_customer_surname' required>
                            </div>
                        </div>

                        <div class='mb-3'>
                            <label for="new_customer_address" class="form-label">Address:</label>
                            <input type='text' class='form-control' id='new_customer_address'>
                        </div>
                        <div class='mb-3'>
                            <label for="new_customer_telephone" class="form-label">Telephone:</label>
                            <input type='tel' class='form-control' id="new_customer_telephone">
                        </div>
                        <div class="mb-3">
                            <label for="new_customer_email" class="form-label">E-mail:</label>
                            <input type='email' class='form-control' id="new_customer_email">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><span
                            class="fas fa-times"></span> Cancel</button>
                    <button type="button" id="add_new_customer" class="btn btn-success"><span
                            class="fas fa-check"></span> Add</a>
                </div>
            </div>
        </div>
    </div>

    <!-- new suplier-->
    <div class="modal fade php-email-form" id="new_supplier" tabindex="-1" aria-labelledby="newLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="EditLabel">Add New Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="new_supplier_form" class="container-fluid">
                        <div class='mb-3 row'>
                            <div class="col-md-6">
                                <label for="supplier_firstname" class="form-label">First name:</label>
                                <input type='text' class='form-control' name='supplier_firstname'
                                    id="supplier_firstname" required>
                            </div>
                            <div class='col-md-6'>
                                <label for="supplier_surname" class="form-label">Surname:</label>
                                <input type='text' class='form-control' name='supplier_surname' id='supplier_surname'
                                    required>
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
                    <button type="button" id="add_new_supplier" class="btn btn-success"><span
                            class="fas fa-check"></span> Add</a>
                </div>

            </div>
        </div>
    </div>

    <!-- new Item -->
    <div class="modal fade php-email-form" id="new_item" tabindex="-1" aria-labelledby="NewItemLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="EditLabel">New Item Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="new_item_form" class="container-fluid">
                            <div class='mb-3'>
                                <label for="add_item_name" class="form-label">ITEM:</label>
                                <input type='text' class='form-control' name='item_name' id="add_item_name" required>
                            </div>
                            <div class='mb-3'>
                                <label for="item_category" class="form-label">CATEGORY:</label>
                                <select class='form-control' aria-label='Default select example' id="add_item_category"
                                    name="item_category" required>
                                    <?php
                                        require_once 'db.php';
                                        $cat_sql = 'SELECT * FROM item_category WHERE 1';
                                        $cat_query = $conn->query($cat_sql);

                                        while ($cat_row = $cat_query->fetch_assoc()) {
                                            echo "<option value='" . $cat_row['cat_id'] . "' >" . $cat_row['category_name'] . "</option>";
                                        }
                                        ?>
                                </select>
                            </div>

                            <div class='mb-3 row'>

                                <div class="col-sm-6">

                                    <label for="BarCode" class="form-label">Bar Code:</label>
                                    <div class="input-group">
                                        <input type='text' class='form-control' name='BarCode' id='BarCode'>
                                        <div class="input-group-append">
                                            <span class="input-group-text square_button">
                                                <span class='fas fa-barcode' onclick="GenerateRandomBarCode()"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="threshold" class="form-label">Threshold:</label>
                                    <input type='number' class='form-control' name='threshold' id="threshold">
                                </div>

                            </div>

                            <div class='mb-3 row'>
                                <div class="col-md-6">
                                    <label for="pricemin" class="form-label">price min:</label>
                                    <input type='number' class='form-control' name='pricemin' id="pricemin">
                                </div>
                                <div class="col-md-6">
                                    <label for="pricemax" class="form-label">price max:</label>
                                    <input type='number' class='form-control' name='pricemax' id="pricemax">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                                class="fas fa-times"></i> Cancel</button>
                        <button type="button" id="new_item" class="btn btn-success"><i class="fas fa-check"></i>Add</a>
                    </div>
                </form>

            </div>
        </div>
    </div>

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
                    <button type="button" class="btn btn-primary button_green_per" id="confirm_print_bttn"><span
                            class='fa-solid fa-print'></span> print</button>
                </div>

            </div>
        </div>
    </div>

</main><!-- End #main -->


<?php require_once 'includes/footer.php';?>
<script>
$("#new_saleIcon").click(function() {
    $("section#new_sale").show();
    $("section#new_supply").hide();
});

$("#new_supplyIcon").click(function() {
    $("section#new_sale").hide();
    $("section#new_supply").show();
});

$(document).ready(function() {

    $('#invoice_table').DataTable({
        searching: false,
        paging: false,
        "language": {
            "emptyTable": "Add Items to the invoice"
        }
    });
    $('#purchase_table').DataTable({
        searching: false,
        paging: false,
        "language": {
            "emptyTable": "Add Items to the purchace table"
        }
    });
    $("section#new_supply").hide();
    $("section#new_sale").hide();
});
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
        } else {
            $("ul#listeCustomer").hide();
            $("input#customer_id").val(-1);
            $("input#customer_type").val(-1);
            $("div#depts_div").fadeOut();
        }
    }
});
// select the items for the invoice
function set_selection_customer(customer_name, customerId, customerType) {

    $("input#customer_name").val(customer_name);
    $("input#customer_id").val(customerId);
    $("input#customer_type").val(customerType);
    $("ul#listeCustomer").hide();

    if (customerType == 2) {

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
    } else {
        $("div#depts_div").fadeOut();
    }

}

$("input#item_quantity").change(function() {
    var inputVar = $("input#item_quantity")
    var max_val = inputVar.attr("max")
    if (parseFloat(inputVar.val()) > parseFloat(max_val)) {
        inputVar.val(max_val);
        // put alert
    }
});
$("input#item_price").change(function() {
    var inputVar = $("input#item_price")
    var min_val = inputVar.attr("min_val")
    if (parseFloat(inputVar.val()) < parseFloat(min_val)) {
        inputVar.val(min_val)
    }

});

$("input.AutoCompleteItem").on({
    keyup: function() {

        var min_long = 2;
        var motcle = $(this).val();
        if (motcle.length >= min_long) {
            var $ajaxData = {
                Item: motcle
            };
            $ajaxData.AutoCompleteItem = '1';
            $.ajax({
                url: "includes/affichage_item.php",
                type: "POST",
                data: $ajaxData,
                success: function(data) {

                    $("ul#listeItem").show();
                    $("ul#listeItem").html(data);
                    //create_toast("Info", $("ul#listeItem li").length);
                    if ($("ul#listeItem li").length == 1 && $("ul#listeItem li:first a:first")
                        .text() != "Aucun résultat trouvé!") {

                        firstLink = $("ul#listeItem li:first a:first");
                        firstLink.click();
                    }
                },
                error: function(resultat, statut, erreur) {
                    toastr.error(
                        "Veuillez contacter le Centre de Ressources Informatiques pour v&eacute;rifier le serveur.",
                        "Erreur Serveur!");
                }
            });
        } else {
            $("ul#listeItem").hide();
        }
    }
});
// select the items for the invoice
function set_selection_item(item_name, itemId, price_max, price_min, availableQty) {

    $("input#item_name").val(item_name);
    $("input#item_id").val(itemId);
    $("ul#listeItem").hide();
    $("input#item_quantity").val(1);
    $("input#item_quantity").attr({
        "max": availableQty
    });

    if ($("input#customer_type").val() == 2) {
        $("input#item_price").val(price_min);
    } else {
        $("input#item_price").val(price_max);
    }

    $("input#item_price").attr({
        "min_val": price_min
    });
}

function remove_item_invoice(item_id) {
    $("td#" + item_id).parent().remove();
    count_invoice_total();
}

function count_invoice_total() {
    var sum = 0.0;
    $("tbody#invoice_tbody > tr").each(function(index) {
        //sum = sum + parseFloat($(this).children("td").eq(1).text()) * parseFloat(this.children("td").eq(2).text()); 
        sum = sum + parseFloat($(this).children("td").eq(1).text()) * parseFloat($(this).children("td").eq(2)
            .text());
    });
    $("span#invoice_total").html(sum + " DA")
}
$("button#add_item_button").click(function() {


    if ($("tbody#invoice_tbody > tr.odd").length) {
        $("tbody#invoice_tbody > tr.odd").remove();
    }
    // remove danger classes
    $("input#item_id").parent().removeClass("has-error has-feedback");
    $("input#item_name").parent().removeClass("has-error has-feedback");
    $("input#item_price").parent().removeClass("has-error has-feedback");
    $("input#item_quantity").parent().removeClass("has-error has-feedback");

    var item_id = $("input#item_id").val();
    var item_name = $("input#item_name").val();
    var unit_price = $("input#item_price").val();
    var quantity = $("input#item_quantity").val();
    var delete_button = "<button class=\"btn btn-danger btn-md \" onclick=\"remove_item_invoice(" + item_id +
        ")\"><i class='fa-solid fa-trash-can'></i></button>";

    var correct_data = true;
    if (item_id === '') {
        //$("input#item_id").parent().addClass("has-error has-feedback");
        correct_data = false;
    }
    if (item_name === '') {
        $("input#item_name").addClass("invalidInput")
        correct_data = false;
    }
    if (unit_price === '') {
        //$("input#item_price").parent().addClass("has-error has-feedback");
        correct_data = false;
    }
    if (quantity === '') {

        //$("input#item_quantity").parent().addClass("has-error has-feedback");
        correct_data = false;
    }
    if (correct_data === true) {
        // look if the item already exist
        if ($("td#" + item_id).length) {
            $("td#" + item_id).next().html(parseFloat($("td#" + item_id).next().html()) + parseFloat(quantity));
        } else {
            $("tbody#invoice_tbody").append("<tr> <td id = \"" + item_id + "\" class=\"invoice_item_name\"> " +
                item_name +
                "</td> <td class=\"invoice_item_quantity\">  " + quantity +
                " </td> <td class=\"invoice_unit_price\">  " +
                unit_price + "</td> <td> " + delete_button +
                " </td></tr>")
        }
        //clear the fields
        $("input#item_id").val("");
        $("input#item_name").val("");
        $("input#item_price").val("");
        $("input#item_quantity").val("");

        // count the invoice total
        count_invoice_total();
    }


});

$("button#clear_invoice").click(function() {
    $("tbody#invoice_tbody").html("");
    $("span#invoice_total").html("0,0 DA")
});


$("button#confirm_print_bttn").click(function() {

    var items_id = [];
    var quantities = [];
    var unit_prices = [];
    var customer_id = $("input#customer_id").val();
    var payment = $("input#payment").val();


    $("td.invoice_item_name").each(function() {
        items_id.push($(this).attr("id"));

    });

    $("td.invoice_unit_price").each(function() {
        unit_prices.push($(this).html());

    });

    $("td.invoice_item_quantity").each(function() {
        quantities.push($(this).html());

    });

    var $ajaxData = {
        get_invoice: 1
    };
    $ajaxData.items_id = items_id;
    $ajaxData.quantities = quantities;
    $ajaxData.unit_prices = unit_prices;

    $ajaxData.customer_id = customer_id;
    $ajaxData.payment = payment;

    //send the data to the server
    $.ajax({

        url: "includes/invoice.php",
        type: "POST",
        data: $ajaxData,
        success: function(data) {
            if (data != -1) {
                //reset the fields
                $("input#customer_name").val("");
                $("input#customer_id").val(-1);
                //$("tbody#invoice_tbody").html("");
                $("span#invoice_total").html("0,0 DA");
                $('#invoice_table').dataTable().fnDestroy();
                // then initialize table again
                $('#invoice_table').dataTable({
                    searching: false,
                    paging: false,
                    "language": {
                        "emptyTable": "Add Items to the invoice"
                    }
                });

                window.location.href = data;
                $("#Confirm_invoice_modal").modal('hide');
                create_toast("Info", "The invoice is printed with success");
            } else {
                create_toast("Error", "Erreur Serveur!");
            }
        },
        error: function(resultat, statut, erreur) {
            toastr.error(
                "Veuillez contacter le Centre de Ressources Informatiques pour v&eacute;rifier le serveur.",
                "Erreur Serveur!");
        }
    });

    $("#Confirm_invoice_modal").modal('hide');
});

$("button#print_invoice").click(function() {

    total = parseFloat($("#invoice_total").html());
    $("#invoice_total_confirm").html($("#invoice_total").html());
    $("#payment").val(total);
    $("#Confirm_invoice_modal").modal('show');
});

// select the items for the invoice
function set_selection_supplier(supplier_name, supplierId) {

    $("input#supplier_name").val(supplier_name);
    $("input#supplier_id").val(supplierId);
    $("ul#listeSupplier").hide();

}

$("input.AutoCompleteSupplier").on({
    keyup: function() {
        var min_long = 2;
        var motcle = $(this).val();
        if (motcle.length >= min_long) {

            var $ajaxData = {
                supplier: motcle
            };
            $ajaxData.AutoCompleteSupplier = '1';
            $.ajax({
                url: "includes/affichage_supplier.php",
                type: "POST",
                data: $ajaxData,
                success: function(data) {

                    $("ul#listeSupplier").show();
                    $("ul#listeSupplier").html(data);

                    // $("ul#listeElevesDossierScolaire").css("top", $("input#rechercheEleveDossierScolaire").prop("scrollTop")+28);

                },
                error: function(resultat, statut, erreur) {
                    toastr.error(
                        "Veuillez contacter le Centre de Ressources Informatiques pour v&eacute;rifier le serveur.",
                        "Erreur Serveur!");
                }
            });
        } else {
            $("ul#listeSupplier").hide();
            $("input#supplier_id").val(-1);
        }
    }
});


$("input.AutoCompleteItemPurchase").on({
    keyup: function() {

        var min_long = 2;
        var motcle = $(this).val();
        if (motcle.length >= min_long) {
            var $ajaxData = {
                Item: motcle
            };
            $ajaxData.AutoCompleteItemPurchase = '1';
            $.ajax({
                url: "includes/affichage_item.php",
                type: "POST",
                data: $ajaxData,
                success: function(data) {

                    $("ul#listeItemPurchase").show();
                    $("ul#listeItemPurchase").html(data);

                    if ($("ul#listeItemPurchase li").length == 1 && $(
                            "ul#listeItemPurchase li:first a:first").text() !=
                        "Aucun résultat trouvé!") {

                        firstLink = $("ul#listeItemPurchase li:first a:first");
                        firstLink.click();
                    }

                },
                error: function(resultat, statut, erreur) {
                    toastr.error(
                        "Veuillez contacter le Centre de Ressources Informatiques pour v&eacute;rifier le serveur.",
                        "Erreur Serveur!");
                }
            });
        } else {
            $("ul#listeItemPurchase").hide();
        }
    }
});

function set_selection_item_purchase(item_name, itemId) {

    $("input#purchase_item_name").val(item_name);
    $("input#purchase_item_id").val(itemId);
    $("ul#listeItemPurchase").hide();
    $("input#item_quantity_purchase").val(1);
}


$("button#add_item_button_purchase").click(function() {
    if ($("tbody#purchase_tbody > tr.odd").length) {
        $("tbody#purchase_tbody > tr.odd").remove();
    }
    // remove danger classes
    $("input#purchase_item_id").parent().removeClass("has-error has-feedback");
    $("input#purchase_item_name").parent().removeClass("has-error has-feedback");
    $("input#item_price_purchase").parent().removeClass("has-error has-feedback");
    $("input#item_quantity_purchase").parent().removeClass("has-error has-feedback");

    var item_id = $("input#purchase_item_id").val();
    var item_name = $("input#purchase_item_name").val();
    var unit_price = $("input#item_price_purchase").val();
    var quantity = $("input#item_quantity_purchase").val();
    var delete_button = "<button class=\"btn btn-danger btn-md \" onclick=\"remove_item_purchase(" + item_id +
        ")\"><i class=\" fa-solid fa-trash-can\"></i></button>";

    var correct_data = true;
    if (item_id === '') {
        $("input#purchase_item_id").parent().addClass("has-error has-feedback");
        correct_data = false;
    }
    if (item_name === '') {
        $("input#purchase_item_name").parent().addClass("has-error has-feedback");
        correct_data = false;
    }
    if (unit_price === '') {
        $("input#item_price_purchase").parent().addClass("has-error has-feedback");
        correct_data = false;
    }
    if (quantity === '') {

        $("input#item_quantity_purchase").parent().addClass("has-error has-feedback");
        correct_data = false;
    }
    if (correct_data === true) {
        // look if the item already exist
        if ($("td#" + item_id).length) {
            $("td#" + item_id).next().html(parseFloat($("td#" + item_id).next().html()) + parseFloat(quantity));
        } else {
            $("tbody#purchase_tbody").append("<tr> <td id = \"" + item_id +
                "\" class=\"purchase_item_name\"> " + item_name +
                "</td> <td class=\"purchase_item_quantity\">  " + quantity +
                " </td> <td class=\"purchase_unit_price\">  " +
                unit_price + "</td> <td> " + delete_button +
                " </td></tr>")
        }
        //clear the fields
        $("input#purchase_item_id").val("");
        $("input#purchase_item_name").val("");
        $("input#item_price_purchase").val("");
        $("input#item_quantity_purchase").val("");

        // count the invoice total
        count_purchase_total();
    }


});

$("button#clear_purchase").click(function() {
    $("tbody#purchase_tbody").html("");
    $("span#purchase_total").html("0,0 DA")
});


$("button#submit_purchase").click(function() {

    var items_id = [];
    var quantities = [];
    var unit_prices = [];
    var supplier_id = $("input#supplier_id").val();

    $("td.purchase_item_name").each(function() {
        items_id.push($(this).attr("id"));

    });
    $("td.purchase_unit_price").each(function() {
        unit_prices.push($(this).html());

    });
    $("td.purchase_item_quantity").each(function() {
        quantities.push($(this).html());

    });;
    var $ajaxData = {
        set_purchase: 1
    };
    $ajaxData.items_id = items_id;
    $ajaxData.quantities = quantities;
    $ajaxData.unit_prices = unit_prices;

    $ajaxData.supplier_id = supplier_id;

    //send the data to the server
    $.ajax({
        url: "includes/purchase.php",
        type: "POST",
        data: $ajaxData,
        success: function(data) {
            if (data != -1) {
                //reset the fields
                $("input#supplier_name").val("");
                $("input#supplier_name").val("");
                //$("tbody#invoice_tbody").html("");
                $("span#purchase_total").html("0,0 DA");
                $('#purchase_table').dataTable().fnDestroy();
                // then initialize table again
                $('#purchase_table').dataTable({
                    searching: false,
                    paging: false,
                    "language": {
                        "emptyTable": "Add Items to the purchase table"
                    }
                });
                create_toast("Info", "The supply operation has been done successfully");
            } else {
                create_toast("Error", "Erreur Serveur!");
            }
        },
        error: function(resultat, statut, erreur) {
            create_toast("Error", "Erreur Serveur!");
        }
    });


});

function remove_item_purchase(item_id) {
    $("td#" + item_id).parent().remove();
    count_purchase_total();
}

function count_purchase_total() {
    var sum = 0.0;
    $("tbody#purchase_tbody > tr").each(function(index) {
        //sum = sum + parseFloat($(this).children("td").eq(1).text()) * parseFloat(this.children("td").eq(2).text()); 
        sum = sum + parseFloat($(this).children("td").eq(1).text()) * parseFloat($(this).children("td").eq(2)
            .text());
    });
    $("span#purchase_total").html(sum + " DA")
}


$("button#add_new_customer").click(function() {
    if (!$("input#new_customer_firstname").val() || !$("input#new_customer_surname").val()) {
        alert("you need to chose firsname and surname");
        return;
    }
    var firstname = $("input#new_customer_firstname").val();
    var surname = $("input#new_customer_surname").val();
    var address = $("input#new_customer_address").val();
    var telephone = $("input#new_customer_telephone").val();
    var email = $("input#new_customer_email").val();


    var $ajaxData = {
        add_new_customer: 1
    };
    $ajaxData.firstname = firstname;
    $ajaxData.surname = surname;
    $ajaxData.address = address;
    $ajaxData.email = email;
    $ajaxData.telephone = telephone;

    //send the data to the server
    $.ajax({
        url: "actions/__add_customerModel.php",
        type: "POST",
        data: $ajaxData,
        success: function(data) {
            if (data == 1) {
                $("input#new_customer_firstname").val("");
                $("input#new_customer_surname").val("");
                $("input#new_customer_address").val("");
                $("input#new_customer_telephone").val("");
                $("input#new_customer_email").val("");

                $("#new_customer").modal('hide');
                create_toast("Info", "The customer has been added succefully!")
            } else {
                create_toast("Error", "The customer already exists!")
            }
        },
        error: function(resultat, statut, erreur) {
            create_toast("Error", "Erreur Serveur!");
        }
    });


});

$("button#add_new_supplier").click(function() {
    if (!$("input#supplier_firstname").val() || !$("input#supplier_surname").val()) {
        alert("you need to chose firsname and surname");
        return;
    }
    var firstname = $("input#supplier_firstname").val();
    var surname = $("input#supplier_surname").val();
    var address = $("input#supplier_address").val();
    var telephone = $("input#supplier_telephone").val();
    var email = $("input#supplier_email").val();


    var $ajaxData = {
        add_new_supplier: 1
    };
    $ajaxData.supplier_firstname = firstname;
    $ajaxData.supplier_surname = surname;
    $ajaxData.supplier_address = address;
    $ajaxData.supplier_email = email;
    $ajaxData.supplier_telephone = telephone;

    //send the data to the server
    $.ajax({
        url: "actions/__add_supplierModel.php",
        type: "POST",
        data: $ajaxData,
        success: function(data) {
            if (data == 1) {
                $("input#supplier_firstname").val("");
                $("input#supplier_surname").val("");
                $("input#supplier_address").val("");
                $("input#supplier_telephone").val("");
                $("input#supplier_email").val("");

                $("#new_supplier").modal('hide');
                create_toast("Info", "The supplier has been added succefully!")
            } else {
                create_toast("Error", "The supplier already exists!")
            }
        },
        error: function(resultat, statut, erreur) {
            create_toast("Error", "Erreur Serveur!");
        }
    });


});

$("button#new_item").click(function() {
    if (!$("input#add_item_name").val()) {
        alert("you need to chose item name");
        return;
    }
    var item_name = $("input#add_item_name").val();
    var item_category = $("#add_item_category").val();
    var code_bare = $("input#BarCode").val();
    var threshold = $("input#threshold").val();
    var price_min = $("input#pricemin").val();
    var price_max = $("input#pricemax").val();

    var $ajaxData = {
        add_new_item: 1
    };
    $ajaxData.item_name = item_name;
    $ajaxData.item_category = item_category;
    $ajaxData.BarCode = code_bare;
    $ajaxData.threshold = threshold;
    $ajaxData.quantity = 0;
    $ajaxData.pricemin = price_min;
    $ajaxData.pricemax = price_max;

    //send the data to the server
    $.ajax({
        url: "actions/__add_itemModel.php",
        type: "POST",
        data: $ajaxData,
        success: function(data) {
            if (data == 0) {
                $("input#add_item_name").val("");
                $("input#add_reference").val("");

                $("#new_item").modal('hide');
                create_toast("Info", "The item has been added succefully!");
            } else if (data == -1) {
                create_toast("Error", "There is already an item with the same name or reference!");
            } else if (data == -2) {
                create_toast("Error", "Something went wrong while adding prices!");
            } else {
                create_toast("Error", "Something went wrong!");
            }

        },
        error: function(resultat, statut, erreur) {
            create_toast("Error", "Erreur Serveur!");
        }
    });


});

function GenerateRandomBarCode() {
    $.ajax({
        url: "actions/__BarCode.php",
        type: "POST",
        data: {
            GetRandomBarCode: "1"
        },

        success: function(data) {
            $("input#BarCode").val(data);
        },
        error: function(resultat, statut, erreur) {
            create_toast("Error", "Error server!")
        }
    });
}
</script>