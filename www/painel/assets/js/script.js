$(function(){

  $('.p_new_image').on('click', function(e){
    e.preventDefault();

    $('.products_files_area').append(`<input type='file' name='images[]' style='margin-bottom:5px;'/>`);


  });

});
