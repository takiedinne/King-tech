<?php
session_start();
include_once('../db.php');
LogInCheck();

if (isset($_SESSION['role'])) {
    if (isset($_POST['getAllISupplyInvoices'])) {
        $date_limit = $_POST['date_limit'];
        //sql according to role
        $sql = "SELECT * FROM `supply_invoice` INNER JOIN `item_supply` 
                            ON `supply_invoice`.`supply_invoice_id` = `item_supply`.`supply_invoice_id` 
                            INNER JOIN `supplier` ON `supplier`.`supplier_id` = `supply_invoice`.`supplier_id` 
                            INNER JOIN `item` on `item`.`item_id` = `item_supply`.`item_id`
                            WHERE `date` >= '" . $date_limit . "' ORDER BY date DESC";
        $query = $conn->query($sql);
        $i = 1;
        while ($row = $query->fetch_assoc()) {
            echo "<tr id='supplyOpt_".$row['supply_invoice_id']."_".$row['item_id']."'>
                            <td>" . $i . "</td>
                            <td>" . $row['supply_invoice_id'] . "</td>
                            <td>" . $row['supplier_firstname'] . " " . $row['supplier_surname'] . "</td>
                            <td>" . $row['item_name'] . "</td>
                            <td>" . $row['date'] . "</td>
                            <td>" . $row['quantity'] . "</td>
                            <td>" . $row['unit_price'] . "</td>
                            <td>
                                <button  id = 'popover_delete_" . $row['supply_invoice_id'] . "_".$row['item_id']."' tabindex='0' class='btn btn-danger btn-sm' data-bs-container='body' data-bs-toggle='popover' data-bs-placement='right' data-bs-content='test' onclick=\"deleteSupplyOpt('".$row['supply_invoice_id']."', '".$row['item_id']."')\"><span class='fas fa-trash'></span></button>
                            </td>
                        </tr>";
            $i++;

        }
    }
    else {
        header('location: ' . URLROOT . '/index.php?codeErreur=-5');
    }
}
else {
    header('location: ' . URLROOT . '/index.php?codeErreur=-5');
}
?>