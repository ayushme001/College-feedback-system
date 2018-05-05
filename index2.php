<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: logins.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: index.html");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
 	<link rel="stylesheet" type="text/css" href="style.css"> 
</head>
<body>

<div class="header">
	<h2>Student Feedback</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
          
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : 
        $username=$_SESSION['username'];?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
       
    	
    <?php endif ?>
        <?php
        $date = date('d/m/Y');
        $db = mysqli_connect('localhost', 'root', '');
        mysqli_select_db($db,'registration'); 
        ?>
       
        
         <form form method='post' name="feedback" id="feedback" action="#">
             
         <select name="sub" style=" width: 210px; margin: 10px; font-size: 100%;">
             <option value="" disabled selected>Select Subject </option>
            <option value="cbnst" >CBNST</option>
            <option value="automata">Automata</option>
            <option value="micro">Microprocessors</option>
            <option value="co" >Computer Organization</option>
            <option value="java" >Java</option>
            <option value="cc">Cloud Computing</option>
         </select>
            
         </form>
          <textarea name="feedback" form="feedback" placeholder="Enter feedback here..." style="width: 550px ; height: 200px ; margin-top: 20px ;font-size: 100%;"></textarea>
             <button type='submit' class="btn" value="submit" form="feedback" name="submit" style="margin-top: 20px;" >submit</button>
            <?php
            $sub=" ";  
           $errors = array(); 
            
           if (isset($_POST['submit'])) {
              
                $sub = mysqli_real_escape_string($db,$_POST['sub']);
                if (empty($sub)) { array_push($errors, "Subject is required"); include('errors.php');}
                    //include('errors.php');
                    $sql = "SELECT `id` FROM `$sub` WHERE (name = '$username')";
                if($sub){
                     $retval = mysqli_query($db , $sql );
                    if(! $retval )
                     {
                        die('Could not get data: ' . mysqli_error());
                     }
                    while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) 
                    {
                     $id=$row['id'];
                     //echo "id :{$row['id']}  <br> " ;
                    }
                
                
                     $text = mysqli_real_escape_string($db,$_POST['feedback']);
                     //if (empty($sub)) { array_push($errors, "Subject is required"); }
                     if (empty($text)) { array_push($errors, "Feedback is required"); }
                     include('errors.php');
                     //echo"$text";
                     //$feed="INSERT INTO $sub WHERE name VALUES ('$text')";
                     //$feed="UPDATE `$sub` SET `feedback` = '$text' WHERE `$sub`.'name' = $username;";
                     $feed="UPDATE `$sub` SET `feedback` = '$text' WHERE `$sub`.`id` = '$id';";
                     $retraval=mysqli_query($db,$feed)  ;
                     if(!$retraval)
                     {
                          die ('Error updating database' . mysqli_error());
                     }
                       
                }
            
              } 
          ?>
        
         
         
         
         
         
        <?php
        /*
        $db = mysqli_connect('localhost', 'root', '');
        mysqli_select_db($db,'registration'); 
        $sql = "SELECT * FROM student_database ORDER BY id ASC ";
        $retval = mysqli_query($db , $sql );
        if(! $retval )
        {
            die('Could not get data: ' . mysqli_error());
         }
        
        
        
        
        
        
        
       
         // Start date
	//$date = '2009-12-06';
	// End date
	$end_date = date('d/m/Y');
        $date1 = '01/05/2018'; 
        $i=0;
        for($i=1;$i<=$end_date;$i++)
	 {  
            
                if($date1!=$end_date+1)
                {
                
                echo"<tr>";
                echo"<td>";
                echo "$date1\n";
                echo"<td>";
                $sql = "SELECT `$date1` FROM `cbnst` WHERE (name = '$name')" ;
                $retval = mysqli_query($db , $sql );
                if(! $retval )
                {
                    die('Could not get data: ' . mysqli_error());
                }
         
                        
                 while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) 
                 {
                    $attn=$row[$date1];
                    echo "$attn " ;
                 }

                echo"</td>";
                echo"<td>";
                $sql = "SELECT `$date1` FROM `automata` WHERE (name = '$name')" ;
                $retval = mysqli_query($db , $sql );
                if(! $retval )
                {
                    die('Could not get data: ' . mysqli_error());
                }
         
                        
                 while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) 
                 {
                    $attn=$row[$date1];
                    echo "$attn " ;
                 }

                
                echo"</td>";
                echo"<td>";
                $sql = "SELECT `$date1` FROM `micro` WHERE (name = '$name')" ;
                $retval = mysqli_query($db , $sql );
                if(! $retval )
                {
                    die('Could not get data: ' . mysqli_error());
                }
         
                        
                 while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) 
                 {
                    $attn=$row[$date1];
                    echo "$attn " ;
                 }

                echo"</td>";
                echo"<td>";
                
                $sql = "SELECT `$date1` FROM `co` WHERE (name = '$name')" ;
                $retval = mysqli_query($db , $sql );
                if(! $retval )
                {
                    die('Could not get data: ' . mysqli_error());
                }
         
                        
                 while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) 
                 {
                    $attn=$row[$date1];
                    echo "$attn " ;
                 }

                echo"</td>";
                echo"<td>";
                $sql = "SELECT `$date1` FROM `java` WHERE (name = '$name')" ;
                $retval = mysqli_query($db , $sql );
                if(! $retval )
                {
                    die('Could not get data: ' . mysqli_error());
                }
         
                        
                 while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) 
                 {
                    $attn=$row[$date1];
                    echo "$attn " ;
                 }

                echo"</td>";
                echo"<td>";
                $sql = "SELECT `$date1` FROM `cc` WHERE (name = '$name')" ;
                $retval = mysqli_query($db , $sql );
                if(! $retval )
                {
                    die('Could not get data: ' . mysqli_error());
                }
         
                        
                 while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) 
                 {
                    $attn=$row[$date1];
                    echo "$attn " ;
                 }

                echo"</td>";
                
                echo"</td>";
                echo"</tr>";

                
                }
                $date1=date('d/m/Y',strtotime("+$i days"));
                
                
	}
        */
      

       
        ?>

      
    
    <p style="margin-top: 20px;"> <a href="index2.php?logout='1'" style="color: red;">logout</a> </p>
</div>	
</body>
</html>