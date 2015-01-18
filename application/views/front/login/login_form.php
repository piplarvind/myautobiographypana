
<!--[if lt IE 10]>
 <!DOCTYPE html>
 	<meta http-equiv="X-UA-Compatible" content="chrome=1">
<![endif]-->

	

<html>
<head>
	<title>Login My Autobiography</title>
	<!-- For mobile devises  -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1 ">

	<!-- jQuery 1.8.3 -->
	<script src="<?php  echo base_url();?>js/jquery-1.8.3.min.js"></script>

	<!-- site style -->
	<link href="<?php  echo base_url();?>css/style.css" rel="stylesheet" type="text/css" media="screen" />


	<!--[if lt IE 10]>
	 	<link href="css/styleIE.css" rel="stylesheet" type="text/css" media="screen" />
	<![endif]-->


</head>
<body>

<!-- Image that triggers the color configuration bar -->
<img src="<?php  echo base_url();?>images/system/login/gear.png" id="OptionColor">

<!-- Image that triggers the background configuration bar -->
<img src="<?php  echo base_url();?>images/system/login/picture.png" id="OptionBack">

<!-- Image that triggers the My Autobiography Home Page configuration bar -->
<a href="<?php  echo base_url();?>"><img src="<?php  echo base_url();?>images/system/login/home.png" id="OptionBack" hspace="50" ></a>

	<!-- Login Box -->
	<div class="LoginBox">

		<!-- live avatar -->
		<img src="<?php  echo base_url();?>images/system/login/avatar.png">

		<!-- Login Message -->
		<h2 class="loginMessage"></h2>

		<!-- Form Fields -->
		 <div class="fields">
			<form id="frmLogin"> 
				<input type="text" id="txtUser" name="txtUser" placeholder="Username" value="<?php  set_value('txtUser');?>" required/>
<label style="color: red;display:none" >This field is required.</label>	

				<p></p>
				<input type="password" id="txtPassword" name="txtPassword" placeholder="Password" value="<?php  set_value('txtPassword'); ?>"  required/>



				<!-- buttons eye and  -->
				<button id="botLogIn" type="submit"></button>
				<img src="<?php  echo base_url();?>images/system/login/eye.png" class="seePass">
                     <h3><a title="forgetpassword" href="<?php  echo base_url();?>forget_password" style="color:white">Can't access your account?</a></h3>  
				<label style="color: red;display:none" id="invalid" >Invalid Username or Password</label>
			</form>
		</div>
		

	</div>




	<!-- javascript for login -->
	<script src="<?php  echo base_url();?>js/MetroLogin.js"></script>

</body>
</html>