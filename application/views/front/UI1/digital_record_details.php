<script type="text/javascript" src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/CombinedDashboard.js?v=14"></script>

<script>
    
jQuery(document).ready(function(e) {	
	setInterval( function(e){
	jQuery(".preloader").hide();
	}, 400);
})
</script>
<!----Middle section start ---->
<div class="middle-section dr-listing-middle metro">
  <div class="container">
    <div class="page-content dr-details">
      <h2 class="page-ttl">Digital record details</h2>
      <div class="dr-content">
        <div class="row cust-row">
          <div class="span5 dr-details-left">
            <div class="dr-logo"> <a href="#"><img width="326" src="<?php echo base_url();?>media/front/img/category-images/<?php echo $arr_digital_record_details['category_image'] ; ?>" alt="Photo Project"></a> </div>
            <div class="dr-timeline-notifications offset-top-25">
              <div class="single-notification"> <a class="notification_link" href="#">US court upholds LA condom law</a>
                <div class="notification-cont offset-top-5">
                  <p><a href="#"><img class="pull-left" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/dr3.png"></a> A US court rules that a law requiring porn actors in Los Angeles County to wear condoms does not infringe constitutional rights ...</p>
                </div>
              </div>
              <div class="single-notification"> <a class="notification_link" href="#">US court upholds LA condom law</a>
                <div class="notification-cont offset-top-5">
                  <p><a href="#"><img class="pull-left" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/dr4.png"></a> A US court rules that a law requiring porn actors in Los Angeles County to wear condoms does not infringe constitutional rights ...</p>
                </div>
              </div>
              <div class="single-notification"> <a class="notification_link" href="#">US court upholds LA condom law</a>
                <div class="notification-cont offset-top-5">
                  <p><a href="#"><img class="pull-left" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/dr1.png"></a> A US court rules that a law requiring porn actors in Los Angeles County to wear condoms does not infringe constitutional rights ...</p>
                </div>
              </div>
            </div>
          </div>
          <div class="span7 dr-desc">
            <div class="dr-desc-inn">
                <p> <a class="sub-ttl" href="#"><?php echo stripslashes($arr_digital_record_details["category_name"]) ; ?></a><?php echo stripslashes($arr_digital_record_details["page_description"]) ; ?> </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!----Middle section end-----> 