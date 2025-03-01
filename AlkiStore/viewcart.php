<?php
$products = $cart = [];

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



require 'dbcon.php';

?>
<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
    <title>My Cart | Grocery Store</title>

<?php
    include 'header.php'?>
        <form action="orderdetails.php?page=checkout" method="post">
        <div class="clearallmsg" style="width:92%; display:none;">
            <div class="checkout-right">
            <h4 style="text-align: center"> Your Shopping Cart looks empty. Click <a href="index.php">here</a> to start </h4>
            </div>
        </div>
            <div class="w3l_banner_nav_right" style="width:92%">
                <!-- about -->
                <div class="privacy about">
                    <h3>My <span>Cart</span></h3>
                    <div class="checkout-right">
                        <h4>Your shopping cart contains: <span><?=count($products)?> Products</span></h4>
                        <table class="timetable_sub">
                            <thead>
                                <tr>
                                    <th>#</th>	
                                    <th>Product</th>
                                    <th>Name</th>
                                    <th>Rate</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                foreach ($products as $i => $product) {
                                    $result = $conn->query('SELECT * FROM `product` WHERE `name` = "'.$product['item_name'].'"');
                                    if ($result) {
                                        $row = $result->fetch_assoc();
                                        $pid = $row['pid'];
                                        $image = $row['pic'];
                                        $amount = $product['amount'];
                                        $products[$i]['subtotal'] = $subtotal = $product['amount'] * $product['quantity'];
                                        $total += $subtotal;
                                    } else {
                                        echo 'Product not found.';
                                    } ?>
                                <tr class="rem<?=$pid?>">
                                    <td class="invert">
                                        <?=$i?>
                                    </td>

                                    <td class="invert-image" style="width:25%">
                                        <a href="single.php">
                                            <img src="<?=$image?>" alt="<?=$product['item_name']?>" class="img-responsive">
                                        </a>
                                    </td>

                                    <td class="invert">
                                        <span id="name_<?=$pid?>">
                                            <?=ucwords($product['item_name'])?>
                                        </span>
                                    </td>
                                    
                                    <input type="hidden" name="name_<?=$pid?>" value="<?=$product['item_name']?>">
                                    <td class="invert">
                                        <span id="amount_<?=$pid?>"><?=$product['amount']?></span>
                                    </td>
                                    <input type="hidden" name="amount_<?=$pid?>" value="<?=$product['amount']?>">
                                    
                                    <td class="invert">
                                         <div class="quantity"> 
                                            <div class="quantity-select">                           
                                                <div class="entry value-minus" data-id="<?=$pid?>">&nbsp;</div>
                                                <div class="entry value">
                                                    <span><?=$product['quantity']?></span>
                                                </div>
                                                <div class="entry value-plus active" data-id="<?=$pid?>">&nbsp;</div>
                                            </div>
                                        </div>
                                    </td>
                                    <input type="hidden" name="quantity_<?=$pid?>" value="<?=$product['quantity']?>">

                                    <td class="invert">
                                        <span id="subtotal_<?=$pid?>"><?=$subtotal?></span>
                                    </td>
                                    <input type="hidden" name="subtotal_<?=$pid?>" value="<?=$subtotal?>">

                                    <td class="invert">
                                        <div class="rem" id="<?=$pid?>">
                                            <div class="close1"></div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                        </tbody>
                      </table>
                    </div>
                    <div>
                        <span><button class="clearall btn-block">Clear All</button>
                    </div>
                    <div class="checkout-left">
                        <div class="col-md-4 checkout-left-basket">
                            <ul>
                                <li style="font-weight: bolder;font-size: 20px">Total  <span id="total"><?=$total?></span> <span>$</span></li>
                                <input type="hidden" name="total" value="<?=$total?>">
                            </ul>
                            <div class="row">
                            </div>
                        </div>
                        
                        <div class="col-md-8 address_form_agile">
                            <section class="creditly-wrapper wthree, w3_agileits_wrapper" style="margin-top: 35px">
                                <div class="information-wrapper">
                                    <button class="submit check_out btn-block">Place Order</button>
                                </div>
                            </section>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- //about -->
            </div>
        </form>
		<div class="clearfix"></div>
	</div>
    <!-- //banner -->

<?php include 'footer.php'?>

    <!--quantity-->
    <script>
    $('.value-plus').on('click', function() {
        id = $(this).attr('data-id');
        var divUpd = $(this).parent().find('.value');
        quantity1 = parseInt(divUpd.text(), 10)
        quantity2 = quantity1 + 1;
        if(quantity2 < 1) { quantity2 = 1; }
        divUpd.text(quantity2);
        $('[name=quantity_'+id+']').val(quantity2);
        amount = Number($('#amount_'+id).text());
        subtotal = quantity2 * amount;
        $('[name=subtotal_'+id+']').val(subtotal);
        $('#subtotal_'+id).text(subtotal);
        total1 = Number($('#total').text());
        total2 = total1 + (amount * (quantity2 - quantity1));
        $('#total').text(total2);
        $('[name=total]').val(total2);
    });

    $('.value-minus').on('click', function() {
        id = $(this).attr('data-id');
        var divUpd = $(this).parent().find('.value');
        quantity1 = parseInt(divUpd.text(), 10)
        quantity2 = quantity1 - 1;
        if(quantity2 < 1) { quantity2 = 1; }
        divUpd.text(quantity2);
        $('[name=quantity_'+id+']').val(quantity2);
        amount = Number($('#amount_'+id).text());
        subtotal = quantity2 * amount;
        $('[name=subtotal_'+id+']').val(subtotal);
        $('#subtotal_'+id).text(subtotal);
        total1 = Number($('#total').text());
        total2 = total1 + (amount * (quantity2 - quantity1));
        $('#total').text(total2);
        $('[name=total]').val(total2);
    });

    $(document).ready(function(c) {
        $('.rem').on('click', function(c) {
            id = $(this).attr("id");
            price_row = $("input[name=subtotal_"+id+"]").val();
            old_total = $("input[name=total]").val();
            new_total = old_total - price_row;
            $('.rem'+id).fadeOut('slow', function(c){
                $('.rem'+id).remove();
            });
            $("input[name=total]").val(new_total);
            $('#total').text(new_total);
        });
    });

    $(document).ready(function(c) {
        $('.close2').on('click', function(c){
            $('.rem2').fadeOut('slow', function(c){
                $('.rem2').remove();
            });
            });	  
        });

    $(document).ready(function(c) {
        $('.close3').on('click', function(c){
            $('.rem3').fadeOut('slow', function(c){
                $('.rem3').remove();
            });
        });	  

        $(".w3l_search").hide();
       
        $(".nav_1").hide();
    });

    function clearCart(){
        $(".w3l_banner_nav_right").empty();
        $(".product_list_header input.button").trigger('click');

         $("#PPMiniCart .minicart-details-remove .minicart-remove").trigger('click'); 
         $(".clearallmsg").show();
    }

    $('.clearall').on('click', function() {
        clearCart();
        setTimeout(function() {
            clearCart(); // tigger('click')
}, 2000);
       
    });

    </script>

</body>
</html>