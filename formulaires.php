<?php
/*
 * Le select permet a present de conserver le donateur choisi, 
 * tout en transmettant ce donateur dans un input hidden 
 * 
 */

$donateurs = ['None', 'Carrefour Lagrange', 'Biocoop Tolbiac', 'Biocoop Alésia', 'Monop'];

function makeForm($formName = ""){
    global $donateurs;
    //differents champs pour les formulaires ["nom" => "unite"]
    switch($formName):
        case "Cyclo-livreur":
            $fields = ["Cyclo-livreur" => ""];
            break;
        case "Collecte":
            $fields = ["Legumes" => "g", "Fruits" => "g", "Pains" => "g", "Transf" => "g", "Autres" => "g"];
            break;   
        case "Livraison":
            $fields = ["Beneficiaire" => "", "Temperature" =>"°C", "Nombre_cagettes" => "", "Nombre_cangabox" => ""  ];
            break;
        case "Remarque":
            $fields = ["Remarque" => ""];
            break;
        default: return;
    endswitch;
    
    $form = '<div class="dynamicForms" id="'.$formName.'">';
    if(strcmp($formName, 'Collecte') === 0){
        $form .= '<select id="donateur_selector" name="taskOption">';
        foreach($donateurs as $key => $nomDonateur){
            $form .= '<option value="'.$nomDonateur.'">'.$nomDonateur.'</option>';
        }
        $form .= '</select>';
    }
    foreach($fields as $field => $unit){
        if(strcmp($unit,"") !== 0){
            $unit = "(".$unit.")";
        }
        $form .= '<form method="get" class="formInputData" name="submit-to-google-sheet" id="'.strtolower($field).'">'
                . ' <div id="'. strtolower($field).'Input">'
                . '     <input type="text" value="" id="'.strtolower($field).'" name="'.strtolower($field).'" placeholder="'.$field.' '.$unit.'" required />';
        
        
        $form .= '     <button type="submit" >Ajouter</button>'
                . ' </div>'
                . '<input class="selected_donateur" name="donateur" type="hidden" value="None">'
                . '</form>';
    }
    echo $form.'</div>';
    
    echo "<script>  
    //Avoir un Select qui ajoute dynamiquement la valeur de donateur au formulaire
    $( '#donateur_selector' ).change(function() {
        alert( $('#donateur_selector').val() );
        $('.selected_donateur').val($('#donateur_selector').val() );

    });

    const scriptURL = 'https://script.google.com/macros/s/AKfycbxcNKj0aQSMX7IFPft50n0HybWeohO9xu5MRCYjdoBiK0BHTcw/exec';
    var forms = document.querySelectorAll('form.formInputData');
    //empecher les doubles envois en desactivant le submit apres un submit
    $('form.formInputData').submit(function(){
        $(this).find(':submit').prop( 'disabled', true );
    });


    forms.forEach(function(form){
        form.addEventListener('submit', e => {
          e.preventDefault();
          fetch(scriptURL, { method: 'POST', body: new FormData(form)})
          .then(function() {
              document.getElementById('responseDiv').innerHTML = 'Ajouté: '+form.id;
              //on reset le formulaire et on reactive le submit
              form.reset(); 
              $('form.formInputData').find(':submit').prop( 'disabled', false );
            })              
          .catch(error => console.error('Error!', error.message));
        });
    });

</script>";
    
}
//

