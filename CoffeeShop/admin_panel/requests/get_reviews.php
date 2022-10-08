<?php

include_once('../../includes/db_connect.php');

if(isset($_POST["action"])){

    if($_POST["action"] == 'rate'){

        $nb_stars = $_POST['dataRating'];
        $total_review = 0;

        // get all reviews
        $query = "SELECT * from review_table where user_rating=$nb_stars  ORDER BY review_id DESC";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {

            // associative array 
            $review_content[] = array(
                "user_name" => $row["user_name"],
                "user_review" => $row["user_review"],
                "rating" => $row["user_rating"],
                "datetime" => $row["datetime"]);

            $total_review++;

        }
         
        // we save all the info in array variable and encode it in json format for sending it to AJAX
        $output = array(
            'total_review' => $total_review,
            'review_data' => $review_content
        );

        echo json_encode($output);
    }



    if($_POST["action"] == 'get_avg'){

        $query2 = "SELECT AVG(user_rating) as avg from review_table";
        $result2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_assoc($result2);

        echo number_format($row2['avg'],1);
    
    }

}

?>