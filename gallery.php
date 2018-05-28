<?php include("includes/header.php");?>


    <div class="mainContainer">
                <?php

                $IMAGES=array("uploads/bahar1.gif"=>"uploads/bahar1.gif","uploads/bahar2.gif"=>"uploads/bahar2.gif","uploads/bahar3.gif"=>'uploads/bahar3.gif',"uploads/bahar6.gif"=>"uploads/bahar6.gif","uploads/bahar7.gif"=>"uploads/bahar7.gif","uploads/bahar9.gif"=>"uploads/bahar9.gif","uploads/bahar10.gif"=>"uploads/bahar10.gif");
            ?>
            <div style="z-index=1000;">
                    <h1 class="gallery_P">PHOTOS</h1>
                    <?php
                        foreach ($IMAGES as $image => $main) {
                            echo '<a class="gallVid gallery"  href="'.$main.' "data-lightbox="bahar"><img class="small-thumb" style="width:150px; padding:15px;" src="'.$image.'"></a>';
                        }
                    ?>
        
                <div>
                    <h1 class="gallery_P">VIDEOS</h1>
                     <video  width="400" controls > <source src="uploads/gallery/videos/bahar1.mp4"></video>
                    <video  width="400" controls > <source src="uploads/gallery/videos/bahar2.mp4"></video>
                       <video  width="400" controls > <source src="uploads/gallery/videos/bahar3.mp4"></video>
                        <video  width="400" controls > <source src="uploads/gallery/videos/bahar4.mp4"></video>
                          <video  width="400" controls > <source src="uploads/gallery/videos/bahar5.mp4"></video>
                            <video  width="400" controls > <source src="uploads/gallery/videos/bahar6.mp4"></video>
                              <video  width="400" controls > <source src="uploads/gallery/videos/bahar7.mp4"></video>
                </div>  
            </div>
        </div>
        <script src="includes/lightbox.js"></script>
        <script>
            lightbox.option({
              'wrapAround': true,
              'alwaysShowNavOnTouchDevices':true
            })
        </script>
 

<?php include("includes/footer.php");?>
