<?php
session_start();
include_once('../db.php');
LogInCheck();
if (isset($_SESSION['role'])){
    
    // Suivi d'études par matière
    if (isset($_POST['AutoCompleteCustomer'])){
        $textCherche = '%'.strtoupper($_POST['customer']).'%';
        $errCode = 0;
        $result = '';
        $sql_customer = " SELECT * FROM `customer` WHERE CONCAT (UPPER(`customer_firstname` ), ' ', UPPER(`customer_surname`) )  LIKE '$textCherche' OR
                                                         CONCAT (UPPER(`customer_surname` ), ' ', UPPER(`customer_firstname`) ) LIKE '$textCherche' ";
        
        $res_customer = $conn->query($sql_customer);
        //$errCode = $conn->error;
        
        while($row = $res_customer->fetch_assoc()) {
            $customer = $row['customer_firstname'] .' '. $row['customer_surname'];
            $highlighted = preg_replace('/('.$_POST['customer'].')/i', '<b class="font-green-sharp">$0</b>', $customer);
            $result .= '<li style="cursor: pointer;cursor: hand;" id="" >
                        <a  onclick="set_selection_customer(\''.$customer.'\',\''.$row["customer_id"].'\',\''.$row["type_customer"].'\')">&nbsp;'.$highlighted.'</a>
                    </li>'; 
        } 
        $res_customer->close();
        if(empty($result)) {
            echo '<li style="cursor: pointer; cursor: hand;" >
                <a style="color: red;">Aucun r&eacute;sultat trouv&eacute;!</a>
            </li>';
        } else {
            echo $result;
        }  

    }
    elseif (isset($_POST['getAllCustomer'])){
        //sql according to role
        $sql =  "SELECT * FROM customer;";
        $query = $conn->query($sql);
        $i = 1;
        $result =array();
       // $result = $query->fetch_all(MYSQLI_ASSOC);
        while ($row = $query->fetch_assoc()) {
            if ($row['customer_id'] == -1){
                continue;
            }

            $customer_id = $row['customer_id'];
            $firstname = $row['customer_firstname'];
            $surname = $row['customer_surname'];
            $address = $row['customer_address'];
            $telephone = $row['customer_telephone'];
            $mail = $row['customer_email'];
        

            //sql according to role
            $sql1 =  "SELECT SUM(t1.total - t2.payment) as dept FROM `invoice` INNER JOIN `customer` ON `invoice`.`customer_id` = `customer`.`customer_id` LEFT JOIN 
                (SELECT SUM(`unit_price` * `quantity`) as total, COUNT(*) as nbr_item, invoice_id FROM `invoice_item` GROUP BY invoice_id) as t1 on invoice.invoice_id = t1.invoice_id
                          LEFT JOIN 
                (SELECT SUM(`payment`) as payment, invoice_id FROM `invoice_payment` GROUP BY invoice_id) as t2 on invoice.invoice_id = t2.invoice_id WHERE `invoice`.`customer_id`='".$customer_id."';";

            //echo $sql;
            $query1 = $conn->query($sql1);
            
            $i = 1;
            
            $dept = -1;
            while ($row = $query1->fetch_assoc()) {
                $dept = $row['dept'];
            }
            echo  "<tr id='customer_" . $row['customer_id'] . "'>
                        <td>" . $i . "</td>
                        <td>" . $firstname . " " . $surname . "</td>
                        <td>". $address ."</td>
                        <td>". $telephone ."</td>
                        <td>". $dept ."</td>
                        <td>
                            <button  id ='" . $row['customer_id'] . "'  class='edit_customer_button btn btn-success btn-sm' data-bs-toggle= 'modal' data-bs-target= '#Edit_customer' onclick = 'edit_customer(".$row['customer_id'].")'><span class='fas fa-edit'></span></button>
                            <button  id = 'popover_delete_" . $row['customer_id'] . "' tabindex='0' class='btn btn-danger btn-sm' data-bs-container='body' data-bs-toggle='popover' data-bs-placement='right' data-bs-content='test' onclick='delete_customer_click(".$row['customer_id'].")'><span class='fas fa-trash'></span> </button>
                            <button  id ='situation_" . $row['customer_id'] . "'  class='situation_customer_button btn btn-primary btn-sm' data-bs-toggle= 'modal' data-bs-target= '#situation_customer_modal' onclick = 'situation_customer(".$row['customer_id'].")'><span class='fas fa-history'></span></button> 
                        </td>
                    </tr>";
            $i++;
        }
    }
    elseif (isset($_POST['get_edit_customer_div'])) {
        
        $sql_customer = "SELECT * FROM customer where customer_id = '".$_POST["customer_id"]."'";
        $customer_query = $conn->query($sql_customer);
		$row_customer = $customer_query->fetch_assoc(); 

        $data =array($row_customer['customer_firstname'], $row_customer['customer_surname'], $row_customer['customer_address'], $row_customer['customer_telephone'], $row_customer['customer_email']);
        echo json_encode($data);
    }
    else {
        header('location: '.URLROOT.'/index.php?codeErreur=-5');
    }
}
else{
    header('location: '.URLROOT.'/index.php?codeErreur=-5');
}
?>