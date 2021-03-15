$(document).ready(function(){
    //Mascara de telefones
    $(".telefone_fixo").inputmask("(99) 9999-9999"); 
    $(".telefone_celular").inputmask('(99) 9999[9]-9999');
   

    //Inicia o plugin select2 na onde possuir a classe select2
    $('.select2').select2();
  });