<?php
require_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/str_convert.php';


if(!empty($_GET['c'])){
    $loc_name = $str_convert->to_query($_GET['c']);
    $slocation = sql_read('select * from location where location like ? limit 1', 's', '%'.$loc_name.'%');
}


?>
<!DOCTYPE html>
<head>
    <title>Kiffah Borneo Tours & Travel Sdn Bhd</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icon.png">

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