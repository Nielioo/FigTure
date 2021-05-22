<?php

require_once("db_controller.php");

function createProfile($user_id, $profile_picture_name, $profile_picture_tmp_name, $mime, $nama, $email, $password, $tipe_user)
{
    $conn = connect();

    if ($conn != null) {
        if ($user_id != null && $profile_picture_name != null && $profile_picture_tmp_name != null && $mime != null && $nama != null && $email != null && $password != null && $tipe_user != null) {

            // Check image type
            $mime_type = explode("/", $mime, 2);

            if (validateType($mime_type)) {
                $target_dir = "profile_picture/";
                $path = pathinfo($_FILES['profile_picture']['name']);
                $profile_picture_tmp_name = $_FILES['profile_picture']['tmp_name'];
                $basename = $path['basename'];
                $path_basename = $target_dir . $basename;

                if (!file_exists($path_basename)) {
                    move_uploaded_file($profile_picture_tmp_name, $path_basename);

                    $query = $conn->prepare("INSERT INTO `user_profile`(`user_id`, `profile_picture`, `nama`, `email`, `password`, `tipe_user`) VALUES (?,?,?,?,?,?);");
                    $query->bind_param("ssssss", $user_id, $path_basename, $nama, $email, $password, $tipe_user);
                    $query->execute() or die(mysqli_error($conn));
                }
            }
        }
    }
    close($conn);
}

function readProfile($id)
{
    
    $conn = connect();

    $user_id = $_SESSION['user_id'];

    $query = $conn->prepare("SELECT * FROM `user_profile` WHERE `user_id`=?;");
    $query->bind_param('s', $user_id);
    $query->execute() or die(mysqli_error($conn));

    $result = $query->get_result();
    $data = $result->fetch_assoc();

    if (!empty($data)) {
        $obj = array(
            'id' => $data['id'],
            'user_id' => $data['user_id'],
            'profile_picture' => $data['profile_picture'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => $data['password'],
            'tipe_user' => $data['tipe_user'],
        );
    }
    close($conn);

    return $obj;
}

function readAllProfile()
{
    $list = array();

    $conn = connect();

    if ($conn != null) {
        $sql = "SELECT * FROM `user_profile`;";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $obj["id"] = $row["id"];
                $obj["user_id"] = $row["user_id"];
                $obj["profile_picture"] = $row["profile_picture"];
                $obj["nama"] = $row["nama"];
                $obj["email"] = $row["email"];
                $obj["password"] = $row["password"];
                $obj["tipe_user"] = $row["tipe_user"];
                array_push($list, $obj);
            }
        }
    }
    close($conn);

    return $list;
}

function updateProfile($id, $user_id, $profile_picture, $nama, $email, $password, $tipe_user)
{
    $conn = connect();

    if ($conn != null) {
        $query = $conn->prepare("UPDATE `user_profile` SET `user_id`=?,`profile_picture`=?,`nama`=?,`email`=?,`password`=?,`tipe_user`=? WHERE `id`=?;");
        $query->bind_param("sbssssi", $user_id, $profile_picture, $nama, $email, $password, $tipe_user, $id);
        $query->execute() or die(mysqli_error($conn));
    }
    close($conn);
}

function deleteProfile($id)
{
    $conn = connect();

    if ($conn != null) {
        $query = $conn->prepare("DELETE FROM `user_profile` WHERE `id`=?;");
        $query->bind_param("i", $id);
        $query->execute() or die(mysqli_error($conn));
    }
    close($conn);
}

function validateType($mime_type)
{
    $allowed_type = array("image");
    $allowed_ext = array("jpg", "jpeg", "png");

    if (in_array($mime_type[0], $allowed_type) && in_array($mime_type[1], $allowed_ext)) {
        return (in_array($mime_type[0], $allowed_type) && in_array($mime_type[1], $allowed_ext));
    }
}
