<script type="text/javascript" language="javascript">
function formvalidation()
{
var uname=document.getElementById("username").value;
var pwd=document.getElementById("password").value;
if (uname==null || uname==""||pwd==null || pwd=="")
  {
  alert("Invalid Username or Password");
  return false;
  }
  else
  { document.forms["login_form"].submit(); }
}
</script>
<div id="templatemo_header">
    	<div id="site_title"><h1><a href="http://www.templatemo.com" style="text-align:right">Online Shopping</a></h1></div>
        
         <!-- END -->
         <div class="fk-act-links" style="margin-right:10px">
         
              <div class="line bmargin10">
              
                  <a href="index.php">Home &nbsp;&nbsp;|&nbsp;&nbsp;</a>
                 <a href="">Contact Us &nbsp;&nbsp;|&nbsp;&nbsp;</a>
                  <?php
				  if(!isset($loginmsg))
				  $loginmsg="";
				  if(!isset($_SESSION['username']))
				  {
				  
				  ?>
                  <a href="signup.php">SignUp</a>
				  <?php } 
				  else { ?>
                  <a href="">Hi &nbsp;<?php echo $_SESSION['username']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;</a>
                  <a href="logout.php">logout&nbsp;&nbsp;</a>
				  <?php } ?>
              </div>
           <?php
                  
				  if(!isset($_SESSION['username']))
				  {
				  
				  ?>
			  <form action="index.php" method="post" name="login_form" id="login_form">
              <div class="line" style="margin-bottom:5px">
                  Username/Email:
				<input type="text" name="username" id="username" />&nbsp;
                Password:
				<input type="password" name="password" id="password" />
              </div>
              <div class="line">
              <input type="submit" name="login" value="Login" class="more"  />
              <span style="color:#FF0000"><?php echo $loginmsg;?></span>&nbsp;&nbsp;Forgot Your Passsword?&nbsp;&nbsp;
              </div>
              </form> 
			  <?php }
			  else { ?>  
              <div class="line"  style="margin-bottom:5px; height:10px"></div>
              <div class="line">
                  <?php if($_SESSION['type']=="A")
				  {
				  ?>
                  <a href="adminorders.php">Orders&nbsp;&nbsp;|&nbsp;&nbsp;</a>
                  <a href="newproduct.php">New Product&nbsp;&nbsp;|&nbsp;&nbsp;</a>
                  <?php }
				  else { ?>
                  <a href="checkout.php">Cart (<?php $count=0; $noofitems=count($_SESSION["gids"]);
  													$i=0;
 													 while($i<$noofitems)
 													 {
    													if($_SESSION["gids"][$i]>0) $count++; $i++;} echo $count; ?>)
                                                        &nbsp;Check out&nbsp;&nbsp;|&nbsp;&nbsp;</a>
                  <a href="orders.php">My Orders&nbsp;&nbsp;|&nbsp;&nbsp;</a>
                  <?php } ?>
                  <a href="">Change Password&nbsp;&nbsp;&nbsp;</a>
                  
              </div>
              <?php }?>           
         </div>
    </div> 