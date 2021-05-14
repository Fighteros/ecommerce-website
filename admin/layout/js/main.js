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

    // change active as focused
    $('ul.navy li').on('click', function (){
        $(this).parent().find('li.active').removeClass('active');
        $(this).addClass('active');
    });

    // add asterisk on Required Fields
    $('input').each(function (){
        if($(this).attr('required') === 'required'){
            $(this).after('<span class="asterisk"><i class="fa fa-asterisk"></i></span>');
        }
    });

    // change icon and make password visible
    $('.show-pass').on('click', function() {
        $(this).toggleClass('fa-eye-slash fa-eye');
        var passSpan = $($(this).attr('toggle'));
        if(passSpan.attr('type') == 'password'){
            passSpan.attr('type', 'text');
        }
        else {
            passSpan.attr('type', 'password')
        }

    });
});
