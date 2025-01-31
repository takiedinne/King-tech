<?php
session_start();
include_once('../db.php');
LogInCheck();
if (isset($_SESSION['role'])){
    
    // Suivi d'études par matière
    if (isset($_POST['today'])){
        //get the items sold today
        /* $sql ="SELECT * FROM `invoice` i INNER JOIN `invoice_item` ii on i.`invoice_id`= ii.invoice_id WHERE i.date = CURRENT_DATE();";

        
        $results =$conn->query($sql);
        $today_total_sales = 0;
        $today_theo_Incomes = 0;
        while($row = $results->fetch_assoc()){
            $quantity = $row['quantity'];
            $price = $row['unit_price'] * $quantity;
            //echo $quantity . ' ' . $row['unit_price'] . ' ' . $price . '\n';

            $today_total_sales += $quantity;
            $today_theo_Incomes += $price;
        } */

        // get
        $sql = "SELECT SUM(t1.total_items) as total_items, SUM(t1.total) as total, SUM(t2.paiment) as paiement, SUM(t1.total - t2.paiment) as Rest FROM (SELECT i.invoice_id, SUM(ii.quantity * ii.unit_price) as total, SUM(ii.quantity) as total_items  FROM `invoice` i INNER JOIN invoice_item ii on i.invoice_id = ii.invoice_id WHERE i.date = CURRENT_DATE() GROUP BY i.invoice_id) as t1 INNER JOIN (SELECT i1.invoice_id, SUM(ip.payment) as paiment FROM `invoice` i1 INNER JOIN invoice_payment ip on i1.invoice_id = ip.invoice_id WHERE i1.date = CURRENT_DATE()GROUP BY i1.invoice_id) as t2 on t1.invoice_id = t2.invoice_id;";
        $results =$conn->query($sql);
        $row = $results->fetch_assoc();
        
        $today_total_sales = $row['total_items'] == NULL ? 0 : $row['total_items'];
        $today_theo_Incomes = $row['total'] == NULL ? 0 : $row['total'];
        $today_actual_Incomes = $row['paiement'] == NULL ? 0 : $row['paiement'];
        $today_rest = $row['Rest'] == NULL ? 0 : $row['Rest'];

        // calculate the profits and the actual profits
        $sql = "SELECT ii.item_id, ii.quantity FROM invoice i INNER JOIN `invoice_item` ii on i.invoice_id = ii.invoice_id WHERE i.date = CURRENT_DATE()";

        
        $results =$conn->query($sql);
        $cost = 0;
        
        while($row = $results->fetch_assoc()){
            $item_id = $row['item_id'];
            $sold_quantity = $row['quantity'];

            //echo "item id = " .$item_id." sold quantity = ". $sold_quantity . "\n";

            $sql = "SELECT i.item_id, it.quantity as purshased_quantity, i.item_quantity as available_quantity, it.unit_price as purshased_price FROM `supply_invoice` as s INNER JOIN `item_supply` as it ON s.supply_invoice_id = it.supply_invoice_id INNER JOIN `item` i on i.item_id = it.item_id WHERE it.`item_id` = ".$item_id." ORDER BY `s`.`date`  DESC;";
            //echo $sql;
            $res_supply = $conn->query($sql);
            // calculate profits from selling this particular item
            $available_items_counter = 0;
            $cost_counter = 0;
            
            $available_quantity = -1;
            $unite_purshased_price = -1; // used in case there is an error in supplying operators where not all the supplying is introduced correctlly.
            while($row_supply = $res_supply->fetch_assoc()){
               
                //First set the AVailable Quantity if we did not set it yet
                if ($available_quantity == -1){
                    $available_quantity = $row_supply['available_quantity'];
                    //echo "available quantity = " .$available_quantity . "\n";
                }

                if ($available_items_counter < $available_quantity){
                    //case 1: the available_items_counter + the purshased quantity is less than the available quantity
                    if ($available_items_counter + $row_supply['purshased_quantity'] <= $available_quantity){
                        $available_items_counter += $row_supply['purshased_quantity'];
                        $unite_purshased_price = $row_supply['purshased_price'];
                        continue;
                    }else{
                        //case 2: the available_items_counter + the purshased quantity is more than the available quantity
                        if($available_items_counter + $row_supply['purshased_quantity'] - $available_quantity >= $sold_quantity){
                            //case 2.1: with this purchase we can cover all the sold quantity
                            $cost += $row_supply['purshased_price'] * $sold_quantity;
                            echo "cost after case 1 = " . $cost . "\n";
                            $cost_counter += $sold_quantity; //does not make a sense but we let it for the sake of clarity
                            $unite_purshased_price = $row_supply['purshased_price']; //does not make a sense but we let it for the sake of clarity
                            $available_items_counter = $available_quantity;
                            break;
                        }else{
                            //case 2.2: with this purchase we can not cover all the sold quantity
                            $quantity_to_cover_from_this_supply = $row_supply['purshased_quantity'] -($available_quantity - $available_items_counter);
                            $cost += $row_supply['purshased_price'] * $quantity_to_cover_from_this_supply;
                            $cost_counter += $quantity_to_cover_from_this_supply;
                            $available_items_counter = $available_quantity;
                            $unite_purshased_price = $row_supply['purshased_price'];
                        }
                    }
                }else{
                    //case 3: we ignored all the purshased for the existing quantity
                    if ($cost_counter + $row_supply['purshased_quantity'] <= $sold_quantity){
                        //case 3.1: we can cover all the sold quantity with this purshase
                        $cost += $row_supply['purshased_price'] * ($sold_quantity - $cost_counter);
                        $cost_counter += ($sold_quantity - $cost_counter);
                        $unite_purshased_price = $row_supply['purshased_price'];
                    }else{
                        //case 3.2: we can not cover all the sold quantity with this purshase
                        $cost += $row_supply['purshased_price'] * $row_supply['purshased_quantity'];
                        $cost_counter += $row_supply['purshased_quantity'];
                        $unite_purshased_price = $row_supply['purshased_price'];
                    }
                        
                }

                if ($cost_counter >= $sold_quantity){
                    //echo " we went out of the loop \n";
                    break;
                }
            }
            //we check that all the $sold items are covered
            // we used this to avoid the case where we did not introduce well the supplying opertaions
            if ($cost_counter < $sold_quantity){
                $cost += $unite_purshased_price * ($sold_quantity - $cost_counter);
                
            }
            //echo "item id = " .$item_id." cost = ". $cost . "\n";
            
        }
         

        $today_theo_profits = $today_theo_Incomes - $cost;
        $today_actual_profits = $today_actual_Incomes - $cost;
        
        echo json_encode(array('today_total_sales' => $today_total_sales, 'today_theo_Incomes' => $today_theo_Incomes, 'today_actual_Incomes' => $today_actual_Incomes, 'today_rest' => $today_rest, 'today_theo_profits' => $today_theo_profits, 'today_actual_profits' => $today_actual_profits));
    }
    else {
        header('location: '.URLROOT.'/index.php?codeErreur=-5');
    }
}
else{
    header('location: '.URLROOT.'/index.php?codeErreur=-5');
}
?>