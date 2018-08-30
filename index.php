<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
session_start(); 
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    </head>
    <body onload="">
        

        <form method="GET">
            <div class ="form_button" id="nouveauCyclo-livreur">
                <input name="formulaire" type="submit" value="Cyclo-livreur">
            </div>

            <div class ="form_button" id="nouvelleCollecte">
                <input name="formulaire" type="submit" value="Collecte">
            </div>

            <div class ="form_button" id="nouvelleLivraison">
                <input name="formulaire"  type="submit" value="Livraison">
            </div>

            <div class ="form_button" id="nouvelleRemarque">
                <input name="formulaire" type="submit" value="Remarque">
            </div>
        </form>
        
        <div id="responseDiv">
            
        </div>
        <div class="allDynamicForms">
            <?php include 'formulaires.php';
            //on recupere la valeur du formulaire actif 
            if( isset($_GET['formulaire'])){
                $formName = htmlspecialchars($_GET['formulaire']);
                $_SESSION['formActif'] = $formName;
            }
            //lorsqu on a le formActif on peut ecrire les formulaires
            if(isset($_SESSION['formActif'])){
                makeForm(htmlspecialchars($_SESSION['formActif']));
            }
            ?>
        </div>
        
    </body>
</html>
