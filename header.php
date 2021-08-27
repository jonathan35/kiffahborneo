<div class="row" style="z-index:999">
    <div class="col-12 smallermobileheight" id="header" style="position:fixed; z-index:20; background: linear-gradient(80deg, rgba(52,52,52,1) 0%, rgba(24,24,24,1) 100%); width:100%; left:0; box-shadow:2px 2px 10px rgba(0,0,0,.2);">
        <div class="row">
            <div class="col-12 col-md-3 offset-md-1">
                <div class="row">
                    <div class="col-12 pl-0 pr-0 pt-1 d-flex justify-content-between">
                        <div class="col-9 col-md-12 pt-1 pb-1 pl-0 pr-0 text-left">
                            <a href="<?php echo A_ROOT?>home">
                            <img src="<?php echo ROOT?>images/kiffah_logo_do2c.png" class="img-fluid pl-1" style="max-height:58px;"><!--<span style="font-size:40px;">LOGO</span>--></a>
                            
                            
                        </div>
                        <div class="col-3 p-3 text-right">
                            <button class="d-inline d-md-none navbar-toggler menu-toggler" type="button" onclick="$('#toggleMenu, .page_title').fadeToggle(); $('#toggleMenu').removeClass('d-lg-inline')">
                            
                            <!--data-toggle="collapse" data-target="#toggleMenu" aria-controls="toggleMenu" aria-expanded="false" aria-label="Toggle navigation"-->
                                <span class="navbar-toggler-icon">
                                    <i class="fas fa-bars burger-menu"></i>
                                </span>
                                <span class="burger-menu-txt d-none d-md-inline">Menu</span>            
                            </button>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="col-12 col-md-3 offset-md-4 p-md-0">
                <?php include 'search.php';?>
            </div>
        </div>

        <div class="row smallermobilewidth" style="background: var(--color2); background: linear-gradient(178deg, rgba(255, 157, 0,1) 0%, rgba(255, 140, 0, 1) 40%, rgba(249, 128, 50, 1) 100%); ">

            <div class="col-12 col-md-10 offset-md-1 p-0">
                <div class="col-12 p-0 collapse d-md-inline-block" id="toggleMenu" style="font-weight:bold;">

                        <?php 
                        $locations = sql_read('select * from location where status =1 order by position asc, id desc');
                        $pages = sql_read('select * from pages where status =1 order by position asc, id desc');


                        $menu_items = array();
                        $menu_width = $menu_str = '';
                        foreach($locations as $l){
                            $menu_items[] = $l['location'];
                        }
                        $menu_items[] = 'Announcement';
                        $menu_items[] = 'Contact Us';
                        foreach($pages as $p){
                            $menu_items[] = $p['title'];
                        }
                        foreach($menu_items as $a => $b){$menu_items[$a] .= $b.'aaaaaaaaaaaaaaaaaaa';}
                        foreach($menu_items as $item){$menu_str .= $item;}
                        $each_char_percent = 100/strlen($menu_str);

                        foreach($menu_items as $item_str){
                            $menu_width .= round(strlen($item_str)*$each_char_percent,2,PHP_ROUND_HALF_DOWN).'% ';
                        }
                            
                        ?>



                    <div class="navigator" style="grid-template-columns: <?php echo $menu_width?>;">
               <!--row d-flex flex-row justify-content-between-->
                        <?php 
                        $a = 1;
                        foreach($locations as $location){
                            $smcats = sql_read("select * from category where  status=? and location=? order by position asc, category asc, id desc", 'is', array(1, $location['id']));
                        ?>
                        <div class="col-12 col-md p-2 pl-3 hd-menu <?php if($slocation['id'] == $location['id']) echo 'active-hd-menu';?>" child="<?php echo $a?>">
                        <a href="<?php echo ROOT?>tours/<?php echo $str_convert->to_eye($location['location'])?>" style="color:white;">
                            <?php echo $location['location']?> 
                            <i class="fa fa-angle-down d-none d-md-inline" aria-hidden="true" style="font-size:12px;"></i>
                        </a>
                            <div class="menu" id="smenu<?php echo $a?>">
                                <div class="menu-inner">
                                <?php foreach($smcats as $cat){?>
                                    <a class="menu-inner-a" href="<?php echo ROOT?>tours/<?php echo $location['location']?>/<?php echo $str_convert->to_url($cat['category'])?>"><?php echo strtolower($cat['category']);?></a>
                                <?php }?>
                                </div>
                            </div>

                        </div>
                        <?php 
                        $a++;
                        }?>

                        <script>
                        $('.hd-menu').hover(function(){
                            var i = $(this).attr('child');
                            //alert(i);
                            $('#smenu'+i).fadeToggle();
                        })
                        /*$('.hd-menu').mouseout(function(){
                            var i = $(this).attr('child');
                            $('#smenu'+i).fadeOut();
                        })*/
                        </script>
                        
                        <div class="col-12 col-md p-2 pl-3 hd-menu <?php if(strpos($_SERVER['PHP_SELF'], '/news.php')) echo 'active-hd-menu';?>">
                            <a href="<?php echo ROOT?>news" style="color:white;">Announcement</a>
                        </div>

                        <div class="col-12 col-md p-2 pr-3 pl-3 hd-menu <?php if(strpos($_SERVER['PHP_SELF'], '/contact_us.php')) echo 'active-hd-menu';?>">
                            <a href="<?php echo ROOT?>contact_us" style="color:white;">Contact Us</a>
                        </div>
                        
                        <?php 
                        foreach($pages as $page){
                        ?>
                        <div class="col-12 col-md p-2 pl-3 hd-menu <?php if($_GET['t'] == $page['title']) echo 'active-hd-menu';?>">
                            <a href="<?php echo ROOT?>page/<?php echo $str_convert->to_eye($page['title'])?>" style="color:white;"><?php echo $page['title']?></a>
                        </div>
                        <?php }?>

                                    
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</div>
<div class="row">
    <div class="col-12 header-spacer" style="height:144px;"><br></div>    
</div>



<script>
$(document).ready(function(){
    reheight();
});
$(window).resize(function() {
    reheight();
});
function reheight(){
    var h = $('#header').height();
    h += 0;
    $('.header-spacer').css('height', h+'px');
}
</script>
