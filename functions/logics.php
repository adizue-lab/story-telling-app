<?php
require_once('dbconnection.php');
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if(isset($_POST['send_stor']))
{
   session_start();
   $name = $_POST['title'];
   $user_id = $_SESSION['user_id'];
   $story_title= $_POST['story_title'];
   $story_photo = $_POST['story_image'];
   $story_content =$_POST['story_content'];
   $story_location= $_POST['location'];
   if(empty($name))
   {
     
   } elseif(empty($story_title))
   {

   }elseif(empty($story_location))
   {

   }elseif (empty($story_content)) {
   	
   }
   else{

try {
  $today = date("F j, Y, g:i a");
  $stmt = $conn->prepare("INSERT INTO stories (story_title, story_body, location,photo,user_id,posted_on)
  VALUES (:story_title, :story_body, :location, :photo,:user_id,:posted_on)");
  $stmt->bindParam(':story_title', $name);
  $stmt->bindParam(':story_body', $story_content);
  $stmt->bindParam(':location', $story_location);
  $stmt->bindParam(':photo',$story_photo);
  $stmt->bindParam(':user_id',$user_id);
  $stmt->bindParam(':posted_on',$today);

  // use exec() because no results are returned
  $conn->execute();
  echo "New record created successfully";
header("location:index.php");
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
   }

}

if(isset($_POST['sign_up']))
{
   $name = $_POST['name'];
   $role = $_SESSION['role'];
   $username= $_POST['username'];
   $password = $_POST['password'];
   if(empty($name))
   {

   }elseif (empty($role))
   {

   }elseif (empty($username))
   {

   }elseif (empty($password)) {
   	# code...
   }
   else{
       
       $stmt = $conn->prepare("INSERT INTO users (name,role,username,password)
  VALUES (:name, :role, :username, :password)");
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':role', $role);
  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':password',$password);
  
  // use exec() because no results are returned
  $conn->execute();

  header("location:index.php");

   }
}

if(isset($_POST['login']))
{

}
?>