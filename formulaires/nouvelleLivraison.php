<?php

function makeForm($formName = ""){
    //differents champs pour les formulaires ["nom" => "unite"]
    switch($formName):
        case "nouvelleJournee":
            $fields = ["Cyclo-livreur" => ""];
            break;
        case "nouvelleCollecte":
            $fields = ["Legumes" => "g", "Fruits" => "g", "Pains" => "g", "Transf" => "g", "Autres" => "g"];
            break;   
        case "nouvelleLivraison":
            $fields = ["Beneficiaire" => "", "Temperature" =>"°C", "Nombre_cagettes" => "", "Nombre_cangabox" => ""  ];
            break;
        default: return;
    endswitch;
    
    $form = "";
    foreach($fields as $field => $unit){
        if(strcmp($unit,"") !== 0){
            $unit = "(".$unit.")";
        }
        $form .= '<form name="submit-to-google-sheet" id="'.strtolower($field).'">'
                . ' <div id="'. strtolower($field).'Input">'
                . '     <input type="text" value="" id="'.strtolower($field).'" name="'.strtolower($field).'" placeholder="'.$field.' '.$unit.'" required />'
                . '     <button type="submit">Ajouter</button>'
                . ' </div>'
                . '</form>';
    }
    echo $form;  
    echo "<script>
              const scriptURL = 'https://script.google.com/macros/s/AKfycbxcNKj0aQSMX7IFPft50n0HybWeohO9xu5MRCYjdoBiK0BHTcw/exec';
              const form = document.forms['submit-to-google-sheet'];
              form.addEventListener('submit', e => {
                e.preventDefault();
                fetch(scriptURL, { method: 'POST', body: new FormData(form)})
                .then(function() {
                    document.getElementById('responseDiv').innerHTML = 'Ajouté';
                  })              
                .catch(error => console.error('Error!', error.message));
              });
            </script>";
}