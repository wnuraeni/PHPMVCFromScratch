$(document).ready(function(){
  var link = $('#reg_link');
  var box = $('#registerbox');
  var form = $('#register_form');  
  link.removeAttr('link');
  link.mouseup(function(login){
     box.toggle();
     link.toggleClass('active');
  });
  form.mouseup(function(){
      return false;
  });
 $(this).mouseup(function(login){
      if(!($(login.target).parent('#link').length > 0)){
          link.removeClass('active');
          box.hide();
      }
  });
});