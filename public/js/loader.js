$(document).ready(function(){
    $(".modal").modal();
    $(".parallax").parallax();
    $('.sidenav').sidenav();
});

function toggleModal() {
    var instance = M.modal.getInstance("#modal3");
    instance.open();
}

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.scrollspy');
    var instances = M.ScrollSpy.init(elems, options);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('.scrollspy').scrollSpy();
  });