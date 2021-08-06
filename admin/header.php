   <?php include('../functions/dbconnection.php') ?>

   <?php 
   function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$name_err=$story_title_err=$story_photo_err=$story_content_err=$story_location_err="";
   session_start();
 

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
header("Location: /storries/index.php");
}

    ?>



   


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
<h3 style="margin-top: 30px">Admin</h3>  
	    <ul style="padding: 50px;"  class="navbar-nav flex-column text-left">
        <li style="padding-bottom: 30px;"  class="nav-item">
              <a  style=""  class="nav-link" href="/storries"><i class="fas fa-user fa-fw mr-2"></i>Site Home</a>
          </li> 
					<li style="padding-bottom: 30px;"   class="nav-item">
					    <a style=""  class="nav-link" href="/storries/admin/admin.php"><i class="fas fa-home fa-fw mr-2"></i>Manage Stories </a>
					</li>
					<li style="padding-bottom: 30px;"  class="nav-item ">
					    <a style="display: inline;"  class="nav-link" href="/storries/admin/admin_users.php"><i class="fas fa-bookmark fa-fw mr-2"></i>Manage Users</a>
					</li>
					<!-- <li style="padding-bottom: 30px;"  class="nav-item">
					    <a  style=""  class="nav-link" href="about.php"><i class="fas fa-user fa-fw mr-2"></i>Profile</a>
					</li> -->
          <li style="display: inline;"  class="nav-item">
              <a  style="display: inline;" data-toggle="modal" data-target="#modalLogoutForm"  class="nav-link" href="about.php"><i class="fas fa-user fa-fw mr-2"></i>Logout</a>
          </li>
				</ul>
        
	    <nav class="navbar navbar-expand-lg navbar-dark" >
           
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
            
			<div id="navigation" class="collapse navbar-collapse flex-column" >
				

			</div>
	
		</nav>


    </header>
