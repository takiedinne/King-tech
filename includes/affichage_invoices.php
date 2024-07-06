<?php
session_start();
include_once('../db.php');
LogInCheck();

if (isset($_SESSION['role'])){
    if (isset($_POST['getAllIInvoices'])){
        $date_limit = $_POST['date_limit'];
        //sql according to role
            $sql =  "SELECT `invoice`.*, `customer`.*, t1.nbr_item, t1.total, t2.payment FROM `invoice` INNER JOIN `customer` ON `invoice`.`customer_id` = `customer`.`customer_id`
                LEFT JOIN (SELECT SUM(`unit_price` * `quantity`) as total, COUNT(*) as nbr_item, invoice_id FROM `invoice_item` GROUP BY invoice_id) as t1 on invoice.invoice_id = t1.invoice_id
                LEFT JOIN (SELECT SUM(`payment`) as payment, invoice_id FROM `invoice_payment` GROUP BY invoice_id) as t2 on invoice.invoice_id = t2.invoice_id
                WHERE payment < total ORDER BY date DESC;";          
        $query = $conn->query($sql);
        $i = 1;
        while ($row = $query->fetch_assoc()) {
            $nbr_items = is_null($row['nbr_item']) ? 0 : $row['nbr_item'] ;
                echo  "<tr id='invoice_".$row['invoice_id']."'>
                        <td>" . $i . "</td>
                        <td>" . $row['invoice_id'] . "</td>
                        <td>" . $row['customer_firstname'] . " ".$row['customer_surname']."</td>
                        <td>". $row['date'] ."</td>
                        <td>". $row['total'] ."</td>
                        <td>". $row['payment'] ."</td>
                        <td>
                            <button  class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target = '#Edit_invoice_modal' 
                                    onclick=\"GetInvoice(".$row['invoice_id'].", '" . $row['customer_firstname'] . " ".$row['customer_surname']."', '". $row['date'] ."')\"><span class='fa-solid fa-rotate-left'></span> return </button>
                            <button  class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target = '#Payments_modal' 
                                    onclick=\"GetPayments(".$row['invoice_id'].", '" . $row['customer_firstname'] . " ".$row['customer_surname']."', '". $row['date'] ."', '". $row['total'] ."', '". $row['payment'] ."')\"><span class='fa-regular fa-credit-card'></span> payments </button>
                                
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
    elseif(isset($_POST['getInvoicePayments'])){
        $invoice_id = $_POST['invoice_id'];
        
        $sql = "SELECT * FROM `invoice_payment` WHERE `invoice_id` = " . $invoice_id;
        $query = $conn->query($sql);

        while ($row = $query->fetch_assoc()) {
            echo  "<tr>
                       <td>" . $row['date'] . "</td>
                       <td>" . $row['time'] . "</td>
                       <td>". $row['payment'] ."</td>
                       <td>
                           <button  class='btn btn-danger btn-sm' id='popover_delete_payment" . $row['item_id'] . "'
                                   onclick=\"delete_payment(".$invoice_id.", ".$row['date']."," . $row['time'] .")\"><span class='fas fa-undo'></span> return </button>
                       </td>
                   </tr>";
        }
    }
    elseif(isset($_POST['getIInvoices'])){
        $invoice_id = $_POST['invoice_id'];
        
        //sql according to role
        $sql =  "SELECT `invoice`.*, `customer`.*, t1.nbr_item, t1.total, t2.payment FROM `invoice` INNER JOIN `customer` ON `invoice`.`customer_id` = `customer`.`customer_id`
            LEFT JOIN (SELECT SUM(`unit_price` * `quantity`) as total, COUNT(*) as nbr_item, invoice_id FROM `invoice_item` GROUP BY invoice_id) as t1 on invoice.invoice_id = t1.invoice_id
            LEFT JOIN (SELECT SUM(`payment`) as payment, invoice_id FROM `invoice_payment` GROUP BY invoice_id) as t2 on invoice.invoice_id = t2.invoice_id
                WHERE invoice.invoice_id like '".$invoice_id."%' ORDER BY date DESC;";          
        $query = $conn->query($sql);
        $i = 1;
        while ($row = $query->fetch_assoc()) {
            $nbr_items = is_null($row['nbr_item']) ? 0 : $row['nbr_item'] ;
                echo  "<tr id='invoice_".$row['invoice_id']."'>
                        <td>" . $i . "</td>
                        <td>" . $row['invoice_id'] . "</td>
                        <td>" . $row['customer_firstname'] . " ".$row['customer_surname']."</td>
                        <td>". $row['date'] ."</td>
                        <td>". $row['total'] ."</td>
                        <td>". $row['payment'] ."</td>
                        <td>
                            <button  class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target = '#Edit_invoice_modal' 
                                    onclick=\"GetInvoice(".$row['invoice_id'].", '" . $row['customer_firstname'] . " ".$row['customer_surname']."', '". $row['date'] ."')\"><span class='fa-solid fa-rotate-left'></span> return </button>
                            <button  class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target = '#Payments_modal' 
                                    onclick=\"GetPayments(".$row['invoice_id'].", '" . $row['customer_firstname'] . " ".$row['customer_surname']."', '". $row['date'] ."', '". $row['total'] ."', '". $row['payment'] ."')\"><span class='fa-regular fa-credit-card'></span> payments </button>
                                
                            <button  id = 'popover_delete_" . $row['invoice_id'] . "' tabindex='0' class='btn btn-danger btn-sm' data-bs-container='body' data-bs-toggle='popover' data-bs-placement='right' data-bs-content='test' onclick='delete_invoice_click(".$row['invoice_id'].", \"".$nbr_items."\")'><span class='fas fa-trash'></span></button>
                        
                        </td>
                    </tr>";
            $i++;
            
        }
    }
    if (isset($_POST['filterInvoices'])){
        
        $date_limit = $_POST['date_limit'];
        $customer_id = $_POST['customerId'];
       

        $whereClause = "";
        if ($date_limit != "") {
            $whereClause = "Where `invoice`.date = '".$date_limit."'";
        }
        if ($customer_id != "" && $customer_id != "-1") {
            if ($whereClause != "") {
                $whereClause = $whereClause . " AND `invoice`.customer_id = '".$customer_id."'";
            }
            else {
                $whereClause = " Where `invoice`.customer_id = '".$customer_id."'";
            }
        }
        if ($whereClause == ""){
            $whereClause = "Where true ";
        }
        
        //sql according to role
        $sql =  "SELECT `invoice`.*, `customer`.*, t1.nbr_item, t1.total, t2.payment FROM `invoice` INNER JOIN `customer` ON `invoice`.`customer_id` = `customer`.`customer_id`
                LEFT JOIN (SELECT SUM(`unit_price` * `quantity`) as total, COUNT(*) as nbr_item, invoice_id FROM `invoice_item` GROUP BY invoice_id) as t1 on invoice.invoice_id = t1.invoice_id
                LEFT JOIN (SELECT SUM(`payment`) as payment, invoice_id FROM `invoice_payment` GROUP BY invoice_id) as t2 on invoice.invoice_id = t2.invoice_id ".$whereClause ." ORDER BY date DESC;";

        //echo $sql;
        $query = $conn->query($sql);
        
        $i = 1;
        
        $response_data = []; 
        while ($row = $query->fetch_assoc()) {
            $nbr_items = is_null($row['nbr_item']) ? 0 : $row['nbr_item'] ;
                 echo  "<tr id='invoice_".$row['invoice_id']."'>
                        <td>" . $i . "</td>
                        <td>" . $row['invoice_id'] . "</td>
                        <td>" . $row['customer_firstname'] . " ".$row['customer_surname']."</td>
                        <td>". $row['date'] ."</td>
                        <td>". $row['total'] ."</td>
                        <td>". $row['payment'] ."</td>
                        <td>
                            <button  class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target = '#Edit_invoice_modal' 
                                    onclick=\"GetInvoice(".$row['invoice_id'].", '" . $row['customer_firstname'] . " ".$row['customer_surname']."', '". $row['date'] ."')\"><span class='fa-solid fa-rotate-left'></span> return </button>
                            <button  class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target = '#Payments_modal' 
                                    onclick=\"GetPayments(".$row['invoice_id'].", '" . $row['customer_firstname'] . " ".$row['customer_surname']."', '". $row['date'] ."', '". $row['total'] ."', '". $row['payment'] ."')\"><span class='fa-regular fa-credit-card'></span> payments </button>
                                
                            <button  id = 'popover_delete_" . $row['invoice_id'] . "' tabindex='0' class='btn btn-danger btn-sm' data-bs-container='body' data-bs-toggle='popover' data-bs-placement='right' data-bs-content='test' onclick='delete_invoice_click(".$row['invoice_id'].", \"".$nbr_items."\")'><span class='fas fa-trash'></span></button>
                        
                        </td>
                    </tr>"; 
            $i++;
            
        }
    }

    if (isset($_POST['getDepts'])){
        
        
        $customer_id = $_POST['customerId'];
       
        //sql according to role
            $sql =  "SELECT SUM(t1.total - t2.payment) as dept FROM `invoice` INNER JOIN `customer` ON `invoice`.`customer_id` = `customer`.`customer_id` LEFT JOIN 
                (SELECT SUM(`unit_price` * `quantity`) as total, COUNT(*) as nbr_item, invoice_id FROM `invoice_item` GROUP BY invoice_id) as t1 on invoice.invoice_id = t1.invoice_id
                          LEFT JOIN 
                (SELECT SUM(`payment`) as payment, invoice_id FROM `invoice_payment` GROUP BY invoice_id) as t2 on invoice.invoice_id = t2.invoice_id WHERE `invoice`.`customer_id`='".$customer_id."';";

        //echo $sql;
        $query = $conn->query($sql);
        
        $i = 1;
        
        $response_data = []; 
        while ($row = $query->fetch_assoc()) {
            echo $row['dept'];
        }
    }
    else {
        echo -1;
       // header('location: '.URLROOT.'/index.php?codeErreur=-5');
    }
}
else{
   header('location: '.URLROOT.'/index.php?codeErreur=-5');
}
?>