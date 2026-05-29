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

?>
<!-- ======= Stats Counter Section For Today ======= -->
<section id="stats-counter_today" class="stats-counter">
  <div class="container" data-aos="fade-up">
    <div class="row gy-4 align-items-center">
      <div class="col-lg-3">
        <img src="assets/img/stats-img.svg" alt="" class="img-fluid">
      </div>

      <div class="col-lg-9">
        <div class="row gy-4">
          <div class="col-lg-4">
              <div class="stats-item d-flex">
                  <i class="bi bi-cart2 flex-shrink-0"></i>
                  <div>
                      <div class="row align-items-start">
                          <div class="col-lg-6">
                              <span id="today_total_sales" data-purecounter-start="0" data-purecounter-end="10"
                                  data-purecounter-duration="1" class="purecounter"></span>
                          </div>
                          <div class="col-lg-6">
                              <span>&nbsp;</span>
                          </div>
                      </div>
                      <p>
                      <h4> Total Items Sold Today&nbsp;</h4>
                      </p>
                  </div>
              </div>
          </div>

          <div class="col-lg-4">
              <div class="stats-item d-flex">
                  <i class="bi bi-graph-up-arrow flex-shrink-0"></i>
                  <div>
                      <div class="row align-items-start">
                          
                        <span id="today_theo_Incomes" data-purecounter-start="0" data-purecounter-end="1000" data-purecounter-currency="DZD"
                            data-purecounter-duration="1" class="purecounter"></span>
                          
                          
                      </div>
                      <p>
                      <h4>Today Thoerical Incomes&nbsp;</h4>
                      </p>
                  </div>
              </div>
          </div>

          <div class="col-lg-4">
              <div class="stats-item d-flex">
                  <i class="bi bi-trophy flex-shrink-0"></i>
                  <div>
                      <div class="row align-items-start">
                          
                              <span id="today_theo_Profits" data-purecounter-currency="DZD" data-purecounter-start="0" data-purecounter-end="10"
                                  data-purecounter-duration="1" class="purecounter"></span>
                          
                          
                      </div>
                      <p>
                      <h4>Today Theorical Profits&nbsp;</h4>
                      </p>
                  </div>
              </div>
          </div>

          <div class="col-lg-4">
              <div class="stats-item d-flex">
                  <i class="bi bi-cash-coin flex-shrink-0"></i>
                  <div>
                      <div class="row align-items-start">
                         
                              <span id="today_Credits" data-purecounter-currency="DZD" data-purecounter-start="0" data-purecounter-end="10"
                                  data-purecounter-duration="1" class="purecounter"></span>
                          
                      </div>
                      <p>
                      <h4>Today Total Credits !&nbsp;</h4>
                      </p>
                  </div>
              </div>
          </div>

          <div class="col-lg-4">
              <div class="stats-item d-flex">
                  <i class="bi bi-currency-dollar flex-shrink-0"></i>
                  <div>
                      <div class="row align-items-start">
                              <span id="today_act_Incomes" data-purecounter-currency="DZD" data-purecounter-start="0" data-purecounter-end="10"
                                  data-purecounter-duration="1" class="purecounter"></span>
                          
                      </div>
                      <p>
                      <h4>Today Actual Incomes&nbsp;</h4>
                      </p>
                  </div>
              </div>
          </div>

          <div class="col-lg-4">
              <div class="stats-item d-flex">
                  <i class="bi bi-bank flex-shrink-0"></i>
                  <div>
                      <div class="row align-items-start">
                          
                              <span id="today_Act_Profits" data-purecounter-currency="DZD" data-purecounter-start="0" data-purecounter-end="10"
                                  data-purecounter-duration="1" class="purecounter"></span>
                          
                      </div>
                      <p>
                      <h4>Today Actual Profits&nbsp;</h4>
                      </p>
                  </div>
              </div>
          </div>
        </div>

      </div>

    </div>

  </div>
</section><!-- End Stats Counter Section -->


<?php require_once './includes/footer.php'; ?>

<script>

    $(document).ready(function () {
        $.ajax({
            url: 'includes/affichage_dashboard.php',
            type: 'POST',
            data: {
                'today': <?php echo $type; ?>
            },
            success: function (data) {
                var obj = JSON.parse(data);
                $('#today_total_sales').attr('data-purecounter-end', obj.today_total_sales);
                $('#today_theo_Incomes').attr('data-purecounter-end', obj.today_theo_Incomes);
                $('#today_theo_Profits').attr('data-purecounter-end', obj.today_theo_profits);
                $('#today_Credits').attr('data-purecounter-end', obj.today_rest);
                $('#today_act_Incomes').attr('data-purecounter-end', obj.today_actual_Incomes);
                $('#today_Act_Profits').attr('data-purecounter-end', obj.today_actual_profits);
                new PureCounter({
                    decimals: 2,
                    separator: ',',
                    formater: false
                });
                
                /* $('#today_theo_Profits').text(obj.theo_Profits);
                $('#today_Credits').text(obj.Credits);
                $('#today_act_Incomes').text(obj.act_Incomes);
                $('#today_Act_Profits').text(obj.Act_Profits);
                $('#today_Paid_Credits').text(obj.Paid_Credits); */
            }
        });
    });
  </script>