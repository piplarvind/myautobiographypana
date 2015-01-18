<!-- Footer -->
                        <div class="footer">
                            <!--<?php echo $global['site_title'];?> &copy; Copyright-->
                            <p>&copy; 2014-2015 <a href="javascript:void(0);"><?php echo $global['site_title'];?></a> | All rights reserved.</p>
                        </div>

                        <!-- // Footer -->
                        </div>
                </div>

                <!-- /st-content-inner -->
                </div>

            <!-- /st-content -->
            </div>

        <!-- /st-pusher -->
        </div>

    <!-- /st-container -->
    
<!-- Inline Script for colors and config objects; used by various external scripts; --><script>
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
        debug: true,
        theme: "social-2",
        skins: {
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
        }
    };
    </script>

    <!-- Compressed Vendor Scripts Bundle
    Includes 3rd party JavaScript libraries used for the current theme/module
    Note: The bundle was tweaked for the current theme/module and it includes only libraries used with the theme/module
    The bundle was generated using modern frontend development tools that are provided with the package
    To learn more about the development process, please refer to the documentation. -->
    <script src="<?php echo base_url(); ?>media/front/UI-2-media/js/vendor-bundle-all.js"></script>

    <!-- Compressed App Scripts Bundle
    Includes Custom Application JavaScript used for the current theme/module -->
    <script src="<?php echo base_url(); ?>media/front/UI-2-media/js/module-bundle-main.min.js"></script>

    <!-- Standalone Modules
    As a convenience, we provide the entire UI framework broke down in separate modules
    Some of the standalone modules were not used with the current theme/module but ALL are 100% compatible -->
    <!--
    <script src="<?php echo base_url(); ?>media/front/UI-2-media/js/module-essentials.min.js"></script>
    <script src="<?php echo base_url(); ?>media/front/UI-2-media/js/module-layout.min.js"></script>
    <script src="<?php echo base_url(); ?>media/front/UI-2-media/js/module-sidebar.min.js"></script>
    <script src="<?php echo base_url(); ?>media/front/UI-2-media/js/module-navbar.min.js"></script>
    <script src="<?php echo base_url(); ?>media/front/UI-2-media/js/module-media.min.js"></script>
    <script src="<?php echo base_url(); ?>media/front/UI-2-media/js/module-timeline.min.js"></script>
    <script src="<?php echo base_url(); ?>media/front/UI-2-media/js/module-chat.min.js"></script>
    <script src="<?php echo base_url(); ?>media/front/UI-2-media/js/module-maps.min.js"></script>
    -->
    
    <!----- Gallery JS start---->
    
    <script src="<?php echo base_url(); ?>media/front/UI-2-media/js/gallery/imagesloaded.pkgd.min.js"></script>
		<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/gallery/masonry.pkgd.min.js"></script>
		<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/gallery/classie.js"></script>
		<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/gallery/cbpGridGallery.js"></script>
		<script>
			new CBPGridGallery( document.getElementById( 'grid-gallery' ) );
		</script>
    
    
    
</body>
</html>
