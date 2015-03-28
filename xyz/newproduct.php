<?php
session_start();
if(!isset($_SESSION['username']))
{
header("location:index.php");
}
if($_SESSION['type']=="C")
{
header("location:index.php");
}
require_once("db.php");

if(isset($_POST['newproduct']))
{
	extract($_POST);
	$pname=mysql_real_escape_string(ucfirst($pname));
	$description=mysql_real_escape_string($description);
	$category=mysql_real_escape_string($category);
	$price=mysql_real_escape_string($price);
	$stock=mysql_real_escape_string($stock);
	$thumburl="";
	//$msg="";
	
	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$extension = end(explode(".", $_FILES["file"]["name"]));
	if ((($_FILES["file"]["type"] == "image/gif")  || ($_FILES["file"]["type"] == "image/jpeg")	|| ($_FILES["file"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts))
  	{
  		if ($_FILES["file"]["error"] > 0)
    	{
		    $msg="Failure in adding thumb image.. Try Later";
		    header("location: newproduct.php?msg=$msg");
    		echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    	}
  		else
    	{
		    $saveto="images/product/";
			$ext = substr($_FILES["file"]["name"], strrpos($_FILES["file"]["name"], '.') + 1);
			$filename=$saveto.$_FILES["file"]["name"];
		    if (file_exists($filename)) {
			$_FILES["file"]["name"]=basename($_FILES["file"]["name"],".".$ext)."1.".$ext;
			}
			
      		move_uploaded_file($_FILES["file"]["tmp_name"],$saveto . $_FILES["file"]["name"]);
			$thumburl="images/product/" . $_FILES["file"]["name"];
			
      	}
  	}
	else
  	{
  		$msg="Failure in adding thumb image.. Try Later";
		header("location: newproduct.php?msg=$msg");
  	}
	
	$query=mysql_query("insert into product(pname,description,category,price,stock,thumburl) values('$pname','$description','$category','$price','$stock','$thumburl')");
	
	if($query)
	{
	    $msg="Added new product to stock successfully.";
		header("location: newproduct.php?msg=$msg");
		
	}
	else
	{
		$msg="Failure in adding new product.. Try Later..";
		header("location: newproduct.php?msg=$msg");
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
        
        <h3>New Product Stock</h3>
        <?php 
		if(isset($_GET['msg']))
		{
		?>
        <h3><?php echo $msg;?></h3>
        <?php }?>
        <form action="newproduct.php" method="post" name="newproduct_form" enctype="multipart/form-data">
        	<table width="98%" border="0" align="right">
            <tr>
            <td width="28%" style="border-bottom:none; text-align:right">Product Name  :</td>
            <td width="1%" style="border-bottom:none">&nbsp;</td>
            <td width="71%" style="border-bottom:none"><input type="text" name="pname" maxlength="50"/></td>
            </tr>
            <tr>
            <td style="border-bottom:none; text-align:right">Description  :</td>
            <td style="border-bottom:none">&nbsp;</td>
            <td style="border-bottom:none">
                            <input type="text" name="description" maxlength="200"/>
            </td>
            </tr>
            <tr>
            <td style="border-bottom:none; text-align:right">Category  :</td>
            <td style="border-bottom:none">&nbsp;</td>
            <td style="border-bottom:none">
                <select name="category"> 
                <option value="0" selected="selected">--Select--</option>
                <option value="Books">Books</option>
                <option value="Mobiles">Mobiles</option>
                <option value="Computers">Computers</option>
                <option value="Camera">Camera</option>
                <option value="Gaming">Gaming</option>
                <option value="Music">Music</option>
                <option value="Home Accessories">Home Accessories</option>
                <option value="Watches">Watches</option>
                <option value="Toys">Toys</option>
                <option value="Clothing">Clothing</option>
                <option value="Shades">Shades</option>
                </select>
            </td>
            </tr>
            <tr>
            <td style="border-bottom:none; text-align:right">Price  :</td>
            <td style="border-bottom:none">&nbsp;</td>
            <td style="border-bottom:none"><input type="text" name="price" maxlength="10"/></td>
            </tr>
            <tr>
            <td style="border-bottom:none; text-align:right">Stock  :</td>
            <td style="border-bottom:none">&nbsp;</td>
            <td style="border-bottom:none"><input type="text" name="stock" maxlength="10"/></td>
            </tr>
            <tr>
            <td style="border-bottom:none;text-align:right">Product Thumbnail Image :</td>
            <td style="border-bottom:none">&nbsp;</td>
            <td style="border-bottom:none"><input type="file" name="file" style="float:left" /></td>
            </tr>
            <tr>
            <td style="border-bottom:none">&nbsp;</td>
            <td style="border-bottom:none">&nbsp;</td>
            <td style="border-bottom:none"><input type="submit" name="newproduct" value="Add to stock" class="more" style="float:left" /></td>
            </tr>
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