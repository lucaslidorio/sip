  
$(document).ready(function(){
  //Mascara de telefones
  $(".telefone_fixo").inputmask("(99) 9999-9999"); 
  $(".telefone_celular").inputmask('(99) 9999[9]-9999');
  $(".cpf").inputmask("999.999.999-99");
  $(".cnpj").inputmask("99.999.999/9999-99");

  
  //Inicia o plugin select2 na onde possuir a classe select2
 // $('.select2').select2();
});
