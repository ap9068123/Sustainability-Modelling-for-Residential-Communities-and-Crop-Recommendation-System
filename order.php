<?php


session_start();
$t=$_SESSION['points'];
//$t=1000;
$amount=0;
if (isset($_GET['amount'])) {
 
    $amount = htmlspecialchars($_GET['amount']);
   
    $_SESSION['amount']=$amount;
    
} 

if($t<$amount)
{
    echo '<br><br><br><h1 style="color:red;" align="center">You do not have enough coins</h1>';
   
}


else{


echo '

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Date Input Form</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
           height: 500px;
            text-align: center;
            border: solid darkgreen 2px;
        }

        h2 {
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }


        .signin input[type="text"],
        .signin input[type="date"],
        .signin input[type="number"],
    .signin input[type="password"],
    .signin input[type="submit"] {
      width: 60%;
      padding: 10px;
      border: solid darkgreen 2px;
      border-radius: 8px;
      margin-bottom: 10px;
    }
    
    .signin input[type="submit"] {
      background-color:  darkgreen;
      width: 60%;
      color: #fff;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }
    
    #d
    {
        background-color: darkgreen;
        color: white;
        padding: 20px 20px 20px 20px;
        border-radius: 8px;
    }
    

        
    </style>
</head>
<body>
    <div id="signup-section" class="signin">
    <form method = "POST" action= "place_order.php" enctype="multipart/form-data" autocomplete="off">

        <h2 id="d">Address Details</h2><br><br>
        <input type="text" id="name" name="name" placeholder="&#128100;  Name" required>
      <input type="text" id="email" name= "email" placeholder="&#9993;  Email" required>
        <input type="text" id="num" name="num" placeholder="&#x2328; Contact no." required>
        <input type="text" id="add" name= "add"  placeholder="&#128205;Address" required>
        <input type="text" id="add" name= "pro"  placeholder="Product and Size (if applicable)" required>
    
        </p>
          <input type="submit" value="&#10004;  Submit">   <br><br><br><br> <br><br><br><br>
         
      </form>
      </div>

</body>
</html>

';

}

?>
