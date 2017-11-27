<?php
 
/**
 * @author Ravi Tamada
 * @link https://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */
 
class DB_Functions {
 
    private $conn;
 
    // constructor
    function __construct() {
        require_once 'connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }
 
    // destructor
    function __destruct() {
         
    }
 
    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($name, $email, $password) {
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"];
        $salt = $hash["salt"];
 
        $stmt = $this->conn->prepare("INSERT INTO user_ticketing(unique_id, name, email, password, salt, created_at) VALUES(?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssss", $uuid, $name, $email, $encrypted_password, $salt);
        $result = $stmt->execute();
        $stmt->close();
 
        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM user_ticketing WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return false;
        }
    }

    public function savePenjualanTicket($uid,
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

        $status_ticketing)
    {
      $stmt = $this->conn->prepare("INSERT INTO tickets 
        (ticketing_id , 
        order_id,
        id_lokasi,
        nama_lokasi,

        ticket_dewasa,
        total_retrib_dewasa,
        ticket_anak,
        total_retrib_anak,
        total_ticket,
        total_retrib_pengunjung,

        total_bus_besar,
        total_retrib_bus_besar,
        total_bus,
        total_retrib_bus,
        total_mobil,
        total_retrib_mobil,
        total_motor,
        total_retrib_motor,
        total_kendaraan,
        total_retrib_kendaraan,

        total_retrib,

        status_ticketing, 
        created_at) VALUES(?,?,?,?, ?,?,?,?,?,?, ?,?,?,?,?,?,?,?,?,?,?, ?, NOW())");

      $stmt->bind_param("ssssssssssssssssssssss", 
                        $uid,
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

      $this->orderUpdate($uid);
      $result = $stmt->execute();
      $stmt->close();

      // check for successful store
      if ($result) {
          $stmt = $this->conn->prepare("SELECT * FROM tickets WHERE ticketing_id = ?");
          $stmt->bind_param("s", $uid);
          $stmt->execute();
          $ticket = $stmt->get_result()->fetch_assoc();
          $stmt->close();

          return $ticket;
      } else {
          return false;
      }
    }

    public function orderUpdate($order_id)
    {
      $sql = "UPDATE ticket_detail_orders SET status_kunjungan='1', tanggal_kunjungan=NOW() WHERE order_id ='ORD4'";
      if ($this->conn->query($sql) === TRUE) {
        return true;
      }
    }
 
    /**
     * Get user by email and password
     */
    public function getUserByEmailAndPassword($email, $password) {
 
        $stmt = $this->conn->prepare("SELECT * FROM user_ticketing WHERE email = ?");
 
        $stmt->bind_param("s", $email);
 
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            // verifying user password
            $salt = $user['salt'];
            $encrypted_password = $user['password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                return $user;
            }
        } else {
            return NULL;
        }
    }

    public function cekHarga($idLokasi) {
 
        $stmt = $this->conn->prepare("SELECT * FROM ticketing_hargas WHERE lokasi_id = ?");
 
        $stmt->bind_param("s", $idLokasi);
 
        if ($stmt->execute()) {
            $harga = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            if ($harga) {
                return $harga;
            }
        } else {
            return NULL;
        }
    }

    public function getOrder($order, $lokasi) {
 
        $stmt = $this->conn->prepare("SELECT * FROM ticket_detail_orders WHERE lokasi_id = ? AND order_id = ?");
        $stmt->bind_param("ss", $lokasi, $order);
 
        if ($stmt->execute()) {
            $order = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            if ($order) {
                return $order;
            }
        } else {
            return NULL;
        }
    }
 
    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $stmt = $this->conn->prepare("SELECT email from user_ticketing WHERE email = ?");
 
        $stmt->bind_param("s", $email);
 
        $stmt->execute();
 
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }
 
    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {
 
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }
 
    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {
 
        $hash = base64_encode(sha1($password . $salt, true) . $salt);
 
        return $hash;
    }
 
}
 
?>