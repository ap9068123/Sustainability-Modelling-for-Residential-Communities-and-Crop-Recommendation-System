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
  

                   $email=$_SESSION['email'];

                   $name=$_POST["editName"];
                  // $em=$_POST["editEmail"];
                   $location=$_POST["editLocation"];

    if(!empty($name) && !empty($email)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            
                if(isset($_FILES['a'])){
                    $img_name1 = $_FILES['a']['name'];
                    $img_type1 = $_FILES['a']['type'];
                    $tmp_name1 = $_FILES['a']['tmp_name'];

                    
                    $img_explode1 = explode('.',$img_name1);
                    $img_ext1 = end($img_explode1);
    
                    $extensions = ["jpeg", "png", "jpg"];
                    if(in_array($img_ext1, $extensions) === true){
                        $types = ["image/jpeg", "image/jpg", "image/png"];
                        if(in_array($img_type1, $types) === true){
                            $time = time();
                            $new_img_name1 = $time.$img_name1;
                            
                            if(move_uploaded_file($tmp_name1,"images/".$new_img_name1)){
                                //$ran_id = rand(time(), 100000000);
                               // $status = "Active now";
                                //$encrypt_pass = md5($password);
                                 
                             echo '<br><br><br><h3 align="center"  style="color:darkgreen;">Updated Successfully</h3>';
                                
  $insert_query = "UPDATE users SET name='$name', location='$location' ,img ='$new_img_name1' where email='$email'";
                    $result = $conn->query($insert_query);

                             
                            
                  
                                
                                
                             
                                if($insert_query){
                                    $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                    if(mysqli_num_rows($select_sql2) > 0){
                                        $result = mysqli_fetch_assoc($select_sql2);
                                        //$_SESSION['unique_id'] = $result['unique_id'];
                                        //echo "success";
                                    }else{
                                        echo "This email address not Exist!";
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


