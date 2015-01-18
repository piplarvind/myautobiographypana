<div class="metro">
    <div class="custom-tile-group cust-tilegroup-1 text-center"> 
        <!-- DR-Tile:- Mango Flip List that triggers every 3 seconds -->
        
        <?php 
        $user_account = $this->session->userdata('user_account');
        
        if($user_account['user_id']!=''){ ?>
        
        <div class="DR-tile-sec"> <a href="javascript:void(0)" class="DR-main-tile"> <span class="tile-status bg-dark opacity">Digital records</span>
                <ul class="flip-list eightTiles" data-mode="flip-list" data-delay="2000">
                        
                  <?php for($i=0; $i<count($arr_digital_records);$i++ ) { ?>
                    <li onclick='window.location.href="<?php echo base_url();?>student-time-line/<?php echo $arr_digital_records[$i]['url'];?>";'>
                        <div class="dr-img"><img class="full" src="<?php echo base_url(); ?>media/front/img/category-images/79X103/<?php echo stripslashes($arr_digital_records[$i]["category_image"]) ?>" alt="1" /></div>
                        <div class="dr-label dr-label1"><span><?php echo stripslashes($arr_digital_records[$i]["category_name"]) ?></span> <div class="count"><?php echo ($arr_digital_records_count[$i][0]["timeline_count"]) ?></div></div>
                    </li>
                  <?php } ?>
                </ul>
            </a>
        </div>

        <?php }else{ ?>
        
        <div class="DR-tile-sec"> <a href="<?php echo base_url(); ?>digital-record" class="DR-main-tile"> <span class="tile-status bg-dark opacity">Digital records</span>
                <ul class="flip-list eightTiles" data-mode="flip-list" data-delay="2000">
                        
                  <?php for($i=0; $i<count($arr_digital_records);$i++ ) { ?>
                    <li>
                        <div class="dr-img"><img class="full" src="<?php echo base_url(); ?>media/front/img/category-images/79X103/<?php echo stripslashes($arr_digital_records[$i]["category_image"]) ?>" alt="1" /></div>
                        <div class="dr-label dr-label1"><span><?php echo stripslashes($arr_digital_records[$i]["category_name"]) ?></span> <div class="count"><?php echo ($arr_digital_records_count[$i][0]["timeline_count"]) ?></div></div>
                    </li>
                  <?php } ?>
                </ul>
            </a>
        </div>

        <?php }?>
        

    </div>



    <script src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/js/bootstrap.min.js"></script> 
    <script>
        $(document).ready(function () {
    // Script to edit tile
            var $tile1 = null;
            var frontFaceClick = function (event) {
                $("#text").val($("#msg").text());
                if ($tile1 == null)
                    $tile1 = $("#tile1").liveTile({repeatCount: 0, delay: 0});
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
        $(".tiles").sortable();
        $(".tiles").disableSelection();

    </script>

</body>
</html>