// on document ready
$(function(){
   'use strict';

   // hide placeholder on form focus and return it on return
    $('[placeholder]').focus(function (){
      $(this).attr('placeholder-text', $(this).attr('placeholder'));
      $(this).attr('placeholder', '');
    }).blur(function (){
       $(this).attr('placeholder', $(this).attr('placeholder-text'));
    });
});
