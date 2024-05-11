<?php

include('./dbconn.php');
session_start();

if(!isset($_SESSION['login']) || $_SESSION['login'] == 0){
  header("Location: /proj1/login.php");
  exit; // Added exit to stop further execution
}
else{
  echo "<script type='text/javascript'>
      window.history.forward();
  </script>";
}

$email = $_SESSION['email'];
echo $email;

$findUser = $conn->prepare("SELECT * FROM `users` WHERE `email`=:email");
$findUser->bindParam(':email', $email); // Binding parameters to prevent SQL injection
$findUser->execute();
$userInfo = $findUser->fetchAll();

$category = $userInfo[0]['caste'];
$_SESSION['formCategory'] = $category;

$_SESSION['fname'] = $userInfo[0]['firstname'];
$_SESSION['lname'] = $userInfo[0]['lastname'];

$userInFirst = $conn->prepare("SELECT * FROM `page1` WHERE `email`=:email");
$userInFirst->bindParam(':email', $email); // Binding parameters to prevent SQL injection
$userInFirst->execute();
$userDataFirst = $userInFirst->fetch();


if(empty($userDataFirst)){
  $_SESSION['new']=1;
}
else{
  $_SESSION['new']=0;
  $_SESSION['form_folder_photo'] = "./images/".$userDataFirst['photo'];
  $_SESSION['form_folder_id_photo'] = "./images/".$userDataFirst['id_photo'];
}


if(isset($_POST['fname'])){

    // General
    $adv_num = $_POST['adv_num'];
    

    $doa = $_POST['doa'];
    $ref_num = $_POST['ref_num'];
    $post = $_POST['post'];
    $dept = $_POST['dept'];

    // personal details
    $folder = "images/";

    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $nationality = $_POST['nationality'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $mstatus = $_POST['mstatus'];
    $id_proof = $_POST['id_proof'];
    
    $id_photo = $_FILES['userfile2']['name'];
    $folder_id_photo = $folder . $id_photo;
    $temp_id_photo = $_FILES['userfile2']['tmp_name'];
    move_uploaded_file($temp_id_photo,$folder_id_photo);
    $_SESSION['form_folder_id_photo'] = $folder_id_photo;

    $father_name = $_POST['father_name']; 

    $photo = $_FILES['userfile']['name'];
    $folder_photo = $folder . $photo;
    $temp_photo = $_FILES['userfile']['tmp_name'];
    move_uploaded_file($temp_photo,$folder_photo);
    $_SESSION['form_folder_photo'] = $folder_photo;


    // Address
    $CStreet = $_POST['cadd'];
    $CCity = $_POST['cadd1'];
    $CState = $_POST['cadd2'];
    $CCountry = $_POST['cadd3'];
    $CPin = $_POST['cadd4'];

    $PStreet = $_POST['padd'];
    $PCity = $_POST['padd1'];
    $PState = $_POST['padd2'];
    $PCountry = $_POST['padd3'];
    $PPin = $_POST['padd4'];

    // Contact
    $mobile = $_POST['mobile'];
    $mobile_2 = $_POST['mobile_2'];
    $email_2 = $_POST['email_2'];
    $landline = $_POST['landline'];


    $checkUSer = $conn->prepare("SELECT * FROM `page1` WHERE `email`=:email");
    $checkUSer->bindParam(':email', $email); // Binding parameters to prevent SQL injection
    $checkUSer->execute();
    $data = $checkUSer->fetchAll();
    if($data){
        $deleteUser = $conn->prepare("DELETE FROM `page1` WHERE `email`=:email");
        $deleteUser->bindParam(':email', $email); // Binding parameters to prevent SQL injection
        $deleteUser->execute();
        
    }

    $insertGeneral = $conn->prepare("
    INSERT INTO `page1` (`email`,`adv_num`,`doa`,`ref_num`,`post`,`dept`,`fname`,`mname`,`lname`,
    `nationality`,`dob`,`gender`,`mstatus`,`category`,`id_proof`,`id_photo`,`father_name`,`photo`,
    `CStreet`,`CCity`,`CState`,`CCountry`,`CPin`,`PStreet`,`PCity`,`PState`,`PCountry`,`PPin`,
    `mobile`,`mobile_2`,`email_2`,`landline`)
    VALUES (:email,:adv_num,:doa,:ref_num,:post,:dept,:fname,:mname,:lname,:nationality,:dob,:gender,:mstatus,:category,:id_proof,:id_photo,:father_name,:photo,:CStreet,:CCity,:CState,:CCountry,:CPin,:PStreet,:PCity,:PState,:PCountry,:PPin,:mobile,:mobile_2,:email_2,:landline)
    ");

    $insertGeneral->bindParam(':email', $email); // Binding parameters to prevent SQL injection
    $insertGeneral->bindParam(':adv_num', $adv_num);
    $insertGeneral->bindParam(':doa', $doa);
    $insertGeneral->bindParam(':ref_num', $ref_num);
    $insertGeneral->bindParam(':post', $post);
    $insertGeneral->bindParam(':dept', $dept);
    $insertGeneral->bindParam(':fname', $fname);
    $insertGeneral->bindParam(':mname', $mname);
    $insertGeneral->bindParam(':lname', $lname);
    $insertGeneral->bindParam(':nationality', $nationality);
    $insertGeneral->bindParam(':dob', $dob);
    $insertGeneral->bindParam(':gender', $gender);
    $insertGeneral->bindParam(':mstatus', $mstatus);
    $insertGeneral->bindParam(':category', $category);
    $insertGeneral->bindParam(':id_proof', $id_proof);
    $insertGeneral->bindParam(':id_photo', $folder_id_photo);
    $insertGeneral->bindParam(':father_name', $father_name);
    $insertGeneral->bindParam(':photo', $folder_photo);
    $insertGeneral->bindParam(':CStreet', $CStreet);
    $insertGeneral->bindParam(':CCity', $CCity);
    $insertGeneral->bindParam(':CState', $CState);
    $insertGeneral->bindParam(':CCountry', $CCountry);
    $insertGeneral->bindParam(':CPin', $CPin);
    $insertGeneral->bindParam(':PStreet', $PStreet);
    $insertGeneral->bindParam(':PCity', $PCity);
    $insertGeneral->bindParam(':PState', $PState);
    $insertGeneral->bindParam(':PCountry', $PCountry);
    $insertGeneral->bindParam(':PPin', $PPin);
    $insertGeneral->bindParam(':mobile', $mobile);
    $insertGeneral->bindParam(':mobile_2', $mobile_2);
    $insertGeneral->bindParam(':email_2', $email_2);
    $insertGeneral->bindParam(':landline', $landline);

    $insertGeneral->execute();

    $_SESSION['new'] = 0;

    header("Location: /proj1/secondpage.php");
}
?>



<html>
<head>

	<title>Update your personal details</title>
	<link rel="stylesheet" type="text/css" href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="https://upload.wikimedia.org/wikipedia/en/thumb/5/52/Indian_Institute_of_Technology%2C_Patna.svg/1200px-Indian_Institute_of_Technology%2C_Patna.svg.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://ofa.iiti.ac.in/facrec_che_2023_july_02/css/bootstrap-datepicker.css">
	<script type="text/javascript" src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/js/jquery.js"></script>
	<script type="text/javascript" src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/js/bootstrap.js"></script>
	<script type="text/javascript" src="https://ofa.iiti.ac.in/facrec_che_2023_july_02/js/bootstrap-datepicker.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Sintony" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Hind&display=swap" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet"> 
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Serif&display=swap" rel="stylesheet">


	
</head>
<style type="text/css">
	body { background-color: lightgray; padding-top:0px!important;}

</style>
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
			<h3 style="color: #e10425; margin-bottom: 20px; font-weight: bold; text-align: center;font-family: 'Noto Serif', serif;" class="blink_me">Application for Faculty Position</h3>

<!-- <body onload="updateAb()">  -->

<style type="text/css">
body { padding-top:30px; }
.floating-box {
display: inline-block;
width: 150px;
height: 75px;
margin: 10px;
border: 3px solid #73AD21;  
}
</style>
<style type="text/css">
body { padding-top:30px; }
.form-control { margin-bottom: 20px; }
label{
padding: 0 !important;
text-align: left!important;
font-family: 'Noto Serif', serif;
}

span{
font-size: 1.2em;
font-family: 'Oswald', sans-serif!important;
text-align: left!important;
padding: 0px 10px 0px 0px!important;
/*font-family: 'Noto Serif', serif;*/
font-weight: bold;
color: #414002;
/*margin-bottom: 20px!important;*/

}
hr{
border-top: 1px solid #025198 !important;
border-style: dashed!important;
border-width: 1.2px;
}

.panel-heading{
font-size: 1.3em;
font-family: 'Oswald', sans-serif!important;
letter-spacing: .5px;
}
.btn-primary{
padding: 9px;
}
</style>


<body>

<script type="text/javascript">  
//   $("#dob").focusout(function(){
//     alert();
//   ageCalculator();
// });
function ageCalculator() 
{
// alert('HI');  

debugger;  
var birthdate = document.getElementById('dob').value; // in "dd/MM/yyyy" format  
var senddate = document.getElementById('Date').value; // in "dd/MM/yyyy" format  
var x = birthdate.split("/");  
var y = senddate.split("/");  
var bdays = x[0];  
var bmonths = x[1];  
var byear = x[2];  
//alert(bdays);  
var sdays = y[0];  
var smonths = y[1];  
var syear = y[2];  
// alert(sdays);  
if (sdays < bdays) {  
sdays = parseInt(sdays) + 30;  
smonths = parseInt(smonths) - 1;  
//alert(sdays);  
var fdays = sdays - bdays;  
//alert(fdays);  
}  
else {  
var fdays = sdays - bdays;  
}  
if (smonths < bmonths) {  
smonths = parseInt(smonths) + 12;  
syear = syear - 1;  
var fmonths = smonths - bmonths;  
}  
else {  
var fmonths = smonths - bmonths;  
}  
var fyear = syear - byear; 
var year_to_days = fyear*365; 
var month_to_days = fmonths*30;
var newage = (fyear + ' years ' + fmonths + ' months ' + fdays + ' days');


var newage_year = (year_to_days+month_to_days+fdays);

document.getElementById("age").value = newage;
document.getElementById("age_days").value = newage_year;
// alert(newage);  
// document.getElementById("btnClickedValue").value = newage;
// window.location.href = window.location.href+'?newage='+newage;
}  


</script> 

<script type="text/javascript">
function updateAb(){     

alert('hi');   
}
</script>
<script type="text/javascript">
$(function () 
{
// $('#dob').datepicker({
//     format: 'dd/mm/yyyy',
//     autoclose: true,
//     onSelect: function() {
//              updateAb(selected);
//         }

// });
});
</script>
<!-- all bootstrap buttons classes -->
<!-- 
class="btn btn-sm, btn-lg, "
color - btn-success, btn-primary, btn-default, btn-danger, btn-info, btn-warning
-->



<a href='https://ofa.iiti.ac.in/facrec_che_2023_july_02/layout'></a>

<div class="container">

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 well">
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
      <!-- <input type="hidden" name="ci_csrf_token" value="" /> -->
    <fieldset>
     
         <legend>

          <div class="row">
            <div class="col-md-8">
                              <h4>Welcome : <font color="#025198"><strong><?php echo $_SESSION['fname']?> <?php echo $_SESSION['lname']?></strong></font></h4>
            </div>
             
            <div class="col-md-3">

             <a href='./changepassword.php' class='btn btn-sm btn-info pull-right'>Change Password</a>


            </div>
            <div class="col-md-1">
              <a href="./logout.php" class="btn btn-sm btn-success  pull-right">Logout</a>
            </div>
          </div>
        
        
</legend>


      
     
    
<div id="project_show">

<div class="row">
  <div class="col-md-12">

      <label class="col-md-2 control-label" for="adv_num">Advertisement Number *</label>    
      <div class="col-md-4">

      <select id="adv_num" name="adv_num" class="form-control input-md" required="">

          <option value="">Select</option>
          <option selected='selected' value="IITI/FACREC-CHE/2023/JULY/02">IITI/FACREC-CHE/2023/JULY/02</option>
      </select>
        
      </div>

      <label class="col-md-2 control-label" for="doa">Date of Application </label>  
      <div class="col-md-4">
      <input id="doa" name="doa" type="text" readonly="readonly" value="<?php $date_today=date('Y-m-d'); echo $date_today;?>" placeholder="" class="form-control input-md" required="">
     </div>

      <label class="col-md-2 control-label" for="ref_num">Application Number</label>  
      <div class="col-md-4">

      <input id="ref_num" name="ref_num" type="text" readonly="readonly" value="1698348185" placeholder="" class="form-control input-md" required="">
     </div>

      <label class="col-md-2 control-label" for="post">Post Applied for *</label>  
      <div class="col-md-4">
      <select id="post" name="post" class="form-control input-md" required="">
          <option value="">Select</option>
          <option   value="Professor">Professor</option>
          <option   value="Associate Professor">Associate Professor</option>
          <option   value="Assistant Professor Grade I">Assistant Professor Grade I</option>
          <option  selected='selected' value="Assistant Professor Grade II">Assistant Professor Grade II</option>
      </select>
      </div>

      <label class="col-md-2 control-label" for="dept">Department/School *</label>  
      <div class="col-md-4">
      <select id="dept" name="dept" class="form-control input-md" required="">
          <option value="">Select</option>
          <option selected='selected' value="Chemical Engineering">Chemical Engineering</option>
      </select>
        
      </div>
</div>
</div>
<hr>


    <!-- Form Name -->
    
      
    <!-- Text input-->
<!-- <h5><font color="#025198"><strong>1. Name:</strong></font></h5>             -->
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-success">
        <div class="panel-heading">1. Personal Details <small class="pull-right">Upload/Update Photo *</small></div>
          <div class="panel-body" style="height: 390px">
              <div class="col-md-10">
                <div class="row">

                  <span class="col-md-2 control-label" for="fname">First Name *</span>  
                    <div class="col-md-4">
                    <input id="fname" value="ghgggggg" name="fname" type="text" placeholder="First name" class="form-control input-md" maxlength="15" required="">
                  </div>
                

                  <span class="col-md-2 control-label" for="mname">Middle Name</span>  
                    <div class="col-md-4">
                    <input id="mname" value="Davonte Beck" name="mname" name="mname" type="text" placeholder="Middle name" class="form-control input-md" maxlength="12">
                    </div>

                  <span class="col-md-2 control-label" for="lname">Last Name *</span>  
                    <div class="col-md-4">
                    <input id="lname" value="Beatty" name="lname"name="lname" type="text" placeholder="Last name" class="form-control input-md" maxlength="15" required="">
                    </div>


                  <span class="col-md-2 control-label" for="nationality">Nationality *</span>
                  <div class="col-md-4"> 
                    <select id="nationality" name="nationality" class="form-control input-md" required="">
                      <option value="">Select</option>
                      <!-- <option  value=" India"> India</option> -->
                      <option selected='selected' value=" Indian"> Indian</option>
                      <!-- <option  value="PIO">PIO</option> -->
                      <option  value="OCI">OCI</option>
                    </select>
                  </div>



                 <!--  <span class="col-md-2 control-label" for="nationality">Nationality </span>  
                  <div class="col-md-4">
                  <input id="nationality" value=" Indian" name="nationality" type="text" placeholder="Nationality" class="form-control input-md" maxlength="15" required="">
                  </div> -->

                  <span class="col-md-2 control-label" for="dob">Date of Birth DD/MM/YYYY *</span>  
                  <div class="col-md-4">
                   <!--  <p id="dobdiv"> -->
                  <input id="dob" name="dob" value="30/11/-0001"  type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="" onfocusout = "ageCalculator()">
                <!-- </p> -->

                  <input type="hidden" name="Date" id="Date" value ="31/08/2023" />
                  <!-- <br/> 
                  <input type="hidden" id="btnClickedValue" name="btnClickedValue" value="" />
                  <button type="Button" onclick="ageCalculator()">Calculate</button >   -->

                    
                  </div>

                 <!--  <span class="col-md-2 control-label" for="age">Age</span>  
                  <div class="col-md-4">
                  <input id="age" name="age"  value="" type="text" class="form-control input-md" readonly>

                  <input id="age_days" name="age_days"  value="0" type="hidden" class="form-control input-md" readonly>
                  </div> -->

                 
                  <span class="col-md-2 control-label" for="gender">Gender *</span>
                  <div class="col-md-4"> 
                    <select id="gender" name="gender" class="form-control input-md" required="">
                      <option value="">Select</option>
                      <option selected='selected' value="Male">Male</option>
                      <option  value="Female">Female</option>
                      <option  value="Other">Other</option>
                    </select>
                  </div>


                  <span class="col-md-2 control-label" for="mstatus">Marital Status *</span>
                  <div class="col-md-4"> 
                    <select id="mstatus" name="mstatus" class="form-control input-md" required="">
                      <option value="">Select</option>
                      <option selected='selected' value="Married">Married</option>
                      <option  value="Unmarried">Unmarried</option>
                      <option  value="Other">Other</option>
                    </select>
                  </div>

                  <span class="col-md-2 control-label" for="cast">Category</span>
                  <div class="col-md-4"> 
                    <input id="cast" name="cast" type="text" placeholder="cast" readonly='readonly' value="<?php echo $_SESSION['formCategory'];?>" class="form-control input-md" required="">
                  </div>

                 <!--  <span class="col-md-2 control-label" for="disability_type">Type of Disability</span>
                  <div class="col-md-4"> 
                    <input id="disability_type" value="" name="disability_type"name="disability_type" type="text" placeholder="Type of Disability" class="form-control input-md" required="">
                  </div>
                     -->

                 <!--  <div class="col-md-6"> 
                  </div> -->
                </div>

                <div class="row">
                  <span class="col-md-2 control-label" for="mstatus">ID Proof *</span>
                  <div class="col-md-4"> 
                   
                      <select id="id_proof" name="id_proof" class="form-control input-md" required="">
                      <option value="">Select</option>
                       <!-- <option value="">Select</option> -->
                      <!--  <option value="AADHAR">AADHAR</option>
                       <option value="PAN-CARD">PAN-CARD</option>
                       <option value="DRIVING-LICENSE">DRIVING-LICENSE</option>
                       <option value="PASSPORT">PASSPORT</option>
                       <option value="OTHER">OTHER</option> -->


                      <option  value="AADHAR">AADHAR</option>
                      <option  value="PAN-CARD">PAN-CARD</option>
                      <option  value="DRIVING-LICENSE">
                      DRIVING-LICENSE</option>
                      <option  value="VOTER ID">VOTER ID</option>
                      <option  value="PASSPORT">PASSPORT</option>
                      <option  value="RATION CARD">RATION CARD</option>
                      
                      <option selected='selected' value="OTHERS">OTHERS</option>
                    </select>
                  </div>

                 
                  
                                        <span class="col-md-2 control-label" for="cast">Update ID Proof</span>
                    <div class="col-md-2"> 
                         <a href="<?php if($_SESSION['new']==1){echo "";}else{echo $_SESSION['form_folder_photo'];}?>" class="btn btn-sm btn-success" target="_blank">View Uploaded File </a>
                    </div>
                     <div class="col-md-2"> 
                       <input id="id_card_file" name="userfile2" type="file" class="form-control input-md">
                    </div>
                     
                    
                    <span class="col-md-2 control-label" for="father_name">Father's Name *</span>  
                      <div class="col-md-4">
                      <input id="father_name" value="Jamar35" name="father_name"name="father_name" type="text" placeholder="Father's Name" class="form-control input-md" maxlength="30" required="">
                      </div>
                  </div>
            </div>

        <div class="col-md-2 pull-right">
                      <img src="<?php if($_SESSION['new']==1){echo "";}else{echo $_SESSION['form_folder_id_photo'];}?>" class="thumbnail pull-right" height="150" width="130" />
            <input id="photo" name="userfile" type="file" class="form-control input-md">
          
         
        </div>
        </div>
      </div>
    </div>
  </div>




<div class="row">
<div class="col-md-12">
<div class="panel panel-success">
<!-- <div class="panel-heading">2. Address *</div> -->
<div class="panel-body">
    <div class="row">
      <div class="col-md-6">
        <span class="control-label" for="cadd">Correspondence Address </span>
        <br />
        <br />
       <textarea style="height:40px" placeholder="Street" class="form-control input-md" name="cadd" maxlength="200" required="">620 McDermott Canyon</textarea>

       <textarea style="height:40" placeholder="City" class="form-control input-md" name="cadd1" maxlength="200" required="">Joliet</textarea>

       <textarea style="height:40" placeholder="State" class="form-control input-md" name="cadd2" maxlength="200" required="">Pennsylvania</textarea>

       <textarea style="height:40" placeholder="Country" class="form-control input-md" name="cadd3" maxlength="200" required="">Nepal</textarea>

       <textarea style="height:40;" placeholder="PIN/ZIP" class="form-control input-md" name="cadd4" maxlength="6" required="">18820-</textarea>


      </div>


      <div class="col-md-6">
        <span class="control-label" for="padd">Permanent Address </span>
        <br />
        <br />
       <textarea style="height:40px" placeholder="Street" class="form-control input-md" name="padd" maxlength="200" required="">2865 Gleichner Valley</textarea>

       <textarea style="height:40" placeholder="City" class="form-control input-md" name="padd1" maxlength="200" required="">Hoover</textarea>

       <textarea style="height:40" placeholder="State" class="form-control input-md" name="padd2" maxlength="200" required="">Louisiana</textarea>

       <textarea style="height:40" placeholder="Country" class="form-control input-md" name="padd3" maxlength="200" required="">Timor-Leste</textarea>


       <textarea style="height:40;" placeholder="PIN/ZIP" class="form-control input-md" name="padd4" maxlength="6" required="">23802-</textarea>

    
      </div>

    </div>

      
    </div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="panel panel-success">
<!-- <div class="panel-heading">3. Contact Details (with STD/ISD code)</div> -->
<div class="panel-body">
  <span class="col-md-2 control-label" for="mobile">Mobile *</span>  
  <div class="col-md-4">
  <input id="mobile" value="Investor Implementat" name="mobile" type="text" placeholder="Mobile" class="form-control input-md" required="" maxlength="20">
  </div>

  

  <span class="col-md-2 control-label" for="email">Email</span>  
  <div class="col-md-4">
  <input id="email" name="email" type="text" placeholder="email" readonly='readonly' value="<?php echo $_SESSION['email'];?>" class="form-control input-md" required="">
  </div>

  <span class="col-md-2 control-label" for="mobile_2">Alternate Mobile </span>  
  <div class="col-md-4">
  <input id="mobile_2" value="Customer Research Co" name="mobile_2" type="text" placeholder="Alternate Mobile " class="form-control input-md" maxlength="20">
  </div>

  <span class="col-md-2 control-label" for="email_2">Alternate Email </span>  
  <div class="col-md-4">
  <input id="email_2" value="your.email+fakedata45730@gmail.com" name="email_2" type="email" placeholder="Alternate Email" class="form-control input-md">
  </div> 
  
 
  <span class="col-md-2 control-label" for="landline">Landline Number</span>  
  <div class="col-md-4">
  <input id="landline" value="375" name="landline" type="text" placeholder="Landline Number" class="form-control input-md" maxlength="20">
  </div> 
  
  

</div>
</div>
</div>
</div>

<div class="form-group">

<div class="col-md-12">
<button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right">SAVE & NEXT</button>
</div>

</div>

<!-- add the div for hide -->
</div>
</div>

</fieldset>
</form>


</div>
</div>


<div id="passModal" class="modal fade" role="dialog">
<form action="./changepassword.php" method="post">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <h2>Change Password</h2>

    </div>
    <div class="modal-body">
        <h3>Change Password For : <font color="#3377a0"><strong id="username_mod"></strong></font></h3>
        <input type="hidden" name="fid" id="fid" value="" />
        <div class="form-group">
            <label>Current Password</label>
            <input type="password" name="cr_password" placeholder="Current Password" class="form-control"/>
        </div>
        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="n_password" placeholder="New Password" class="form-control"/>
        </div>
        <div class="form-group">
            <label>Confirm New Password</label>
            <input type="password" name="cn_password" placeholder="New Confirm Password" class="form-control"/>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" name="submit" value="Submit" class="btn btn-info" >Submit</button>
        <button class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
</div>
</div>
</form>
</div>


<script type="text/javascript">
  $(document).ready(function(){

    var show_status = '0';
    if(show_status==1){
      show1();
    }

  });
function get_username(u, fid)
{
document.getElementById("username_mod").innerHTML=u;
// document.getElementById("fname").value=u;
document.getElementById("fid").value=fid;
}
// function form_submit(a, b)
// {
//     window.location="https://ofa.iiti.ac.in/facrec_che_2023_july_02/news/change/"+a+"/"+b;
// }
</script>


<script type="text/javascript">
   function show_none()
   {
   // alert("Hello! I am an alert box!!");
   document.getElementById('project_show').style.display ='none';
   }

   function show1()
   {
   // alert("Hello! I am an alert box!!");
   document.getElementById('project_show').style.display = 'block';
   }
</script>

<div id="footer"></div>
</body>
</html>

<script type="text/javascript">
	
	function blinker() {
	    $('.blink_me').fadeOut(500);
	    $('.blink_me').fadeIn(500);
	}

	setInterval(blinker, 1000);
</script>