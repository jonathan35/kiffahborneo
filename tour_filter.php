<?php 

if(!empty($_GET['ty'])){//This is tour type
    $type_name = $str_convert->to_query($_GET['ty']);
    $selected_type = sql_read('select * from tour_type where tour_type like ? and status=1 limit 1', 's', '%'.$type_name.'%');
}

if(!empty($_GET['cat'])){//This is category
    $cat_name = $str_convert->to_query($_GET['cat']);
    $selected_category = sql_read('select * from category where category like ?  and status=1 limit 1', 's', '%'.$cat_name.'%');
}


$locations = sql_read('select * from location where status=1');

foreach($locations as $location){
?>

    <div class="row">
        <div class="col-12 pb-3">
            <h4 style="text-transform: uppercase; padding:8px;">
                <?php 
                if(!empty($location['location'])){
                    echo $location['location'];
                }?>
            </h4>
            <?php 
            $cats = sql_read('select * from category where status=1 and location=? order by position asc, category asc, id desc', 'i', $location['id']);

            foreach($cats as $cat){
            ?>
            <div class="row">
                <div class="col-12">                                            
                    <a href="<?php echo ROOT?>tours/<?php echo $location['location']?>/<?php echo $str_convert->to_url($cat['category'])?>"><div class="filter_menu <?php if($selected_category['id'] == $cat['id']) echo 'active_filter_menu';?>">
                            <?php echo $cat['category']?>
                    </div></a>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
    <!--
    <hr>
    <div class="row">
        <div class="col-12 pl-4 pt-1">                            
        <?php 
        /*$types = sql_read('select * from tour_type where status=1 order by position asc, tour_type asc, id desc');

        foreach($types as $type){
        ?>
        <div class="row">
            <div class="col-12">
                <a href="<?php echo ROOT?>type/<?php echo $_GET['c']?>/<?php echo $str_convert->to_url($type['tour_type'])?>"><div class="filter_menu <?php if($selected_type['id'] == $type['id']) echo 'active_filter_menu';?>">
                    <?php echo $type['tour_type']?>
                </div></a>
            </div>
        </div>
        <?php }*/?>
        </div>
    </div>-->
<?php }?>    
