<?php

//note we need to go up 1 more directory
require(__DIR__ . "/../../partials/nav.php");
$db = getDB();
$quantity = "quantity";
if (!is_logged_in()) {
    //this will redirect to login and kill the rest of this script (prevent it from executing)
    flash("You must be logged in to access this page", "warning");
    die(header("Location: login.php"));
}
if(isset($_POST["update"])){
    if ($quantity>0){
        $stmt = $db->prepare("UPDATE Cart set quantity = :q where id = :id");
        $r = $stmt->execute([":id"=>$_POST["cartId"], ":q"=>$_POST["quantity"]]);
        if($r){
            flash("Updated quantity", "success");
        }
    } elseif ($quantity==0 || $quantity<0){
        $stmt = $db->prepare("DELETE FROM Cart where id = :id");
        $r = $stmt->execute([":id"=>$_POST["cartId"]]);
        if($r){
            flash("Product deleted from cart", "success");
        }
    }
}
if(isset($_POST["delete"])){
    $stmt = $db->prepare("DELETE FROM Cart where id = :id");
    $r = $stmt->execute([":id"=>$_POST["cartId"]]);
    if($r){
        flash("Product deleted from cart", "success");
    }
}
if(isset($_POST["clear"])){
    $stmt = $db->prepare("DELETE FROM Cart where user_id = :id");
    $r = $stmt->execute([":id"=>get_user_id()]);
    if($r){
        flash("Cart cleared", "success");
    }
}


$db = getDB();
$results = [];

if (!isset($user_id)) {
    $user_id = get_user_id();
}

error_log("Cart");
//$stmt = $db->prepare("SELECT i.id, name, image, quantity FROM cart inv JOIN Products i on item_id = i.id WHERE Cart.user_id = :uid and quantity > 0");
$stmt = $db->prepare("SELECT i.id, name, image, Cart.quantity, category, Cart.unit_price, (Cart.unit_price * Cart.quantity) as subtotal FROM Cart JOIN Products i on item_id = i.id WHERE Cart.user_id = :uid and Cart.quantity > 0");
$stmt->execute([":uid"=>get_user_id()]);
try {
    $stmt->execute([":uid" => $user_id]);
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($r) {
        $results = $r;
    }
} catch (PDOException $e) {
    error_log(var_export($e, true));
    flash("<pre>" . var_export($e, true) . "</pre>");
}
//TODO
//display inventory output
//allow triggering effects for next game session
//store triggered items in a new table (so it persists between page loads and logouts)
?>
<div class="container-fluid">
   <h5>Cart</h5>
   <?php global $cart_total;?>
    <div class="list-group">
        <?php if($results && count($results) > 0):?>
            <?php $sum=0;?>
            <div class="list-group-item">
                <div class="row">
                    <div class="col">
                       Product
                    </div>
                    <div class="col">
                        Quantity
                    </div>
                    <div class="col">
                        Price
                    </div>
                    <div class="col">
                        Subtotal
                    </div>
                    <div class="col">
                        Actions
                    </div>
                </div>
            </div>
        
            <?php foreach($results as $r):?>
                

            <div class="list-group-item">
                <form method="POST">
                <div class="row">
                    <div class="col">
                        <a href="product_detail.php?id=<?php se($r, "id") ?>"> <?php se($r, "name")?></a>
                        <!--<?php echo $r["name"];?> -->
                    </div>
                    <div class="col">
                        

                        <input type="number" min="0" name="quantity" value="<?php echo $r["quantity"];?>"/>
                        <input type="hidden" name="cartId" value="<?php echo $r["id"];?>"/>


                </div>
                <div class="col">
                    <div class="col">
                        <?php echo $r["unit_price"];?>
                    </div>     
                    <?php
                    $subtotal = $r["subtotal"];
                    $cart_total= $cart_total+$subtotal;
                    $r["subtotal"]; ?>
                    </div>
                    <div class="col">
                        <!-- form split was on purpose-->
                        <input type="submit" class="btn btn-outline-dark" name="update" value="Quantity Update"/>
                        </form>
                        <form method="POST">
                            <input type="hidden" name="cartId" value="<?php echo $r["id"];?>"/>
                            <input type="submit" class="btn btn-outline-dark" name="delete" value="Remove"/>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
            <div class = "card-footer">
                <h2>Cart Summary</h2>
                <div class="list-group-item">
                    <form method = "POST">
                        <h5>Cart Total </h5>
                        <?php echo $cart_total?>
                        <div class = "col">

                        </div>
                
                        <div class = "row">
                                <input type="hidden" name="cartId" value="<?php echo $r["id"];?>"/>
                                <input type="submit" class="btn btn-outline-dark" name="clear" value="Clear Cart"/>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        <?php else:?>
        <div class="list-group-item">
            No items in cart
        </div>
        <?php endif;?>
        </div>
    </div>
    <?php 
    
?>
<?php require(__DIR__ . "/../../partials/flash.php");
require(__DIR__ . "/../../partials/footer.php");
?>
