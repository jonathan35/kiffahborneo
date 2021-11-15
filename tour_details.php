<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
include_once 'head.php';



?>





<html lang="en">
<body class="container-fluid p-0" ><!--style="background:#EFEFEF;"-->

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v9.0&appId=169459756468358&autoLogAppEvents=1" nonce="i4bMr8gD"></script>


    <?php include 'header.php'?>

    <div class="row p-0">
        <div class="col-12 col-md-10 offset-md-1 pt-5 pb-5">
            <div class="row">
         
                <div class="col-12">

                    <div class="row" style="border-bottom:1px solid #CCC;">
                        <div class="col-12 p-1 pl-4 pr-4 p-md-3">
                            
                            <div class="row mb-3">

                                <?php 
                                $photos = sql_read("select photo from photos where parent_table=? and parent_id=? and status=? order by id asc", 'ssi', array('tour', $tour['id'], 1));
                                $c = count((array)$photos) + 1;
                                ?>

                                <div class="col-12 <?php if($c>1){?>col-md-7<?php }else{?>col-md-8<?php }?> pr-md-1">
                                    <div class="zoom-outter">
                                        <?php if(file_exists($tour['photo'])){?>
                                            <img class="large-photo zoom-inner" src="<?php echo ROOT.$tour['photo']?>" width="100%" style="box-shadow: 1px 1px 4px rgba(0,0,0,.3)">
                                        <?php }else{?>
                                            <img src="<?php echo ROOT.'images/SD-default-image.png'?>" class="large-photo img-fluid" style="box-shadow: 1px 1px 4px rgba(0,0,0,.3)">
                                        <?php }?>
                                    </div>
                                </div>
                                <?php if($c>1){?>
                                <div class="col-12 col-md-1">
                                    <div class="row pt-1 pl-3 pr-3 p-md-0">
                                        <?php                                  
                                        if($c>1) $h = 250/$c;?>
                                        <div class="col-4 col-md-12 p-md-0">
                                            <div class="zoom-outter">
                                                <div class="bg-cover photo-thum zoom-inner" style="height:<?php echo $h?>px; overflow:hidden; background-position: center; background-image:url('<?php echo ROOT.$tour['photo']?>')" data-photo="<?php echo ROOT.$tour['photo']?>"></div>
                                            </div>
                                        </div>
                                        <?php
                                        foreach((array)$photos as $photo){?>
                                            <div class="col-4 col-md-12 p-md-0">
                                                <div class="zoom-outter">
                                                    <div class="bg-cover photo-thum zoom-inner" style="height:<?php echo $h?>px; overflow:hidden; background-position: center; background-image:url('<?php echo ROOT.$photo['photo']?>')" data-photo="<?php echo ROOT.$photo['photo']?>"></div>
                                                </div>
                                            </div>
                                        <?php }?>

                                        

                                        <script>
                                        $('.photo-thum').click(function(){
                                            var a = $(this).attr('data-photo');
                                            change_photo(a);
                                        });
                                        $('.photo-thum').hover(function(){
                                            var a = $(this).attr('data-photo');
                                            change_photo(a);
                                        });
                                        function change_photo(a){
                                            $('.large-photo').attr('src', a);
                                        }
                                        
                                        </script>
                                    </div>
                                </div>
                                <?php }?>
                             

                                <div class="col-12 col-md-4">
                                    
                                    <div class="row">
                                        <div class="col-12 text-black pb-4 pb-md-5" style="font-size:30px; line-height:1.2;">
                                            <?php echo $tour['name']?>
                                        </div>
                                        <?php 
                                        foreach($locations as $location){
                                            $ls[$location['id']] = $location['location'];
                                        }
                                        
                                        if(!empty($ls[$tour['location']])){?>
                                        <div class="col-12 pt-2">
                                            <i class="fa fa-map-marker ico-cus2"></i>
                                            <b>Location: </b>
                                            <?php echo $ls[$tour['location']]?>
                                        </div>
                                        <?php }?>

                                        <?php if(!empty($tour['duration'])){?>
                                        <div class="col-12 pt-2">
                                            <i class="fa fa-hourglass-start ico-cus2"></i>
                                            <b>Duration: </b>
                                            <?php echo $tour['duration']?>
                                        </div>
                                        <?php }?>

                                        <?php if(!empty($tour['departure'])){?>
                                        <div class="col-12 pt-2">
                                            <i class="fa fa-bell ico-cus2"></i>
                                            <b>Departure: </b>
                                            <?php echo $tour['departure']?>
                                        </div>
                                        <?php }?>

                                        <?php if(!empty($tour_type[$tour['tour_type']])){?>
                                        <div class="col-12">
                                            <i class="fa fa-flag ico-cus2"></i>
                                            <b>Tour Type: </b>
                                            <?php echo $tour_type[$tour['tour_type']]?>
                                        </div>
                                        <?php }?>


                                        <div class="d-inline pt-4 pl-3">
                                            <div class="fb-share">
                                            <? /*!-- Your share button code -->
                                            <div class="fb-share-button" 
                                            data-href="https://kiffahborneo.com.my/tour_details/<?php echo $str_convert->to_url($tour['name'])?>">
                                            </div>*/?>
                                            <div class="fb-share-button" data-href="https://kiffahborneo.com.my/tour_details/<?php echo $str_convert->to_url($tour['name'])?>" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>

                                            </div>
                                            
                                        </div>

                                        <div class="d-inline" style="position:relative; left: 12px; top:25px;">
                                            <a href="https://www.facebook.com/kiffahborneo" target="_blank" style="display:inline;"><img src="<?php echo ROOT?>images/facebook-circle.svg" style="width:22px;"></a>
                                        </div>

                                        <?php if(!empty($tour['price'])){?>
                                        <div class="col-12 pt-4 mt-0 pt-md-5 mt-md-5" style="font-size:30px;">
                                            <b><?php echo $tour['price']?></b>
                                        </div>
                                        <?php }?>


                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-5">
                    
                        <div class="col-12 col-md-7 p-4">
                            <?php 
                            $tour['full_description'] = str_replace(array('../../', '<img'), array(ROOT, '<img class="img-fluid"'), $tour['full_description']);                
                            echo $tour['full_description'];                            
                            ?>
                            <?php //echo $tour['popular']?>

                            <div class="row">
                                <div class="col d-none d-md-block">
                                    <?php include 'related.php';?>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 offset-md-1">
                            <?php include 'message.php';?>                            
                        </div>
                        
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col d-md-none p-5">
                        <?php include 'related.php';?>
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
