
<?php

$sql="select categoryid,categoryname from Categories";
$arrcategories=$objDBClass->RetriveData($sql,$strErr);

?>

<nav class="navbar navbar-default">
     <div class="container">
        <div class="row-fluid">
           <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              </button>
              <a href="index.php"><img class="logo img-responsive" src="images/logo.png" alt=""></a>
           </div>
           <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                 <li><a href="#">All Deals</a></li>
                 <li><a href="#">Mega Deals</a></li>
                 <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Categories <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    	<?php for($i=0;$i<count($arrcategories);++$i){?>
                       <li><a href="#"><?php echo($arrcategories[$i][1]);?></a></li>
                       <?php }?>
                    </ul>
                 </li>
                    <?php
					if(isset($_SESSION["cart"]) && $_SESSION["cart"]!=NULL)
                    {
						$cart=unserialize(serialize($_SESSION["cart"]));
						$totalCartItems=count($cart);
						//print_r($cart);
					}
					else
					{
						$cart="";
						$totalCartItems=0;
					}
                    ?>
                 <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-shopping-cart"></i> <span id="cartcount"><?php echo($totalCartItems);?></span><span class="caret"></span></a>
                    
                   
                    <ul class="dropdown-menu cart-item" id="linkedEventList">
                        <?php
						$cartids="";
                        if($cart!="")
                        {
                            for($i=0;$i<count($cart);++$i)
                            {
                                $cartids=$cartids.",".$cart[$i]->id;
                            ?>
                           <li class="cart-single" id="navli<?php echo($cart[$i]->id); ?>">
                              <span class="cart-item-title"><?php echo($cart[$i]->name);?></span>
                             <!-- <span class="cart-item-quantity">1</span>-->
                              <span class="cart-item-price">@ <?php echo($cart[$i]->price); ?></span>
                              <span class="remove-from-cart">
                              <a href="javascript:removefromcart(<?php echo($cart[$i]->id);?>)" class="itemDelete"><!--<i class="fa fa-times"></i>-->X</a>
                              
                              </span>
                           </li>
                           <?php }
						   $cartids=$cartids.",";
                        }?>
                       <!--<li class="cart-single">
                          <span class="cart-item-title">HP Probook</span>
                          <span class="cart-item-quantity">1</span>
                          <span class="cart-item-price">@ 2,000</span>
                          <span class="remove-from-cart">
                          <a href=""><i class="fa fa-times"></i></a>
                          </span>
                       </li>-->
                      
                       <!--<li class="cart-total">
                          <span><strong>Total: 2,000</strong></span>
                       </li>-->
                       <li class="cart-checkout">
                          <a href="checkout.php" class="btn btn-primary">Checkout</a>
                       </li>
                       
                    </ul>
                 </li>
                 <li>
                 <?php if($_SESSION["unamesite"]==""){?>
                 	<a href="" data-toggle="modal" data-target="#signUpModal">Login </a>
                    <?php }else{?>
                    <a href=""><?php echo($_SESSION["unamesite"]); }?></a></li>
              </ul>
           </div>
        </div>
     </div>
     </div>
  </nav>