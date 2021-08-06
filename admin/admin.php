<!DOCTYPE html>
<html lang="en"> 
<?php include('../navs/head.php') ?>



<body>
    
    <?php include('header.php'); ?>
<?php

if(isset($_POST['delete']))
{
    $id =$_POST['story_id'];
    $sql="DELETE FROM stories WHERE id=?";
    $stmt_ = $conn->prepare($sql);
    $stmt_->execute([$id]);
}

?>
    <div class="main-wrapper">
	    <section class="cta-section theme-bg-light py-5">
		    <div class="container text-center">
			     <h2 class="heading">Storylac - Administration </h2>
			    <div class="intro"></div>
			    
		    </div><!--//container-->
	    </section>
	    <section class="blog-list px-3 py-5 p-md-5">
	    	
		    <div class="">
		    
			    <table class="table">
           
               <thead>
                   <th>Story id</th>
                   <th>Story Title</th>
                   <th>Story Category</th>
                   <th>Story Content</th>
                   <th>Location</th>
                   <th>Story Image</th>
                   <th>Date Posted</th>
                   <th>Action</th>
               </thead>


                <tbody>
                    
                
			
			<?php 

              $sql = "SELECT * FROM stories";
              $stmt =$conn->prepare($sql);
              $stmt->execute();
              $data = $stmt->fetchAll();
              foreach ($data as $res) {
            ?>
			
			   
                 <tr>
                    <td><?php echo $res['id'];?></td>
                    <td><?php echo $res['story_title'];?></td>
                    <td><?php echo $res['category'];?></td>
                    <td><?php echo substr($res['story_body'],0,80)?>...</td>
                    <td><?php echo $res['location'];?></td>
                    <td><img class="img img-thumb" height="100" width="100" src="../<?php echo $res['photo'];?>" /></td>
                    <td><?php echo $res['posted_on'];?></td>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

                    <td><input type="hidden" name="story_id" value="<?php echo $res['id']; ?>" /><button type="submit" name="delete" class="btn btn-danger " style="color: white" >Delete</button> </td>
                </form>
                </tr>
               <?php }?>
               </tbody>

               </table>
				
		    </div>
		

           <div class="container">
		    	
                 
			    

			  
			
			
			
			   
				
		    </div>


	    </section>
	    
	    <?php include('../navs/footer.php');?>
    
    </div><!--//main-wrapper-->
    
    
    
    
    <!-- *****CONFIGURE STYLE (REMOVE ON YOUR PRODUCTION SITE)****** -->  
    <div id="config-panel" class="config-panel d-none d-lg-block">
        <div class="panel-inner">
            <a id="config-trigger" class="config-trigger config-panel-hide text-center" href="#"><i class="fas fa-cog fa-spin mx-auto" data-fa-transform="down-6" ></i></a>
            <h5 class="panel-title">Choose Colour</h5>
            <ul id="color-options" class="list-inline mb-0">
                <li class="theme-1 active list-inline-item"><a data-style="assets/css/theme-1.css" href="#"></a></li>
                <li class="theme-2  list-inline-item"><a data-style="assets/css/theme-2.css" href="#"></a></li>
                <li class="theme-3  list-inline-item"><a data-style="assets/css/theme-3.css" href="#"></a></li>
                <li class="theme-4  list-inline-item"><a data-style="assets/css/theme-4.css" href="#"></a></li>
                <li class="theme-5  list-inline-item"><a data-style="assets/css/theme-5.css" href="#"></a></li>
                <li class="theme-6  list-inline-item"><a data-style="assets/css/theme-6.css" href="#"></a></li>
                <li class="theme-7  list-inline-item"><a data-style="assets/css/theme-7.css" href="#"></a></li>
                <li class="theme-8  list-inline-item"><a data-style="assets/css/theme-8.css" href="#"></a></li>
            </ul>
            <a id="config-close" class="close" href="#"><i class="fa fa-times-circle"></i></a>
        </div><!--//panel-inner-->
    </div><!--//configure-panel-->

    
  <?php include('../navs/scripts.php')?>   
    
<script type="text/javascript">
    	
$(function () {
	
    $(".story").slice(0, 4).show();
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $(".story:hidden").slice(0, 4).slideDown();
        if ($(".story:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
        $('html,body').animate({
            scrollTop: $(this).offset().top
        }, 1500);
    });
});

$('a[href=#top]').click(function () {
    $('body,html').animate({
        scrollTop: 0
    }, 600);
    return false;
});

$(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
        $('.totop a').fadeIn();
    } else {
        $('.totop a').fadeOut();
    }
});

    </script>
</body>
</html> 

