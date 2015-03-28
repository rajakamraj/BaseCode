<?php
session_start();
if(!isset($_SESSION['username']))
{
header("location:index.php");
}
if($_SESSION['type']=="A")
{
header("location:index.php");
}
require_once("db.php");
$msg="";
if(isset($_POST['checkout']))
{
	extract($_POST);
	$uid=$_SESSION['uid'];
	$saddress=mysql_real_escape_string($saddress);
	$baddress=mysql_real_escape_string($baddress);
	$payment=mysql_real_escape_string($payment);
	$query2=mysql_query("select * from orders");
	$ocount=mysql_num_rows($query2);
	//echo $uname;
	$orderno=" ";
	$orderno=$uid.strtoupper(substr($uname,0,2)).$ocount;
	$msg="";
	$noofitems=count($_SESSION["gids"]);
  	$i=0;
  	while($i<$noofitems)
  	{
    	$pid=$_SESSION["gids"][$i];
		$quantity=$_SESSION["counts"][$i];
		if($pid>0){
			$query=mysql_query("insert into orders (orderno,uid,pid,quantity,baddress,saddress,payment,status) values('$orderno','$uid','$pid','$quantity','$baddress','$saddress','$payment','Order in process')");
    
	     }
		 $i++;
	}

	if($query)
	{
	    $msg="Order Placed Successfully. Your Reference order number is ".$orderno." ..";
		 unset($_SESSION["gids"]);
		 unset($_SESSION["counts"]);
		 $_SESSION["gids"] = array();
    $_SESSION["counts"] = array();
		header("location: checkout.php?cmsg=$msg");
		
	}
	else
	{
		$msg="Failure in Placing order.. try later...";
		header("location: checkout.php?cmsg=$msg");
	}
}

if (isset($_GET["rmfromcart"]) && (int)$_GET["rmfromcart"] > 0) //remove product with productID == $remove
    {
        $i=0;
        while ($i<count($_SESSION["gids"]) && $_SESSION["gids"][$i] != (int)$_GET["rmfromcart"])
            $i++;
        if ($i<count($_SESSION["gids"]))
            $_SESSION["gids"][$i] = 0;
    } 
	
if(isset($_GET['msg']))
{
  $msg=$_GET['msg'];
}

if(isset($_GET['cmsg']))
{
  $cmsg=$_GET['cmsg'];
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
    	
      <?php 
		if(!isset($_GET['cmsg']))
		{
	?>   
        <div id="sidebar" style="width:500px">
        <h3>Cart</h3> <h4><?php echo $msg;?></h4>
        <table width="95%" border="0">
  <tr style="text-align:center">
    <td width="10%">S.No.</td>
    <td width="32%">Product Name</td>
    <td width="22%">Cost (Rs)</td>
    <td width="12%">Quantity</td>
    <td width="24%">Gross (Rs)</td>
    <td> Action</td>
  </tr>
  
  <?php 
  require_once("db.php");
  $total=0;
  $sn=1;
  $noofitems=count($_SESSION["gids"]);
  $i=0;
  while($i<$noofitems)
  {
    $pid=$_SESSION["gids"][$i];
	$quantity=$_SESSION["counts"][$i];
	if($pid>0){
	$query=mysql_query("select * from product where ID='$pid'");
	//$count=mysql_num_rows($query);
	if($row=mysql_fetch_array($query))
	{
	   $gross=$row['price']*$quantity;
	   $total=$total+$gross;
	  
  ?>
  <tr>
   
    <td><?php echo $sn;?></td>
    <td><?php echo $row['pname'];?></td>
    <td style="text-align:right"><?php echo $row['price'];?></td>
    <td style="text-align:right"><?php echo $quantity;?></td>
    <td style="text-align:right"><?php echo $gross;?></td>
    <td><a href="checkout.php?rmfromcart=<?php echo $pid;?>" style="color:#FF0000">Remove</a></td>
  </tr>
  <?php $sn++; } }$i++;  }?>
  <tr>
   
    <td></td>
    <td></td>
    <td></td>
    <td>Total</td>
    <td style="text-align:right"><?php echo "Rs ".$total?></td>
    <td></td>
  </tr>
</table>

        </div>
        
        <div id="content" style="width:400px">
        <?php 
		if(!isset($_GET['msg']))
		{
		?>
        <h3>Check Out Details</h3>
        
        <form action="#" method="post" name="checkout_form">
        <?php
		 require_once("db.php");
		 $userid=$_SESSION['uid'];
		 $query1=mysql_query("select * from users where ID='$userid'");
		 $count1=mysql_num_rows($query1);
		 $row1=mysql_fetch_array($query1);
		 $uname="";
		 $umobile="";
		 $uemail="";
		 if($count1==1)
		 {
		    $uname=$row1['name'];
			$umobile=$row1['mobile'];
			$uemail=$row1['email'];
		 }
		 ?>
        	<table width="98%" border="0" align="right">
            <tr>
            <td width="35%" style="border-bottom:none; text-align:right">Name  :</td>
            <td width="3%" style="border-bottom:none">&nbsp;</td>
            <td width="62%" style="border-bottom:none"><input type="text" name="uname" value="<?php echo $uname?>" maxlength="50"/></td>
            </tr>
            <tr>
            <td style="border-bottom:none; text-align:right">Mobile  :</td>
            <td style="border-bottom:none">&nbsp;</td>
            <td style="border-bottom:none">
                            <input type="text" value="+91" disabled="disabled"  style="width:25px"/>
                            <input disabled="disabled" value="<?php echo $umobile?>" type="text" name="mobile" maxlength="10" style="width:110px"/>
            </td>
            </tr>
            <tr>
            <td style="border-bottom:none; text-align:right">Email ID  :</td>
            <td style="border-bottom:none">&nbsp;</td>
            <td style="border-bottom:none"><input disabled="disabled" value="<?php echo $uemail?>" type="text" name="email" maxlength="100"/></td>
            </tr>
            <tr>
            <td style="border-bottom:none; text-align:right">Shipping Address  :</td>
            <td style="border-bottom:none">&nbsp;</td>
            <td style="border-bottom:none"><input type="text" name="saddress" maxlength="50"/></td>
            </tr>
            <tr>
            <td style="border-bottom:none; text-align:right">Billing Address  :</td>
            <td style="border-bottom:none">&nbsp;</td>
            <td style="border-bottom:none"><input type="text" name="baddress" maxlength="50"/></td>
            </tr>
            <tr>
            <td style="border-bottom:none; text-align:right">Payment Mode  :</td>
            <td style="border-bottom:none">&nbsp;</td>
            <td style="border-bottom:none">
            	<select name="payment">
                  <option selected="selected" value="Credit Card">Credit Card</option>
                  <option value="Debit Card">Dedit Card</option>
                  <option value="Cash">Cash</option>
            	</select>
            </td>
            </tr>
            <tr>
            <td style="border-bottom:none">&nbsp;</td>
            <td style="border-bottom:none">&nbsp;</td>
            <td style="border-bottom:none"><input type="submit" name="checkout" value="Checkout and pay" class="more" style="float:left" /></td>
            </tr>
          </table> 	
          </form>
          <?php } 
		  else {?>
          <h3><?php echo $msg;?></h3>
          <?php }?>
      </div> 
      <!-- END of content -->
      <?php }
	  else if(isset($_GET['cmsg']))
	     {
	  ?>
      <h3><?php echo $cmsg?></h3>
      <h4><a href="index.php">Click here to continue shopping..</a></h4>
      <?php } ?>
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