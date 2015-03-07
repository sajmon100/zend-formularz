var res;
$(document).ready(function(){
  res = false;
    $('form#Formularz #email').on('keyup change', function(){
       ajaxSubmit();
      });
    $('form#Formularz').submit(function(){return res;})
});

function ajaxSubmit(){ console.log ($( "form#Formularz" ).serialize());
  $.post( "/zend-formularz/public/index/ajax/", $( "form#Formularz" ).serialize(), function(result){
    $('#email').parent().find('span.info').remove();
    if (result != '0') {
      res = true
      $('#email').parent().append('<span class="info" style="color:green;"> Podany adres email jest wolny</span>');
    }
    else {
      res = false;
      $('#email').parent().append('<span class="info" style="color:red;"> Podany adres email jest zajęty</span>');
    }
    } );
  
  return res;
}