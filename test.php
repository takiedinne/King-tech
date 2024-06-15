<?php
session_start();
if (!isset($_SESSION['connected'])) {
    header('Location: '.URLROOT.'/index.php');
    exit();
}
require_once 'includes/header.php';
require_once 'bootstrap.php';
require_once 'includes/main_header.php';
include_once 'db.php';

//error_reporting(E_ALL);
//ini_set('display_errors', 1);


?>
 <input id="purchase_item_name" autocomplete="false" type="text"
                                        class="form-control AutoCompleteItemPurchase" name="item"
                                        placeholder="Enter item name" required>
<div class="dropdown">
        <ul id="listeItem" class="dropdown-menu"
            aria-labelledby="purchase_item_name"
            style="max-height: 250px; overflow: scroll; display: none; position:absolute; margin:0px; width:100%; left:auto;">
        </ul>
</div>
<script>
     $("input.AutoCompleteItem").on({
        keyup: function() {

            var min_long = 2;
            var motcle = $(this).val();
            if (motcle.length >= min_long) {
                var $ajaxData = {
                    Item: motcle
                };
                $ajaxData.AutoCompleteItem = '1';
                $.ajax({
                    url: "includes/affichage_item.php",
                    type: "POST",
                    data: $ajaxData,
                    success: function(data) {

                        $("ul#listeItem").show();
                        $("ul#listeItem").html(data);

                        if ($("ul#listeItem").length == 1 && $("ul#listeItem li a").text() != "Aucun résultat trouvé!"){
                            
                            set_selection_item($("ul#listeItem li a").text(), $("ul#listeItem li a").attr("id"), $("ul#listeItem li a").attr("price_max"), $("ul#listeItem li a").attr("price_min"), $("ul#listeItem li a").attr("availableQty"));
                        }
                    },
                    error: function(resultat, statut, erreur) {
                        toastr.error(
                            "Veuillez contacter le Centre de Ressources Informatiques pour v&eacute;rifier le serveur.",
                            "Erreur Serveur!");
                    }
                });
            } else {
                $("ul#listeItem").hide();
            }
        }
    });
</script>