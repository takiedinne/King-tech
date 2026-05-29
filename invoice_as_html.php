<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
        }
        .invoice {
            width: 80mm;
            max-width: 100%;
            margin: auto;
            padding: 5px;
            border: 1px solid #000;
        }

        .logo {
            display: block;
            margin: auto;
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .barcode {
            display: block;
            margin: 10px auto 0 auto;
            height: 60px; /* or 70px if needed */
            width: 100%;
        }

        .invoice-table { width: 100%; border-collapse: collapse; }
        .invoice-table th, .invoice-table td {
            padding: 2px;
            font-size: 10px;
        }
        .text-center { text-align: center; }
        .no-border { border: none; }

        .no-print, button {
            display: none !important;
        }
        @page {
            size: 80mm auto;
            margin: 5mm;
        }
    </style>
</head>
<body>
    <div class="invoice" id="invoice">
        <img src="assets/img/kingtech/KingTechLogo.jpeg" alt="Invoice Logo" class="logo">
        
        <hr>
        <p class="text-center">Selling and repairing phone and accessories<br>+213 673 39 83 27</p>
        <hr>

        <div class="small-text">
            <div class="row">
                <div class="col-12 text-center">
                    <p>Date: <span id="invoice-date">2025/03/30</span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p class="small text-nowrap text-truncate mb-0">CASHIER: <span id="cashier-name">Abdel Hakim</span></p>
                </div>
                <div class="col-6 text-end">
                    <p class="small text-nowrap text-truncate mb-0">Customer: <span id="customer-name">Hakim Maatar</span></p>
                </div>
            </div>
        </div>

        <hr>
        <table class="invoice-table" id="invoice-items">
            <thead>
                <tr>
                    <th>Designation</th>
                    <th>Qty</th>
                    <th>UP</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="designation">LCD Iphone 6S Black</span></td>
                    <td><span class="qty">2</span></td>
                    <td><span class="unit-price">4500</span></td>
                    <td><span class="total-price">9000</span></td>
                </tr>
                <tr>
                    <td><span class="designation">LCD Iphone 7G Black</span></td>
                    <td><span class="qty">1</span></td>
                    <td><span class="unit-price">4500</span></td>
                    <td><span class="total-price">4500</span></td>
                </tr>
            </tbody>
        </table>
        <hr>    
        <div class="small-text">
            <div class="row">
                <div class="col-6">
                    <p>N of product: <span id="num-products">2</span></p>
                </div>
                <div class="col-6">
                    <p>Total: <span id="invoice-total">13500</span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p>Paid: <span id="invoice-paid">13500</span></p>
                </div>
                <div class="col-6">
                    <p>Rest: <span id="invoice-rest">0</span></p>
                </div>
            </div>
        </div>
        
        <img src="PHPWord/barcode.png" alt="Invoice barcode" class="barcode" id="barcode-img">

        <button onclick="printInvoice()" class="btn btn-primary d-block mx-auto mt-3">Print</button>
    
        <script>
            function printInvoice() {
                var printContents = document.getElementById('invoice').innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        </script>
    </div>
</body>
</html>
