<?php
    session_start();
    
    if(isset($_POST['firstname'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $caste = $_POST['caste'];
        $password = $_POST['password'];
        $re_password = $_POST['re_password'];
        // $inputCaptcha = $_POST['captcha'];

        if($password==$re_password){
            // if($inputCaptcha==$_SESSION['captcha']){
                include('./dbconn.php');
                echo "connection successful";

                $checkEmail = $conn->prepare("
                SELECT * FROM `users` WHERE `email` = '$email'
                ");
                $checkEmail->execute();
                if($checkEmail->rowCount() > 0){
                    header("Location: /proj1/index.php");
                    echo "User already present";
                    die();
                }


                $insert = $conn->prepare("
                insert into `users` (`firstname`,`lastname`,`email`,`caste`,`password`)
                values('$firstname','$lastname','$email','$caste','$password')
                ");

                $res = $insert->execute();

                if($res){
                    echo "Inserted successfully";
                }
                else{
                    echo "Error inserting values";
                }
            // }
            // else{
            //     echo "Wrong Captcha";
            // }
        }
        else{
            echo "password not matching";
        }

    }
?>



<html><head>
	<title>Faculty Register | IIT Patna</title>
	<link rel="stylesheet" type="text/css" href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/images/favicon.ico">
	<link rel="icon" href="https://upload.wikimedia.org/wikipedia/en/thumb/5/52/Indian_Institute_of_Technology%2C_Patna.svg/1200px-Indian_Institute_of_Technology%2C_Patna.svg.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/css/bootstrap-datepicker.css">
	<script type="text/javascript" src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/js/jquery.js"></script>
	<script type="text/javascript" src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/js/bootstrap.js"></script>
	<script type="text/javascript" src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/js/bootstrap-datepicker.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Sintony" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Hind&amp;display=swap" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&amp;display=swap" rel="stylesheet"> 
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Serif&amp;display=swap" rel="stylesheet">


	
<style type="text/css">
	body { background-color: lightgray; padding-top:0px!important;}

</style></head>

<body>
<div class="container-fluid" style="background-color: #f7ffff; margin-bottom: 10px;">
	<div class="container">
        <div class="row" style="margin-bottom:10px; ">
        	<div class="col-md-8 col-md-offset-2">

        		<!--  <img src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/images/IITIndorelogo.png" alt="logo1" class="img-responsive" style="padding-top: 5px; height: 120px; float: left;"> -->

        		<h3 style="text-align:center;color:#414002!important;font-weight: bold;font-size: 2.3em; margin-top: 3px; font-family: 'Noto Sans', sans-serif;">भारतीय प्रौद्योगिकी संस्थान पटना</h3>
    			<h3 style="text-align:center;color: #414002!important;font-weight: bold;font-family: 'Oswald', sans-serif!important;font-size: 2.2em; margin-top: 0px;">Indian Institute of Technology Patna</h3>
    			

        	</div>
        	

    	   
        </div>
		    <!-- <h3 style="text-align:center; color: #414002; font-weight: bold;  font-family: 'Fjalla One', sans-serif!important; font-size: 2em;">Application for Academic Appointment</h3> -->
    </div>
   </div> 
			<h3 style="color: rgb(225, 4, 37); margin-bottom: 20px; font-weight: bold; text-align: center; font-family: &quot;Noto Serif&quot;, serif; opacity: 0.160023;" class="blink_me">Application for Faculty Position</h3>

<style type="text/css">

.form-control { margin-bottom: 10px; }

.back-imgs{
      /*background-position: center; */
      background-size: cover; /* Resize the background image to cover the entire container */
    }

    h3{
  font-weight: bold;
  /*color:green;*/
  font-family: 'Sintony', sans-serif;
  text-align:center; color:green;
  /*text-align: center;*/
}
</style>

<!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->
<div class="container" style=" border-radius:10px; margin-top:20px;">
    <div class="row" style="border-width: 2px; border-style: solid; border-radius: 10px; box-shadow: 0px 1px 30px 1px #284d7a; height:500px; background-color:#F7FFFF;">

      <div class="col-md-6 col-sm-6 col-xs-6">
        
       <img src="./images/logo.jpeg" style="margin-left:22%; margin-top: 5%;">
       </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
          <h3>CREATE YOUR PROFILE</h3><br>
            <form method="post" class="form" role="form">
                
                <!-- <input type="hidden" name="ci_csrf_token" value=""> -->
            <div class="row">
                                <div class="col-xs-6 col-md-6">
                    <input class="form-control" value="" name="firstname" placeholder="First name" type="text" required="" autofocus="">
                                    </div>
                <div class="col-xs-6 col-md-6">
                    <input class="form-control" name="lastname" value="" required="" placeholder="Last name" type="text">
                                    </div>
            </div>
             <div class="row">
              <div class="col-xs-6 col-md-6">
               <input class="form-control" name="email" placeholder="Your email" value="" required="" type="email">
                              </div>

                  <div class="col-xs-6 col-md-6">
                  <select id="caste" name="caste" class="form-control input-md" required="">
                    <option value="">Select Category</option>
                      <option value="UR">UR</option>
                      <option value="OBC">OBC</option>
                      <option value="SC">SC</option>
                      <option value="ST">ST</option>
                      <option value="PWD">PWD</option>
                      <option value="EWS">EWS</option>
                  </select>
                  </div>
             </div>
           
           <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-6">

            <input class="form-control" name="password" placeholder="New password" required="" type="password">
                              </div>
                  <div class="col-md-6 col-sm-6 col-xs-6">

            <input class="form-control" name="re_password" placeholder="Retype - new password" required="" type="password">
                              </div></div>
                  
          

        <div class="row">

          <input id="created_at" name="created_at" type="hidden">

            <!-- <div class="col-xs-6 col-md-6">
                  
            <img src="captcha.php" alt="CAPTCHA Image">
                <input class="form-control" name="firstname" placeholder="First Name" type="text" require autofocus /> 
                
                            </div>


            <div class="col-xs-6 col-md-6" style="">
                <input class="form-control" name="captcha" placeholder="Insert image text" required="" type="text">
           </div>  -->

          
            <div class="col-xs-12 col-md-12" style="">
                <h5><strong><font color="red">Note:</font>
                <br>  
                <br>  
                  <br>
                <font color="#124f93">
                1. Applicant should enter correct email address for further communication. 
                <br>  
                2. To ensure the integrity and security of your account, it is necessary for the provided email address to be valid in order to facilitate future password changes.<br>
                3. Applicant applying for more than one position/ department should use <strong><font color="red">different email id</font></strong> for each application.</font> </strong>
                  <br>
                  <br>
                  <br>
                  </h5>
                <button class="btn btn-sm btn-primary" type="submit" name="submit" value="Submit">Register</button>

                <strong class=" pull-right" style="color: green;">If registered <a href="./login.php" class="btn btn-sm btn-success"> Login Here</a></strong>
           </div>

           
            

             
            </div>

            </form>

        </div>
    </div>

</div>
<br>
<div class="container">
    <div class="col-md-8 col-md-offset-2" style="text-align: center!important; font-weight: bold; color: black!important;">
      
    </div>
</div>

<div id="footer"></div>



<script type="text/javascript">
	
	function blinker() {
	    $('.blink_me').fadeOut(500);
	    $('.blink_me').fadeIn(500);
	}

	setInterval(blinker, 1000);
</script></body></html>