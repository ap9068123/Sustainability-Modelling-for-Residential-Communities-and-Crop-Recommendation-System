<?php 
session_start();
$email=$_SESSION['email'];
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'cf';

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
$m="";

//$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$sql1 = "SELECT * FROM users where email='$email'";
$result1 = $conn->query($sql1); 


$s=0;


foreach($result1 as $row)
{
   
 
 $s=$row['credit'];
 $_SESSION['points']=$s;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
    margin: 0;
    font-family: Arial, sans-serif;
}

.grid-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 40px;
    padding: 20px;
}

.grid-item {
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
}

.grid-item img {
    width: 100%; /* Make images responsive */
    height: 300px; /* Fixed height for all images */
   /* object-fit: cover; /* Ensures image covers the area, might crop */
}

.item-info {
    padding: 10px;
    text-align: center;
}

.item-info p {
    margin: 10px 0;
    font-size: 20px;
    font-weight: bold;
}

button {
    padding: 10px 20px;
    font-size: 16px;
    color: #fff;
    /*background-color: #007bff;*/
    background-color: darkgreen;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

.t
{
    text-align: center;
   

    background-color: darkgreen;
    margin: 0 auto;
    width: 18%;
    height: 60%;
    color: white;
    padding: 10px 10px 10px 10px;
    border-radius: 8px;
}

    </style>
</head>
<body>

<div class="grid-container">
    <div class="grid-item">
        <img src="tshirt.png" alt="Product 1">
        <div class="item-info">
            <p>1000 <span style="background-color:gold; color:gold;border-radius:50%;">&#9711;</span> </p>

            <button data-value="1000" class="value-btn">Add to Cart</button>
        </div>
    </div>
    <div class="grid-item">
        <img src="bag.png" alt="Product 2">
        <div class="item-info">
        <p>2000 <span style="background-color:gold; color:gold;border-radius:50%;">&#9711;</span> </p>
        <button data-value="2000" class="value-btn">Add to Cart</button>
        </div>
    </div>

    <div class="grid-item">
        <img src="hoodie.png" alt="Product 2">
        <div class="item-info">
        <p>5000 <span style="background-color:gold; color:gold;border-radius:50%;">&#9711;</span> </p>
        <button data-value="5000" class="value-btn">Add to Cart</button>
        </div>
    </div>

    <div class="grid-item">
        <img src="cover.png" alt="Product 2">
        <div class="item-info">
        <p>1500 <span style="background-color:gold; color:gold;border-radius:50%;">&#9711;</span> </p>
            <button data-value="1500" class="value-btn">Add to Cart</button>
        </div>
    </div>

    <div class="grid-item">
        <img src="watch.png" alt="Product 2">
        <div class="item-info">
        <p>2500 <span style="background-color:gold; color:gold;border-radius:50%;">&#9711;</span> </p>
        <button data-value="2500" class="value-btn">Add to Cart</button>
        </div>
    </div>

   
    <!-- Add more items here -->
</div>
<br><br>
<div class="t">
    <h2>Total coins</h2>
    <h3>  <?php echo $s?> &nbsp;<span style="background-color:gold; color:gold;border-radius:50%;">&#9711;</span></h3>
</div>

<script>

document.querySelectorAll('.value-btn').forEach(button => {
        button.addEventListener('click', function() {
            var value = this.getAttribute('data-value'); // Get the value
            // Redirect to the new page with the value as a query string parameter
            window.location.href = 'order.php?amount=' + value;

        
        });
    });
    
</script>
</body>
</html>
