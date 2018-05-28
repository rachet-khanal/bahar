
   <script type="text/javascript">
 
$(document).on('click', '#send_msg', function(){
  
 var firstName=$("#firstName").val();
 var reserve=$("#send_msg").val();
 var lastName=$("#lastName").val();
 var email=$("#email").val();
 var phoneNum=$("#phoneNum").val();
 var num_guest=$("#num_guest").val();
 var datepicker=$("#datepicker").val();
 var hour=$("#hour").val();
 var min=$("#min").val();
 var message=$("textarea#message").val();

  //call ajax to verify login
  $.ajax({
      method: "POST",
      url: "reservation.php",
    success :function(responseText){
      if(responseText=="success"){
        $(".error").html("success");
        document.location.href="index.php";
      }else{
              $("#dialog").html("");
              $("#dialog").dialog("open");
            
              $("#dialog").load("reservation.php", {reserve:reserve, firstName: firstName,reserve:reserve,
                lastName:lastName,email:email,phoneNum:phoneNum,num_guest:num_guest,datepicker:datepicker,
                hour:hour,min:min,sp_inst:message
              }, function () {
              $(this).dialog("option", "title", $(this).find('h1').text());
              $(this).find('h1').remove();
              });
      }
      
    }
    });
    
});

  </script>
  <?php
  if(isset($_POST["date"]) && isset($_POST["hour"]) && isset($_POST["min"]))
  {
  $date=$_POST["date"];
  $hour=$_POST["hour"];
  $min=$_POST["min"];
  }else{
    $date="";
  }

                        $reserve = "";
                        $firstName_err = $lastName_err = $email_err = $phn_err = $gnum_err = $date_err = $time_err = "";
                        $firstName = $lastName = $email = $phoneNum = $gnum = $time = $sp_inst = "";
                        $success = "";
                        $errors = 0;

                        if(isset($_POST["reserve"]))
                        {
                        
                        if(empty($_POST["firstName"]))
                        {
                            $firstName_err = "Name cannot be empty";
                            $errors = 1;
                        }
                        else
                        {
                           $firstName = $_POST["firstName"];
                           if(!preg_match("/^[a-zA-Z ]*$/", $firstName))
                           {
                               $firstName_err = "Only letters and white space are allowed";
                               $errors = 1;
                           }
                        }
                        if(empty($_POST["lastName"]))
                        {
                            $lastName_err = "Name cannot be empty";
                            $errors = 1;
                        }
                        else
                        {
                           $lastName = $_POST["lastName"];
                           if(!preg_match("/^[a-zA-Z ]*$/", $lastName))
                           {
                               $lastName_err = "Only letters and white space are allowed";
                               $errors = 1;
                           }
                        }
                        
                        if(empty($_POST["email"]))
                        {
                            $email_err = "Email cannot be empty";
                            $errors = 1;
                        }
                        else
                        {
                           $email = $_POST["email"];
                           if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                           {
                               $email_err = "Email is invalid";
                               $errors = 1;
                           }
                        }
                        if(empty($_POST["phoneNum"]))
                        {
                            $phn_err = "Phone Number cannot be empty";
                            $errors = 1;
                        }
                        else
                        {
                           $phoneNum = $_POST["phoneNum"];
                           if(!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i", $phoneNum))
                           {
                               $phn_err = "Phone Number number is invalid";
                               $errors = 1;
                           }
                        }
                        if(empty($_POST["num_guest"]))
                        {
                            $gnum_err = "Guest number cannot be empty";
                            $errors = 1;
                        }
                        else
                        {
                           $gnum = $_POST["num_guest"];
                           if(!filter_var($gnum, FILTER_VALIDATE_INT))
                           {
                               $email_err = "Guest number is invalid";
                               $errors = 1;
                           }
                        }
                        if(empty($_POST["datepicker"]))
                        {
                            $date_err = "Date cannot be empty";
                            $errors = 1;
                        }
                        else
                        {
                           $date = $_POST["datepicker"];
                           $date_split = explode("/", $date);
                           if(!checkdate($date_split[0], $date_split[1], $date_split[2]))
                           {
                               $date_err = "Invalid date format";
                               $errors = 1;
                           }
                        }
                        if((isset($_POST["hour"]) && isset($_POST["min"])))
                        {
                            if($_POST["hour"] == "" || $_POST["min"] == "")
                            {
                                $time_err = "Please select time";
                                $errors = 1;
                            }
                            else
                            {
                                $hour = $_POST["hour"];
                                $min = $_POST["min"];
                                $time = str_replace("00", $min, $hour);
                            }
                        }
                        if(empty($_POST["sp_inst"]))
                        {
                            $sp_inst = "None";
                        }
                        else
                        {
                            $sp_inst = $_POST["sp_inst"];
                        }
                         if($errors == 0)
                        {
                            $subject="Reservation Request";
                            $message="Name: ".$firstName." ".$lastName."
                            Phone Number: ".$phoneNum."
                            Number of Guest/s: ".$gnum."
                            Date: ".$date."
                            Time: ".$time."
                            Special Request: 
                            ".$sp_inst."";
                            $mail= mail("baharrestaurant1@gmail.com", $subject, $message, "FROM:".$email.""); 
                            if($mail){
                               echo "Thank you for using our Reservation form.<br/> Please call 02-8677-7335 to confirm your reservation.";
                               $mail= mail($email, $subject." Sent", $message, "FROM:"."baharrestaurant1@gmail.com".""); 
                                }else{
                                  echo "Mail sending failed."; 
                                }
                        }
                        }
                      

  ?>
                 
                    
                  <div class="error "> </div>
                    <div id="reserve_form">
                        <div id="reserve_form_content">
                        <h1>Reservation Form</h1>

                        <?php ;?>
                         <!--Request for reserving your table <span style="color:#FF0000;">Required Field  *</span><br/>-->
                        <form method="post" action="" >
                          <ul class="formDesign">
                            <li>
                            <label for="firstName">First Name*: </label>
                            <input type="text" id="firstName" Name="firstName" placeholder="FirstName" value="<?php echo $firstName;?>"/> 
                            <span style="color:red;"><?php echo $firstName_err;?></span><br/><br/>
                            </li>
                            <li>
                            <label for="lastName">Last Name*: </label>
                            <input type="text" id="lastName" Name="lastName" placeholder="Last Name" value="<?php echo $lastName;?>"/>
                            <span style="color:red;"><?php echo $lastName_err;?></span><br/><br/>
                            </li>
                            <li>
                            <label for="subject">Email*: </label>
                            <input type="email" id="email" Name="email" placeholder="Email" value="<?php echo $email;?>"/>
                            <span style="color:red;"><?php echo $email_err;?></span><br/><br/>
                            </li>
                            <li>
                            <label for="subject">Phone Num*: </label>
                            <input type="text" id="phoneNum" Name="phoneNum" placeholder="Only 10 digit number" value="<?php echo $phoneNum;?>"/>
                            <span style="color:red;"><?php echo $phn_err;?></span><br/><br/>
                            </li>
                            <li>
                            <label for="subject">Number of Guest*: </label>
                            <input type="text" id="num_guest" Name="num_guest" placeholder="Number of Guest" value="<?php echo $gnum;?>"/>
                            <span style="color:red;"><?php echo $gnum_err;?></span><br/><br/>
                            </li>
                            <li>
                            <label for="subject">Date*: </label>
                            <input type="text" id="datepicker" Name="datepicker" placeholder="When" value="<?php echo $date;?>"/>
                            <span style="color:red;"><?php echo $date_err;?></span><br/><br/>
                            </li>
                            <li>
                            <label for="hour">Time*: </label><br/>
                            <select id="hour" class="selectBox" style="background-color:#eeeeee;width:150px" Name="hour">
                                <option value="">Hour</option>
                                <option value="8:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "8:00 ") {echo "selected";} ?>>8:00 </option>
                                <option value="9:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "9:00 ") {echo "selected";} ?>>9:00 </option>
                                <option value="10:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "10:00 ") {echo "selected";} ?>>10:00 </option>
                                <option value="11:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "11:00 ") {echo "selected";} ?>>11:00 </option>
                                <option value="12:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "12:00 ") {echo "selected";} ?>>12:00 </option>
                                <option value="13:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "13:00 ") {echo "selected";} ?>>13:00 </option>
                                <option value="14:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "14:00 ") {echo "selected";} ?>>14:00 </option>
                                <option value="15:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "15:00 ") {echo "selected";} ?>>15:00 </option>
                                <option value="16:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "16:00 ") {echo "selected";} ?>>16:00 </option>
                                <option value="17:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "17:00 ") {echo "selected";} ?>>17:00 </option>
                                <option value="18:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "18:00 ") {echo "selected";} ?>>18:00 </option>
                                <option value="19:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "19:00 ") {echo "selected";} ?>>19:00 </option>
                                <option value="20:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "20:00 ") {echo "selected";} ?>>20:00 </option>
                                <option value="21:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "21:00 ") {echo "selected";} ?>>21:00 </option>
                                <option value="22:00 " <?php if(isset($_POST["hour"]) && $_POST["hour"] == "22:00 ") {echo "selected";} ?>>22:00 </option>
                            </select>
                           
                            <select id="min" Name="min" class="selectBox" style="background-color:#eeeeee;width:150px">
                                <option value="">Min</option>
                                <option value="00" <?php if(isset($_POST["min"]) && $_POST["min"] == "00") {echo "selected";} ?>>00</option>
                                <option value="30" <?php if(isset($_POST["min"]) && $_POST["min"] == "30") {echo "selected";} ?>>30</option>
                            </select>
                            </li>
                            <li>
                            <span style="color:red;"><?php echo $time_err;?></span><br/><br/>
                            <label for="message">Any Special Instruction: </label>
                            <textarea id="message" Name="sp_inst" placeholder="Instruction Details"></textarea><br/><br/>
                            <li>
                            <li>
                            <input type="button" Name="reserve" id="send_msg" value="Reserve"/>
                            </li>
                        </ul>
                        </form>
                        </div>
                    </div>
