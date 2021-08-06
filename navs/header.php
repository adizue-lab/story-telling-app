   <?php include('functions/dbconnection.php') ?>

   <?php 
   error_reporting(0);
   function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$name_err=$story_title_err=$story_photo_err=$story_content_err=$story_location_err="";
   session_start();
 if(isset($_POST['send_story']))
{
   $target_dir = "uploads/";
   $target_file = $target_dir . basename($_FILES["story_image"]["name"]);
   $uploadOk = 1;
   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

   $name = "";//$_POST['title'];
   //$user_id = $_SESSION['user_id'];
   $story_title= $_POST['story_title'];
   $story_photo = $_POST['story_image'];
   $story_content =$_POST['story_content'];
   $story_location= $_POST['location'];
   if(empty($story_title))
   {
     $story_title_err= "Please Title is required";
     $not_ok=0;
   } 
   else
   {
     $story_title= test_input($story_title);
     $not_ok=1;
   }

   if(empty($story_location))
   {
   $story_location_err="Please Enter Story Location";
   $not_ok=0;
   }
   else{
   	$story_location =test_input($story_location);
   	$not_ok=1;
   }


   
 

   if(empty($story_content))
   {
   	$story_content_err="please Enter Story Content";
   	$not_ok=0;
   }
   else{
   	$story_content= test_input($story_content);
   	$not_ok=1;
   }
    if (move_uploaded_file($_FILES["story_image"]["tmp_name"], $target_file)) {
    	$story_photo ="uploads/".basename( $_FILES["story_image"]["name"]);
    //echo "The file ". htmlspecialchars( basename( $_FILES["story_image"]["name"])). " has been uploaded.";
    $not_ok=1;
  } else {
    $story_photo_err= "Sorry, there was an error uploading your file/Not Found!.";
    $not_ok=0;
  }
   
   

try {

  $stmt = $conn->prepare("INSERT INTO stories (category,story_title, story_body, location,photo,user_id,name,posted_on)
  VALUES (:category,:story_title, :story_body, :location, :photo,:user_id,:name,:posted_on)");
  $stmt->bindParam(':category', $category,PDO::PARAM_STR);
  $stmt->bindParam(':story_title', $story_title,PDO::PARAM_STR);
  $stmt->bindParam(':story_body', $story_content,PDO::PARAM_STR);
  $stmt->bindParam(':location', $story_location,PDO::PARAM_STR);
  $stmt->bindParam(':photo',$story_photo,PDO::PARAM_STR);
  $stmt->bindParam(':user_id',$user_id,PDO::PARAM_STR);
  $stmt->bindParam(':name',$name,PDO::PARAM_STR);
  $stmt->bindParam(':posted_on',$today,PDO::PARAM_STR);
  // use exec() because no results are returned

   $category =$_POST['story_category'];
   $story_title= $_POST['story_title'];
   $story_photo = $_POST['story_image'];
   $story_content =$_POST['story_content'];
   $story_location= $_POST['location'];
   $story_photo="uploads/".basename( $_FILES["story_image"]["name"]);
   $today = date("F j, Y, g:i a");;
   $user_id=$_SESSION['user_id'];
   $name =$_SESSION['name'];
  $stmt->execute();
  if($stmt->rowCount()>0) {
  	$inserted="Story Has Been Published Successfully";
  	echo "New record created successfully";
  }
  else{
  	echo "could not upload story at the moment";
  }
  
  

} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
   
}

if(isset($_POST['login']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];

	$stmt =$conn->prepare("SELECT * from users WHERE username=:username AND password=:password");
	$stmt->execute(['username' => $username,'password'=>$password]);
	$user = $stmt->fetch();
	if($user){

		$_SESSION['user_id']= $user['id'];
		$_SESSION['username'] =$user['username'];
		$_SESSION['name']= $user['name'];
		$_SESSION['role']=$user['role'];
    if($user['role']=="admin")
  {
    header("Location: /storries/admin/admin.php");
  }
	}
		else{

        $error="Invalid Login Details";
		}
}

if(isset($_POST['signup']))
{
	$name=$_POST['name'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$role="storyteller";

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->execute([$username]); 
    $user = $stmt->fetch();
if ($user) {
   $error="User already exists with sam email";
} else {
    


    $sql="INSERT INTO users(name,role,username,password) VALUES(?,?,?,?)";
	$stmt=$conn->prepare($sql);
	$stmt->execute([$name,$role,$username,$password]);

	if($stmt->rowCount()>0){
        $success="Account created successfully";

        $_SESSION['user_id']= $conn->lastInsertId();
		$_SESSION['username'] =$_POST['username'];
		$_SESSION['name']= $_POST['name'];
		$_SESSION['role']='storyteller';
	}
	else{
		$error="counldn't create account";
	}
} 

	

}
if(isset($_POST['logout']))
{
unset($_SESSION);
session_destroy();
session_write_close();
}

    ?>



    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type="email" id="defaultForm-email" required="" name="username" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-email">Your email</label>
        </div>

        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type="password" id="defaultForm-pass" required="" name="password" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-pass">Your password</label>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" name="login" class="btn btn-default">Login</button>
      </div>
  </form>
    </div>
  </div>
</div>



 <div class="modal fade" id="modalSignupForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Sign Up</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="modal-body mx-3">
      	<div class="md-form mb-5">
          
          <input type="text" id="defaultForm-email" name="name" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-email">Full Name</label>
        </div>
        <div class="md-form mb-5">
          
          <input type="email" id="defaultForm-email" name="username" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-email">Your email</label>
        </div>

        <div class="md-form mb-4">
          
          <input type="password" id="defaultForm-pass" name="password" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-pass">Your password</label>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" name="signup" class="btn btn-default">Sign Up</button>
      </div>
  </form>
    </div>
  </div>
</div>



<div class="modal fade" id="modalLogoutForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-warning" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header text-center">
        <h4 class="modal-title white-text w-100 font-weight-bold py-2">Logout Request</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">
        <p class="text-center">You are about to be logged out</p>
      </div>

      <!--Footer-->
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="modal-footer justify-content-center">
        <button  type="submit" name="logout" class="btn btn-outline-warning waves-effect">Logout <i class="fas fa-paper-plane-o ml-1"></i></button>
      </div>
  </form>
    </div>
    <!--/.Content-->
  </div>
</div>



<header style="overflow-y: scroll;" class="header text-center">	    
	    <ul style="display: inline;padding: 20px;"  class="navbar-nav flex-column text-left">
					<li style="display: inline;"   class="nav-item">
					    <a style="display: inline;"  class="nav-link" href="/storries"><i class="fas fa-home fa-fw mr-2"></i>Story Home </a>
					</li>
					<li style="display: inline;"  class="nav-item ">
					    <a style="display: inline;"  class="nav-link" href="blog-post.php"><i class="fas fa-bookmark fa-fw mr-2"></i>Stories</a>
					</li>
					<li style="display: inline;"  class="nav-item">
					    <a  style="display: inline;"  class="nav-link" href="about.php"><i class="fas fa-user fa-fw mr-2"></i>Logged in as: <?php if(isset($_SESSION['name'])){?><?php echo $_SESSION['name']?>  <?php }?></a>
					</li>
				</ul>
        
	    <nav class="navbar navbar-expand-lg navbar-dark" >
           
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
            
			<div id="navigation" class="collapse navbar-collapse flex-column" >
				<?php 

                  if($_SESSION['user_id']!=null){
				?>
				<span style="color:#8a6219"><b><?php echo $error;?></b></span>
					 <span style="color:red"><?php echo $success;?></span>
				<h1 class="blog-name pt-lg-4 mb-0"><a href="#">Add Story</a></h1>
				<div class="profile-section pt-3 pt-lg-0">
				    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" >		<span class="error" style="color:color;font-weight: weight"> <?php echo $inserted;?></span>
					<div class="bio mb-3">
							<input placeholder="Story Title"   type="text" class="form-control" name="story_title">
						<span class="error" style="color:red"> <?php echo $story_title_err;?></span>
						</div>
						<div class="bio mb-3">
							<select class="form-control" name="story_category">
								<option value="Comedy">Comedy</option>
								<option value="Tragedy">Tragedy</option>
								<option value="Rebirth">Rebirth</option>
								<option value="Horror">Horror</option>
								<option value="Entertainment">Entertainment</option>
								<option value="Educational">Educational</option>

							</select>
						<span class="error" style="color:red"> <?php echo $story_category_err;?></span>
						</div>
						<div class="bio mb-3">
							<input type="text"  class="form-control" name="location" placeholder="input story location..." />
							<span class="error" style="color:red"><?php echo $story_location_err;?></span>
						</div>
					<div class="bio mb-3">
                      
                        <textarea placeholder="Story Content"  name="story_content" class="form-control" style="width: 100%" rows="10"></textarea>
                        <span class="error" style="color:red"><?php echo $story_content_err;?></span>
						</div>
						<div class="bio mb-3">
							<input type="file" style="height:70px" class="form-control"  name="story_image">
							<span class="error" style="color:red"><?php echo $story_photo_err;?></span>
						</div>
						<div class="bio mb-3">
							<input type="submit" name="send_story" class="btn btn-secondary" />
						</div>
                    </form>
                    <div>
	                <h1 class="blog-name pt-lg-4 mb-0"><a href="#">My Stories</a></h1>
                    	<ul>
                    		<?php

                 $sql ="SELECT * FROM stories WHERE user_id=:id ORDER BY id desc ";

                 $stmt = $conn->prepare($sql);
                 $stmt->execute(['id'=>$_SESSION['user_id']]);

                 $data = $stmt->fetchAll();

		    	 ?>
		    	 <?php 

                 foreach ($data as $res) {
                 	?>
                    		<li style="text-align: left;"><a href="blog-post.php?id=<?php  echo $res['id']; ?>" style='color:white'><?php  echo $res['story_title']; ?></a></li>

                    	<?php } ?>
                    	</ul>
                    </div>

                       
						<!--//bio-->
					<!-- <ul class="social-list list-inline py-3 mx-auto">
			            <li class="list-inline-item"><a href="#"><i class="fab fa-twitter fa-fw"></i></a></li>
			            <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in fa-fw"></i></a></li>
			            <li class="list-inline-item"><a href="#"><i class="fab fa-github-alt fa-fw"></i></a></li>
			            <li class="list-inline-item"><a href="#"><i class="fab fa-stack-overflow fa-fw"></i></a></li>
			            <li class="list-inline-item"><a href="#"><i class="fab fa-codepen fa-fw"></i></a></li>
			        </ul> --><!--//social-list-->
			        <hr> 
				</div><!--//profile-section-->

                   <a class="btn btn-primary" data-toggle="modal" data-target="#modalLogoutForm" href="" target="_blank">Logout</a>
				<?php } else {?>
					<span style="color:#8a6219"><b><?php echo $error;?></b></span>
          
				<div class="my-2 my-md-3">
					 
				    <a class="btn btn-primary" data-toggle="modal" data-target="#modalLoginForm" href="https://themes.3rdwavemedia.com/" target="_blank">Login To Post Stories</a> 
				    <br>OR
				    <br>
				    <a class="btn btn-primary" data-toggle="modal" data-target="#modalSignupForm" href="https://themes.3rdwavemedia.com/" target="_blank">Sign Up To Post Stories</a> 
				    
				</div>
			<?php }?>
				
				
				
			</div>
	
		</nav>


    </header>
