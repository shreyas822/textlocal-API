<!DOCTYPE html>
<html lang='en'>
<head>
<title>Registration</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" />
</head>
<body>
<div>
<?php

$dbhost='localhost';
$dbuser='root';
$dbpwd='';
$dbname='test';
$con=mysqli_connect($dbhost,$dbuser,$dbpwd,$dbname);
if(!$con)
{
echo "Failed to connect to Mysql mysqli_connect_error()" ;
exit();
}
else
{
if(isset($_POST['click']))
{
$uname=$_POST['uname'];
$email=$_POST['email'];
$phno='91'.$_POST['phno'];

    $apiKey = urlencode('N6GKTI5S5aY-fIrUBuaTfDdRwR5LnPUPJgaRCjluot');
	$numbers = array($phno);
	$sender = urlencode('TXTLCL');
	$message = rawurlencode('Thankyou for Registration');
 
	$numbers = implode(',', $numbers);
 
	// Prepare data for POST request
	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
	// Send the POST request with cURL
	$ch = curl_init('https://api.textlocal.in/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	// Process your response here
	echo $response;

$query=mysqli_query($con,"SELECT phonenum FROM registration WHERE phonenum='$phno' ");

if ($rowcount=mysqli_num_rows($query)!=0)
{
echo "user already exists";
}
else
{
      $result="INSERT INTO registration (name, mail,phonenum)
      VALUES ('$uname','$email','$phno')";
       if (mysqli_query($con, $result)) {
      echo "New record created successfully";
}      else {
       echo "Error: <br>" , mysqli_error($con);
        }
     
}
}
}

mysqli_close($con);

?>
</div>
<div class="container">
<form method="post" action="insert.php">

<div >
    <h3 align="center">Webinar Registration Form</h3>
UserName <input class="form-control" type="text" name="uname" required><br>
Email <input class="form-control"type="email" name="email" required><br>

PhoneNumber <input class="form-control"  type="text" name="phno" required><br>

</div>
<div >
<input class="btn btn-primary" type="submit" name="click" value="Submit">
    </div>

</form>

</div>

</body>
</html>