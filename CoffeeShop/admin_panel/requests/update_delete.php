<?php session_start();

include_once('../../includes/db_connect.php');

if(isset($_POST['action'])) {

    // remove manager
    if($_POST["action"] == "remove_manager") { 

        $manager_id = $_POST['manager_id'];

        $query = "DELETE FROM manager where manager_id=$manager_id";
        mysqli_query($conn,$query);
    }

    // remove team
    if($_POST["action"] == "remove_member") { 

        $member_id = $_POST['member_id'];

        $query = "DELETE FROM team where member_id=$member_id";
        mysqli_query($conn,$query);

    }

    // remove admin
    if($_POST["action"] == "remove_admin") { 

        $admin_id = $_POST['admin_id'];

        $query = "DELETE FROM administrator where admin_id=$admin_id";
        mysqli_query($conn,$query);

    }

    // remove menu
    if($_POST["action"] == "remove_menu") { 

        $menu_id = $_POST['menu_id'];

        // delete items from offer table if exists

        $query = "SELECT offer.item_id FROM menuitem,offer where menuitem.item_id = offer.item_id and menuitem.menu_id=$menu_id";
        $result = mysqli_query($conn,$query);

        while($row = mysqli_fetch_assoc($result)){

            $query2 = "DELETE FROM offer where item_id=".$row['item_id'];
            mysqli_query($conn,$query2);

        }

        // delete all items inside this menu
        $query = "DELETE FROM menuitem where menu_id=$menu_id";
        mysqli_query($conn,$query);

        // delete menu
        $query = "DELETE FROM menu where menu_id=$menu_id";
        if(mysqli_query($conn,$query)){echo "success";}

    }


    // remove item
    if($_POST["action"] == "remove_item") { 

        $item_id = $_POST['item_id'];

        // delete item from offer table if exists
        $query = "DELETE FROM offer where item_id=$item_id";
        mysqli_query($conn,$query);

        // delete item from MenuItem table
        $query = "DELETE FROM menuitem where item_id=$item_id";
        mysqli_query($conn,$query);;

    }


    // remove topping category
    if($_POST["action"] == "remove_toppingCat") { 

        $toppingCat_id = $_POST['toppingCat_id'];

        // delete all items inside this category
        $query = "DELETE FROM toppings where topping_category_id=$toppingCat_id";
        mysqli_query($conn,$query);

        // delete menu
        $query = "DELETE FROM toppingscategory where topping_category_id=$toppingCat_id";
        mysqli_query($conn,$query);

    }

    // remove topping category
    if($_POST["action"] == "remove_topping") { 

        $topping_id = $_POST['topping_id'];

        // delete topping
        $query = "DELETE FROM toppings where topping_id=$topping_id";
        mysqli_query($conn,$query);

    }

    // remove offer
    if($_POST["action"] == "remove_offer") { 

        $offer_id = $_POST['offer_id'];

        // delete offer
        $query = "DELETE FROM offer where offer_id=$offer_id";
        mysqli_query($conn,$query);

    }

    // remove finished offers
    if($_POST["action"] == "remove_finished_offers") { 
        $todaydate = date("Y")."-".date("m")."-".date("d");

        $query = "DELETE FROM offer where end_date < '$todaydate'";
        mysqli_query($conn,$query);

    }

    // remove all offers
    if($_POST["action"] == "remove_all_offers") { 

        $query = "DELETE FROM offer";
        mysqli_query($conn,$query);

    }


    if($_POST["action"] == "remove_currency") { 

        $currency_id = $_POST['cur_id'];

        // delete currency
        $query = "DELETE FROM currency where currency_id=$currency_id";
        mysqli_query($conn,$query);

    }



    
}



?>
