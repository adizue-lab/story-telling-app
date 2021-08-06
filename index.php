<!DOCTYPE html>
<html lang="en"> 
<?php include('navs/head.php') ?>



<body>
    
    <?php include('navs/header.php') ?>

    <div class="main-wrapper">
	    <section class="cta-section theme-bg-light py-5">
		    <div class="container text-center">
			    <h2 class="heading">Storylac - By Cyril </h2>
			    <div class="intro">Welcome to my story liner.</div>
			    <form class="signup-form form-inline justify-content-center pt-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="GET">
                    <div class="form-group">
                        <label class="sr-only" for="semail">Filter Stories By Location</label>
                        <select name="location" style="height: 50px; margin-bottom: 10px"  class="form-control mr-md-1">
                        	<option value="" class="sr-only" for="semail">Filter Stories By Location</option>
                        	<?php

                 $sql ="SELECT  DISTINCT location FROM stories";

                 $stmt = $conn->prepare($sql);
                 $stmt->execute();

                 $data = $stmt->fetchAll();

		    	 ?>
		    	 <?php 

                 foreach ($data as $res) {
                 	?>
                        	<option value="<?php echo $res['location'] ?>"><?php echo $res['location'] ?></option>
                        <?php }?>
                        </select>
                       
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="semail">Filter Stories By Category</label>
                        <select style="height: 50px; margin-bottom: 10px" name="category" class="form-control mr-md-1">
                        	<option value="">Filter Stories By Category</option>
                        	<?php

                 $sql ="SELECT  DISTINCT category FROM stories";

                 $stmt = $conn->prepare($sql);
                 $stmt->execute();

                 $data = $stmt->fetchAll();

		    	 ?>
		    	 <?php 

                 foreach ($data as $res) {
                 	?>
                 	
                        	<option value="<?php echo $res['category'] ?>"><?php echo $res['category'] ?></option>
                        <?php }?>
                        </select>
                       
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
		    </div><!--//container-->
	    </section>
	    <section class="blog-list px-3 py-5 p-md-5">
	    	<?php 
              if(!isset($_GET['location']))
                {
	    	?>
		    <div class="container">
		    	<?php

                 $sql ="SELECT * FROM stories ORDER BY id desc";

                 $stmt = $conn->prepare($sql);
                 $stmt->execute();

                 $data = $stmt->fetchAll();

		    	 ?>
		    	 <?php 

                 foreach ($data as $res) {
                 	?>

                 
			    <div class="item mb-5 story">
				    <div class="media">
					    <img class="mr-3 img-fluid post-thumb d-none d-md-flex" src="<?php echo $res['photo']; ?> " alt="image">
					    <div class="media-body">
						    <h3 class="title mb-1"><a href="blog-post.php?id=<?php echo $res['id']; ?> "><?php echo $res['story_title']; ?> </a></h3>
						    <div class="meta mb-1"><span class="date">Published <?php echo $res['posted_on']; ?> </span> | <span class="date">Story by <?php echo $res['name']; ?> </span> | <span class="date">Category <?php echo $res['category']; ?></span></div>
						    <div class="intro"><?php echo substr($res['story_body'],0,100)?>..... </div>
						    <a class="more-link" href="blog-post.php?id=<?php echo $res['id']; ?> ">Read more &rarr;</a>
					    </div><!--//media-body-->
				    </div><!--//media-->
			    </div><!--//item-->

			    <?php }
		    	  ?>
			    
			
			
			
			    
			    <nav  class="blog-nav nav nav-justified my-5">
				  <!-- <a class="nav-link-prev nav-item nav-link d-none rounded-left" href="#">Load More<i class="arrow-prev fas fa-long-arrow-alt-left"></i></a> -->
				  <a  id="loadMore" class="nav-link-next nav-item nav-link rounded" href="blog-list.html">Load More<i class="arrow-next fas fa-long-arrow-alt-right"></i></a>
				</nav>
				
		    </div>
		<?php } else {?>

 <div class="container">
		    	<?php
		    	$sql=$stmt=$data="";
                 if(!empty($_GET['category']) && !empty($_GET['location']))
                 {
                 	$sql="SELECT * FROM stories WHERE location=? AND category=? ORDER BY id desc";
                 	$stmt = $conn->prepare($sql);
                    $stmt->execute([$_GET['location'],$_GET['category']]);
                    $data = $stmt->fetchAll();
                    
                 }
                 elseif(empty($_GET['location']) && !empty($_GET['category']) ){
                 	$sql="SELECT * FROM stories WHERE category=? ORDER BY id desc";
                 	$stmt = $conn->prepare($sql);
                    $stmt->execute([$_GET['category']]);
                    $data = $stmt->fetchAll();
                    

                 }elseif(!empty($_GET['location']) && empty($_GET['category']) ){
                 	$sql="SELECT * FROM stories WHERE location=? ORDER BY id desc";
                 	$stmt = $conn->prepare($sql);
                    $stmt->execute([$_GET['location']]);
                    $data = $stmt->fetchAll();

                 }
                 else{

                 	$sql="SELECT * FROM stories ORDER BY id desc";
                 	$stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $data = $stmt->fetchAll();
                 }

                 //$sql ="SELECT * FROM stories WHERE location=? ORDER BY id desc";

		    	 ?>
		    	 <?php 

                 foreach ($data as $res) {
                 	?>

                 
			    <div class="item mb-5 story">
				    <div class="media">
					    <img class="mr-3 img-fluid post-thumb d-none d-md-flex" src="<?php echo $res['photo']; ?> " alt="image">
					    <div class="media-body">
						    <h3 class="title mb-1"><a href="blog-post.php?id=<?php echo $res['id']; ?> "><?php echo $res['story_title']; ?> </a></h3>
						    <div class="meta mb-1"><span class="date">Published <?php echo $res['posted_on']; ?> </span> | <span class="date">Story by <?php echo $res['name']; ?> </span> | <span class="date">Category <?php echo $res['category']; ?></span></div>
						    <div class="intro"><?php echo substr($res['story_body'],0,100)?>..... </div>
						    <a class="more-link" href="blog-post.php?id=<?php echo $res['id']; ?> ">Read more &rarr;</a>
					    </div><!--//media-body-->
				    </div><!--//media-->
			    </div><!--//item-->

			    <?php }
		    	  ?>
			    
			
			
			
			    
			    <nav  class="blog-nav nav nav-justified my-5">
				  <!-- <a class="nav-link-prev nav-item nav-link d-none rounded-left" href="#">Load More<i class="arrow-prev fas fa-long-arrow-alt-left"></i></a> -->
				  <a  id="loadMore" class="nav-link-next nav-item nav-link rounded" href="blog-list.html">Load More<i class="arrow-next fas fa-long-arrow-alt-right"></i></a>
				</nav>
				
		    </div>


		<?php }?>
	    </section>
	    
	    <?php include('navs/footer.php');?>
    
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

    
  <?php include('navs/scripts.php')?>   
    
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

