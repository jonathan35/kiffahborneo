<?php
require_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/str_convert.php';


if(!empty($_GET['c'])){
    $loc_name = $str_convert->to_query($_GET['c']);
    $slocation = sql_read('select * from location where location like ? limit 1', 's', '%'.$loc_name.'%');
}

$seo_title = $seo_keyword = $seo_description = '';


/*
if (strpos($_SERVER['SCRIPT_NAME'], 'news.php') !== false && !empty($_GET['cat'])) {
    
    $news_name = $str_convert->to_query($_GET['cat']);
    $seo_news = sql_read('select title, seo_keyword, seo_description from news where category like ? limit 1', 's', '%'.$news_name.'%');
    $seo_title = ' - '.$seo_news['title'];
    $seo_keyword =  $seo_news['seo_keyword'];
    $seo_description = $seo_news['seo_description'];
}*/


if (strpos($_SERVER['SCRIPT_NAME'], 'tours.php') !== false) {

    if(!empty($_GET['ty'])){
        $tour_type_name = $str_convert->to_query($_GET['ty']);
        $seo_tour_type = sql_read('select tour_type, seo_keyword, seo_description from tour_type where tour_type like ? and status=? limit 1', 'si', array('%'.$tour_type_name.'%', 1));
        $seo_title = ' - '.$seo_tour_type['tour_type'];
        $seo_keyword =  $seo_tour_type['seo_keyword'];
        $seo_description = $seo_tour_type['seo_description'];
    }elseif(!empty($_GET['cat'])){
        $category_name = $str_convert->to_query($_GET['cat']);
        $seo_category = sql_read('select category, seo_keyword, seo_description from category where category like ? limit 1', 's', '%'.$category_name.'%');
        $seo_title = ' - '.$seo_category['category'];
        $seo_keyword =  $seo_category['seo_keyword'];
        $seo_description = $seo_category['seo_description'];
    }elseif(!empty($_GET['c'])){
        $location_name = $str_convert->to_query($_GET['c']);
        $seo_location = sql_read('select location, seo_keyword, seo_description from location where location like ? limit 1', 's', '%'.$location_name.'%');
        $seo_title = ' - '.$seo_location['location'];
        $seo_keyword =  $seo_location['seo_keyword'];
        $seo_description = $seo_location['seo_description'];
    }

    
}

if (strpos($_SERVER['SCRIPT_NAME'], 'tour_details.php') !== false && !empty($_GET['p'])) {
    $tour_name = $str_convert->to_query($_GET['p']);
    $seo_tour = sql_read("select * from tour where status=1 and name like ? limit 1", 's', $tour_name);
    $seo_title = ' - '.$seo_tour['name'];
    $seo_keyword =  $seo_tour['seo_keyword'];
    $seo_description = $seo_tour['seo_description'];
}

if (strpos($_SERVER['SCRIPT_NAME'], 'page.php') !== false && !empty($_GET['t'])) {
    $title = $str_convert->to_query($_GET['t']);
    $seo_page = sql_read("select title, seo_keyword, seo_description from pages where status = ? and title like ? limit 1", 'is', array(1, '%'.$title.'%'));
    $seo_title = ' - '.$seo_page['title'];
    $seo_keyword =  $seo_page['seo_keyword'];
    $seo_description = $seo_page['seo_description'];
}

?>
<!DOCTYPE html>
<head>
    <title>Kiffah Borneo Tours & Travel Sdn Bhd <?php echo $seo_title?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icon.png">
    <?php if(!empty($seo_keyword)){?>
    <meta name="keywords" content="<?php echo $seo_keyword?>">
    <?php }?>
    <?php if(!empty($seo_description)){?>
    <meta name="description" content="<?php echo $seo_description?>">
    <?php }?>

    <script src="<?php echo ROOT?>js/jquery.min.js"></script>
    <script src="<?php echo ROOT?>js/popper.min.js"></script>
    <script src="<?php echo ROOT?>js/4.3.1/bootstrap.min.js"></script>
    <script src="<?php echo ROOT?>js/bootstrap.min.js"></script>
    <script src="<?php echo ROOT?>js/jquery-3.5.0.js"></script>
    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo ROOT?>css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo ROOT?>fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo ROOT?>fontawesome/css/all.css">
    <link rel="stylesheet" href="<?php echo ROOT?>fontawesome/css/solid.css">
    <link rel="stylesheet" href="<?php echo ROOT?>fontawesome/css/solid.min.css">


    <script src="<?php echo ROOT?>js/animate.js"></script>
    <link rel="stylesheet" href="<?php echo ROOT?>css/animate.css">
    

    <link href="<?php echo ROOT?>css/custom.css" rel="stylesheet" />
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500&display=swap" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer></script>
    <script type="text/javascript">
    var onloadCallback = function() {
        grecaptcha.render('recaptcha', {
            'sitekey' : '6LdPR5gUAAAAAObMmAHwsTGWbMNB4veEV1u4lTJU'
        });
    };
    </script>

<?php 

////////////////////////////// Tour Details Page - Start ///////////////////////////////       
if(!empty($_GET['p'])){
    $tour_name = $str_convert->to_query($_GET['p']);
    $tour = sql_read('select * from tour where status=1 and name like ? limit 1', 's', $tour_name);
    //debug($tour);

    if(!empty($tour['tour_type'])){
        $type = sql_read('select * from tour_type where status=1 and id=? limit 1', 'i', $tour['tour_type']);
    }
    if(!empty($tour['category'])){
        $category = sql_read('select * from category where status=1 and id=? limit 1', 'i', $tour['category']);
    }
    if(!empty($tour['location'])){
        $location = sql_read('select * from location where status=1 and id=? limit 1', 'i', $tour['location']);
    }
    
}



if(!empty($tour['id'])){?>
    <meta property="og:url" content="https://kiffahborneo.com.my/tour_details/<?php echo $str_convert->to_url($tour['name'])?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="kiffahborneo.com.my" />
    <meta property="og:description" content="<?php echo $tour['name']?>" />
    <meta property="og:image" content="https://kiffahborneo.com.my/<?php echo $tour['photo']?>" />

<?php }
////////////////////////////// Tour Details Page - End /////////////////////////////// 
?>

</head>