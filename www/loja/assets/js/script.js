$(function(){

  $( "#slider-range" ).slider({
    range: true,
    min: 0,
    max: maxSlider,
    values: sliderValues,
    slide: function( event, ui ) {
      $( "#amount" ).val( "R$" + ui.values[ 0 ] + " - R$" + ui.values[ 1 ] );
    }
  });

  $( "#amount" ).val( "R$" + $( "#slider-range" ).slider( "values", 0 ) +
    " - R$" + $( "#slider-range" ).slider( "values", 1 ) );



  $('.filterarea').find('input').on('change', function(){

    $('.filterarea form').submit();

  });

});
