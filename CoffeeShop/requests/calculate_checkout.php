<?php session_start();

include('../includes/db_connect.php');

if(isset($_POST["action"])){
    if($_POST["action"] == "checkout"){

        // get shipping price from database -> shipping cost initially in ($)
        $query="SELECT delivery_cost FROM Delivery";
        $result=mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        // convert shipping cost to the selected currency by the user
        $shipping=$row["delivery_cost"]*$_SESSION['currency']['price'];

        // save shipping inside a session
        $_SESSION["shipping"] = $shipping;

        $total_with_shipping=$_SESSION["shopping_cart_total"]+$shipping;

        // save total inside a session
        $_SESSION["shopping_cart_total"]=$total_with_shipping;
}}
?>