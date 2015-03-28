<?php
session_start();
require_once("db.php");
if(isset($_POST['signup']))
{
	extract($_POST);
	$name=mysql_real_escape_string(ucfirst($name));
	$mobile=mysql_real_escape_string($mobile);
	$email=mysql_real_escape_string($email);
	$password=mysql_real_escape_string($password);
	$msg="";
	$query=mysql_query("insert into users (name,mobile,email,password,type) values('$name','$mobile','$email','$password','C')");


	if($query)
	{
	    $msg="Sign Up Successful. Login to purchase products..";
		header("location: signup.php?msg=$msg");
		
	}
	else
	{
		$msg="Sign Up Failure.. Try Later";
		header("location: signup.php?msg=$msg");
	}
}
if(isset($_GET['msg']))
{
  $msg=$_GET['msg'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--Credit:  VENKATRAJ-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>XYZ Web Store</title>

<link href="css/templatemo_style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js"></script>


<link rel="stylesheet" type="text/css" href="css/styles.css" />
<script language="javascript" type="text/javascript" src="scripts/mootools-1.2.1-core.js"></script>
<script language="javascript" type="text/javascript" src="scripts/mootools-1.2-more.js"></script>
<script language="javascript" type="text/javascript" src="scripts/slideitmoo-1.1.js"></script>

</head>

<body id="home">

<div id="templatemo_wrapper">
	<?php include("header.php"); ?><!-- END of header -->
    
    
    
    <div id="templatemo_main_top"></div>
    <div id="templatemo_main">
    	
        
        <?php include("categories.php"); ?>
        
        <div id="content">
        <?php 
		if(!isset($_GET['msg']))
		{
		?>
        <h3>Create Account</h3>
        
        <form action="#" method="post" name="signup_form">
        	<table width="98%" border="0" align="right">
            <tr>
            <td width="28%" style="border-bottom:none; text-align:right">Name  :</td>
            <td width="1%" style="border-bottom:none">&nbsp;</td>
            <td width="71%" style="border-bottom:none"><input type="text" name="name" maxlength="50"/></td>
            </tr>
            <tr>
            <td style="border-bottom:none; text-align:right">Mobile  :</td>
            <td style="border-bottom:none">&nbsp;</td>
            <td style="border-bottom:none">
                            <input type="text" value="+91" disabled="disabled"  style="width:25px"/>
                            <input type="text" name="mobile" maxlength="10" style="width:110px"/>
            </td>
            </tr>
            <tr>
            <td style="border-bottom:none; text-align:right">Email ID  :</td>
            <td style="border-bottom:none">&nbsp;</td>
            <td style="border-bottom:none"><input type="text" name="email" maxlength="100"/></td>
            </tr>
            <tr>
            <td style="border-bottom:none; text-align:right">Password  :</td>
            <td style="border-bottom:none">&nbsp;</td>
            <td style="border-bottom:none"><input type="password" name="password" maxlength="50"/></td>
            </tr>
            <tr>
            <td style="border-bottom:none; text-align:right">Confirm Password  :</td>
            <td style="border-bottom:none">&nbsp;</td>
            <td style="border-bottom:none"><input type="password" name="cpassword" maxlength="50"/></td>
            </tr>
            <tr>
            <td style="border-bottom:none">&nbsp;</td>
            <td style="border-bottom:none">&nbsp;</td>
            <td style="border-bottom:none"><input type="submit" name="signup" value="Sign Up" class="more" style="float:left" /></td>
            </tr>
          </table> 	
          </form>
          <?php } 
		  else {?>
          <h3><?php echo $msg;?></h3>
          <?php }?>
      </div> <!-- END of content -->
        <div class="cleaner"></div>
    </div> <!-- END of main -->
    
    <div id="templatemo_footer">
    	
        
        
		<center>
			Copyright © 2012 XYZ Online Shopping | Designed by RAJ
		</center>
    </div> <!-- END of footer -->   
   
</div>

</body>
</html>