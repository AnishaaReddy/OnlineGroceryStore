<?php
session_start();

require 'dbcon.php';

if (isset($_POST['details'])) {
    $un = $_POST['Name'];
    $um = $_POST['Mobile'];
    $ue = $_POST['Email'];
    $ua = $_POST['Address'];
    $us = $_POST['State'];
    $uc = $_POST['City'];
    $up = $_POST['PostCode'];
   

    $_SESSION['NAME'] = $un;
    $_SESSION['MOBILE'] = $um;
    $_SESSION['EMAIL'] = $ue;
    $_SESSION['ADDRESS'] = $ua;
    $_SESSION['STATE'] = $us;
    $_SESSION['CITY'] = $uc;
    $_SESSION['POSTCODE'] = $up;

    $page = 'checkout.php';
    header("Location: $page");
    exit;
}

if (!isset($_SESSION['products']) || empty($_SESSION['products'])) { 
    if (empty($_POST)) {
        header('Location: index.php');
        exit;
    }
    foreach ($_POST as $key => $val) {
        $array = explode('_', $key); // discount_amount_1 => Array([0] => discount, [1] => amount, [2] => 1)

        if (count($array) > 1) { // exclude keys without _
            $i = array_pop($array); // get and remove last member of array => Array([0] => discount, [1] => amount)
        } else {
            $i = $array[0];
        }

        $key = implode('_', $array); // Array([0] => discount, [1] => amount) => discount_amount

        if (is_numeric($i)) {
            $products[$i][$key] = $val;
        } else {
            $cart[$key] = $val;
        }
    }

    $total = $cart['total'];
    $_SESSION['products'] = $products;
    $_SESSION['total'] = $total;
} else {
    $products = $_SESSION['products'];
    $total = $_SESSION['total'];
}

?>
<!DOCTYPE html>
<html>
<head>
<title> Online Grocery Store</title>
<body>
<?php include 'header.php' ?>
		
		<div class="w3l_banner_nav_right">


		<div class="w3_login">
			<h3>Enter your information here</h3>
			<div class="w3_login_module">
				<div class="module form-module">
                    <div class="form" style="display:block;">
                        <h2>Delivery Details</h2>
                        <span class="text-danger"></span>
                        <form action="" method="post">
                            <label for="name">Name: *</label>
                            <input type="text" name="Name" required pattern="^[a-zA-Z\s]+$" placeholder="John Doe">

                            <label for="name">Mobile: *</label>
                            <input type = "text" name="Mobile" placeholder="0400000000" required pattern="\d{10}">

                            <label for="name">Email Address: *</label>
                            <input type="text" name="Email" placeholder="joe@company.com" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" required style="text-align:center:">

                            <label for="name">Delivery Address: *</label>
                            <input type="text" name="Address" placeholder="Unit 6/100...." required pattern="A-Za-z0-9'\.\-\s\,]">
                            
                            
                            <label for="name">City: *</label>
                            <input type="text" name="City" placeholder="Sydney" required style="text-align:center:" pattern="^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$">

                            <label for="name">State: *</label>
                            <select name="State" style="text-align:center:">
                            <option value="ACT">Australian Capital Territory</option>
                            <option value="NSW">New South Wales</option>
                            <option value="QLD">Queensland</option>
                            <option value="SA ">South Australia</option>
                            <option value="VIC">Victoria</option>
                            <option value="WA ">Western Australia</option>
                            </select>

                            <label for="name">PostCode: *</label>
                            <input type="text" name="PostCode" placeholder="2000" required pattern="^(0[289][0-9]{2})|([1-9][0-9]{3})$">



                            <input type="submit" value="Place Order" name="details">
                        </form>
                    </div>
				</div>
			</div>
                       

		</div>
        
<!-- //login -->
		</div>
		<div class="clearfix"></div>
	</div>
    <script type="text/javascript">
    $(document).ready(function() {

         $(".w3l_search").hide();
         $(".nav_1").hide();

    });
</script>
<?php include 'footer.php' ?>
</body>
</html>