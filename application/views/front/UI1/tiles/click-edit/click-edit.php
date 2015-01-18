
<!---Metro css attchment---->
<link href="<?php echo base_url();?>media/front/UI-1-media/UI1/tiles/click-edit/css/metro-bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>media/front/UI-1-media/UI1/tiles/click-edit/css/metro-bootstrap-responsive.css" rel="stylesheet">
<link href="<?php echo base_url();?>media/front/UI-1-media/UI1/tiles/click-edit/css/MetroJs.css" rel="stylesheet">

<!---Custom css attchment---->
<link href="<?php echo base_url();?>media/front/UI-1-media/UI1/tiles/click-edit/css/main.css" rel="stylesheet">
<link href="<?php echo base_url();?>media/front/UI-1-media/UI1/tiles/click-edit/css/font-awesome.css" rel="stylesheet">


<!-- Load JavaScript Libraries -->

<script src="<?php echo base_url();?>media/front/UI-1-media/UI1/tiles/click-edit/js/MetroJs.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>media/front/UI-1-media/UI1/tiles/click-edit/js/jquery/jquery.widget.min.js"></script>
<script src="<?php echo base_url();?>media/front/UI-1-media/UI1/tiles/click-edit/js/jquery/jquery.mousewheel.js"></script>
<script src="<?php echo base_url();?>media/front/UI-1-media/UI1/tiles/click-edit/js/load-metro.js"></script>

<div class="metro">

    <div class="custom-tile-group cust-tilegroup-2 text-center tile-double click-edit"> 
        <!--Profile Tile:- Tile effect-PRofile pict editable  -->
         <?php if($user_account['profile_picture']!=""){
         $image = 'media/front/img/user-images/'.$user_account['profile_picture'];    
         }else{
         $image = 'media/front/UI-1-media/UI1/img/propf-pic.png';    
         }
         ?>
         
        <div class="live-tile tile-double editable-tile bottom-tiles" id="tile1" data-mode="flip" >
            
            <div class="front" style="background-image: url(<?php echo $image;?>)" >
                <div class="tile-status bg-dark opacity" id="msg">Me Tile</div>
            </div>
            <div class="back">
                <p>
                    <label for="text">Me Tile:</label>
                    <textarea onclick="EditText()" id="text" value=" Click to edit" ></textarea>
                   <!--<input id="text" type="text" /> -->
                    <input type="button" value="done" class="done" />
                </p>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            // Script to edit tile
            var $tile1 = null;
            var frontFaceClick = function(event) {


                $("#text").val($("#msg").text());
                if ($tile1 == null)
                    $tile1 = $("#tile1").liveTile({repeatCount: 0, delay: 0});
                else
                    $tile1.liveTile('play');
            }
            var backFaceClick = function(event) {
                event.stopPropagation();
            }
            var doneClick = function(event) {


                $("#msg").text($("#text").val());
                $tile1.liveTile('play');
            }
            $("#tile1").find(">.front").bind("click", frontFaceClick);
            $("#tile1").find(">.back").bind("click", backFaceClick);
            $(".done").bind("click", doneClick);
        });


        function EditText() {
            $('#text').focus();
        }


    </script>

</div>