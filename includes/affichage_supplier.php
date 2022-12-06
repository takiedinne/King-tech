<?php
session_start();
include_once('../db.php');
LogInCheck();

if (isset($_SESSION['role'])){
    // Suivi d'études par matière
    if (isset($_POST['get_edit_supplier_div'])) {
        
        $sql_supplier = "SELECT * FROM supplier where supplier_id = '".$_POST["supplier_id"]."'";
        $supplier_query = $conn->query($sql_supplier);
		$row_supplier = $supplier_query->fetch_assoc(); 

        $data =array($row_supplier['supplier_firstname'], $row_supplier['supplier_surname'], $row_supplier['supplier_address'], $row_supplier['supplier_telephone'], $row_supplier['supplier_mail']);
        echo json_encode($data);
    }
    elseif (isset($_POST['AutoCompleteSupplier'])){
        $textCherche = '%'.strtoupper($_POST['supplier']).'%';
        
        $result = '';
        $sql_supplier = " SELECT * FROM `supplier` WHERE UPPER( CONCAT(`supplier_firstname`, ' ', `supplier_surname`) ) LIKE '$textCherche'
                                 OR UPPER( CONCAT(`supplier_surname`, ' ', `supplier_firstname`) ) like '$textCherche' ";
        $res_supplier = $conn->query($sql_supplier);
        
        while($row = $res_supplier->fetch_assoc()) {
            
            $supplier = $row['supplier_firstname'] .' '. $row['supplier_surname'];
            
            $highlighted = preg_replace('/('.$_POST['supplier'].')/i', '<b class="font-green-sharp">$0</b>', $supplier);
            
            $result .= '<li style="cursor: pointer;cursor: hand;" id="" >
                        <a  onclick="set_selection_supplier(\''.$supplier.'\',\''.$row["supplier_id"].'\')">&nbsp;'.$highlighted.'</a>
                    </li>';
        }
        
        $res_supplier->close();
        if(empty($result)) {
            echo '<li style="cursor: pointer; cursor: hand;" >
                <a style="color: red;">Aucun r&eacute;sultat trouv&eacute;!</a>
            </li>';
        } else {
            echo $result;
        } 
    }
    elseif (isset($_POST['getAllSuppliers'])){
        //sql according to role
        $sql =  "SELECT * FROM supplier;";
        $query = $conn->query($sql);
        $i = 1;
        $result =array();
       // $result = $query->fetch_all(MYSQLI_ASSOC);
        while ($row = $query->fetch_assoc()) {
             echo  "<tr id='supplier_" . $row['supplier_id'] . "'>
                        <td>" . $i . "</td>
                        <td>" . $row['supplier_firstname'] . " " . $row['supplier_surname'] . "</td>
                        <td>". $row['supplier_address'] ."</td>
                        <td>". $row['supplier_telephone'] ."</td>
                        <td>". $row['supplier_mail'] ."</td>
                        <td>
                            <button  id ='" . $row['supplier_id'] . "'  class='edit_supplier_button btn btn-success btn-sm' data-bs-toggle= 'modal' data-bs-target= '#Edit_supplier' onclick = 'edit_supplier(".$row['supplier_id'].")'><span class='fas fa-edit'></span></button>
                            <button  id = 'popover_delete_" . $row['supplier_id'] . "' tabindex='0' class='btn btn-danger btn-sm' data-bs-container='body' data-bs-toggle='popover' data-bs-placement='right' data-bs-content='test' onclick='delete_supplier_click(".$row['supplier_id'].")'><span class='fas fa-trash'></span> </button>
                        </td>
                    </tr>";
            $i++;
        }
    }
}else{
    header('location: '.URLROOT.'/index.php?codeErreur=-5');
}
?>

