<?php
session_start();
include_once('../db.php');
LogInCheck();

if (isset($_SESSION['role'])){
   if (isset($_POST['getAllIInvoices'])){
            $date_limit = $_POST['date_limit'];
            //sql according to role
            $sql =  "SELECT `invoice`.*, `customer`.*, t1.nbr_item  FROM `invoice` INNER JOIN `customer` ON `invoice`.`customer_id` = `customer`.`customer_id`
                        LEFT JOIN (SELECT COUNT(*) as nbr_item, invoice_id FROM `invoice_item` GROUP BY invoice_id) as t1 on invoice.invoice_id = t1.invoice_id
                        WHERE date >= '".$date_limit."' ORDER BY date DESC;";          
            $query = $conn->query($sql);
            $i = 1;
            while ($row = $query->fetch_assoc()) {
                $nbr_items = is_null($row['nbr_item']) ? 0 : $row['nbr_item'] ;
                 echo  "<tr id='invoice_".$row['invoice_id']."'>
                            <td>" . $i . "</td>
                            <td>" . $row['invoice_id'] . "</td>
                            <td>" . $row['customer_firstname'] . " ".$row['customer_surname']."</td>
                            <td>". $row['date'] ."</td>
                            <td>
                                <button  class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target = '#Edit_invoice_modal' 
                                        onclick=\"GetInvoice(".$row['invoice_id'].", '" . $row['customer_firstname'] . " ".$row['customer_surname']."', '". $row['date'] ."')\"><span class='glyphicon glyphicon-search'></span> Invoice </button>
                                <button  id = 'popover_delete_" . $row['invoice_id'] . "' tabindex='0' class='btn btn-danger btn-sm' data-bs-container='body' data-bs-toggle='popover' data-bs-placement='right' data-bs-content='test' onclick='delete_invoice_click(".$row['invoice_id'].", \"".$nbr_items."\")'><span class='fas fa-trash'></span></button>
                           
                            </td>
                        </tr>";
                $i++;
                
            }
    }
    elseif(isset($_POST['getInvoiceDetails'])){
        $invoice_id = $_POST['invoice_id'];
        
        $sql = "SELECT * FROM `invoice_item` as ii INNER JOIN item as i ON ii.item_id = i.item_id   WHERE `invoice_id` = " . $invoice_id;
        $query = $conn->query($sql);

        while ($row = $query->fetch_assoc()) {
            echo  "<tr id=\"item_".$row['item_id']."\">
                       <td>" . $row['item_name'] . "</td>
                       <td>" . $row['quantity'] . "</td>
                       <td>". $row['unit_price'] ."</td>
                       <td>
                           <button  class='btn btn-danger btn-sm' id='popover_delete_" . $row['item_id'] . "'
                                   onclick=\"return_item(".$invoice_id.", ".$row['item_id']."," . $row['quantity'] . " ,". $row['unit_price'] ." )\"><span class='fas fa-undo'></span> return </button>
                       </td>
                   </tr>";
       }
        

    }
    else {
        header('location: '.URLROOT.'/index.php?codeErreur=-5');
    }
}
else{
    header('location: '.URLROOT.'/index.php?codeErreur=-5');
}
?>

