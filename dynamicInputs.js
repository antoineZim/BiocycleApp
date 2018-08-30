    var elementPattern = /^livreurDiv(\d+)$/;
    var deletePattern = /^delete(\d+)$/;
    var parentDiv = "";
    var childDiv = "";
function ajouterElement(elemName)
{
        if(elemName === 'biocycleur' ){
            parentDiv = 'allLivreursDiv';
            childDiv = 'livreurDiv';
            var Conteneur = document.getElementById(parentDiv);
            if(Conteneur)
            {
                    Conteneur.appendChild(creerElementBiocycleur(dernierElement() + 1));
            }
        }
        else if(elemName === 'collecte' ){
            parentDiv = 'allCollectesDiv';
            childDiv = 'collecteDiv';
            var Conteneur = document.getElementById(parentDiv);
            if(Conteneur)
            {
                    Conteneur.appendChild(creerElementBiocycleur(dernierElement() + 1));
            }
        }
}


function creerElementCollecte(ID)
{
  var Conteneur = document.createElement('div');
  Conteneur.setAttribute('id', childDiv + ID);
  var Input = document.createElement('input');
  Input.setAttribute('type', 'text');
  Input.setAttribute('name', 'prenom' + ID);
  Input.setAttribute('id', 'prenom' + ID);
  Input.setAttribute('placeHolder','Prénom');
  var Delete = document.createElement('input');
  Delete.setAttribute('type', 'button');
  Delete.setAttribute('value', 'Supprimer');
  Delete.setAttribute('id', 'delete' + ID);
  Delete.onclick = supprimerElement;
  Conteneur.appendChild(Input);
  Conteneur.appendChild(Delete);
  return Conteneur;
}

function creerElementBiocycleur(ID)
{
    var Conteneur = document.createElement('div');
    Conteneur.setAttribute('id', childDiv + ID);
    var Input = document.createElement('input');
    Input.setAttribute('type', 'text');
    Input.setAttribute('name', 'prenom' + ID);
    Input.setAttribute('id', 'prenom' + ID);
    Input.setAttribute('placeHolder','Prénom');
    var Delete = document.createElement('input');
    Delete.setAttribute('type', 'button');
    Delete.setAttribute('value', 'Supprimer');
    Delete.setAttribute('id', 'delete' + ID);
    Delete.onclick = supprimerElement;
    Conteneur.appendChild(Input);
    Conteneur.appendChild(Delete);
    return Conteneur;
}

function dernierElement()
{
  var Conteneur = document.getElementById(parentDiv), n = 0;
  if(Conteneur)
  {
    var elementID, elementNo;
    if(Conteneur.childNodes.length > 0)
    {
      for(var i = 0; i < Conteneur.childNodes.length; i++)
      {
        // Ici, on vérifie qu'on peut récupérer les attributs, si ce n'est pas possible, on renvoit false, sinon l'attribut
        elementID = (Conteneur.childNodes[i].getAttribute) ? Conteneur.childNodes[i].getAttribute('id') : false;
        if(elementID)
        {
          elementNo = parseInt(elementID.replace(elementPattern, '$1'));
          if(!isNaN(elementNo) && elementNo > n)
          {
            n = elementNo;
          }
        }
      }
    }
  }
  return n;
}


function supprimerElement()
{
  var Conteneur = document.getElementById(parentDiv);
  var n = parseInt(this.id.replace(deletePattern, '$1'));
  if(Conteneur && !isNaN(n))
  {
    var elementID, elementNo;
    if(Conteneur.childNodes.length > 0)
    {
      for(var i = 0; i < Conteneur.childNodes.length; i++)
      {
        elementID = (Conteneur.childNodes[i].getAttribute) ? Conteneur.childNodes[i].getAttribute('id') : false;
        if(elementID)
        {
          elementNo = parseInt(elementID.replace(elementPattern, '$1'));
          if(!isNaN(elementNo) && elementNo  === n)
          {
            Conteneur.removeChild(Conteneur.childNodes[i]);
            updateElements(); // A supprimer si tu ne veux pas la màj
            return;
          }
        }
      }
    }
  }  
}





function updateElements()
{
  var Conteneur = document.getElementById(parentDiv), n = 0;
  if(Conteneur)
  {
    var elementID, elementNo;
    if(Conteneur.childNodes.length > 0)
    {
      for(var i = 0; i < Conteneur.childNodes.length; i++)
      {
        elementID = (Conteneur.childNodes[i].getAttribute) ? Conteneur.childNodes[i].getAttribute('id') : false;
        if(elementID)
        {
          elementNo = parseInt(elementID.replace(elementPattern, '$1'));
          if(!isNaN(elementNo) )
          {
            n++;
            Conteneur.childNodes[i].setAttribute('id', childDiv + n);
            document.getElementById('prenom' + elementNo).setAttribute('name', 'prenom' + n);
            document.getElementById('prenom' + elementNo).setAttribute('id', 'prenom' + n);
            //le premier element ne peut pas être supprimé
            if(elementNo !== 1)
                document.getElementById('delete' + elementNo).setAttribute('id', 'delete' + n);
          }
        }
      }
    }
  }
}


