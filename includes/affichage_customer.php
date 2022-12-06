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
                        <a  onclick="set_selection_customer(\''.$customer.'\',\''.$row["customer_id"].'\')">&nbsp;'.$highlighted.'</a>
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
    else {
        header('location: '.URLROOT.'/index.php?codeErreur=-5');
    }
}
else{
    header('location: '.URLROOT.'/index.php?codeErreur=-5');
}
?>

