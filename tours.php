<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
include_once 'head.php';

?>


<html lang="en">
<body class="container-fluid p-0" style="">
    
    <?php include 'header.php'?>

    <div class="row">
        <div class="col-10 offset-1 pb-5 pt-5 mt-4 mt-md-0">
            <div class="row">

                <div class="cat-trigger d-sm-none" onclick="$('.category-panel-outter').fadeToggle();"><i class="fa fa-search" aria-hidden="true"></i></div>

                <!--$('.category-panel-outter').toggleClass('category-active');-->

                <div class="col-12 col-md-3 category-panel-outter">
                    <div class="row">
                        <div class="col-12 p-0 pr-md-5 category-panel">
                            <?php include 'tour_filter.php';?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="tour_list">
                        <?php include 'tour_list.php';?>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">            
            <?php include 'footer.php';?>
        </div>
    </div>

</body>
</html>
