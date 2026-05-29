<?php
session_start();
if (isset($_SESSION['connected']) == false) {
    header('location: ' . URLROOT . '/index.php');
    exit();
}
require_once 'includes/header.php';
require_once 'bootstrap.php';
require_once 'includes/main_header.php';
include_once('db.php');
flash();
// get type of dashboard

$type = $_GET['type'];

$date_constraint ='';
if ($type == 'day') {
  $date_constraint = 'i.date = CURRENT_DATE()';
  $title = "Today's";
} elseif ($type == 'week') {
  $date_constraint = 'i.date >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY) -1';
  $title = "This week's";
} elseif ($type == 'month') {
  $date_constraint = 'i.date >=  DATE_SUB(CURRENT_DATE(), INTERVAL DAYOFMONTH(CURRENT_DATE())-1 DAY)';
  $title = "This month's";
}

//get the selling of today
$sql_income_sales ="SELECT sum( it.unit_price * it.quantity) as income, sum(it.quantity) as sales 
                    FROM `invoice` as i INNER JOIN `invoice_item` as it on i.invoice_id = it.invoice_id 
                    WHERE ".$date_constraint.";";

$res_income = $conn->query($sql_income_sales);

$income = 0;
$profit = 0;
$sales = 0;

if($row = $res_income->fetch_assoc()){
    $income = $row['income'];
    $sales = $row['sales'];
}

$sql_sales ="SELECT it.item_id as item_id, sum(it.quantity * it.unit_price) as cum_sale, sum(it.quantity) as quantity 
            FROM `invoice` as i INNER JOIN `invoice_item` as it on i.invoice_id = it.invoice_id  
            WHERE ".$date_constraint." GROUP BY it.item_id;";
$res_sales = $conn->query($sql_sales);
$items_sale = array();
while ($row = $res_sales->fetch_assoc()) {
  $sql_purchase = "SELECT `quantity`, `unit_price` FROM `supply_invoice` as s INNER JOIN `item_supply` as it 
                    ON s.supply_invoice_id = it.supply_invoice_id 
                    WHERE `item_id` = " . $row['item_id'] . " 
                    ORDER BY s.date, s.time ASC;";
  $res_purchase = $conn->query($sql_purchase);
  $purchased_quantity = $row['quantity'];
  $purchased_cost = 0;
  while ($row_purchase = $res_purchase->fetch_assoc()) {
    $purchased_cost += ($row_purchase['quantity'] <= $purchased_quantity) ? 
      $row_purchase['unit_price'] * $row_purchase['quantity'] :
      $row_purchase['unit_price'] * $purchased_quantity;
    $purchased_quantity -= $row_purchase['quantity'];
    if ($purchased_quantity <= 0) {
      break;
    }
  }
  $profit += $row['cum_sale'] - $purchased_cost;
}



?>

<!-- ======= Our Services Section ======= -->
 <!-- ======= Stats Counter Section ======= -->
 <section id="stats-counter" class="stats-counter">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4 align-items-center">

          <div class="col-lg-6">
            <img src="assets/img/stats-img.svg" alt="" class="img-fluid">
          </div>

          <div class="col-lg-6">

            <div class="stats-item d-flex align-items-center">
              <p><h2><?php echo $title;?> income is :&nbsp;</h2></p>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $income;?>" data-purecounter-duration="1" class="purecounter"></span>
              <span> DZ</span>
              
            </div><!-- End Stats Item -->

            <div class="stats-item d-flex align-items-center">
              <p><h2><?php echo $title;?> profits is: &nbsp;</h2> </p>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $profit;?>" data-purecounter-duration="1" class="purecounter"></span>
              <span> DZ</span>
              
            </div><!-- End Stats Item -->

            <div class="stats-item d-flex align-items-center">
              <p><h2>Number of items sold:&nbsp; </h2></p>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $sales;?>" data-purecounter-duration="1" class="purecounter"></span>
              <span> DZ</span>
              
            </div><!-- End Stats Item -->
          </div>

        </div>

      </div>
    </section><!-- End Stats Counter Section -->

<?php require_once './includes/footer.php'; ?>