<?php
    include('./dbconn.php');
    session_start();
    if($_SESSION['login']==0){
        header("Location: /proj1/login.php");
      }
    else{
    echo "<script type='text/javascript'>
            window.history.forward();
        </script>";
    }

    
    if (isset($_POST["submit"])) { 

        $email = $_SESSION['email'];
        
        $jsondata = json_encode($_POST);

        $checkUSer = $conn->prepare("
        select * from `page3` where `email` = '$email'
        ");

        $checkUSer->execute();
        $data = $checkUSer->fetchAll();
        if($data){
            $deleteUser = $conn->prepare("
            delete from `page3` where `email`='$email'
            ");
            $deleteUser->execute();
        }

        $insertjson = $conn->prepare("insert into `page3` (`email`,`jsondata`) values ('$email','$jsondata')");
        $insertjson->execute();
        
        if ($insertjson) {
            echo "Inserted successfully";
            header("Location: /proj1/fourthpage.php");
        }  
    }
        

?>




<html>
<head>
	<title>Employment Details</title>
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


<style type="text/css">
body { padding-top:30px; }
.form-control { margin-bottom: 10px; }
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
.form-control { margin-bottom: 10px; }
label{
  padding: 0 !important;
}
hr{
  border-top: 1px solid #025198 !important;
}
span{
  font-size: 1.2em;
  font-family: 'Oswald', sans-serif!important;
  text-align: left!important;
  padding: 0px 10px 0px 0px!important;
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
.btn-primary {
  padding: 9px;
}
</style>
<script type="text/javascript">
    $(function () {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        });
    });
</script>

<script type="text/javascript">
var tr="";
var counter_exp=1;
var counter_t_exp=1;
var counter_r_exp=1;
var counter_ind_exp=1;


  $(document).ready(function(){
    
    $("#add_more_exp").click(function(){
        create_tr();
        create_serial('exp');
        create_input('position[]', 'Position','position'+counter_exp, 'exp',counter_exp, 'exp');
        create_input('employer[]', 'Organization/Institution', 'employer'+counter_exp,'exp',counter_exp, 'exp');
        create_input('doj[]', 'DD/MM/YYYY', 'doj'+counter_exp,'exp',counter_exp, 'exp');
        create_input('dol[]', 'DD/MM/YYYY', 'dol'+counter_exp,'exp',counter_exp, 'exp');
        create_input('exp_duration[]', 'Duration','exp_duration'+counter_exp, 'exp',counter_exp,'exp', true);
        counter_exp++;
        return false;
    });

    $("#add_more_t_exp").click(function(){
        create_tr();
        create_serial('t_exp');
        create_input('te_position[]', 'Position','te_position'+counter_t_exp, 't_exp',counter_t_exp, 't_exp');
        create_input('te_employer[]', 'Employer', 'te_employer'+counter_t_exp,'t_exp',counter_t_exp, 't_exp');
        create_input('te_course[]', 'Courses', 'te_course'+counter_t_exp,'t_exp',counter_t_exp, 't_exp');
        create_input('te_ug_pg[]', 'UG/PG', 'te_ug_pg'+counter_t_exp,'t_exp',counter_t_exp, 't_exp');
        create_input('te_no_stu[]', 'No. of Students', 'te_no_stu'+counter_t_exp,'t_exp',counter_t_exp, 't_exp');
        create_input('te_doj[]', 'DD/MM/YYYY', 'te_doj'+counter_t_exp,'t_exp',counter_t_exp, 't_exp');
        create_input('te_dol[]', 'DD/MM/YYYY', 'te_dol'+counter_t_exp,'t_exp',counter_t_exp, 't_exp');
        create_input('te_duration[]', 'Duration', 'te_duration'+counter_t_exp,'t_exp',counter_t_exp, 't_exp', true);
        counter_t_exp++;
        return false;
    });

    
    $("#add_more_r_exp").click(function(){
        create_tr();
        create_serial('r_exp');
        create_input('r_exp_position[]', 'Position','r_exp_position'+counter_r_exp, 'r_exp',counter_r_exp, 'r_exp');
        create_input('r_exp_institute[]', 'Institute', 'r_exp_institute'+counter_r_exp,'r_exp',counter_r_exp, 'r_exp');
        create_input('r_exp_supervisor[]', 'Supervisor', 'r_exp_supervisor'+counter_r_exp,'r_exp',counter_r_exp, 'r_exp');
        create_input('r_exp_doj[]', 'DD/MM/YYYY', 'r_exp_doj'+counter_r_exp,'r_exp',counter_r_exp, 'r_exp');
        create_input('r_exp_dol[]', 'DD/MM/YYYY', 'r_exp_dol'+counter_r_exp,'r_exp',counter_r_exp, 'r_exp');
        create_input('r_exp_duration[]', 'Duration', 'r_exp_duration'+counter_r_exp,'r_exp',counter_r_exp, 'r_exp', true);
        counter_r_exp++;
        return false;
    });



$("#add_more_ind_exp").click(function(){
    create_tr();
    create_serial('ind_exp');
    create_input('org[]', 'Organization','org'+counter_ind_exp, 'ind_exp',counter_ind_exp, 'ind_exp');
    create_input('work[]', 'Work Profile', 'work'+counter_ind_exp,'ind_exp',counter_ind_exp, 'ind_exp');
    create_input('ind_doj[]', 'DD/MM/YYYY', 'ind_doj'+counter_ind_exp,'ind_exp',counter_ind_exp, 'ind_exp');
    create_input('ind_dol[]', 'DD/MM/YYYY', 'ind_dol'+counter_ind_exp,'ind_exp',counter_ind_exp, 'ind_exp');
    create_input('period[]', 'Duration', 'period'+counter_ind_exp,'ind_exp',counter_ind_exp, 'ind_exp',true);
    counter_ind_exp++;
    return false;
  });

  

});

  function create_select()
  {
    
  }
  function create_tr()
  {
    tr=document.createElement("tr");
  }
  function create_serial(tbody_id)
  {
    //console.log(tbody_id);
    var td=document.createElement("td");
    // var x=0;
     var x = document.getElementById(tbody_id).rows.length;
    // if(document.getElementById(tbody_id).rows)
    // {
    // }
    td.innerHTML=x;
    tr.appendChild(td);
  }
   function for_date_picker(obj)
  {
    obj.setAttribute("data-provide", "datepicker");
    obj.className += " datepicker";
    return obj;

  }
  
  function create_input(t_name, place_value, id, tbody_id, counter, remove_name, btn=false, select=false, datepicker_set=false)
  {
    //console.log(counter);
    if(select==false)
    {

      var input=document.createElement("input");
      input.setAttribute("type", "text");
      input.setAttribute("name", t_name);
      input.setAttribute("id", id);
      input.setAttribute("placeholder", place_value);
      input.setAttribute("class", "form-control input-md");
      input.setAttribute("required", "");
      var td=document.createElement("td");
      td.appendChild(input);
    }
    if(select==true)
    {

      var sel=document.createElement("select");
      sel.setAttribute("name", t_name);
      sel.setAttribute("id", id);
      sel.setAttribute("class", "form-control input-md");
      sel.innerHTML+="<option>Select</option>";
      sel.innerHTML+="<option value='Principal Investigator'>Principal Investigator</option>";
      sel.innerHTML+="<option value='Co-investigator'>Co-investigator</option>";
      // sel.innerHTML+="<option value='in_preparation'>In-Preparation</option>";
      var td=document.createElement("td");
      td.appendChild(sel);
    }
    if(datepicker_set==true)
    {
      input=for_date_picker(input);
    }
    if(btn==true)
    {
      // alert();
      var but=document.createElement("button");
      but.setAttribute("class", "close");
      but.setAttribute("onclick", "remove_row('"+remove_name+"','"+counter+"', '"+tbody_id+"')");
      but.innerHTML="x";
      td.appendChild(but);
    }
    tr.setAttribute("id", "row"+counter);
    tr.appendChild(td);
    document.getElementById(tbody_id).appendChild(tr);
     $('.datepicker').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true
                });
    
  }
  function remove_row(remove_name, n, tbody_id)
  {
    var tab=document.getElementById(remove_name);
    var tr=document.getElementById("row"+n);
    tab.removeChild(tr);
    var x = document.getElementById(tbody_id).rows.length;
    for(var i=0; i<=x; i++)
    {
      $("#"+tbody_id).find("tr:eq("+i+") td:first").text(i);
      
    }
    
  }
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
              <input type="hidden" name="ci_csrf_token" value="" />
            <fieldset>
             
                 <legend>
                  <div class="row">
                    <div class="col-md-10">
                        <h4>Welcome : <font color="#025198"><strong><?php echo $_SESSION['fname']?> <?php echo $_SESSION['lname']?></strong></font></h4>
                    </div>
                    <div class="col-md-2">
                    <a href="./logout.php" class="btn btn-sm btn-success  pull-right">Logout</a>
                    </div>
                  </div>
                
                
        </legend>

<h4 style="text-align:center; font-weight: bold; color: #6739bb;">3. Employment Details</h4>


            <!-- Form Name -->

<div class="row">
    <div class="col-md-12">
      <div class="panel panel-success">
      <div class="panel-heading">(A) Present Employment</div>
        <div class="panel-body">
          
          <span class="col-md-2 control-label" for="pres_emp_position">Position</span>  
          <div class="col-md-4">
          <input id="pres_emp_position" value="hbdfhj" name="pres_emp_position" type="text" placeholder="Position" class="form-control input-md" autofocus="" required="">
          </div>

          <span class="col-md-2 control-label" for="pres_emp_employer">Organization/Institution</span>  
          <div class="col-md-4">
          <input id="pres_emp_employer" value="48197 Moises Knoll" name="pres_emp_employer" type="text" placeholder="Organization/Institution" class="form-control input-md" autofocus="">
          </div> 
          
          <span class="col-md-2 control-label" for="pres_status">Status</span>  
          <div class="col-md-4">
          <select id="pres_status" name="pres_status" class="form-control input-md" required="">
              <option value="">Select</option>
              <option   value="Central Govt.">Central Govt.</option>
              <option   value="State Government">State Government</option>
              <option  selected='selected' value="Private">Private</option>
              <option   value="Quasi Govt.">Quasi Govt.</option>
              <option   value="Other">Other</option>
          </select>
          </div>

          <span class="col-md-2 control-label" for="pres_emp_doj">Date of Joining</span>  
          <div class="col-md-4">
          <input id="pres_emp_doj" name="pres_emp_doj" type="text" placeholder="Date of Joining" value="3664 Lowe Harbors" class="form-control input-md" required="">
          </div>

          <span class="col-md-2 control-label" for="pres_emp_dol">Date of Leaving <br />(Mention Continue if working)</span>  
          <div class="col-md-4">
          <input id="pres_emp_dol" value="372 Darrick Ridge" name="pres_emp_dol" type="text" placeholder="Date of Leaving" class="form-control input-md" required="">
          </div>
          
          <span class="col-md-2 control-label" for="pres_emp_duration">Duration (in years & months)</span>  
          <div class="col-md-4">
          <input id="pres_emp_duration" name="pres_emp_duration" type="text" placeholder="Duration" value="8084 Klein Creek" class="form-control input-md" required="">
          </div>


         

  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-success">
      <div class="panel-heading">(B) Employment History (After PhD, Starting with Latest)  </strong></font>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-sm btn-danger" id="add_more_exp">Add Details</button></div>
      <div class="panel-body">
        
           <table class="table table-bordered">
              <tbody id="exp">
              
                <tr height="30px">
                <th class="col-md-1"> S. No.</th>
                <th class="col-md-3"> Position </th>
                <th class="col-md-4"> Organization/Institution </th>
                <th class="col-md-1"> Date of Joining</th>
                <th class="col-md-1"> Date of Leaving </th>
                <th class="col-md-2"> Duration (in years & months)</th>
              </tr>
            
                              <tr height="60px">

                    <td class="col-md-1"> 
                      1                    </td>
                  <td class="col-md-2">  
                      <input id="position1" value="Mollitia eveniet optio suscipit quibusdam." name="position[]" type="text" placeholder="Position" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-2"> 
                      <input id="employer" value="Perspiciatis ex officia itaque adipisci quasi harum qui modi." name="employer[]" type="text" placeholder="Employer" class="form-control input-md" required=""> 
                    </td>
                  <td class="col-md-2"> 
                    <input id="doj" name="doj[]" value="Quos deserunt animi explicabo." type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-2"> 
                    <input id="dol" name="dol[]" value="Necessitatibus repudiandae ea vel eligendi exercitationem impedit." type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-2"> 
                    <input  name="exp_duration[]" value="2024-03-06 21:01:52" type="text" placeholder="Duration" class="form-control input-md" required=""> 
                  </td>
                 
                </tr>
                                <tr height="60px">

                    <td class="col-md-1"> 
                      2                    </td>
                  <td class="col-md-2">  
                      <input id="position2" value="Fugit nemo expedita eius." name="position[]" type="text" placeholder="Position" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-2"> 
                      <input id="employer" value="Ducimus deserunt beatae similique." name="employer[]" type="text" placeholder="Employer" class="form-control input-md" required=""> 
                    </td>
                  <td class="col-md-2"> 
                    <input id="doj" name="doj[]" value="Velit reiciendis repellat iste harum optio." type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-2"> 
                    <input id="dol" name="dol[]" value="Repellat eaque libero rerum." type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-2"> 
                    <input  name="exp_duration[]" value="2024-03-15 05:29:33" type="text" placeholder="Duration" class="form-control input-md" required=""> 
                  </td>
                 
                </tr>
                               </tbody>
              </table>

              
                            <h4 style="color:red;">
              <div>

                <textarea style="height:50px; font-weight: bold; color: red;" class="form-control input-md" name="teach_exp_declaration" readonly="" required="">Experience : Minimum 6 years’ experience of which at least 3 years should be at the level of Assistant Professor Grade I/Senior Scientific Officer/Senior Design Engineer.</textarea>
                <input type="radio" name="teach_exp" checked='checked' value="Yes" required="">Yes</input>
                
                <input type="radio" name="teach_exp"  value="No" required="">No</input>
              </div>
              </h4>
              
                        </div>
        </div>
      </div>
    </div>

<!-- Teaching Experience  -->
          
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-success">
    <div class="panel-heading">(C) Teaching Experience (After PhD)&nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_t_exp">Add Details</button></div>
      <div class="panel-body">
        <table class="table table-bordered">
            <tbody id="t_exp">
            
            <tr height="30px">
              <th class="col-md-1"> S. No.</th>
              <th class="col-md-2"> Position</th>
              <th class="col-md-1"> Employer </th>
              <th class="col-md-1"> Course Taught </th>
              <th class="col-md-1"> UG/PG </th>
              <th class="col-md-1"> No. of Students </th>
              <th class="col-md-1"> Date of Joining the Institute</th>
              <th class="col-md-1"> Date of Leaving the Institute</th>
              <th class="col-md-1"> Duration (in years & months) </th>
              
            </tr>


                        
            <tr height="60px">
             
              <td class="col-md-1"> 
                1                </td>
              <td class="col-md-2"> 
                  <input id="te_position1" name="te_position[]" type="text" value="Molestiae aliquam ducimus ullam incidunt accusamus recusandae. Placeat qui saepe commodi at eligendi sapiente ipsam beatae. Sint occaecati dolores adipisci.Eos exercitationem velit quisquam sequi laborum eos. Tenetur optio reiciendis repudiandae tempore e"  placeholder="Position" class="form-control input-md" required=""> 
                </td>
              <td class="col-md-2"> 
                <input id="te_employer1" name="te_employer[]" type="text" value="Nam laboriosam labore tenetur rem dolorem. Quas quis accusamus cum autem nemo odio numquam. Atque cumque ut assumenda.Ipsam deleniti distinctio voluptatum. Quis possimus nostrum. Explicabo quis tempora nihil maiores error.Nihil necessitatibus architecto s"  placeholder="Employer" class="form-control input-md" required=""> 
              </td>

              <td class="col-md-2"> 
                <input id="te_course1" name="te_course[]" type="text" value="Bahrain"  placeholder="Course Taught" class="form-control input-md" required=""> 
              </td>
             
             <td class="col-md-2"> 
               <input id="te_ug_pg1" name="te_ug_pg[]" type="text" value="Quae sit officia deserunt vero explicabo ipsam sunt quisquam omnis. Quaerat assumenda sapiente perspiciatis doloribus. Vel necessitatibus eligendi aliquam.Quo illo accusantium distinctio sapiente saepe. Doloremque numquam recusandae ex quos cumque. Facere"  placeholder="UG/PG" class="form-control input-md" required=""> 
             </td>

             <td class="col-md-2"> 
               <input id="te_no_stu1" name="te_no_stu[]" type="text" value="619"  placeholder="No. of Students" class="form-control input-md" required=""> 
             </td>

              <td class="col-md-1"> 
                <input id="te_doj1" name="te_doj[]" type="text" value="Ratione incidunt totam eius sed est nostrum consequuntur cumque. Animi pariatur accusantium corporis provident quo nemo. Illum officia alias aut iste ab quasi.Officiis deleniti impedit illo error pariatur. Id quidem placeat nobis inventore consequuntur re" placeholder="Joining" class="form-control input-md" required=""> 
              </td>
              <td class="col-md-1"> 
                <input id="te_dol1" name="te_dol[]" type="text" value="Error quod cum nobis perspiciatis rem vel eaque dolores iste. Voluptas autem perspiciatis. Doloribus dignissimos eligendi nemo aut.Cupiditate rerum dolore voluptate commodi perferendis nam itaque. Facilis beatae eligendi. Quo recusandae exercitationem ver" placeholder="Leaving" class="form-control input-md" required=""> 
              </td>
              <td class="col-md-1"> 
                <input id="te_duration1" name="te_duration[]" type="text" value="Ea soluta perspiciatis beatae possimus. Reiciendis corrupti quaerat magni. Cupiditate voluptatem alias mollitia eius consequatur inventore blanditiis consequuntur error.Quidem similique quae aspernatur placeat odit cum doloremque natus magnam. Explicabo e"  placeholder="Duration" class="form-control input-md" required=""> 
              </td>
             
            </tr>
                        
            <tr height="60px">
             
              <td class="col-md-1"> 
                2                </td>
              <td class="col-md-2"> 
                  <input id="te_position2" name="te_position[]" type="text" value="Atque in vel quisquam. Consectetur in saepe. Dignissimos itaque occaecati quasi facilis sunt eius mollitia.Et hic dolorum veritatis rerum labore error inventore maiores. Quod fuga ratione maxime magnam laudantium aspernatur cupiditate. Sapiente neque opti"  placeholder="Position" class="form-control input-md" required=""> 
                </td>
              <td class="col-md-2"> 
                <input id="te_employer2" name="te_employer[]" type="text" value="Vel iste modi. Voluptates commodi corporis consequuntur illum nobis qui saepe optio. Laboriosam ullam deleniti.Asperiores optio unde corporis quasi. Quasi ipsa adipisci vitae facilis ipsam. Odio corrupti saepe occaecati inventore doloribus neque cumque sa"  placeholder="Employer" class="form-control input-md" required=""> 
              </td>

              <td class="col-md-2"> 
                <input id="te_course2" name="te_course[]" type="text" value="China"  placeholder="Course Taught" class="form-control input-md" required=""> 
              </td>
             
             <td class="col-md-2"> 
               <input id="te_ug_pg2" name="te_ug_pg[]" type="text" value="Dignissimos molestiae illo cum quo consectetur. Commodi voluptatum voluptate. Mollitia reprehenderit a vel ratione aliquam.Quo repellat fugiat. Facilis ut autem quas dolor cumque voluptate nobis. Officia consectetur aspernatur impedit nulla quod totam mag"  placeholder="UG/PG" class="form-control input-md" required=""> 
             </td>

             <td class="col-md-2"> 
               <input id="te_no_stu2" name="te_no_stu[]" type="text" value="574"  placeholder="No. of Students" class="form-control input-md" required=""> 
             </td>

              <td class="col-md-1"> 
                <input id="te_doj2" name="te_doj[]" type="text" value="Natus ad delectus laboriosam omnis autem libero culpa libero delectus. Dolorem commodi nobis dolorum cum eaque quidem facilis ducimus iusto. Molestiae officia laboriosam dolor voluptatibus autem.Voluptate itaque ut exercitationem esse. Soluta eos laborum " placeholder="Joining" class="form-control input-md" required=""> 
              </td>
              <td class="col-md-1"> 
                <input id="te_dol2" name="te_dol[]" type="text" value="Mollitia nihil repudiandae reprehenderit id dolorem repellat ipsa. Tempore velit similique repellendus perferendis velit veritatis reiciendis dolorem accusantium. Vel vero a earum nulla illo fugiat aut.Quas voluptatem ex quia in accusamus deleniti id assu" placeholder="Leaving" class="form-control input-md" required=""> 
              </td>
              <td class="col-md-1"> 
                <input id="te_duration2" name="te_duration[]" type="text" value="Dolores velit illum rem asperiores enim cumque corrupti dolore. Ab maxime culpa consequatur. Similique dolores adipisci.Reprehenderit atque repellendus suscipit reprehenderit consequuntur voluptate aspernatur distinctio. Consequuntur vero tenetur ad tempo"  placeholder="Duration" class="form-control input-md" required=""> 
              </td>
             
            </tr>
                        
            <tr height="60px">
             
              <td class="col-md-1"> 
                3                </td>
              <td class="col-md-2"> 
                  <input id="te_position3" name="te_position[]" type="text" value="Adipisci dolor aperiam excepturi sequi aliquid facilis laudantium quibusdam sequi. Deserunt sint omnis fugiat modi. Laborum dolore expedita est cupiditate qui aut rerum.Pariatur quasi minus cum eligendi quos soluta. Provident itaque expedita. Iure accusan"  placeholder="Position" class="form-control input-md" required=""> 
                </td>
              <td class="col-md-2"> 
                <input id="te_employer3" name="te_employer[]" type="text" value="Suscipit culpa labore cum nostrum cumque quisquam. Soluta cupiditate cum a nobis illum. Sapiente quibusdam rerum animi earum.Unde vel eligendi itaque autem quis aut dolor modi. Deserunt cupiditate quidem repellat dolore. Minima ipsa nostrum qui exercitati"  placeholder="Employer" class="form-control input-md" required=""> 
              </td>

              <td class="col-md-2"> 
                <input id="te_course3" name="te_course[]" type="text" value="Republic of Korea"  placeholder="Course Taught" class="form-control input-md" required=""> 
              </td>
             
             <td class="col-md-2"> 
               <input id="te_ug_pg3" name="te_ug_pg[]" type="text" value="Occaecati vero officiis. Dolor atque quam expedita. Officiis recusandae soluta non necessitatibus exercitationem enim laborum illum.Dicta optio aliquam. Ut error eum culpa non. Tenetur porro beatae consectetur hic.Facilis itaque officiis quos fugit tempor"  placeholder="UG/PG" class="form-control input-md" required=""> 
             </td>

             <td class="col-md-2"> 
               <input id="te_no_stu3" name="te_no_stu[]" type="text" value="624"  placeholder="No. of Students" class="form-control input-md" required=""> 
             </td>

              <td class="col-md-1"> 
                <input id="te_doj3" name="te_doj[]" type="text" value="Incidunt repudiandae quod cumque aut odit illo. Esse officia ratione temporibus exercitationem necessitatibus hic reiciendis. Ex accusamus ratione distinctio.Pariatur libero nobis odit. Officiis quae autem. Eos at nisi distinctio ea sequi quod aliquam in." placeholder="Joining" class="form-control input-md" required=""> 
              </td>
              <td class="col-md-1"> 
                <input id="te_dol3" name="te_dol[]" type="text" value="Eaque distinctio iste nulla vero ipsum. Aliquam accusamus beatae fuga. Minima deserunt sapiente beatae cum.Laborum eum exercitationem ea placeat esse est. Dolorem enim excepturi suscipit autem hic minima. Ad quisquam reprehenderit rerum soluta eius sint n" placeholder="Leaving" class="form-control input-md" required=""> 
              </td>
              <td class="col-md-1"> 
                <input id="te_duration3" name="te_duration[]" type="text" value="Nemo aspernatur error consectetur incidunt recusandae praesentium voluptate itaque. Fugiat voluptatum explicabo doloribus doloremque ut aspernatur. Itaque error porro adipisci.Facere doloremque dolore. Eaque magni voluptatem eaque nulla enim velit et quib"  placeholder="Duration" class="form-control input-md" required=""> 
              </td>
             
            </tr>
            
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>

  <!-- c) Research Experience: (including Postdoctoral) input-->
                 
<div class="row">
<div class="col-md-12">
  <div class="panel panel-success">
  <div class="panel-heading">(D) Research Experience (Post PhD, including Post Doctoral)&nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_r_exp">Add Details</button></div>
    <div class="panel-body">
      <table class="table table-bordered">
          <tbody id="r_exp">
          
          <tr height="30px">
            <th class="col-md-1"> S. No.</th>
            <th class="col-md-1"> Position </th>
            <th class="col-md-2"> Institute</th>
            <th class="col-md-2"> Supervisor</th>
            <!-- <th class="col-md-2"> Topic </th> -->
            <th class="col-md-1"> Date of Joining</th>
            <th class="col-md-1"> Date of Leaving</th>
            <th class="col-md-1"> Duration (in years & months) </th>
            
          </tr>


                    
          <tr height="60px">
           
            <td class="col-md-1"> 
              1              </td>
            <td class="col-md-2"> 
                <input id="r_exp_position1" name="r_exp_position[]" type="text" value="Numquam iusto eius."  placeholder="Position" class="form-control input-md" required=""> 
              </td>
            <td class="col-md-2"> 
              <input id="r_exp_institute1" name="r_exp_institute[]" type="text" value="Minnesota"  placeholder="Institute" class="form-control input-md" required=""> 
            </td>
            <td class="col-md-2"> 
              <input id="r_exp_supervisor1" name="r_exp_supervisor[]" type="text" value="Laborum omnis quo inventore quod tempora."  placeholder="Supervisor" class="form-control input-md" required=""> 
            </td>
           <!--  <td class="col-md-2"> 
              <input id="r_exp_topic1" name="r_exp_topic[]" type="text" value=""  placeholder="Topic" class="form-control input-md" required=""> 
            </td> -->
            <td class="col-md-1"> 
              <input id="r_exp_doj1" name="r_exp_doj[]" type="text" value="Rerum sit unde sit a laboriosam."  placeholder="Joining" class="form-control input-md" required=""> 
            </td>
            <td class="col-md-1"> 
              <input id="r_exp_dol1" name="r_exp_dol[]" type="text" value="Reprehenderit repellendus ad." placeholder="Leaving" class="form-control input-md" required=""> 
            </td>
            <td class="col-md-1"> 
              <input id="r_exp_duration1" name="r_exp_duration[]" type="text" value="2024-08-15 23:36:01"  placeholder="Duration" class="form-control input-md" required=""> 
            </td>
           
          </tr>
                    
          <tr height="60px">
           
            <td class="col-md-1"> 
              2              </td>
            <td class="col-md-2"> 
                <input id="r_exp_position2" name="r_exp_position[]" type="text" value="Maiores fugiat quos."  placeholder="Position" class="form-control input-md" required=""> 
              </td>
            <td class="col-md-2"> 
              <input id="r_exp_institute2" name="r_exp_institute[]" type="text" value="New Hampshire"  placeholder="Institute" class="form-control input-md" required=""> 
            </td>
            <td class="col-md-2"> 
              <input id="r_exp_supervisor2" name="r_exp_supervisor[]" type="text" value="Magni libero harum molestias."  placeholder="Supervisor" class="form-control input-md" required=""> 
            </td>
           <!--  <td class="col-md-2"> 
              <input id="r_exp_topic2" name="r_exp_topic[]" type="text" value=""  placeholder="Topic" class="form-control input-md" required=""> 
            </td> -->
            <td class="col-md-1"> 
              <input id="r_exp_doj2" name="r_exp_doj[]" type="text" value="Quaerat blanditiis asperiores."  placeholder="Joining" class="form-control input-md" required=""> 
            </td>
            <td class="col-md-1"> 
              <input id="r_exp_dol2" name="r_exp_dol[]" type="text" value="Quod autem explicabo animi dicta optio nemo laboriosam facere." placeholder="Leaving" class="form-control input-md" required=""> 
            </td>
            <td class="col-md-1"> 
              <input id="r_exp_duration2" name="r_exp_duration[]" type="text" value="2023-06-03 06:16:20"  placeholder="Duration" class="form-control input-md" required=""> 
            </td>
           
          </tr>
                    
          <tr height="60px">
           
            <td class="col-md-1"> 
              3              </td>
            <td class="col-md-2"> 
                <input id="r_exp_position3" name="r_exp_position[]" type="text" value="Libero nemo sed praesentium error."  placeholder="Position" class="form-control input-md" required=""> 
              </td>
            <td class="col-md-2"> 
              <input id="r_exp_institute3" name="r_exp_institute[]" type="text" value="California"  placeholder="Institute" class="form-control input-md" required=""> 
            </td>
            <td class="col-md-2"> 
              <input id="r_exp_supervisor3" name="r_exp_supervisor[]" type="text" value="Maiores perspiciatis reiciendis iste error dicta natus repellat."  placeholder="Supervisor" class="form-control input-md" required=""> 
            </td>
           <!--  <td class="col-md-2"> 
              <input id="r_exp_topic3" name="r_exp_topic[]" type="text" value=""  placeholder="Topic" class="form-control input-md" required=""> 
            </td> -->
            <td class="col-md-1"> 
              <input id="r_exp_doj3" name="r_exp_doj[]" type="text" value="Labore consequatur dignissimos ullam velit odio eius voluptatem."  placeholder="Joining" class="form-control input-md" required=""> 
            </td>
            <td class="col-md-1"> 
              <input id="r_exp_dol3" name="r_exp_dol[]" type="text" value="Blanditiis quia impedit commodi quod magni accusamus debitis voluptatem." placeholder="Leaving" class="form-control input-md" required=""> 
            </td>
            <td class="col-md-1"> 
              <input id="r_exp_duration3" name="r_exp_duration[]" type="text" value="2024-07-20 17:27:01"  placeholder="Duration" class="form-control input-md" required=""> 
            </td>
           
          </tr>
                    
          <tr height="60px">
           
            <td class="col-md-1"> 
              4              </td>
            <td class="col-md-2"> 
                <input id="r_exp_position4" name="r_exp_position[]" type="text" value="Nesciunt magnam est vero libero veniam neque."  placeholder="Position" class="form-control input-md" required=""> 
              </td>
            <td class="col-md-2"> 
              <input id="r_exp_institute4" name="r_exp_institute[]" type="text" value="Kentucky"  placeholder="Institute" class="form-control input-md" required=""> 
            </td>
            <td class="col-md-2"> 
              <input id="r_exp_supervisor4" name="r_exp_supervisor[]" type="text" value="Qui quos quos impedit alias."  placeholder="Supervisor" class="form-control input-md" required=""> 
            </td>
           <!--  <td class="col-md-2"> 
              <input id="r_exp_topic4" name="r_exp_topic[]" type="text" value=""  placeholder="Topic" class="form-control input-md" required=""> 
            </td> -->
            <td class="col-md-1"> 
              <input id="r_exp_doj4" name="r_exp_doj[]" type="text" value="Molestiae amet quidem qui quam."  placeholder="Joining" class="form-control input-md" required=""> 
            </td>
            <td class="col-md-1"> 
              <input id="r_exp_dol4" name="r_exp_dol[]" type="text" value="Tenetur eum dolor eius iure tempore odio consequuntur." placeholder="Leaving" class="form-control input-md" required=""> 
            </td>
            <td class="col-md-1"> 
              <input id="r_exp_duration4" name="r_exp_duration[]" type="text" value="2024-03-19 06:15:58"  placeholder="Duration" class="form-control input-md" required=""> 
            </td>
           
          </tr>
          
        </tbody>
      </table>
      </div>
    </div>
  </div>
</div>


<!-- g)  Industrial Experience Interaction -->
<div class="row">
    <div class="col-md-12">
      <div class="panel panel-success">
      <div class="panel-heading">(E) Industrial Experience &nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-danger" id="add_more_ind_exp">Add Details</button></div>
        <div class="panel-body">

            <table class="table table-bordered">
                <tbody id="ind_exp">
                
                <tr height="30px">
                  <th class="col-md-1"> S. No.</th>
                  <th class="col-md-2"> Organization </th>
                  <th class="col-md-3"> Work Profile</th>
                  <th class="col-md-2"> Date of Joining</th>
                  <th class="col-md-2"> Date of Leaving</th>
                  <th class="col-md-2"> Duration (in years & months)</th>
                </tr>


                                
                <tr height="60px">
                 
                  <td class="col-md-1"> 
                    1                    </td>
                  <td class="col-md-2"> 
                      <input id="org1" name="org[]" type="text" value="Commodi occaecati accusantium ut quibusdam nostrum magnam omnis."  placeholder="Organization" class="form-control input-md" required=""> 
                    </td>
                  <td class="col-md-2"> 
                    <input id="work1" name="work[]" type="text" value="doloremque quibusdam nihil"  placeholder="Nature of Work" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-1"> 
                    <input id="ind_doj1" name="ind_doj[]" type="text" value="Natus aspernatur id error ipsam voluptas voluptas in." placeholder="Joining" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-1"> 
                    <input id="ind_dol1" name="ind_dol[]" type="text" value="Quisquam odit iste illum." placeholder="Leaving" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-2"> 
                    <input id="period1" name="period[]" type="text" value="Assumenda eum nobis repellendus ab ipsa porro recusandae."  placeholder="Period" class="form-control input-md" required=""> 
                  </td>
                 
                </tr>
                                
                <tr height="60px">
                 
                  <td class="col-md-1"> 
                    2                    </td>
                  <td class="col-md-2"> 
                      <input id="org2" name="org[]" type="text" value="Molestias libero saepe ab consequuntur voluptas quis sunt."  placeholder="Organization" class="form-control input-md" required=""> 
                    </td>
                  <td class="col-md-2"> 
                    <input id="work2" name="work[]" type="text" value="iusto excepturi odit"  placeholder="Nature of Work" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-1"> 
                    <input id="ind_doj2" name="ind_doj[]" type="text" value="Saepe quo doloribus ducimus." placeholder="Joining" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-1"> 
                    <input id="ind_dol2" name="ind_dol[]" type="text" value="Eligendi amet ut quae eius numquam ut." placeholder="Leaving" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-2"> 
                    <input id="period2" name="period[]" type="text" value="Quos minima alias sint ex aspernatur libero inventore recusandae."  placeholder="Period" class="form-control input-md" required=""> 
                  </td>
                 
                </tr>
                                
                <tr height="60px">
                 
                  <td class="col-md-1"> 
                    3                    </td>
                  <td class="col-md-2"> 
                      <input id="org3" name="org[]" type="text" value="Libero sequi amet perspiciatis."  placeholder="Organization" class="form-control input-md" required=""> 
                    </td>
                  <td class="col-md-2"> 
                    <input id="work3" name="work[]" type="text" value="unde perspiciatis provident"  placeholder="Nature of Work" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-1"> 
                    <input id="ind_doj3" name="ind_doj[]" type="text" value="Id unde sunt nesciunt." placeholder="Joining" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-1"> 
                    <input id="ind_dol3" name="ind_dol[]" type="text" value="Facere nulla accusantium." placeholder="Leaving" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-2"> 
                    <input id="period3" name="period[]" type="text" value="Totam mollitia doloribus facere rem alias animi repellendus ullam."  placeholder="Period" class="form-control input-md" required=""> 
                  </td>
                 
                </tr>
                                
                <tr height="60px">
                 
                  <td class="col-md-1"> 
                    4                    </td>
                  <td class="col-md-2"> 
                      <input id="org4" name="org[]" type="text" value="Reprehenderit dolores dolores deserunt sequi doloribus."  placeholder="Organization" class="form-control input-md" required=""> 
                    </td>
                  <td class="col-md-2"> 
                    <input id="work4" name="work[]" type="text" value="esse ducimus nemo"  placeholder="Nature of Work" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-1"> 
                    <input id="ind_doj4" name="ind_doj[]" type="text" value="Quas repellendus exercitationem libero ab asperiores adipisci cupiditate corporis." placeholder="Joining" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-1"> 
                    <input id="ind_dol4" name="ind_dol[]" type="text" value="Beatae labore atque ipsam labore et." placeholder="Leaving" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-2"> 
                    <input id="period4" name="period[]" type="text" value="Quaerat quaerat fugit non iure."  placeholder="Period" class="form-control input-md" required=""> 
                  </td>
                 
                </tr>
                                
                <tr height="60px">
                 
                  <td class="col-md-1"> 
                    5                    </td>
                  <td class="col-md-2"> 
                      <input id="org5" name="org[]" type="text" value="Voluptatibus pariatur accusamus sapiente dolorum animi."  placeholder="Organization" class="form-control input-md" required=""> 
                    </td>
                  <td class="col-md-2"> 
                    <input id="work5" name="work[]" type="text" value="minima reiciendis earum"  placeholder="Nature of Work" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-1"> 
                    <input id="ind_doj5" name="ind_doj[]" type="text" value="Numquam quisquam pariatur ullam." placeholder="Joining" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-1"> 
                    <input id="ind_dol5" name="ind_dol[]" type="text" value="Sit placeat cupiditate voluptatem aspernatur." placeholder="Leaving" class="form-control input-md" required=""> 
                  </td>
                  <td class="col-md-2"> 
                    <input id="period5" name="period[]" type="text" value="Vel quo unde rerum ea iure."  placeholder="Period" class="form-control input-md" required=""> 
                  </td>
                 
                </tr>
                              </tbody>
            </table>
          </div>
      </div>
    </div>
</div>


<h4 style="text-align:center; font-weight: bold; color: #6739bb;">4. Area(s) of Specialization and Current Area(s) of Research</h4>
 <div class="row">
  <div class="col-md-6">
    <div class="panel panel-success">
      <!-- <div class="panel-heading">9. Area(s) of Specialization *</div> -->
      <div class="panel-body">
        <strong>Areas of specialization</strong>
        <textarea style="height:150px" placeholder="Areas of specialization" class="form-control input-md" name="area_spl" maxlength="500" required="">Nesciunt sunt quos impedit quidem quas architecto.hhvvnvmn</textarea>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="panel panel-success">
      <!-- <div class="panel-heading">10. Current Area(s) of Research *</div> -->
      <div class="panel-body">
        <strong>Current Area of research</strong>
        <textarea style="height:150px" placeholder="Current Area of research" class="form-control input-md" name="area_rese" maxlength="500" required="">3134 Genesis Spur</textarea>
      </div>
    </div>
  </div>
 </div>

<div class="form-group">
  
  <div class="col-md-1">
    <a href="./secondpage.php" class="btn btn-primary pull-left">Back</a>
  </div>

  <div class="col-md-11">
  <button id="submit" type="submit" name="submit" value="Submit" class="btn btn-success pull-right">SAVE & NEXT</button>
    
  </div>
  
</div>
          
</fieldset>
</form>

        </div>
    </div>
</div>

<script type="text/javascript">
  function yearcalc()
  { 
    // alert('hi');
    var num1=document.getElementById("yoj").value;
    var num2=document.getElementById("yog").value;

    var duration_year=parseFloat(num2)-parseFloat(num1);
    // alert(duration_year);
    document.getElementById("result_test").value = duration_year ;
   
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