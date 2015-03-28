<?php
session_start();
$loginmsg="";
$msg="";
if(isset($_POST['login']))
{
require_once("db.php");
extract($_POST);
$username=stripslashes($username);
$password=stripslashes($password);
$query=mysql_query("select * from users where email='$username' and password ='$password'");
$loginmsg="select * from users where email='$username' and password ='$password'";
$count=mysql_num_rows($query);
$row=mysql_fetch_array($query);
	if($count==1)
	{
	
	$_SESSION['uid']=$row['ID'];
	$_SESSION['username']=$row['email'];
	$_SESSION['type']=$row['type'];
	$_SESSION['cartcount']=0;
	$_SESSION["gids"] = array();
    $_SESSION["counts"] = array();
	//header("location: index.php");
	}
	else
	{
	$loginmsg= "Username and Password does not match!";
	}
	//mysql_close($conn);
}
if (isset($_GET["add2cart"]) && (int)$_GET["add2cart"]>0) //add product to cart with productID=$add2cart
    {
        //$_SESSION['gids'] contains product IDs
        //$_SESSION['counts'] contains item quantities ($_SESSION['counts'][$i] corresponds to $_SESSION['gids'][$i])
        //$_SESSION['gids'][$i] == 0 means $i-element is 'empty' (does not refer to any product)
        if (!isset($_SESSION["gids"]))
        {
            $_SESSION["gids"] = array();
            $_SESSION["counts"] = array();
        }
        //check for current product in visitor's shopping cart content
        $i=0;
        while ($i<count($_SESSION["gids"]) && $_SESSION["gids"][$i] != $_GET["add2cart"]) $i++;
        if ($i < count($_SESSION["gids"])) //increase current product's item quantity
        {
            $_SESSION["counts"][$i]++;
        }
        else //no such product in the cart - add it
        {
            $_SESSION["gids"][] = $_GET["add2cart"];
            $_SESSION["counts"][] = 1;
        }
		$msg="Product added to cart successfully...";
		header("location: index.php?msg=$msg");
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
        <h3 align="center"><?php echo $msg;?></h3>
        <?php
		$i=1;
		$row="";
		$noitemflag=0;
        if(isset($_GET['chcat']))
		{
			require_once("db.php");
			
			    $category=$_GET['chcat'];
				$query=mysql_query("select * from product where category='$category'");
				while($row=mysql_fetch_array($query))
				{$noitemflag=1;
  			
		?>
           <div class="col col_14 product_gallery<?php if($i==3){echo " no_margin_right"; $i=0;}?>">
            	<a href=""><img src="<?php echo $row['thumburl'];?>"/></a>
                <h3><?php echo $row['pname'];?></h3>
                <p class="product_price">Rs <?php echo " ".$row['price'];?></p>
                <?php if(isset($_SESSION['username']))
				  { if($_SESSION['type']=="C"){
				  ?>
                <a href="index.php?add2cart=<?php echo $row['ID'];?>" class="add_to_cart">Add to Cart</a>
                <?php }}
				else
				  echo "Login To Buy...";
				?>
            </div>   
        
		<?php $i++;
		        }
				if($noitemflag==0){echo "No Items in this Category";}
		   
		   
		}
		else
		{
		        require_once("db.php");
				$query1=mysql_query("select * from product");
				while($row=mysql_fetch_array($query1))
				{$noitemflag=1;
  			
		?>
           <div class="col col_14 product_gallery<?php if($i==3){echo " no_margin_right"; $i=0;}?>">
            	<a href=""><img src="<?php echo $row['thumburl'];?>"/></a>
                <h3><?php echo $row['pname'];?></h3>
                <p class="product_price">Rs <?php echo " ".$row['price'];?></p>
                <?php if(isset($_SESSION['username']))
				  { if($_SESSION['type']=="C"){
				  ?>
                <a href="index.php?add2cart=<?php echo $row['ID'];?>" class="add_to_cart">Add to Cart</a>
                <?php }}
				else
				  echo "Login To Buy...";
				?>
            </div>   
        
		<?php $i++; }
		  if($noitemflag==0){echo "No Items in this Category";}
		
		 }?>
        	     	
                	
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