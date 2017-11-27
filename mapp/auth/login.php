<?php
require_once '../include/function.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['email']) && isset($_POST['password'])) {
 
    // receiving the post params
    $email = $_POST['email'];
    $password = $_POST['password'];
 
    // get the user by email and password
    $user = $db->getUserByEmailAndPassword($email, $password);
 
    if ($user != false) {
        $idLokasi= $user["lokasi_id"];
        $harga = $db->cekHarga($idLokasi);
        if ($harga) {

            $response["error"] = FALSE;
            $response["uid"] = $user["unique_id"];
            $response["user"]["name"] = $user["name"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["created_at"] = $user["created_at"];
            $response["user"]["updated_at"] = $user["updated_at"];

            $response["harga"]["lokasi_id"] = $harga["lokasi_id"];
            $response["harga"]["nama_lokasi"] = $harga["nama_lokasi"];
            $response["harga"]["dewasa"] = $harga["harga_dewasa"];
            $response["harga"]["anak"] = $harga["harga_anak"];
            $response["harga"]["bus_besar"] = $harga["harga_bus_besar"];
            $response["harga"]["bus"] = $harga["harga_bus_kecil"];
            $response["harga"]["mobil"] = $harga["harga_mobil"];
            $response["harga"]["motor"] = $harga["harga_motor"];
            echo json_encode($response);

        }

        // use is found
        
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Login credentials are wrong. Please try again!";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters email or password is missing!";
    echo json_encode($response);
}
?>