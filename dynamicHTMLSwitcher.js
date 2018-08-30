/*
 * parentDiv contient le nom de la balise enrobant le formulaire modifiable
 * les modifications dynamiques sont faites a l interrieur 
 */
var PATH = "formulaires/";
var parentDiv = "";

/*
 * charge un fichier HTML a partir d un fichier <elemName>.php
 */

function loadHTMLByFileName(elemName)
{
    $.get("formulaires.php", function(data){
        $(".dynamicForms").html(data);
    });
}

function displayOnlyDivInClass(divToShow){
    $(".dynamicForms").each(function (){
        console.log($(this).attr('style'));

        if($(this).is("."+divToShow)){
            $(this).css('display', 'inline-block');
        } else {
            $(this).css('display', 'none');
        }
    });

}