<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
include_once 'head.php';
?>


<html lang="en">
<body class="container-fluid p-0">
    
    <?php include 'header.php'?>

    <div class="row">
        <div class="col-12 text-center">
            <?php include 'banner.php'?>
        </div>
    </div>

    <div class="row">
        <div class="col-12 text-center p-4 pt-5 pb-5" style="background:#e1e1e1; border-bottom:1px solid #e1e1e1; color:#e1e1e1 !important;">
        <?php 
        $home_content = sql_read('select * from content where id = 2 limit 1');        
        echo str_replace('../../',ROOT,$home_content['content']);
        ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12 why_choose_us scroll_animate" ani-sub=".choose-block" style="border-top:1px solid #000; border-bottom:1px solid #000; background-color: #eeeeee; background-image:url('images/Flat-Mountains.svg');background-repeat: no-repeat; background-size:cover; background-position:center bottom;">
            <div class="row"><div class="col-12 d-none d-md-inline"><br><br></div></div>
            <div class="row"><div class="col-12"><br><br></div></div>
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="p-3">Why Choose Us</h1>

                    <div class="row">
                        <div class="col-10 offset-1">
                            <div class="row">
                                <?php 
                                $home_blocks = sql_read('select * from home_block where status=? order by position asc', 'i', 1);
                                foreach((array)$home_blocks as $home_block){

                                    
                                ?>
                                <div class="col-12 col-md-4">
                                    <div class="choose-block" style="background: url('<?php echo $home_block['background']?>'); background-size:cover; background-position:center;">
                                        <?php echo $home_block['block_text']?>
                                    </div>
                                </div>
                                <? }?>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="row"><div class="col-12 d-none d-md-inline"><br><br><br></div></div>
            <div class="row"><div class="col-12"><br><br></div></div>
        </div>
    </div>


    <div class="row">
        <div class="col-12 p-4 pt-5 pb-5 scroll_animate" ani-sub=".category-block" ani-class="flipOutX" style="background: #222; ">

            <div class="row">
                <div class="col-12 col-md-10 offset-md-1 p-3 text-center">
                    <h1 class="p-3">We've Wide Range of Tour Packages to Offer</h1>
                    <div class="pb-5">
                        You Have The Choice
                    </div>
                    <?php 
                    $types = sql_read("select * from tour_type where status=1 order by rand() limit 8");
                    $x = 1;
                    
                    $cl = array('rgba(255, 159, 56, 0.4)', 'rgba(171, 207, 41, 0.4)', 'rgba(72, 184, 103, 0.4)', 'rgb(56, 171, 150, 0.4)', 'rgba(61, 119, 161, 0.4)', 'rgba(88, 74, 161, 0.4)', 'rgba(142, 71, 168, 0.4)', 'rgba(217, 89, 178, 0.4)', 'rgba(189, 70, 70, 0.4)');
                    $cl2 = array('rgba(255, 196, 79, 0.8)', 'rgba(184, 212, 83, 0.8)', 'rgba(99, 199, 127, 0.8)', 'rgba(107, 194, 178, 0.8)', 'rgba(120, 162, 191, 0.8)', 'rgba(144, 132, 209, 0.8)', 'rgba(198, 140, 219, 0.8)', 'rgba(232, 137, 203, 0.8)', 'rgba(235, 96, 96, 0.8)');

                    foreach($types as $type){
                        
                        $bg = 'background-image: linear-gradient(to right top, '.$cl[rand(0,8)].', '.$cl2[rand(0,8)].');';
                        
                        if($x%4==1){ echo '<div class="row">';}?>
                        <div class="col-12 col-md-3 text-white pb-5">
                            <div class="category-block">
                            <a href="<?php echo ROOT?>type/<?php echo $str_convert->to_url($type['tour_type'])?>">
                            <div class="bg-cover img-fluid" style="height:200px; background-image:url('<?php echo ROOT.$type['photo']?>')"></div>
                            <div class="p-2" style="<?php echo $bg?>; background-size:cover; background-position:center; color:white;">
                            <span ><?php echo $type['tour_type']?></span>
                            </div></a>
                            </div>
                        </div>
                        <?php if($x%4==0){ echo '</div>';}?>
                    <?php 
                    $x++;
                    }?>
                </div>
            </div>            
        </div>
    </div>


    <!--
    <div class="row">
        <div class="col-12 p-4 pt-5 pb-5" style="background:#CCC;">
            <div class="row">
                <div class="col-12 col-md-10 offset-md-1 p-3 text-center" style="bnorder:1px solid red;">
                    <h1 class="p-3 text-black">Popular Trip</h1>
                    <div class="pb-5 text-black">
                    Here are some of our top Borneo must-dos and see that's not to be missed
                    </div>                    <div class="row">
                    <?php 
                    
                    $populars = sql_read("select * from tour where status=1 and popular='Yes' order by rand() limit 3");
                    
                    
                    foreach($populars as $popular) {?>
                        <div class="col-12 col-md-4 text-white pb-5">
                            <div class="row">
                                <div class="col-12 p-0" style="background:#EFEFEF; color:black;">
                                    <div class="bg-cover img-fluid p-0" style="width:100%; height:230px; background-image:url('<?php echo ROOT.$popular['photo']?>');"></div>

                                    <div class="row pl-3 pr-3">
                                        <div class="col-12 p-0" style="overflow:hidden; border:none; ">
                                            <div class="p-2">
                                                <?php echo $popular['name']?>
                                            </div>
                                            <div class="p-2">
                                                <?php echo $popular['price']?>
                                            </div>
                                            <div class="row" style="color:white; font-size:90%;">
                                                <div class="col-6 p-2" style="background:#F83A00; color:white; cursor:pointer;"  data-toggle="modal" data-target="#enquiryModal" href=# onclick="change_title('<?php echo $popular['name']?>')">
                                                    GET A QUOTE
                                                </div>
                                                <a class="col-6 p-2" href="<?php echo ROOT.'tour_details/'.$str_convert->to_url($popular['name'])?>" style="background:var(--color5); color:white;">
                                                    VIEW TOUR
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php }?>
                    </div>


                </div>
            </div>
        </div>

    </div>
    -->


    <div class="row">
        <div class="col-12">            
            <?php include 'footer.php';?>
        </div>
    </div>
</body>

</html>
