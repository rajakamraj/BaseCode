<?php
session_start();
require_once("db.php");
$query=mysql_query("select * from orders group by orderno");
$count=mysql_num_rows($query);
$omsg="";
if(isset($_POST['order']))
{
	extract($_POST);
	$query=mysql_query("select * from orders where orderno='$orderno' group by orderno");
	$count=mysql_num_rows($query);
	
	if($count==0)
	{
		$omsg="Invalid Order number...";
		header("location:orders.php?omsg=$omsg");
	}
}
if(isset($_GET['chstatus']))
{
	$orderno=$_GET['chstatus'];
	//echo "UPDATE orders SET status='Shipped' WHERE orderno='$orderno";
	$query1=mysql_query("UPDATE orders SET status='Shipped' WHERE orderno='$orderno'");
	if($query1)
	{
		$omsg="Order shipped successfully...";
		header("location:adminorders.php?omsg=$omsg");
	}
}
if(isset($_GET['omsg']))
{
  $omsg=$_GET['omsg'];
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
    	
        
        <div id="content" style="width:98%">
        <form name="order_form" method="post" action="adminorders.php">
        <table width="100%" border="0">
  <tr>
    <td width="15%">Reference Order No. :</td>
    <td width="18%"><input type="text" name="orderno" maxlength="50"/></td>
    <td width="15%"><input type="submit" name="order" value="Get Order Details" class="more" style="float:left" /></td>
    <td width="52%"><?php echo $omsg;?></td>
  </tr>
</table>
        </form>

        </div>
        <div id="content" style="width:98%">
       
        <h3>List Of Orders</h3>
        
        <form action="#" method="post" name="signup_form">
        	<table width="98%" border="0" align="right">
            <tr style="text-align:center">
            <td width="4%" style="border-bottom:none;">S.No.</td>
            <td width="7%" style="border-bottom:none">Order No.</td>
            <td width="9%" style="border-bottom:none">Customer ID</td>
            <td width="20%" style="border-bottom:none">Shipping Address</td>
            <td width="23%" style="border-bottom:none">Billing Address</td>
            <td width="11%" style="border-bottom:none">Payment mode</td>
            <td width="14%" style="border-bottom:none">Status</td>
            <td width="12%" style="border-bottom:none">Change Status to</td>
            </tr>
            <?php 
			$sn=0;
			while($row=mysql_fetch_array($query))
			{
			$sn++;
			?>
            <tr style="text-align:center">
            <td style="border-bottom:none"><?php echo $sn;?></td>
            <td style="border-bottom:none"><?php echo $row['orderno'];?></td>
            <td style="border-bottom:none"><?php echo $row['uid'];?></td>
            <td style="border-bottom:none"><?php echo $row['saddress'];?></td>
            <td style="border-bottom:none"><?php echo $row['baddress'];?></td>
            <td style="border-bottom:none"><?php echo $row['payment'];?></td>
            <td style="border-bottom:none">  <?php echo $row['status'];?></td>
            <td style="border-bottom:none;">
             <?php
			  if($row['status']!="Shipped"){
			 ?>
             <a href="adminorders.php?chstatus=<?php echo $row['orderno'];?>" style="color:#009900">Shipped</a>
             <?php } ?>
            </td>
            </tr>
            <?php } ?>
          </table> 	
          </form>
          
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