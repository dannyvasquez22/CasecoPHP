$(document).ready(function () {
  var trigger = $('.hamburger'),
      overlay = $('.overlay'),
     isClosed = false;

    trigger.click(function () {
      hamburger_cross();      
    });

    function hamburger_cross() {
      if (isClosed == true) {          
        overlay.hide();
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        isClosed = false;
      } else {   
        overlay.show();
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        isClosed = true;
      }
  }
  
  $('[data-toggle="offcanvas"]').click(function () {
    $('#wrapper').toggleClass('toggled');
  });  


  $('.menu').addClass('original').clone().insertAfter('.menu').addClass('cloned').css('position','fixed').css('top','0').css('margin-top','0').css('z-index','500').removeClass('original').hide();

  scrollIntervalID = setInterval(stickIt, 10);

  function stickIt() {
    var orgElementPos = $('.original').offset();
    orgElementTop = orgElementPos.top;               

    if ($(window).scrollTop() >= (orgElementTop)) {
      // Al bajar en la pagina se va clonando el menu top, el cual cuenta con sus mismas caracteristicas.  
      orgElement = $('.original');
      coordsOrgElement = orgElement.offset();
      leftOrgElement = coordsOrgElement.left;  
      widthOrgElement = orgElement.css('width');
      $('.cloned').css('left',leftOrgElement+'px').css('top',0).css('width',widthOrgElement).show();
      $('.original').css('visibility','hidden');
    } else {
      // Para mostrar el original cuando vuelva a la posicion inicial, y oculte el clonado.
      $('.cloned').hide();
      $('.original').css('visibility','visible');
    }
  }

  $('#wrapper').scrollspy({target: ".menu", offset: 50});

});