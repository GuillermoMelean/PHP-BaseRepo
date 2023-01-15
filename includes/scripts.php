
<!-- JavaScripts
============================================= -->
<script src="/js/jquery.js"></script>
<script src="/js/plugins.min.js"></script>

<!-- Bootstrap Select Plugin -->
<script src="/js/components/bs-select.js"></script>

<!-- Bootstrap Switch Plugin -->
<script src="/js/components/bs-switches.js"></script>

<!-- Range Slider Plugin -->
<script src="/js/components/rangeslider.min.js"></script>

<!-- Footer Scripts
============================================= -->
<script src="/js/functions.js"></script> 
<script src="js/jquery.backstretch.js"></script> 


 

<script>
  (function ($) {
  // Begin jQuery
  $(function () {
    // DOM ready
    // If a link has a dropdown, add sub menu toggle.
    $("nav ul li a:not(:only-child)").click(function (e) {
      $(this).siblings(".nav-dropdown").toggle();
      // Close one dropdown when selecting another
      $(".nav-dropdown").not($(this).siblings()).hide();
      e.stopPropagation();
    });
    // Clicking away from dropdown will remove the dropdown class
    $("html").click(function () {
      $(".nav-dropdown").hide();
    });
    // Toggle open and close nav styles on click
    $("#nav-toggle").click(function () {
      $("nav ul").slideToggle();
    });
    // Hamburger to X toggle
    $("#nav-toggle").on("click", function () {
      this.classList.toggle("active");
    });
  }); // end DOM ready
})(jQuery); // end jQuery 
</script>


<script>
  jQuery(document).ready(function($) {
    'use strict';
    jQuery('body').backstretch([ 
        "assets/bg/bg2.jpg", 
        "assets/bg/bg4.jpg",
        "assets/bg/bg5.jpg"
    ], {
        duration: 60000,
        fade: 500,
        alignY: true
    });
});
</script>

