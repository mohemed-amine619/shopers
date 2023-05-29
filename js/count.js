$('.counter-add').click(function(e){
   let qte = $(e.currentTarget).siblings('#qty');
   qtv = parseInt(qte.val())+1;
   qte.val(qtv);
   
})
$('.counter-remove').click(function(e){
    let qte = $(e.currentTarget).siblings('#qty');
    qtv = parseInt(qte.val())-1;
    if(qtv < 0){
        qtv = 0;
    }
    qte.val(qtv);
    
 })