    <meta charset="utf-8">
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <script type="application/x-javascript">
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1);}
    </script>

    <!-- //for-mobile-apps -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css" media="all" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- //font-awesome icons -->

    <!-- js -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <!-- //js -->

    <link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){		
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>
    <!-- start-smoth-scrolling -->
</head>

<body>
    <!-- header -->
    <div class="agileits_header">
      <div class="w3l_offers"> <a href="#">Alki Online Grocery</a> </div>
      <div class="w3l_search" style="width:50%">
        <form action="search.php" method="post">
          <input type="text" name="Product" value="Search vegetables,apple,milk etc..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search a product...';}" required="">
          <input type="submit" name="submit" value=" ">
          <i class="fa-solid fa-magnifying-glass"></i>
        </form>
      </div>
      <div class="product_list_header">
        <form action="#" method="post" class="last">
          <fieldset>
            <input type="hidden" name="cmd" value="_cart" />
            <input type="hidden" name="display" value="1" />
            <input type="submit" name="submit" value="View your cart" class="button"  />
          
          </fieldset>
        </form>
      </div>
      <div class="clearfix"> </div>
    </div>

    <!-- script-for sticky-nav --> 
    <script>
        $(document).ready(function() {
             var navoffeset=$(".agileits_header").offset().top;
             $(window).scroll(function(){
                var scrollpos=$(window).scrollTop(); 
                if(scrollpos >=navoffeset){
                    $(".agileits_header").addClass("fixed");
                }else{
                    $(".agileits_header").removeClass("fixed");
                }
             });

        });
        </script> 
            <script>
    $(document).ready(function(){
        $(".dropdown").hover(            
            function() {
                $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
                $(this).toggleClass('open');        
            },
            function() {
                $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
                $(this).toggleClass('open');       
            }
        );
    });
    </script> 

    <!-- //script-for sticky-nav -->
    <div class="logo_products">
      <div class="container" style="background: #9aa369;">
        <div class="w3ls_logo_products_left">
          <h1><a href="index.php"> </a></h1>
        </div>
        <img src="images/logo.jpg" alt="logo" style="width: 35%;display: block;margin-left: auto;margin-right: auto;">
        <div class="clearfix"></div>
      </div>
    </div>
    <!-- //header --> 

    <!-- banner -->
    <div class="products-breadcrumb">
      <div class="container">
        <ul>
          <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Home</a><span>|</span></li>
          <li></li>
        </ul>
      </div>
    </div>

    <div class="banner">
        <div class="w3l_banner_nav_left">
          <nav class="navbar nav_bottom"> 
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header nav_2">
              <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse " id="bs-megadropdown-tabs">
              <ul class="nav navbar-nav nav_1">
                  <?php
                  $result1 = mysqli_query($conn, 'SELECT * FROM `category` WHERE `parent_id` = 0');
                  while ($category = $result1->fetch_assoc()) {
                      $result2 = mysqli_query($conn, 'SELECT * FROM `category` WHERE `parent_id` = '.$category['cid']);
                      if ($result2->num_rows) {
                          ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php echo ucwords($category['name']); ?> <span class="caret"></span>
                    </a>
                  <div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
                    <div class="w3ls_vegetables">
                      <ul>
                          <?php
                          while ($subcategory = $result2->fetch_assoc()) {
                              echo '<li style="margin:5px"><a href="products.php?id='.$subcategory['cid'].'">'.ucwords($subcategory['name']).'</a></li>';
                          } ?>
                      </ul>
                    </div>
                  </div>
                </li>
                          <?php
                      } else {
                          echo '<li><a href="products.php?id='.$category['cid'].'">'.ucwords($category['name']).'</a></li>';
                      }
                  }
                  ?>


              </ul>
            </div>
            <!-- /.navbar-collapse --> 
          </nav>
        </div>
