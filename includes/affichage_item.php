<?php
session_start();
include_once('../db.php');
LogInCheck();

if (isset($_SESSION['role'])){
    // Suivi d'études par matière
    if (isset($_POST['get_edit_item_div'])) {
        
        $sql_item = "SELECT i.item_id, i.item_name, i.item_cat, i.item_quantity, ip.price_max, ip.price_min, i.item_reference FROM item AS i LEFT JOIN item_price AS ip ON i.item_id = ip.item_id
                            WHERE i.item_id = ".$_POST['item_id']." and  (ip.`accreditation_date` = ( SELECT MAX( `accreditation_date` )
                            FROM  item_price AS ip2 
                            WHERE ip2.item_id = i.item_id ) OR ip.`accreditation_date` IS NULL)";
        $item_query = $conn->query($sql_item);
		$row_item = $item_query->fetch_assoc(); 

        $data = array($row_item['item_name'], $row_item['item_cat'], $row_item['item_reference'], $row_item['item_quantity'], $row_item['price_min'], $row_item['price_max']); 
        echo json_encode($data);
    }
    elseif (isset($_POST['AutoCompleteItem'])){

        $textCherche = '%'.strtoupper($_POST['Item']).'%';
        
        $result = '';
        $sql_item = " SELECT * FROM `item` as i, item_price as ip WHERE
                             i.item_id= ip.item_id and
                             UPPER( `item_name` ) LIKE '$textCherche' AND ip.`accreditation_date` = ( SELECT MAX( `accreditation_date`)
                                        FROM item_price AS ip2 WHERE ip2.item_id = i.item_id ) ";

                              
        $res_item = $conn->query($sql_item);
        
        while($row = $res_item->fetch_assoc()) {
            $item = $row['item_name'];
            
            $highlighted = preg_replace('/('.$_POST['Item'].')/i', '<b class="font-green-sharp">$0</b>', $item);
            
            $result .= '<li style="cursor: pointer;cursor: hand;" id="" >
                        <a  onclick="set_selection_item(\''.$row["item_name"].'\',\''.$row["item_id"].'\',\''.$row["price_max"].'\',\''.$row["price_min"].'\' , \''.$row["item_quantity"] .'\')">&nbsp;'.$highlighted.'</a>
                    </li>';
        }
        $res_item->close();
        if(empty($result)) {
            echo '<li style="cursor: pointer; cursor: hand;" >
                <a style="color: red;">Aucun r&eacute;sultat trouv&eacute;!</a>
            </li>';
        } else {
            echo $result;
        } 

    }
    elseif (isset($_POST['AutoCompleteItemPurchase'])){

        $textCherche = '%'.strtoupper($_POST['Item']).'%';
        
        $result = '';
        $sql_item = " SELECT * FROM `item`  WHERE UPPER( `item_name` ) LIKE '$textCherche' ";
        $res_item = $conn->query($sql_item);
        
        while($row = $res_item->fetch_assoc()) {
            $item = $row['item_name'];
            
            $highlighted = preg_replace('/('.$_POST['Item'].')/i', '<b class="font-green-sharp">$0</b>', $item);
            
            $result .= '<li style="cursor: pointer;cursor: hand;" id="" >
                        <a  onclick="set_selection_item_purchase(\''.$row["item_name"].'\',\''.$row["item_id"].'\')">&nbsp;'.$highlighted.'</a>
                    </li>';
        }
        $res_item->close();
        if(empty($result)) {
            echo '<li style="cursor: pointer; cursor: hand;" >
                <a style="color: red;">Aucun r&eacute;sultat trouv&eacute;!</a>
            </li>';
        } else {
            echo $result;
        } 

    }
    elseif (isset($_POST['getAllItems'])){
            //sql according to role
            $sql = "SELECT i.item_id, i.item_name, i.item_quantity,i.item_cat, ip.price_max, ip.price_min, its.unit_price
             FROM item AS i LEFT JOIN item_price AS ip ON i.item_id = ip.item_id LEFT JOIN item_supply its ON
            its.item_id = i.item_id LEFT JOIN supply_invoice as si ON si.supply_invoice_id = its.supply_invoice_id WHERE
            (ip.`accreditation_date` = ( SELECT MAX( `accreditation_date` ) FROM item AS i1 LEFT JOIN item_price AS ip2 ON
            i1.item_id = ip2.item_id WHERE ip2.item_id = i.item_id ) OR ip.`accreditation_date` IS NULL) AND (si.`date` = (SELECT
            MAX(si1.date) from supply_invoice as si1 INNER JOIN item_supply its1 ON si1.supply_invoice_id = its1.supply_invoice_id
            where its1.item_id = i.item_id ) OR si.date IS NULL );";

            $query = $conn->query($sql);
            $i = 1;
            $result =array();
           // $result = $query->fetch_all(MYSQLI_ASSOC);
            while ($row = $query->fetch_assoc()) {
                $price_max = ($row['price_max']=== null) ? "/" : $row['price_max'];
                $price_min = ($row['price_min']=== null) ? "/" : $row['price_min'];
                $purchase_price = ($row['unit_price']=== null) ? "/" : $row['unit_price'];
                 echo  "<tr id='item_" . $row['item_id'] . "'>
                            <td>" . $i . "</td>
                            <td>" . $row['item_name'] . "</td>
                            <td style='text-align: center; vertical-align: middle;'>
                                    <img alt='image' src='assets/img/kingtech/category_" . $row['item_cat'] . ".png' height='30' width='30' style='margin-top: -15px;'>
                            </td>
                            <td>" . $row['item_quantity'] . "</td>
                            <td>" . $purchase_price . " DA</td>
                            <td>". $price_max ." DA</td>
                            <td>". $price_min ." DA</td>
                            <td>
                                <button  id ='" . $row['item_id'] . "'  class='edit_item_button btn btn-success btn-sm' data-bs-toggle= 'modal' data-bs-target= '#Edit' onclick = 'edit_item(".$row['item_id'].")'><span class='fas fa-edit'></span></button>
                                <button  id = 'popover_delete_" . $row['item_id'] . "' tabindex='0' class='btn btn-danger btn-sm' data-bs-container='body' data-bs-toggle='popover' data-bs-placement='right' data-bs-content='test' onclick='delete_item_click(".$row['item_id'].", \"".$row['item_name']."\")'><span class='fas fa-trash'></span></button>
                            </td>
                        </tr>";
                $i++;
                
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

