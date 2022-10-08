<?php


// #######################################################################################################
//  we have used Ajax request, so when user click on submit button after filling review fields, and rating
//  data will be sent to this PHP script. 
//  We'll write all the actions like submit review, load all reviews from database, etc..
// #######################################################################################################


include('../includes/db_connect.php');

if (isset($_POST["action"])){

    // Insert reviews data into database
    if ($_POST["action"] == "submit_rating")
    {
        $username = $_POST["user_name"];
        $userRating = $_POST["rating_data"];
        $userReview = $_POST["user_review"];
        $datetime = date('j')."-".date('n')."-".date('Y');


        $query = "INSERT INTO review_table(user_name,user_rating,user_review,datetime) VALUES ('$username', '$userRating', '$userReview', '$datetime')";

        if (mysqli_query($conn, $query))
            echo "Review submitted successfully!"; //send response to ajax 
        else
            echo mysqli_error($conn);
    }



    // Retrieve reviews data from database
    if ($_POST["action"] == "load_data") 
    {
        $average_rating = 0;
        $total_review = 0;
        $five_star_review = 0;
        $four_star_review = 0;
        $three_star_review = 0;
        $two_star_review = 0;
        $one_star_review = 0;
        $total_user_rating = 0;
        $review_content = array();

        $query2 = "SELECT * FROM review_table ORDER BY review_id DESC";

        $result = mysqli_query($conn, $query2);

        if (!$result)
            echo mysqli_error($conn);

        while ($row = mysqli_fetch_assoc($result)) {

            // associative array 
            $review_content[] = array(
                "user_name" => $row["user_name"],
                "user_review" => $row["user_review"],
                "rating" => $row["user_rating"],
                "datetime" => $row["datetime"]);

            if ($row["user_rating"] == '5')
                $five_star_review++;
            if ($row["user_rating"] == '4')
                $four_star_review++;
            if ($row["user_rating"] == '3')
                $three_star_review++;
            if ($row["user_rating"] == '2')
                $two_star_review++;
            if ($row["user_rating"] == '1')
                $one_star_review++;


            $total_review++;

            $total_user_rating += $row["user_rating"];

        }

        $average_rating = $total_user_rating / $total_review;

        // we save all the info in array variable and encode it in json format for sending it to AJAX
        $output = array(
            'average_rating' => number_format($average_rating, 1),
            'total_review' => $total_review,
            'five_star_review' => $five_star_review,
            'four_star_review' => $four_star_review,
            'three_star_review' => $three_star_review,
            'two_star_review' => $two_star_review,
            'one_star_review' => $one_star_review,
            'review_data' => $review_content
        );

        echo json_encode($output);
    }
}

?>