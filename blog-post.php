<!DOCTYPE html>
<html lang="en"> 
<?php include('navs/head.php');?>

<body>
    
    <?php include('navs/header.php'); ?>
    
    <div class="main-wrapper">
	    
	    <article class="blog-post px-3 py-5 p-md-5">
	    	<?php 
            $stmt = $conn->prepare("SELECT * FROM stories WHERE id=?");
            $stmt->execute([$_GET['id']]); 
            $story = $stmt->fetch();
            if($story)
            {
	    	?>

		    <div class="container">
			    <header class="blog-post-header">
				    <h2 class="title mb-2"><?php echo $story['story_title']; ?></h2>
				    <div class="meta mb-3"><span class="date">Published <?php echo $res['posted_on']; ?> </span> | <span class="date">Published by <?php echo $story['name']; ?> </span></div>
			    </header>
			    
			    <div class="blog-post-body">
				    <figure class="blog-banner">
				        <a href="https://made4dev.com"><img class="img-fluid" src="<?php echo $story['photo'] ?>" alt="image"></a>
				        
				    </figure>
				    <p><?php echo $story['story_body']; ?> </p>
				    
				  

				   
			    </div>
				    
			    <nav class="blog-nav nav nav-justified my-5">
				  <a class="nav-link-prev nav-item nav-link rounded-left" href="/storries">Stories<i class="arrow-prev fas fa-long-arrow-alt-left"></i></a>
				
				</nav>
				
			
				
		    </div><!--//container-->
		<?php }?>
	    </article>
	    
	  
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
    

</body>
</html> 

