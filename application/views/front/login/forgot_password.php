<?php // echo "test";die;?>



<div class="modal fade transparent-popup" id="ForgotPw" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>-->
                <h4 id="myModalLabel" class="modal-title">Forgot password</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form login-form">
                            <div class="sign-box">
                                <div class="sign-inner text-center">
                                    
                                    <form class="offset-top-20 text-left" id="frm_forgot_password" name="frm_forgot_password" method="post" action="<?php echo base_url(); ?>password-recovery">
                                        <div class="form-group form-group-icon-left"><i class="fa fa-envelope input-icon input-icon-show"></i>
                                            <label>Email</label>
                                            <input class="form-control" id="user_email" name="user_email" placeholder="e.g. johndoe@gmail.com" type="text" />
                                            <input class="form-control" type="hidden" value="<?php echo base_url() ?>" id="base_url" name="base_url" />
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 btn-grp">
                                                <input class="btn btn-primary" type="submit"  id="bnt_submit" name="bnt_submit" value="Forgot password" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Forgot password end--> 