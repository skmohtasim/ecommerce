<?php
require 'Item.php';
session_start();

	$item=new Item();
	$item->id="1";
	$item->name="hp";
	$item->price="100";
	$item->quantity="2";
	$_SESSION["cart"][]=$item;
	
	$cart=unserialize(serialize($_SESSION["cart"]));

?>
<table>
	<?php  for($i=0;count($cart);++$i){?>
    <tr>
    	<td><?php echo($cart[$i]->id)?></td>
        <td><?php echo($cart[$i]->name)?></td>
        <td><?php echo($cart[$i]->price)?></td>
        <td><?php echo($cart[$i]->quantity)?></td>
    </tr>
    <?php }?>
</table>