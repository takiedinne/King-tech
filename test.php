<?php
session_start();
require_once 'bootstrap.php';
require_once 'includes/header.php';
?>

<main id="main">
    <!-- ======= New Sale Section ======= -->
    <section id="new_sale" class="contact sections-bg">
        <div class="container" data-aos="fade-up">

            <div class="row gx-lg-0 gy-4">

                <div class="col-lg-12">
                    <div class="php-email-form">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <h4> Selling and repairing phone and accessories
                                </h4>
                                <h4>  +213 673 39 83 27
                                </h4>
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
                                        <th>TOTAL</td>
                                    </tr>
                                </thead>
                                <tbody id="invoice_tbody">
                                <tr>
                                    <td>LCD iPhone 7+ White</td>
                                    <td>1</td>
                                    <td>4800</td>
                                    <td>4800</td>
                                </tr>
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
                                    Submit</a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Contact Form -->

            </div>

        </div>
    </section><!-- End New sale Section -->

</body>
<script>
  $(document).ready(function () {
    $("#print_invoice").click(function () {
        var printContent = document.getElementById("new_sale").innerHTML;
        var originalContent = document.body.innerHTML;

        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
        location.reload(); // Reload the page to restore original content
    });
  });

</script>
</html>
