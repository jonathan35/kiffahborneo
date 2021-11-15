

<form action="<?php echo ROOT?>tours" method="post" class="form-group pt-0" id="search_from" style="margin-top:20px;">
    <div class="ic-search" style="color:#555;">
        <i class="fa fa-search"></i>
    </div>
    <input type="text" class="form-control h-search" name="keyword" placeholder="Search Tour" id="keyword" autocomplete="off" style="width:96%; display:inline-block; background: #111; border:1px solid #333; color:white; ">
    
    <div style="width:0; height:0; position:relative; left:-30px; overflow:visible; display:inline-block; ">
    <img src="<?php echo ROOT?>images/close-16.png" id="clearkeyword" onclick="clearkeyword()" onload="fadeOut()"></div>
    
    
</form>

<div id="auto_list">
    <?php 
    $tour_items = sql_read("select name, brief_description, full_description from tour where status =1 order by name asc");

    foreach((array)$tour_items as $tour_item){
        echo '<div class="auto_suggest_item">'.$tour_item['name'].'<span style="display:none">||||'.$tour_item['brief_description'].$tour_item['full_description'].'</span></div>';
    }
    ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

$('#clearkeyword').fadeOut();

$("#keyword").on('keyup dblclick', function(){
    
    //var asdsad = '#clearkeyword';
    //$("#clearkeyword").css("display", "inline-block");

    $('#clearkeyword').fadeIn();

    var keyw = $(this).val();

    if( keyw != ''){
        $('#auto_list').fadeIn();
    }else{
        $('#auto_list').fadeOut();
    }

    $( ".auto_suggest_item" ).each(function( index ) {
        var auto_suggest_item = $(this).text();
        if(auto_suggest_item.toLowerCase().includes(keyw.toLowerCase()) === true){
            $(this).fadeIn();
        }else{
            $(this).fadeOut();
        }
    });
});

$(".auto_suggest_item").on('click', function(){
    var str = $(this).text();
    var str = str.split('||||')[0];
    $('#keyword').val(str);
    //$('#keyword').focus(); 
    $('#auto_list').fadeOut();
    document.getElementById('search_from').submit();
});

$(function() {
    $("body").click(function(e) {
        if (e.target.id == "auto_list" || $(e.target).parents("#auto_list").length || e.target.id == "keyword" ) {
            //alert("Inside div");
        } else {
            $('#auto_list').fadeOut();
        }
    });
})

$("#clearkeyword").click(function(e) {
    $('#clearkeyword').fadeOut();
    $('#keyword').val('');
    $('#keyword').focus();
})

</script>

<style>
#search_from {
    padding-top:20px;
}
#auto_list {
    /**/display:none;
    position:absolute;
    top:62px;
    z-index:4;
    background: #444;
    border:1px solid #444;
    box-shadow:2px 2px 4px rgb(0,0,0);
    overflow-y:scroll;
    overflow-x:hidden;
    max-height:80vh;
    transition: background .5s;
}
@media (max-width: 575px) {
    #search_from {
        top:-10px;
    }
    #auto_list {
        top:50px;
        width:91%;
    }
}
#auto_list > div {
    padding:4px 10px;
    cursor:pointer;
}
#auto_list > div:hover {
    background: #222;
}
.h-search::placeholder {
    color:#999;
}
</style>
