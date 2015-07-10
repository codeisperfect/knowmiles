         <div class="row cab-box" data-filter="<?php echo $filter; ?>" data-filterpic="<?php echo $image; ?>" data-rating="<?php echo $rating; ?>" data-price="<?php echo $charge; ?>" >
          <div class="col-md-12 col-sm-12" style="font-size:80%"> <!-- Master Sector -->
           <div class="row">
            <div class= "col-xs-4 col-sm-4 col-md-4 col-lg-2 name-cab div-centering" align="center" style="margin-top:0; padding:10px;"> <!-- Company Name -->
             <span>
              <a href="<?php echo "company.php?cid=".$cid; ?>" style='color:black;' ><?php echo $Name; ?></a>
             </span>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-2 cad-pad div-centering" align="center" style="margin-top:0; padding:10px;"> <!-- Car Image -->
              <div class="row">
                <div class="col-xs-12"><img src="<?php echo $image; ?>" class="car-img" /></div>
                <div class="col-xs-12" style="text-align:center;">
                  <span>
                  <?php echo $TypeName; ?>
                  </span>
               </div>
              </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-2 rating div-centering" style="margin-top:0; padding:10px;" align="center"> <!-- Rating -->
              <div class="row">
                <div class="col-xs-12">
                  <p>
                    <?php
                    disp_rating($rating);
                    ?>
                  </p>
                </div>
                <div class="col-xs-12">
                  <p>
                    <?php echo $rating;?> Ratings.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-2 tooltip-options div-centering" align="center" style="margin-top:0; padding:10px;"> <!-- Offer -->
             <a  class="off-it" data-toggle="tooltip" data-placement="bottom" title="" style="<?php echo pit("display:none;", !$isoffer); ?>" >
              <h3>
                <span class="label label-info">
                 Offers!!!
                </span>
              </h3>
             </a>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-2 tooltip-options div-centering" style="margin-top:0; padding:10px;" align="center"> <!-- Cost -->
             <a class="off-it" data-toggle="tooltip" title="<?php echo $farebreak; ?>"  data-placement="top">
              <span class="rupee">
               <i class="fa fa-rupee">
               </i>
               <?php echo $charge; ?>
              </span>
             </a>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-2 div-centering tooltip-options " style="margin-top:0; padding:10px;" align="center"> <!-- Book Now -->
              <form method="post" action="<?php echo HOST."profile.php?tab=tabs2-pane2"; ?>" >
                <?php
                foreach($hidinps as $key=>$val){
                  hidinp($key,$val);
                }
                ?>
               <a  onclick="<?php if($islogin!=null){ ?>$(this).parent().submit();<?php } else { ?>$('#loginbutton').click();<?php } ?>" class="button book-nw" data-toggle="tooltip" title="<?php echo $islogin==null?"Login/Signup":"You cab is just 1 button ahead"; ?>"  data-placement="top"  >
                <i class="fa fa-right-arrow">
                </i>
                Book Now
               </a>
              </form>
            </div>
           </div>
          </div>
          <style>
            .div-centering {
              position: relative;
              top: 50%;
              transform: translateY(+20%);
            }
          </style>
         </div>
