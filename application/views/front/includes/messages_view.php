<!-- [Start :: Messages]  -->

        <div class="container" id="status_div">
            
             <div class="alert-msg-otr">       
           
            <?php if ($this->session->userdata('message')) { ?>
               <div class="alert alert-success" role="alert" >
                    <h5><?php echo $this->session->userdata('message'); ?><a id="closeid" class="close"  href="javascript:void(0)" style="font-weight: normal!important;margin-right: 5px;" >X</a></h5>
                </div> 
                <?php
                $this->session->unset_userdata('message');
            }
            if ($this->session->userdata('message-error')) {
                ?>
               <div class="alert alert-danger" role="alert" >
                    <h5><?php echo $this->session->userdata('message-error'); ?><a id="closeid" class="close"  href="javascript:void(0)" style="font-weight: normal!important;margin-right: 5px;">X</a></h5>
                </div> 
                <?php
                $this->session->unset_userdata('message-error');
            }
            ?>
    </div>
                
                            
            </div>
    <!-- [End :: Messages]  -->
  <script type="text/javascript">

    $('#closeid').click(function(){
   
    $('#status_div').hide();
    });     
        
 </script> 