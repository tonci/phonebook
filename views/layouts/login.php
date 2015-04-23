<?php
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
    <title>Simple PhoneBook Application</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Simple PhoneBook Application">

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
    <link rel="shortcut icon" href="<?= $baseUrl ?>img/favicon.ico">
    
</head>

<body>
<div class="ch-container">
    <div class="row">
        <?= $content; ?>
    </div><!--/fluid-row-->

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


</body>
</html>
