

<div class="middle-section">

<div class=" contactus offset-top-35">
<div class="cms-cont">
	<h2>
        <?php
            if ($arr_cms[0]['page_title'] != '') {
                echo ucwords(str_replace('-', ' ', stripslashes($arr_cms[0]['page_title'])));
            }
            ?></h2>
    <hr>
    <h4><?php echo stripslashes($arr_cms[0]['page_content']); ?></h4>
    

 
</div>
<div class="clearfix"></div>
</div>


</div>

<script>
$( document ).ready(function() {
// Script to edit tile
var $tile1 = null;
var frontFaceClick = function (event) {
    $("#text").val($("#msg").text());
    if ($tile1 == null)
        $tile1 = $("#tile1").liveTile({ repeatCount: 0, delay: 0 });
    else
        $tile1.liveTile('play');
}   
var backFaceClick = function (event) {
    event.stopPropagation();
}    
var doneClick = function (event) {
    $("#msg").text($("#text").val());
    $tile1.liveTile('play');
}    
$("#tile1").find(">.front").bind("click", frontFaceClick);
$("#tile1").find(">.back").bind("click", backFaceClick);
$(".done").bind("click", doneClick);
});

//Script for tiles 
$(".live-tile, .flip-list").not(".exclude").liveTile();
	$(".live-tile").liveTile();
	$( ".tiles" ).sortable();
	$( ".tiles" ).disableSelection();

</script> 

</body>
</html>




