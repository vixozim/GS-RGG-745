
  (function ($) {
  
  "use strict";

    // AOS ANIMATIONS
    AOS.init();

    // NAVBAR
    $('.navbar-nav .nav-link').click(function(){
        $(".navbar-collapse").collapse('hide');
    });

    // NEWS IMAGE RESIZE
    function NewsImageResize(){
      $(".navbar").scrollspy({ offset: -76 });
      
      var LargeImage = $('.large-news-image').height();

      var MinusHeight = LargeImage - 6;

      $('.news-two-column').css({'height' : (MinusHeight - LargeImage / 2) + 'px'});
    }

    $(window).on("resize", NewsImageResize);
    $(document).on("ready", NewsImageResize);

    $('a[href*="#"]').click(function (event) {
      if (
        location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        if (target.length) {
          event.preventDefault();
          $('html, body').animate({
            scrollTop: target.offset().top - 66
          }, 1000);
        }
      }
    });
    
  })(window.jQuery);

  
  
    /* CONTACT FORM */

    function contactValidator() {
      var contact_form = $( "#contact-form" );
      if ( contact_form < 1 ) {
          return;
      }
      contact_form.validator();
      // when the form is submitted
      contact_form.on( "submit", function ( e ) {
          // if the validator does not prevent form submit
          if ( !e.isDefaultPrevented() ) {
              var url = "contact.php";
  
              // POST values in the background the the script URL
              $.ajax( {
                  type : "POST",
                  url : url,
                  data : $( this ).serialize(),
                  success : function ( data ) {
                      // data = JSON object that contact.php returns
  
                      // we recieve the type of the message: success x danger and apply it to the
                      var messageAlert = "alert-" + data.type;
                      var messageText = data.message;
  
                      // let's compose Bootstrap alert box HTML
                      var alertBox = "<div class=\"alert " + messageAlert + " alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + messageText + "</div>";
  
                      // If we have messageAlert and messageText
                      if ( messageAlert && messageText ) {
                          // inject the alert to .messages div in our form
                          contact_form.find( ".messages" ).html( alertBox );
                          // empty the form
                          contact_form[ 0 ].reset();
                      }
                      setTimeout( function () {
                          contact_form.find( ".messages" ).html( "" );
                      }, 3000 );
  
                  },
                  error : function ( error ) {
                      console.log( error );
                  },
              } );
              return false;
          }
      } );
  }
