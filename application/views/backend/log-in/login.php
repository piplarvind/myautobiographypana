
<!DOCTYPE html>
<html class="login" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <?php if (count($header) != 0) { ?>
            <title><?php echo stripslashes($global['site_title']) . '-' ?><?php echo empty($header['title']) ? stripslashes($global['site_title']) : stripslashes($header['title']); ?></title>
        <?php } else { ?>
            <title><?php echo stripslashes($global['site_title']) . '-' ?><?php echo empty($title_for_layout) ? stripslashes($global['site_title']) : stripslashes($header['title']); ?></title>
        <?php } ?>
        <!-- App Styling Bundle -->
        <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/jquery-1.10.2.min.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/jquery.validate.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/login/admin-login.js"></script>
        <link href="<?php echo base_url(); ?>media/backend/css/default.min.css" rel="stylesheet">

    </head>
    <body>
        <div class="container-fluid">
            <div class="brand-logo">
                <?php
                $abs_path = $this->common_model->absolutePath();
                $picture = "";
                $user_photo = ($get_admin_image[0]['profile_picture'] != "" && file_exists($abs_path . 'media/backend/images/admin_user/' . $get_admin_image[0]['profile_picture'])) ? base_url() . 'media/backend/images/admin_user/' . $get_admin_image[0]['profile_picture'] : base_url() . 'media/front/UI-1-media/img/login-prof.png';
                ?>
                <img src="<?php echo $user_photo ?>">
            </div>
            <div class="row">
                <h1>Account Access</h1>
                <div class="col-sm-4 col-sm-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                            $success_msg = $this->session->userdata('success_msg');
                            ?>
                            <!--[message box]-->
                            <?php if ($success_msg != '') { ?>
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                    </button>
                                    <?php
                                    echo $success_msg;
                                    $this->session->unset_userdata('success_msg');
                                    ?> 
                                </div>
                                <?php
                            }
                            ?>
                            <?php
                            $error_msg = $this->session->userdata('error_msg');
                            ?>
                            <!--[message box]-->
                            <?php if ($error_msg != '') { ?>
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                    </button>
                                    <?php
                                    echo $error_msg;
                                    $this->session->unset_userdata('error_msg');
                                    ?> 
                                </div>
                                <?php
                            }
                            ?>

                            <!-- Sign in -->
                            <form role="form" name="frm_admin_login" id="frm_admin_login" action="<?php echo base_url(); ?>backend/login" method="post">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input autofocus class="form-control" type="text" name="user_name" size="" id="user_name" value="" placeholder="Username" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-shield"></i></span>
                                        <input class="form-control" type="password" name="user_password" id="user_password" value="" placeholder="Password" >   
                                    </div>
                                </div>
                                <div class="text-center">

                                    <button type="submit" class="btn btn-success" value="Login">Login<i class="fa fa-fw fa-unlock-alt"></i></button>
                                </div>
                            </form>
                            <!-- //Signin -->
                        </div>
                    </div>
                    <a href="<?php echo base_url() ?>backend/forgot-password" class="forgot-pass">
                        Forgot your Password?
                        <i class="fa fa-question-circle"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- Inline Script for colors and config objects; used by various external scripts; -->
        <script>
            var colors = {
                "danger-color": "#e74c3c",
                "success-color": "#81b53e",
                "warning-color": "#f0ad4e",
                "inverse-color": "#2c3e50",
                "info-color": "#2d7cb5",
                "default-color": "#6e7882",
                "default-light-color": "#cfd9db",
                "purple-color": "#9D8AC7",
                "mustard-color": "#d4d171",
                "lightred-color": "#e15258",
                "body-bg": "#f6f6f6"
            };
            var config = {
                "theme": "admin",
                "themes": [],
                "dist": "dist/themes",
                "skins": {
                    "docs": {
                        "default": {
                            "primary-color": "#16ae9f"
                        },
                        "orange": {
                            "primary-color": "#e74c3c"
                        },
                        "blue": {
                            "primary-color": "#4687ce"
                        },
                        "purple": {
                            "primary-color": "#af86b9"
                        },
                        "brown": {
                            "primary-color": "#c3a961"
                        }
                    },
                    "admin": {
                        "default": {
                            "primary-color": "#3498db"
                        },
                        "orange": {
                            "primary-color": "#e74c3c"
                        },
                        "blue": {
                            "primary-color": "#4687ce"
                        },
                        "purple": {
                            "primary-color": "#af86b9"
                        },
                        "brown": {
                            "primary-color": "#c3a961"
                        }
                    },
                    "layout": {
                        "default": {
                            "primary-color": "#16ae9f"
                        }
                    },
                    "sidebar": {
                        "default": {
                            "primary-color": "#16ae9f"
                        }
                    },
                    "navbar": {
                        "default": {
                            "primary-color": "#16ae9f"
                        }
                    },
                    "color": {
                        "default": {
                            "primary-color": "#16ae9f"
                        }
                    },
                    "music": {
                        "default": {
                            "primary-color": "#3498db"
                        },
                        "orange": {
                            "primary-color": "#e74c3c"
                        },
                        "blue": {
                            "primary-color": "#4687ce"
                        },
                        "purple": {
                            "primary-color": "#af86b9"
                        },
                        "brown": {
                            "primary-color": "#c3a961"
                        }
                    },
                    "social-1": {
                        "default": {
                            "primary-color": "#16ae9f"
                        },
                        "orange": {
                            "primary-color": "#e74c3c"
                        },
                        "blue": {
                            "primary-color": "#4687ce"
                        },
                        "purple": {
                            "primary-color": "#af86b9"
                        },
                        "brown": {
                            "primary-color": "#c3a961"
                        }
                    },
                    "social-2": {
                        "default": {
                            "primary-color": "#16ae9f"
                        },
                        "orange": {
                            "primary-color": "#e74c3c"
                        },
                        "blue": {
                            "primary-color": "#4687ce"
                        },
                        "purple": {
                            "primary-color": "#af86b9"
                        },
                        "brown": {
                            "primary-color": "#c3a961"
                        },
                        "default-nav-inverse": {
                            "color-block": "#242424"
                        }
                    },
                    "social-3": {
                        "default": {
                            "primary-color": "#16ae9f"
                        },
                        "orange": {
                            "primary-color": "#e74c3c"
                        },
                        "blue": {
                            "primary-color": "#4687ce"
                        },
                        "purple": {
                            "primary-color": "#af86b9"
                        },
                        "brown": {
                            "primary-color": "#c3a961"
                        },
                        "default-nav-inverse": {
                            "color-block": "#242424"
                        }
                    },
                    "learning": {
                        "default": {
                            "primary-color": "#16ae9f"
                        },
                        "orange": {
                            "primary-color": "#e74c3c"
                        },
                        "blue": {
                            "primary-color": "#4687ce"
                        },
                        "purple": {
                            "primary-color": "#af86b9"
                        },
                        "brown": {
                            "primary-color": "#c3a961"
                        }
                    }
                },
                "vendor_css": ["app/icons/pictoicons/css/picto.css", "bower_components/bootstrap3-datepicker/css/datepicker.css", "bower_components/jquery-minicolors/jquery.minicolors.css", "bower_components/seiyria-bootstrap-slider/dist/css/bootstrap-slider.css", "bower_components/highlightjs/styles/railscasts.css", "bower_components/jvectormap/jquery-jvectormap.css", "bower_components/owlcarousel/owl-carousel/owl.carousel.css", "bower_components/morrisjs/morris.css"],
                "discover": {
                    "exclude": ["animated-climacons", "bridget", "bootstrap-sass", "bootstrap-rtl", "mocha", "modernizr", "requirejs", "jquery-ui-map", "jquery-ui"]
                },
                "debug": true
            };
        </script>

        <!-- Vendor Scripts Bundle -->
        <script src="<?php echo base_url(); ?>media/backend/js/vendor.min.js"></script>
        <!-- App Scripts Bundle -->
        <script src="<?php echo base_url(); ?>media/backend/js/scripts.min.js"></script>
    </body>
</html>