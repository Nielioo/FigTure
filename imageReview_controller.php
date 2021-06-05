<?php
require_once("db_controller.php");  

function createImageReview($user_id, $image_id)
{
    $conn = connect();

    if($conn != null){
        if(!is_null($user_id) && !is_null($image_id)){
            $user_id = $_POST['user_id'];
            $review = $_POST['review'];

            $sql = "INSERT INTO user_buy (user_id, item_review) values ('$user_id', '$review')";
            $result = mysqli_query($conn, $sql) 
            or die (mysqli_error($conn));

            if($result){
                $response['message'] = 'Review posted';
            }else{
                $response['message'] = 'Failed to post review';
            }
        }
    }else{
        echo "Failed to connect to database";
    }
    close($conn);
}


function readImageReview($user_id, $image_id){
    $conn = connect();
    

    if($conn != null){
        if(!is_null($image_id)){
            $query = $conn->query("SELECT user_buy.item_review, user_buy.image_id
            FROM (`user_buy`) WHERE user_buy.user_id = ?");
            $response["count"] = $query->num_rows;
            $review_data = array();

            while($data = mysqli_fetch_assoc($query)){
                $object = array(
                    'nama' => $data['user_id'], 
                    'review' => $data['item_review'],
                    'image_id' => $data['image_id']
                );

        array_push($review_data, $object);
            };
        }
    }else{
        echo "Failed to connect to database";
    }
    close($conn);
    return $review_data;
}

function updateImageReview($user_id, $image_id, $item_review){

    $conn = connect();

    if($conn != null){
        if(!is_null($user_id, $image_id, $item_review)){
            if(!is_null($_POST)){
                $image_id = $_POST['item_review'];
                $item_review = $_POST['item_review'];
        
                $conn = connect();
            
                if(!is_null($user_id) && !is_null($image_id)){
                    $query = $conn ->prepare("SELECT item_review FROM user_buy WHERE image_id = ? ");
                    $query->bind_param('i', $image_id);
                    $query->execute();
                    $result = $query->get_result();
        
                    if($result->num_rows > 0){
                        $query = $conn->prepare ("UPDATE user_buy SET item_review = ? WHERE image_id = ?");
                    }
                }
            }
        }
    }
    
    close($conn);
}

function deleteImageReview($user_id, $image_id, $item_review){
    $conn = connect();

    if($conn != null){
        if(!is_null($user_id, $image_id, $item_review)){
            if(!is_null($_POST)){
                $item_review = $_POST['item_review'];
        
                $query = $conn->prepare("SELECT item_review FROM user_buy WHERE image_id = ?");
                $query->bind_param('i',$image_id);
                $query->execute();
                $result = $query->get_result();
    
                if($result->num_rows > 0){
                    $query = $conn->prepare("DELETE $item_review FROM user_buy WHERE image_id = ?");
                    $query->bind_param('i',$image_id);
                    $result = $query->execute();
    
                    if($result){
                        $response['message'] = "Review Deleted";
                    }else{
                        $response['message'] = "Failed to delete";
                    }
                }else{
                    $response['message'] = "Data not found";
                }
            }else{
                $response['message'] = "No Post Data";
            }
        }
    }
    close($conn);
}



?>