
<div class="row text-center p-4 p-md-2" style="background:#CCC; border-top:4px solid #666;  color:#555; font-size:15px;">
    <div class="col-12 col-md-10 offset-md-1">
        <div class="row text-center pt-2">
            <div class="col-12 text-center back-top" style="color:#FFF;">
                <i class="fa fa-chevron-circle-up" aria-hidden="true" onclick="scroll_top();"></i>
            </div>
            <script>
            function scroll_top(){
                var body = $("html, body");
                body.stop().animate({scrollTop:0}, 500, 'swing', function() { });
            }
            </script>
        </div>

        <div class="row d-flex pt-4 pb-5 text-left" >

            <div class="col-12 col-md">
                <div class="footer-title pt-5 mt-3 pt-md-2">Tours</div>
                <div class="row">                
                    <?php 
                    $types = sql_read("select * from tour_type where status=1 order by position asc, id desc limit 8");
                    foreach($types as $type){?>
                    <div class="col-6 col-md-12 pt-1">
                        <a href="<?php echo ROOT?>type/<?php echo $str_convert->to_url($type['tour_type'])?>" style="color:#555;"><?php echo $type['tour_type']?></a>
                    </div>
                    <?php }?>
                </div>
            </div>

            <div class="col-12 col-md">
                <div class="footer-title pt-5 mt-3 pt-md-2">Social</div>
                <div class="pb-1">
                    <a href="https://www.facebook.com/Kiffah/?ref=hl" target="_blank">
                        <img src="<?php echo ROOT?>images/facebook-f.svg" width="14px" style="margin:10px">
                    </a>
                    <a href="https://wa.me/60198889999" target="_blank">
                        <img src="<?php echo ROOT?>images/whatsapp.svg" width="20px" style="margin:10px">
                    </a>
                    <a href="#" target="_blank">
                    <img src="<?php echo ROOT?>images/instagram.svg" width="20px" style="margin:10px">
                    </a>
                </div>
       
                <div class="footer-title pt-5 mt-3 pt-md-2">Email</div>
                <div class="pb-1">
                    kiffahborneo@yahoo.com
                </div>
                <div class="pb-1">
                    kiffahtrvlkch@yahoo.com.my
                </div>
            </div>


            <div class="col-12 col-md">

                <div class="footer-title pt-5 mt-3 pt-md-2" style="over">Mobile</div>
                <div class="pb-1">
                    +6 016 859 3342<br>
                    +6 019 866 0559<br>
                    +6 016 867 8364<br>
                </div> 
                <div class="footer-title pt-5 mt-3 pt-md-2">Call</div>
                <div class="pb-1">
                    +6 082 239 385 
                </div>            
                <div class="footer-title pt-5 mt-3 pt-md-2">Fax</div>
                <div class="pb-1">
                    +6 082 239 385
                </div>
                
                


            </div>

            <div class="col-12 col-md">
                <div class="footer-title pt-5 mt-3 pt-md-2">Address</div>
                <div class="pb-1">
                    Lot 386, Sub Lot 15,<br>
                    2nd Floor Wisma Polarwood<br>
                    Jalan Muhibbah Satok,<br>
                    93400 Kuching, Sarawak
                </div>
                <br><br>
                <div class="pb-1">
                <a href="https://www.google.com/maps/place/Kiffah+Borneo+Tours+%26+Travel+Sdn+Bhd/@1.5537765,110.3258201,17z/data=!3m1!4b1!4m5!3m4!1s0x31fb099e79893221:0xf3d89ec3f96dcad0!8m2!3d1.5537955!4d110.3280098" target="_blank" style="color:darkorange;">
                    <img src="<?php echo ROOT?>images/678111-map-marker-512.webp" width="18px" style="display:inline-block;">
                    View Map</a>
                </div>
            </div>
        


        </div>

        <br><br>
        <div class="row">
            <div class="col-12 text-muted">
                2020. kiffahborneo.com.my All rights reserved. Powered by Quest Marketing.
            </div>
        </div>




    </div>
</div>



<div id="enquiryModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-edit-panel" style="background:#555; ">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-black" aria-hidden="true">&times;</span>
                </button>
                <div class="login-panel form-rounded">
                    <?php include 'message.php'?>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
function change_title(title){
    $('input[name=tour]').val(title);
}
</script>

<?php include_once 'config/session_msg.php';?>