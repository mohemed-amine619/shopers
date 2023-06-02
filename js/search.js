var search = document.getElementById('search');
search.addEventListener('keyup',function(){
  var result, div, prix,input,filter, txtValue;
  input= document.getElementById('search');
  filter = input.value.toUpperCase();
  div = document.querySelectorAll('#oop');
  result=0;
  for (i = 0; i < div.length; i++) {
    div2 = div[i].getElementsByTagName('div')[1];
    prix = div2.getElementsByTagName('h5')[0];
    txtValue = prix.textContent || prix.innerText;
    if(result !== div.length){
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      div[i].style.display = "";
    } else {
      div[i].style.display = "none"
      result += 1;
    }
  }else{
     break;
  }
  if(result == div.length){
    document.getElementById('no').innerHTML = "aucun resultat pour votre recherche !!";
  }
  else{
    document.getElementById('no').innerHTML = "";
  }
  }
  })
