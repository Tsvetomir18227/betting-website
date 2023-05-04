console.log("Hello from your JavaScript file");


$(document).ready(function(){
    $('.button').on('click', function(){
      var isActive = $(this).hasClass('active');
      // remove active class from all buttons in the same row
      $(this).closest('tr').find('.button').removeClass('active');
      // add active class to the clicked button if it wasn't already active
      if (!isActive) {
        $(this).addClass('active');
      }
    });
  });


  
  
  
  