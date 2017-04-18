<!DOCTYPE html>
<html  class="no-js html-api" <?php language_attributes(); fh_html(); ?>>
<head profile="http://gmpg.org/xfn/11">
	
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
   
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
	<title><?php wp_title(''); ?></title>
   	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
   	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/style-print.css" media="print">

   	<link href='https://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>

	<?php // wp_enqueue_script('jquery'); ?>
	<?php // wp_head(); ?>
	
    <style>
        
    /*  ------------------------------------------------------------------   
    API FEED STYLES
    -------------------------------------------------------------------- */

    /* API page */

    .html-api {
        height:100%;
        overflow:hidden;
    }

    .page-api {
        height:100%;
        background:#fff;
    }

    .page-api .wrapper {
        width:1200px;
        margin:0 auto;
    }

    .page-api .header.hack {
        height:8px;
        width:100%;
        background:#000;
        position:relative;
        top:0;
        left:0;
    }

    .page-api .footer.hack {
        height:10px;
        width:100%;
        background:#666;
        position:absolute;
        bottom:0px;
        left:0;
    }

    .page-api .wrapper-int {
        width:900px;
        margin:111px auto 0 auto;
    } 

    .page-api header{
        width:100%;
        height:40px;
        position:relative;
        background: #770433;
    }

    .page-api .header-int {
        width:1200px;
        margin:0 auto;
        position:relative;
    }

    .page-api .bmw-logo {
        position:absolute;
        right:0;
        top:0;
        z-index:99;
        height:98px;
        width:239px;
        text-indent:-9999px;
        background-image: url('<?php bloginfo(stylesheet_directory);?>/images/bmw-logo.png');
        background-repeat: no-repeat;
        background-position:top left;

    }

    .page-api .left-column {
        width:431px;
        float:left;
        border-right: 1px solid #770433;
    }

    .page-api .right-column {
        float:right;
        width:400px;
    }

    /* API feed table FUTURES OVERRIDES */
    .page-api table.dtn-quote {
        font-size: 1em;
        font-family: 'Verdana', geneva,tahoma,sans-serif;
    }

    .page-api span.underlying {
        font-size: 1.5em;
        color:black;   
    }

    .page-api table th {
        background-color:#fff;
        color:#000;
    }

    .page-api table, 
    .page-api td, 
    .page-api th {  
        border:none;
    }

    .page-api .caption .underlying {
        display: block;
        padding-bottom: 10px;
    }

    .page-api table tr.even,
    .page-api table tr.odd {
        border-bottom:1px solid #ccc;
    }

    .page-api table .delivery-date {
        font-weight:normal;
        font-family: "Verdana", Geneva, sans-serif;
    }

    .page-api .dtn-quote th {
    }

    .page-api table.dtn-quote tbody.dupheader th {
        font-size: 1em !important;
    }

    .page-api table.dtn-quote th~td {
        font-size: 1.3em !important;
    }

    .page-api .endtable {
        display:;
    }

    .page-api .dtnDisclaimer {
        display:none;
    }

    .page-api .disclaimer.hack a {
        /*
        position:absolute;
        */
        height:35px;
        width:197px;
        margin:60px auto 0 auto;
        background-image:url('<?php bloginfo(stylesheet_directory);?>/images/dtn-disclaimer-hack.gif');
        background-repeat: no-repeat;
        background-position: top left;
        display:block;
    }

    </style>
    
</head>

<body class='page-api'>

    <header>
        <div class='header hack'></div>
        <div class='header-int'>
            <h1 class='bmw-logo'>
                Bank Midwest
            </h1>
        </div>
    </header>
    