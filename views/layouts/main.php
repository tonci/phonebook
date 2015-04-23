<?php
    use lib\helpers\html\Html;
    $baseUrl = lib\App::getComponent('request')->baseUrl;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--
        ===
        This comment should NOT be removed.

        Charisma v2.0.0

        Copyright 2012-2014 Muhammad Usman
        Licensed under the Apache License v2.0
        http://www.apache.org/licenses/LICENSE-2.0

        http://usman.it
        http://twitter.com/halalit_usman
        ===
    -->
    <meta charset="utf-8">
    <title>Simple Phonebook Application</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Simple Phonebook Application">

    <!-- The styles -->
    <link id="bs-css" href="<?= $baseUrl ?>css/bootstrap-cerulean.min.css" rel="stylesheet">

    <link href="<?= $baseUrl ?>css/charisma-app.css" rel="stylesheet">
    <link href='<?= $baseUrl ?>bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='<?= $baseUrl ?>bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='<?= $baseUrl ?>bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='<?= $baseUrl ?>bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='<?= $baseUrl ?>bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='<?= $baseUrl ?>bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='<?= $baseUrl ?>css/jquery.noty.css' rel='stylesheet'>
    <link href='<?= $baseUrl ?>css/noty_theme_default.css' rel='stylesheet'>
    <link href='<?= $baseUrl ?>css/elfinder.min.css' rel='stylesheet'>
    <link href='<?= $baseUrl ?>css/elfinder.theme.css' rel='stylesheet'>
    <link href='<?= $baseUrl ?>css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='<?= $baseUrl ?>css/uploadify.css' rel='stylesheet'>
    <link href='<?= $baseUrl ?>css/animate.min.css' rel='stylesheet'>

    <!-- jQuery -->
    <script src="<?= $baseUrl ?>bower_components/jquery/jquery.min.js"></script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.ico">
    <script type="text/javascript">
        var csrf = "<?= lib\App::getComponent('request')->getCSRF(); ?>";
    </script>
</head>

<body>
    <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= $baseUrl ?>"><span>PhoneBook</span></a>



        </div>
    </div>
    <!-- topbar ends -->
<div class="ch-container">
    <div class="row">
        
        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Main</li>
                        <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-plus"></i><span> User</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a class="ajax-link" href="<?= Html::createLink('user', 'passwordchange'); ?>"><i class="glyphicon glyphicon-wrench"></i><span> Password Change</span></a></li>
                                <li><a class="ajax-link" href="<?= Html::createLink('user', 'logout'); ?>"><i class="glyphicon glyphicon-off"></i><span> Logout</span></a></li>
                            </ul>
                        </li>
                        <li><a class="ajax-link" href="<?= Html::createLink('contacts', 'index'); ?>"><i class="glyphicon glyphicon-user"></i><span> Contacts</span></a>
                        </li>
                       
                        
                    </ul>
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->

                <?= $content; ?>


    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Settings</h3>
                </div>
                <div class="modal-body">
                    <p>Here settings can be configured...</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                </div>
            </div>
        </div>
    </div>


</div><!--/.fluid-container-->

<!-- external javascript -->

<script src="<?= $baseUrl ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- library for cookie management -->
<script src="<?= $baseUrl ?>js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='<?= $baseUrl ?>bower_components/moment/min/moment.min.js'></script>
<script src='<?= $baseUrl ?>bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='<?= $baseUrl ?>js/jquery.dataTables.min.js'></script>

<!-- select or dropdown enhancer -->
<script src="<?= $baseUrl ?>bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="<?= $baseUrl ?>bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<script src="<?= $baseUrl ?>js/jquery.noty.js"></script>
<!-- library for making tables responsive -->
<script src="<?= $baseUrl ?>bower_components/responsive-tables/responsive-tables.js"></script>
<!-- tour plugin -->
<script src="<?= $baseUrl ?>bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="<?= $baseUrl ?>js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="<?= $baseUrl ?>js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="<?= $baseUrl ?>js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="<?= $baseUrl ?>js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="<?= $baseUrl ?>js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="<?= $baseUrl ?>js/charisma.js"></script>
<script src="<?= $baseUrl ?>js/grid.js"></script>


</body>
</html>
