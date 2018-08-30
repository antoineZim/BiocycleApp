<?php
$denrees = ["Legumes", "Fruits", "Pains", "Transf", "Autres"];
$form = "";
foreach($denrees as $key => $denree){
    $form .= '<form name="submit-to-google-sheet" id="'.strtolower($denree).'">'
            . ' <div id="'. strtolower($denree).'Input">'
            . '     <input type="text" value="" id="'.strtolower($denree).'" name="'.strtolower($denree).'" placeholder="'.$denree.' (g)" required />'
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