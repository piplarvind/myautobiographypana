<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $header['title'];?></title>
    <meta name="keywords" content="<?php echo $header['keywords'];?>">
	<meta name="description" content="<?php echo $header['description'];?>">
	<link rel="stylesheet" href="<?php echo base_url();?>media/front/css/bootstrap.css" media="screen">
	<script src="<?php echo base_url();?>media/front/js/jquery-1.10.2.min.js"></script>

<script>
jQuery(document).ready(function(e) {
    jQuery(".panel-heading").bind("click",handleClickOfQuestion);
	 jQuery(".panel-heading").css("cursor","pointer");
});

function handleClickOfQuestion()
{
	
	if(jQuery(this).find(".btn-faq").hasClass("glyphicon-chevron-right"))
	{
		jQuery(this).next(".panel-body").hide().removeClass("hidden").show("fast");
		jQuery(this).find(".btn-faq").removeClass("glyphicon-chevron-right").addClass("glyphicon-chevron-down");
	}
	else
	{
		jQuery(this).next(".panel-body").addClass("hidden");
		jQuery(this).find(".btn-faq").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-right");
	}
	
	
}
</script>
</head>
<body>
<div class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <div class="navbar-brand">Page Header</div>
        </div>
     </div>
</div>
<div class="container">

 <div class="page-header">
          <div class="row">
            <div class="col-lg-12">
              <h1 id="buttons">Frequently Asked Questions</h1>
            </div>
          </div>
        </div>
    
    
    <div>
   <?php foreach($categorized_faqs as $category=>$faqs){?>
<section>
<legend><?php echo $category;?></legend>
<div class="panel-group">
<?php
foreach($faqs as $faq){
?>
<div class="panel panel-default">
<div class="panel-heading"><div class="row"><div class="col-lg-11"><?php echo $faq['question'];?></div><div class="col-lg-1 text-right"><a  href="javascript:void(0)"><span class="glyphicon glyphicon-chevron-right btn-faq" ></span></a></div></div></div>
<div class="panel-body hidden"><?php echo $faq['answer'];?></div>
</div>
<?php
}
?>
</div>
</section>
<br>
<?php
}
?>
    
</div>

</div>
<footer><br />
<br />
<hr />
<div class="container">
<div class="row">
          <div class="col-lg-12">
            <p>Made by <a href="http://www.panaceatek.com">Panacea Infotech Pvt. Ltd</a>.

          </div>
        </div>
        </div>
</footer>
</body>
</html>