<?php
require_once '../include/function.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);

// $response["error"] = FALSE;
// $response["order"]["order_id"] = "no error";
// $response["order"]["lokasi_nama"] = "no error";
// $response["order"]["tiket_dewasa"] = "no error";
// $response["order"]["tiket_anak"] = "no error";
//             echo json_encode($response);
 
if (isset($_POST['order']) && isset($_POST['id_lokasi'])) {
 
    // receiving the post params
    $order = $_POST['order'];
    $lokasi = $_POST['id_lokasi'];
 
    // get the user by email and password
    $order = $db->getOrder($order, $lokasi);
 
    if ($order != false) {

        $response["error"] = FALSE;
        $response["order"]["order_id"] = $order["order_id"];
        $response["order"]["lokasi_nama"] = $order["lokasi_nama"];
        $response["order"]["tiket_dewasa"] = $order["tiket_dewasa"];
        $response["order"]["tiket_anak"] = $order["tiket_anak"];
        $response["order"]["status_payment"] = $order["status_payment"];
        $response["order"]["status_kunjungan"] = $order["status_kunjungan"];
        $response["order"]["tanggal_kunjungan"] = $order["tanggal_kunjungan"];

            echo json_encode($response);

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