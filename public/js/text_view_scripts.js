/*
* Scripts to handle the showing and hiding of the menu and
* output area of the Lorem Ipsum Text Generator
*
*/

$(document).ready(function(){
  /*
  If output is being shown, menu starts hidden (up).
  Otherwise the menu starts visible (down).
  */
  var display = $('#ouput-div').css('display');
  if (display != 'none'){
    $('#main_form').slideUp();
    $('#open-form').show();
  } else {
    $('#main_form').slideDown();
    $('#open-form').hide();
  }

  /*
   When the top alert bar is clicked, toggle the visibility
   of the main form. Makes it slightly easier to get to the results.
  */
  $("#open-form").click(function(){
    $("#main_form").slideToggle();
  });

  /*
  Make the show/hide form bar change color on mouse enter/leave
  */
  $("#open-form").mouseenter(function(){
    $(this).removeClass("alert-info");
    $(this).addClass("alert-success");
  });

  $("#open-form").mouseleave(function(){
    $(this).removeClass("alert-success");
    $(this).addClass("alert-info");
  });
});
