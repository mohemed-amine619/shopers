// counter for produit par categorie
var qte , add ,remove,int;
int = 0;
qte = document.getElementById('qty');
add = document.getElementById('add');
remove = document.getElementById('remove');
qte.value = 1;
add.addEventListener('click', function(){
    if(int <= qte.value){
        if(int < qte.getAttribute('max'))
    int+=1;
    qte.value = int;
    }
})
remove.addEventListener('click',function(){
    if(int > 0){
    int-=1;
    qte.value = int;
    }    
})
