<?php

 
session_start();
include_once('../db.php');
LogInCheck();

if (isset($_SESSION['role'])) {
    
    if (isset($_POST['getSupplyInvoices'])) {
        $date_limit = $_POST['date_limit'];
        $supply_name = $_POST['supply_name'];
        $invoice_id = $_POST['invoice_id'];
        $only_not_paid = $_POST['only_not_paid'];
        //sql according to role
        
        $sql = "SELECT 
                t1.supply_invoice_id,
                t1.supplier_name as s_name,
                t1.date as s_date,
                t1.total AS total,
                COALESCE(t2.total_payment, 0) AS payment
            FROM (SELECT 
                si.supply_invoice_id,
                CONCAT(s.supplier_firstname, ' ', s.supplier_surname) AS supplier_name,
                si.date,
                SUM(isu.unit_price * isu.quantity) AS total
                    FROM 
                        supply_invoice si
                    JOIN 
                        supplier s ON si.supplier_id = s.supplier_id
                    JOIN 
                        item_supply isu ON si.supply_invoice_id = isu.supply_invoice_id
                    GROUP BY 
                        si.supply_invoice_id, s.supplier_firstname, s.supplier_surname, si.date
                ) AS t1
            LEFT OUTER JOIN ( SELECT 
                        si1.supply_invoice_id, 
                        SUM(sp.payment) AS total_payment
                    FROM 
                        supply_invoice si1 
                    JOIN 
                        supply_payment sp ON si1.supply_invoice_id = sp.supply_invoice_id
                    GROUP BY 
                        si1.supply_invoice_id
                ) AS t2
            ON t1.supply_invoice_id = t2.supply_invoice_id  
            WHERE t1.total > COALESCE(t2.total_payment, 0)
            ORDER BY t1.date DESC;";    
        $query = $conn->query($sql);
        $i = 1;
        
        while ($row = $query->fetch_assoc()) {
            echo "<tr ondblclick='showSupplyModal(\"".$row['supply_invoice_id']."\")'>
                            <td>" . $i . "</td>
                            <td>" . $row['supply_invoice_id'] . "</td>
                            <td>" . $row['s_name'] . "</td>
                            <td>" . $row['s_date'] . "</td>
                            <td>" . $row['total'] . "</td>
                            <td>" . $row['payment'] . "</td>
                        </tr>";
            $i++;

        } 
    }
    elseif(isset($_POST['GetSupplyInvoice'])){
        echo 1;
    }
    else {
        header('location: ' . URLROOT . '/index.php?codeErreur=-5');
    }
}
else {
    header('location: ' . URLROOT . '/index.php?codeErreur=-5');
} 