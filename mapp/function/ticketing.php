<?php
require_once '../include/function.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
  
  $uid = md5(date("Y-m-d H:i:s"));
  $order_id = $_POST['order_id'];
  $id_lokasi = $_POST['lokasi_id'];
  $nama_lokasi = $_POST['nama'];

  $ticket_dewasa = $_POST['ticket_dewasa'];
  $total_retrib_dewasa = $_POST['total_retrib_dewasa'];
  $ticket_anak = $_POST['ticket_anak'];
  $total_retrib_anak= $_POST['total_retrib_anak'];
  $total_ticket = $_POST['total_ticket'];
  $total_retrib_pengunjung = $_POST['total_retrib_pengunjung'];

  $total_bus_besar = $_POST['total_bus_besar'];
  $total_retrib_bus_besar = $_POST['total_retrib_bus_besar'];
  $total_bus = $_POST['total_bus'];
  $total_retrib_bus= $_POST['total_retrib_bus'];
  $total_mobil = $_POST['total_mobil'];
  $total_retrib_mobil = $_POST['total_retrib_mobil'];
  $total_motor = $_POST['total_motor'];
  $total_retrib_motor = $_POST['total_retrib_motor'];
  $total_kendaraan= $_POST['total_kendaraan'];
  $total_retrib_kendaraan = $_POST['total_retrib_kendaraan'];

  $total_retrib= $_POST['total_retrib'];
  // $operator = $_POST['operator'];
  $status_ticketing = $_POST['statusTicket'];

// $response["error"] = FALSE;
// $response["order"]["order_id"] = "no error";
// $response["order"]["lokasi_nama"] = "no error";
// $response["order"]["tiket_dewasa"] = "no error";
// $response["order"]["tiket_anak"] = "no error";
//             echo json_encode($response);
                                        // $total_ticket,
                                        // $total_retrib_pengunjung,
 
if (isset($uid)) {

    $ticket = $db->savePenjualanTicket($uid,
                                        $order_id,
                                        $id_lokasi,
                                        $nama_lokasi,

                                        $ticket_dewasa,
                                        $total_retrib_dewasa,
                                        $ticket_anak,
                                        $total_retrib_anak,
                                        $total_ticket,
                                        $total_retrib_pengunjung,

                                        $total_bus_besar,
                                        $total_retrib_bus_besar,
                                        $total_bus,
                                        $total_retrib_bus,
                                        $total_mobil,
                                        $total_retrib_mobil,
                                        $total_motor,
                                        $total_retrib_motor,
                                        $total_kendaraan,
                                        $total_retrib_kendaraan,
                                        
                                        $total_retrib,

                                        $status_ticketing);
 
    if ($ticket != false) {

        $response["error"] = FALSE;

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