<!--    <form class="new-search-sec" action="book.php" method="get" onsubmit="if(isallfilled(this)){ page.addiframe( '<?php echo HOST; ?>mapsapi.php?'+$(this).serialize()); };funcs.f1(this);return false;">
 -->
   <form class="new-search-sec" action="book.php" method="get" onsubmit="if(isallfilled(this)){ page.addiframe( '<?php echo HOST; ?>mapsapi.php?'+$(this).serialize());funcs.f1(this); };return false;">
    <div class="row">
     <div class="container">
      <div class="col-md-1">
      </div>
      <div class="col-md-11 col-sm-11 sec-tran bac" <?php echo ($page=='book'?'style="background-color:#cccccc;"':'');  ?> >
       <div class="row">
        <?php
           hidinp("city",getval($_SESSION["city"],$_ginfo["allcityiddict"]));
        ?>
        <div class="col-xs-12 col-sm-3 col-md-3 search-text pad-inpu" style="margin-top: 7px;">
         <input type="text" name="from" placeholder="From" class="text-from from" max="100" value="" id="pac-input" style="padding-right:10px;" autofocus />
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 search-text pad-inpu" style="margin-top: 7px;">
         <input type="text" name="to" placeholder="To" class="text-from from" max="100" id="pac-input2" style="padding-right:10px;" />
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 search-text pad-inpu" style="margin-top: 7px;">
         <input type="text" name="time" placeholder="<?php echo (get("time")==""?"ASAP":get("time")); ?>" class="text-from picup form_datetime1" max="100"  />
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 search-text pad-inpu" style="margin-top: 7px;  padding-right: 10px;">
         <button type="submit" id="but" class="global-input btn-ani btn-ani-4 btn-ani-4a hvr-icon-wobble-horizontal" style="width: 100%; font-size: 20px; font-weight: 500;">
          Let's go <img style="display:none;" src='photo/loading1.gif' />
         </button>
        </div>
       </div>
      </div>
     </div>
    </div>
   </form>
