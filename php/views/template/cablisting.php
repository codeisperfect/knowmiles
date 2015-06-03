         <div class="row cab-box" data-filter="<?php echo $filter; ?>" data-filterpic="<?php echo $image; ?>" data-rating="<?php echo $rating; ?>" data-price="<?php echo $charge; ?>" >
          <div class="col-md-12 col-sm-12">
           <div class="row">
            <div class="col-md-2 name-cab" align="center" >
             <span>
              <?php echo $Name; ?>
             </span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-4 cad-pad" align="center" >
             <img src="<?php echo $image; ?>" class="car-img" />
             <span>
              <?php echo $TypeName; ?>
             </span>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ratin">
             <p class="per-pd">
              <?php
              disp_rating($rating/2);
              ?>
              Ratings(<?php echo $rating;?>)
             </p>
            </div>
            <div class="col-md-2 col-sm-1 col-xs-12 ll tooltip-options" style="" >
             <a  class="off-ti" data-toggle="tooltip" data-placement="bottom" title="" style="<?php echo $isoffer?"display:none;":""; ?>" >
              <span class="offer">
               Offers!!!
              </span>
             </a>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-12 ll tooltip-options">
             <a class="off-ti" data-toggle="tooltip" title="<?php echo $day_waiting_charge>0?"Waiting Charge Rs.  ".$day_waiting_charge." /min":"No waiting charge"; ?>"  data-placement="top">
              <span class="rupee">
               <i class="fa fa-rupee">
               </i>
               <?php echo $charge; ?>
              </span>
             </a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ll-l">
              <form method="post" action="<?php echo HOST."profile.php?tab=tabs2-pane2"; ?>" >
                <?php
                foreach($hidinps as $key=>$val){
                  hidinp($key,$val);
                }
                ?>
               <a onclick="$(this).parent().submit();" class="button book-nw">
                <i class="fa fa-right-arrow">
                </i>
                Book Now
               </a>
              </form>
            </div>
           </div>
          </div>
         </div>
