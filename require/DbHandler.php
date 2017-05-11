<?php

/**
 * Class to handle db operations
 */
class DbHandler {

    private $conn;

    function __construct() {
        require_once dirname(__FILE__) . './DbConnect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }



    /**
     * Store data to the db
     */
    public function store_caller_data($insect_type, $house_size, $furniture_name, $too_much_disturbance, $can_we_move_furniture, $cleaning_after_work, $spray_chemical, $day, $month, $year, $hour, $minute, $am_pm) {



            // insert query
            $stmt = $this->conn->prepare("INSERT INTO order_specification(insect_type, house_size, furniture_name, too_much_disturbance, can_we_move_furniture, cleaning_after_work, spray_chemical, day, month, year, hour, minute, am_pm) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssssssss", $insect_type, $house_size, $furniture_name, $too_much_disturbance, $can_we_move_furniture, $cleaning_after_work, $spray_chemical, $day, $month, $year, $hour, $minute, $am_pm);
            $result = $stmt->execute();

            $stmt->close();

            // Check for successful insertion
            if ($result) {
                // User successfully inserted
                return "ORDER_CREATED_SUCCESSFULLY";
            } else {

                // Failed to create user
                return "ORDER_CREATE_FAILED";
            }



    }

}

?>
