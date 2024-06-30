<?php
session_start();

require_once 'includes/header.php';
require_once 'bootstrap.php';
require_once 'includes/main_header.php';
include_once 'db.php';
?>
<br>
<div class="row">
    <table id="invoice_table" class="table table-hover table-bordered table-striped table-responsive">
        <thead>
            <tr>
                <th>ITEM</td>
                <th>QUANTITY</td>
                <th>UNIT PRICE</td>
                <th>ACTIONS</td>
            </tr>
        </thead>
        <tbody id="invoice_tbody">

            <tr>
                <td id="4" class="invoice_item_name"> LCD Iphone 7G White</td>
                <td class="invoice_item_quantity"> 1 </td>
                <td class="invoice_unit_price"> 4500</td>
                <td> <button class="btn btn-danger btn-md " onclick="remove_item_invoice(4)"><svg
                            class="svg-inline--fa fa-trash-can" aria-hidden="true" focusable="false" data-prefix="fas"
                            data-icon="trash-can" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                            data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z">
                            </path>
                        </svg><!-- <i class="fa-solid fa-trash-can"></i> Font Awesome fontawesome.com --></button> </td>
            </tr>
            <tr>
                <td id="9" class="invoice_item_name"> LCD Samsung J8 Oled</td>
                <td class="invoice_item_quantity"> 1 </td>
                <td class="invoice_unit_price"> 7500</td>
                <td> <button class="btn btn-danger btn-md " onclick="remove_item_invoice(9)"><svg
                            class="svg-inline--fa fa-trash-can" aria-hidden="true" focusable="false" data-prefix="fas"
                            data-icon="trash-can" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                            data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z">
                            </path>
                        </svg><!-- <i class="fa-solid fa-trash-can"></i> Font Awesome fontawesome.com --></button> </td>
            </tr>
            <tr>
                <td id="427" class="invoice_item_name"> Mobile Phone Wise Tech A1</td>
                <td class="invoice_item_quantity"> 1 </td>
                <td class="invoice_unit_price"> 3000</td>
                <td> <button class="btn btn-danger btn-md " onclick="remove_item_invoice(427)"><svg
                            class="svg-inline--fa fa-trash-can" aria-hidden="true" focusable="false" data-prefix="fas"
                            data-icon="trash-can" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                            data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z">
                            </path>
                        </svg><!-- <i class="fa-solid fa-trash-can"></i> Font Awesome fontawesome.com --></button> </td>
            </tr>
        </tbody>
    </table>
</div>

<br>
<div class="row">
    <div class="col-md-8" style="text-align: left;">
        <h4><b>Total:
                <span class="label label-info" id="invoice_total">256000,00 DA</span></b></h4>
    </div>

    <div class="col-md-6">
        
        <button class="btn btn-primary" id="print_invoice"><span class='fa-solid fa-print'></span>
            Print</a>
        </button>
    </div>
</div>
<br>
<?php
    require_once 'includes/footer.php';
?>
<section class="contact sections-bg">
    <div class="container">
        <div id="to_print_section" class="php-email-form">
            <div class="row">
                <!--insert image--->
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <img src="assets/img/kingtech/KingTechLogo.jpeg" class="rounded mx-auto d-block" alt="alternatetext"
                        width="200" height="50">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center">Selling and repairing phone and accessories
                    </h2>
                    <h2 class="text-center">+213 673 39 83 27</h2>
                </div>
            </div>

            <div class="row" id="row_table_to_print">
                <table id="table_to_print">

                </table>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <h5 class="text-left">N° of products: <span id="total_items">3</span> </h5>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-left">Total: <span id="total_to_pay">1000.00</span> DA </h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-left">Paid: <span id="paid">1000.00</span> DA </h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-left">Rest: <span id="Rest">0.00</span> DA </h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-left">Customer: <span id="customer_name">Unknown</span> </h5>
                        </div>
                    </div>


                </div>

                <div class="col-md-1"></div>

                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-left">Cachier: <span id="chashier_name">Abdel Hakim</span></h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-left">Date: <span id="Date">2024/06/27</span></h5>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div id="imageContainer">
                        
                    </div>

                    <h5 class="text-center"><span id="invoice_nbr">201319001665</span></h5>
                </div>
            </div>
        </div>
    </div>
</section>

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


<script>
    $(document).ready(function() {
        $('#invoice_table').DataTable();
    });

    $("button#print_invoice").click(function() {
        /* var htmlContent = $("#to_print_section").html();
        alert(htmlContent); */
        total = parseFloat($("#invoice_total").html());
        $("#invoice_total_confirm").html($("#invoice_total").html());
        $("#payment").val(total);
        $("#Confirm_invoice_modal").modal('show');
    });

    $("#confirm_print_bttn").click(function() {

        // first coppy all the data from table to the table to be printed
        $("#table_to_print").html($("#invoice_table").html());
        $('#table_to_print').DataTable().destroy();

        //add the total items column
        $('#table_to_print thead tr').append('<th>Total</th>');

        //add the total items columns
        $('#table_to_print tbody tr').each(function() {
            var quantity = parseFloat($(this).find('.invoice_item_quantity').text());
            var unitPrice = parseFloat($(this).find('.invoice_unit_price').text());
            var total = quantity * unitPrice;
            $(this).append('<td>' + total.toFixed(2) + '</td>');
        });

        // Reinitialize DataTables on the new content in table2
        $('#table_to_print').DataTable({
            "paging": false,
            "searching": false,
            "info": false,
            "ordering": false,
            "columnDefs": [{
                "visible": false,
                "targets": 3
            }]
        });

        // set the total items and the total paid and everything
        var total_items = $('#table_to_print tr').length - 1; // -1 to remove the header

        var Total_to_pay = parseFloat($("#invoice_total_confirm").text()).toFixed(2);
        var payment = parseFloat($("input#payment").val()).toFixed(2);

        var rest = Total_to_pay - payment;

        var customer_name = $("input#customer_name").val();
        var cashier_name = <?php echo json_encode($_SESSION['user_name']); ?>;
        var date = new Date().toISOString().slice(0, 10);

        var data = [123456987, 'PHPWord/barcode.png']

        var invoice_nbr = data[0];
        var image_url = data[1];

        //put all element
        $("#total_items").text(total_items);
        $("#total_to_pay").text(Total_to_pay);
        $("#paid").text(payment);
        $("#Rest").text(rest);
        $("#customer_name").text(customer_name);
        $("#chashier_name").text(cashier_name);
        $("#Date").text(date);
        $("#invoice_nbr").text(invoice_nbr);

        // add the image of bar code
       
        image = new Image();
        image.src = image_url;
        image.onload = function () {
            $('#imageContainer').empty().append(image);
            
            // Apply CSS to center the image
            $('#imageContainer img').css({
                'display': 'block', // Ensure it's a block element to center it properly
                'margin': '0 auto', // Auto horizontal margins to center
                'max-width': '100%', // Optional: Adjust max-width as needed
                'height': 'auto' // Maintain aspect ratio
            });
        };
        image.onerror = function () {
            $('#imageContainer').empty().html('That image is not available.');
        };

        $('#imageContainer').empty().html('Loading...');
        
        $("#Confirm_invoice_modal").modal('hide');
        
        var printWindow = window.open('', '_blank');
        var htmlContent = $("#to_print_section").html();
        
        printWindow.document.open();
        printWindow.document.write('<html><body">'+htmlContent+'</body></html>');
        printWindow.document.close();
        
        setTimeout(function(){printWindow.close();},10000000);
        // Print the contents
        //printWindow.print();

        // Close the new window/tab after printing
        //printWindow.close();

        create_toast("Info", "The invoice is printed with success");
    
        // clear everything
        $("#total_items").text("");
        $("#total_to_pay").text("");
        $("#paid").text("");
        $("#Rest").text("");
        $("#customer_name").text("");
        $("#chashier_name").text("");
        $("#Date").text("");
        $("#invoice_nbr").text("");
        $('#table_to_print').empty();
    });
</script>