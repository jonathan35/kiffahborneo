<?php 
//require_once 'config/ini.php';
//require_once 'config/security.php';
//include_once 'head.php';

$type_cond = $cat_cond = $loc_cond = $key_cond = '';
$params[] = 1;
$sta_cond = ' status=? ';

if(!empty($_POST['keyword'])){//This is tour type    
    $key_cond = " and name like ? ";
    $params[] = "%".$_POST['keyword']."%";    
}

if(!empty($selected_type['id'])){//This is tour type    
    $type_cond = " and tour_type=? ";
    $params[] = $selected_type['id'];
}
if(!empty($selected_category['id'])){//This is category
    $cat_cond = " and category=? ";
    $params[] = $selected_category['id'];
}
if(!empty($slocation['id'])){//This is location
    $loc_cond = " and location=? ";
    $params[] = $slocation['id'];
}


$tours = sql_read("select * from tour where $sta_cond $key_cond $type_cond $cat_cond $loc_cond order by position asc, id desc", str_repeat('s',count($params)), $params);


$types = sql_read('select * from tour_type where status=1');
foreach($types as $type){
    $tour_type[$type['id']] = $type['tour_type'];
}
$category_ds = sql_read('select * from category where status=1');
foreach($category_ds as $category_d){
    $categories[$category_d['id']] = $category_d['category'];
}
$location_ds = sql_read('select * from location where status=1');
foreach($location_ds as $location_d){
    $locations[$location_d['id']] = $location_d['location'];
}


if(!isset($tours)){
    echo '<div class="row"><div class="col-12"><div class="row"><div class="col-12 p-2">No tour found</div></div></div></div>';
}else{
    echo '<div class="row"><div class="col-12"><div class="row"><div class="col-12 p-2">'.count($tours).' tours found</div></div></div></div>';    
}

$itemCount=1;
$maxPerPage=10;



foreach((array)$tours as $tour){
?>
<div class="row mb-5 p-0 page page<?php echo $itemCount?>" style=" <?php if($itemCount>$maxPerPage){?> display:none;<?php }?>; linear-gradient(180deg, rgba(222,111,111,1) 0%, rgba(222,222,11,1) 100%); border:1px solid #444; ">
    <div class="col-12">
        <div class="row">
            <div class="col-12 p-2 text-white" style="background: linear-gradient(160deg, rgba(52,52,52,1) 0%, rgba(24,24,24,1) 100%); font-size:20px;">
                <?php echo $tour['name']?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-5 mt-0 p-0 p-md-3">
                <div class="zoom-outter">
                    <?php if(file_exists($tour['photo'])){?>
                        <img src="<?php echo ROOT.$tour['photo']?>" class="img-fluid zoom-inner">
                    <?php }else{?>
                        <img src="<?php echo ROOT.'images/SD-default-image.png'?>" class="img-fluid">
                    <?php }?>
                </div>
            </div>
            <div class="col-12 col-md-7 pt-1 pb-5 pl-4 pr-4 p-md-4" style="font-size:14px;">
                <div class="row">
                    <?php if(!empty($locations[$tour['location']])){?>
                    <div class="col-6 p-1">
                        <i class="fa fa-map-marker ico-cus"></i>
                        <b class="d-none d-md-inline">Location: </b>
                        <?php echo $locations[$tour['location']]?>
                    </div>
                    <?php }?>

                    <?php if(!empty($tour['duration'])){?>
                    <div class="col-6 p-1">
                        <i class="fa fa-hourglass-start ico-cus"></i>
                        <b class="d-none d-md-inline">Duration: </b>
                        <?php echo $tour['duration']?>
                    </div>
                    <?php }?>

                    <?php if(!empty($tour['departure'])){?>
                    <div class="col-6 p-1">
                        <i class="fa fa-bell ico-cus"></i>
                        <b class="d-none d-md-inline">Departure: </b>
                        <?php echo $tour['departure']?>
                    </div>
                    <?php }?>

                    <?php if(!empty($tour_type[$tour['tour_type']])){?>
                    <div class="col-6 p-1">
                        <i class="fa fa-flag ico-cus"></i>
                        <b class="d-none d-md-inline">Tour Type: </b>
                        <?php echo $tour_type[$tour['tour_type']]?>
                    </div>
                    <?php }?>

                    <div class="col-12 p-1" style="white-space: pre-line;">
                        <?php if(!empty($tour['brief_description'])){ echo $tour['brief_description'].'..';}?>
                    </div>
                    
                    <div class="col-12 p-1 pt-2 mb-4 mb-md-5" style="font-size:24px;">
                        <?php if(!empty($tour['price'])){?>
                            <b><?php echo $tour['price']?></b>
                        <?php }?>
                    </div>
                    

                    <div class="col-12 pt-4" style="position: absolute; bottom:15px; left:-3px;">
                        <div class="row">
                            <div class="col-6 text-left">
                                <div class="btn btn-lg text-center btn-tour-enquiry" data-toggle="modal" data-target="#enquiryModal" href=# style="width:100%;" onclick="change_title('<?php echo $tour['name']?>')">
                                    ENQUIRY
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <a href="<?php echo ROOT?>tour_details/<?php echo $str_convert->to_url($tour['name'])?>">
                                <div class="btn btn-lg text-center btn-tour-view" style="width:100%;">
                                    VIEW TOUR
                                </div></a>
                            </div>
                        </div>
                    </div>
                

                </div>
        
                
            </div>
        </div>
    </div>
</div>
<?php 
$itemCount++;
}?>

<div class="row">
    <div class="col-12 p-0">
        <?php include 'paging.php';?>
    </div>
</div>
