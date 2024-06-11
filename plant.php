<?php
    session_start();
   

    $host = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'cf';
    
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
  
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $ptype = mysqli_real_escape_string($conn, $_POST['ptype']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $pnum = mysqli_real_escape_string($conn, $_POST['num']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $la= $_POST['latitude'];
    $lo=$_POST['longitude'];
    
  // echo "lat : " .$la."  ".$lo;

    if(!empty($name) && !empty($email)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            
                if(isset($_FILES['image'])){
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    
                    $img_explode = explode('.',$img_name);
                    $img_ext = end($img_explode);
    
                    $extensions = ["jpeg", "png", "jpg"];
                    if(in_array($img_ext, $extensions) === true){
                        $types = ["image/jpeg", "image/jpg", "image/png"];
                        if(in_array($img_type, $types) === true){
                            $time = time();
                            $new_img_name = $time.$img_name;
                            if(move_uploaded_file($tmp_name,"images/".$new_img_name)){
                                //$ran_id = rand(time(), 100000000);
                               // $status = "Active now";
                                //$encrypt_pass = md5($password);
                                
                                $insert_query = mysqli_query($conn, "INSERT INTO plantation (name, email, ptype,location,count, image,date,lat,longi)
                                VALUES ( '{$name}', '{$email}', '{$ptype}','{$location}','{$pnum}', '{$new_img_name}','{$date}','{$la}','{$lo}')");
                                if($insert_query){
                                    $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                    if(mysqli_num_rows($select_sql2) > 0){
                                        $result = mysqli_fetch_assoc($select_sql2);
                                        //$_SESSION['unique_id'] = $result['unique_id'];
                                        echo '<br><br><br><h3 align="center"  style="color:darkgreen;">Updated Successfully</h3>';
                                    }else{
                                        echo "This email address does not Exist!";
                                    }
                                }else{
                                    echo "Something went wrong. Please try again!";
                                }
                            }
                        }else{
                            echo "Please upload an image file - jpeg, png, jpg";
                        }
                    }else{
                        echo "Please upload an image file - jpeg, png, jpg";
                    }
                
            }
        }else{
            echo "$email is not a valid email!";
        }
    }else{
        echo "All input fields are required!";
    }
?>