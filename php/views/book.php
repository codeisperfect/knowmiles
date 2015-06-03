<body style="" >
<?php
  load_view("template/header.php",$inp);
?>
<main>
 <div class="container">
  <div class="row" style="background-color:none;">
  <?php
    load_view("locsearchform.php");
  ?>
  </div>
  <div class="row">
   <div class="col-md-9 col-sm-9 col-xs-12">
    <div class="row" style="" >
     
     <form style="padding-top:0% !important" id="cartypefilter" >
      <div class="col-md-2 col-sm-8">
       <h4 style="padding-top: 18px; color: #00A0E1">
        Car Type
       </h4>
      </div>
      <?php
      foreach($carfilters as $i=>$val){
      ?>
      <div class="col-md-2 col-sm-8 col-xs-12">
       <div class="col-md-12 col-sm-12 col-xs-4" style="margin-top: 7px;">
        <img src="<?php echo $val; ?>" alt="auto" />
       </div>
       <div class="col-md-12 col-sm-4 col-xs-4">
        <input type="checkbox" class="checkbox" onclick="filterpic();" checked='' data-filterpic="<?php echo $val; ?>" />
       </div>
       <div>
       </div>
      </div>
      <?php
      }
      ?>
     </form>
    </div>


    <div class="row"  >
     <div class="col-md-12 col-sm-12">
      <div class="tabbable">
       <ul class="nav nav-tabs">
        <li class="active tab-li col-md-4  col-sm-4 col-xs-12 pad-imp">
         <a onclick="carresultsort('price');" href="#" data-toggle="tab" class="lef-tab teb">
          Cheapest
         </a>
        </li>
        <li class="tab-li col-md-4  col-sm-4 col-xs-12 pad-imp">
         <a onclick="carresultsort('price');" href="#" data-toggle="tab" class="lef-tab teb">
          Closest
         </a>
        </li>
        <li class="tab-li col-md-4  col-sm-4 col-xs-12 pad-imp">
         <a onclick="carresultsort('rating');" href="#" data-toggle="tab" class="lef-tab teb">
          Best Rated
         </a>
        </li>
       </ul>
       <div class="tab-content">
        <div class="tab-pane active" id="tabs1-pane1">
          <div id="carlisting" >
          <?php
          foreach($carresult as $i=>$row){
            load_view("template/cablisting.php",$row);
          }
          ?>
          </div>
        </div>
        <div class="tab-pane" id="tabs1-pane2">
         <div class="row cab-box">


          <div class="col-md-12 col-sm-12">
           <div class="row">
            <div class="col-md-2 name-cab">
             <span>
              Ola Cab
             </span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-4 cad-pad">
             <img src="images/car.png" class="car-img" />
             <span>
              Mini/HatchBack
             </span>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ratin">
             <span>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
             </span>
             <p class="per-pd">
              Ratings(7)
             </p>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options">
             <a href="#" class="off-ti" data-toggle="tooltip" data-placement="top" title="<h3>'I am Header2333</h3>" >
              <span class="offer">
               Offers!!!1123
              </span>
             </a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options">
             <a href="#" class="off-ti" data-toggle="tooltip" title="<h3>'I am Header2'</h3>"  data-placement="bottom">
              <span class="rupee">
               <i class="fa fa-rupee">
               </i>
               150
              </span>
             </a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ll-l">
             <a href="#" class="button book-nw">
              <i class="fa fa-right-arrow">
              </i>
              Book Now
             </a>
            </div>
           </div>
          </div>

         </div>
         <div class="row cab-box">
          <div class="col-md-12 col-sm-12">
           <div class="row">
            <div class="col-md-2 name-cab">
             <span>
              Meru
             </span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-4 cad-pad">
             <img src="images/car.png" class="car-img" />
             <span>
              Mini/HatchBack
             </span>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ratin">
             <span>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
             </span>
             <p class="per-pd">
              Ratings(7)
             </p>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options">
             <a href="#" class="off-ti" data-toggle="tooltip" data-placement="bottom" title="<h3>'I am Header2'</h3>" >
              <span class="offer">
               Offers!!!
              </span>
             </a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options">
             <a href="#" class="off-ti" data-toggle="tooltip" title="<h3>'I am Header2'</h3>"  data-placement="bottom">
              <span class="rupee">
               <i class="fa fa-rupee">
               </i>
               138
              </span>
             </a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ll-l">
             <a href="#" class="button book-nw">
              <i class="fa fa-right-arrow">
              </i>
              Book Now
             </a>
            </div>
           </div>
          </div>
         </div>
         <div class="row cab-box">
          <div class="col-md-12 col-sm-12">
           <div class="row">
            <div class="col-md-2 name-cab">
             <span>
              Uber
             </span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-4 cad-pad">
             <img src="images/car.png" class="car-img" />
             <span>
              Mini/HatchBack
             </span>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ratin">
             <span>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
             </span>
             <p class="per-pd">
              Ratings(7)
             </p>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options">
             <a href="#" class="off-ti" data-toggle="tooltip" data-placement="bottom" title="<h3>'I am Header2'</h3>"  >
              <span class="offer">
               Offers!!!
              </span>
             </a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options">
             <a href="#" class="off-ti" data-toggle="tooltip" title="<h3>'I am Header2'</h3>"  data-placement="bottom">
              <span class="rupee">
               <i class="fa fa-rupee">
               </i>
               180
              </span>
             </a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ll-l">
             <a href="#" class="button book-nw">
              <i class="fa fa-right-arrow">
              </i>
              Book Now
             </a>
            </div>
           </div>
          </div>
         </div>
        </div>
        <div class="tab-pane" id="tabs1-pane3">
         <div class="row cab-box">
          <div class="col-md-12 col-sm-12">
           <div class="row">
            <div class="col-md-2 name-cab">
             <span>
              Uber
             </span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-4 cad-pad">
             <img src="images/car.png" class="car-img" />
             <span>
              Mini/HatchBack
             </span>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ratin">
             <span>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
             </span>
             <p class="per-pd">
              Ratings(7)
             </p>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options">
             <a href="#" class="off-ti" data-toggle="tooltip" data-placement="bottom" title="<h3>'I am Header2'</h3>" >
              <span class="offer">
               Offers!!!
              </span>
             </a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options">
             <a href="#" class="off-ti" data-toggle="tooltip" title="<h3>'I am Header2'</h3>"  data-placement="bottom">
              <span class="rupee">
               <i class="fa fa-rupee">
               </i>
               180
              </span>
             </a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ll-l">
             <a href="#" class="button book-nw">
              <i class="fa fa-right-arrow">
              </i>
              Book Now
             </a>
            </div>
           </div>
          </div>
         </div>
         <div class="row cab-box">
          <div class="col-md-12 col-sm-12">
           <div class="row">
            <div class="col-md-2 name-cab">
             <span>
              Meru
             </span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-4 cad-pad">
             <img src="images/car.png" class="car-img" />
             <span>
              Mini/HatchBack
             </span>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ratin">
             <span>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
             </span>
             <p class="per-pd">
              Ratings(7)
             </p>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options">
             <a href="#" class="off-ti" data-toggle="tooltip" data-placement="bottom" title="<h3>'I am Header2'</h3>"  >
              <span class="offer">
               Offers!!!
              </span>
             </a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options">
             <a href="#" class="off-ti" data-toggle="tooltip" title="<h3>'I am Header2'</h3>" data-placement="bottom">
              <span class="rupee">
               <i class="fa fa-rupee">
               </i>
               138
              </span>
             </a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ll-l">
             <a href="#" class="button book-nw">
              <i class="fa fa-right-arrow">
              </i>
              Book Now
             </a>
            </div>
           </div>
          </div>
         </div>
         <div class="row cab-box">
          <div class="col-md-12 col-sm-12">
           <div class="row">
            <div class="col-md-2 name-cab">
             <span>
              Ola Cab
             </span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-4 cad-pad">
             <img src="images/car.png" class="car-img" />
             <span>
              Mini/HatchBack
             </span>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ratin">
             <span>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
              <i class="fa fa-star">
              </i>
             </span>
             <p class="per-pd">
              Ratings(7)
             </p>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options">
             <a href="#" class="off-ti" data-toggle="tooltip" data-placement="bottom" title="<h3>'I am Header2'</h3>" >
              <span class="offer">
               Offers!!!
              </span>
             </a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ll tooltip-options">
             <a href="#" class="off-ti" data-toggle="tooltip" title="<h3>'I am Header2'</h3>" data-placement="bottom">
              <span class="rupee">
               <i class="fa fa-rupee">
               </i>
               150
              </span>
             </a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 ll-l">
             <a href="#" class="button book-nw">
              <i class="fa fa-right-arrow">
              </i>
              Book Now
             </a>
            </div>
           </div>
          </div>
         </div>
        </div>
       </div>
       
      </div>
     </div>
    </div>
   </div>
   <div class="col-md-3 col-sm-3 col-xs-12" style="margin-top:70px;">
    <div id="map-canvas">
    </div>
   </div>
  </div>
 </div>
</main>
