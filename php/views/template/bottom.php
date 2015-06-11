<script type='text/javascript' src='wp-content/themes/woodshed/assets/js/plugins.min.js'></script>
<script type='text/javascript' src='wp-content/themes/woodshed/assets/js/scripts.min.js'></script>
<script type='text/javascript' src='wp-includes/js/comment-reply.min.js'></script>
<script src="lightbox/jquery.fs.boxer.js"></script>
<script>
      $(document).ready(function() {
        $(".boxer").not(".retina, .boxer_fixed, .boxer_top, .boxer_format, .boxer_mobile, .boxer_object").boxer();

        $(".boxer.boxer_fixed").boxer({
          fixed: true
        });

        $(".boxer.boxer_top").boxer({
          top: 50
        });

        $(".boxer.retina").boxer({
          retina: true
        });

        $(".boxer.boxer_format").boxer({
          formatter: function($target) {
            return '<h3>' + $target.attr("title") + "</h3>";
          }
        });

        $(".boxer.boxer_object").click(function(e) {
          e.preventDefault();
          e.stopPropagation();
        });
        $(".boxer.boxer_mobile").boxer({
          mobile: true
        });
      });
    </script>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('a[href^="#"]').click(function(){  
        var the_id = $(this).attr("href");  
        $('html, body').animate({  
            scrollTop:$(the_id).offset().top  
        }, 'slow');  
        return false;  
    });

//    $(".form_datetime1").datetimepicker({format: 'yyyy-mm-dd hh:ii', forceParse: true});
    
    var dateToday=new Date();
    $(".form_datetime1").datetimepicker({
      format: 'yyyy-mm-dd hh:ii', 
      forceParse: true,
      minDate:dateToday,
     onSelect: function(selectedDate) {
        var option = this.id == "from" ? "minDate" : "maxDate",
          instance = $(this).data("datepicker"),
           date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
       dates.not(this).datepicker("option", option, date);
    }});


  </script>
<script src="js/jquery.simplePopup.js" type="text/javascript"></script>
<?php

?>


<script type="text/javascript">

$(document).ready(function(){
    $('.show1').click(function(){
  $('#pop1').simplePopup();
    });
  
    $('.show2').click(function(){
  $('#pop2').simplePopup();
    });  
  
});

</script>

<?php
  addmyjs();
//  addall_js(array("js/mohit.js","js/mohitlib.js","js/lib.js","", "js/main.js"));
?>

</body>
</html>
