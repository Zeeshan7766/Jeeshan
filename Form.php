<?php include_once 'connection.php';
session_start(); 
if(isset($_POST['submit']))
{

  $name = $_POST['name'];
  $email = $_POST['email'];
  $dob   = $_POST['dob'];
  $message = $_POST['message'];

  $insert ="INSERT INTO `user`(`name`, `email`, `dob`, `message`) 
  VALUES ('$name','$email','$dob','$message')";

if (mysqli_query($db, $insert)) {
  echo "New record created successfully !";
 } else {
  echo "Error: " . $insert . "
" . mysqli_error($db);
 }
 mysqli_close($db);
}
?>
<!DOCTYPE html>
<html>
<head>
 
 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <div class= "main">
<form method="POST" action="" id="form"> 

<label for="name">Name: </label>
<input type="text" name="name" 
value="" required>
<br>
<label for="email">Email: </label>
<input type="text" name="email" 
value="" required>
<br>
<label for="dateofbirth">Date Of Birth: </label>
<input type="text" name="dob" 
value="" required>
<br>
<label for="message">About Your Self:</label> 
<textarea style="margin-top:20px" name="message" rows=8 cols=30 required></textarea>
<br>
<div class="g-recaptcha" data-sitekey="6LcKLrgcAAAAAIznF_xyS9urn3pSetojqL5rxW8Z"></div>
      <br/>
      <?php
  if(!empty($_POST['g-recaptcha-response']))
  {
        $secret = '6LcKLrgcAAAAALdV_gu4xQcHz5cjbDjzDfE_06qi';
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success)
            $message = "g-recaptcha varified successfully";
        else
            $message = "Some error in vrifying g-recaptcha";
       echo $message;
   }
?>
<input type="submit" value="Submit" name="submit">
</form>	
</div>
<p id="countdown">3:00</p>
<script>
const startingminutes = 3;
let time = startingminutes * 60;

const countdownl = document.getElementById('countdown');
setInterval(updateCountdown,1000);

function updateCountdown(){
  const minutes = Math.floor(time / 60);
  let second = time % 60;

  countdownl.innerHTML = `${minutes}:${second}`;
  time--;
}

</script>

</body>
</html>