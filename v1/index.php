<?php

require_once '../require/DbHandler.php';
require '.././libs/vendor/autoload.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();



/**
 * Verifying required params posted or not
 */
function verifyRequiredParams($required_fields) {
    $error = false;
    $error_fields = "";
    $request_params = array();
    $request_params = $_REQUEST;

    foreach ($required_fields as $field) {
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }

    if ($error) {
        // Required field(s) are missing or empty
        // echo error json and stop the app
        $response = array();
        $app = \Slim\Slim::getInstance();
        $response["error"] = true;
        $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
        echoRespnse(400, $response);
        $app->stop();
    }
}



/**
 * Echoing json response to client
 * @param $status_code Http response code
 * @param $response Json response
 */
function echoRespnse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);

    // setting response content type to json
    $app->contentType('application/json');

    echo json_encode($response);
}





/**
 * Calling handy_mama
 * url - /call_handy_mama
 * method - POST
 * params - insect_type, house_size, furniture_name, too_much_disturbance, can_we_move_furniture, cleaning_after_work, spray_chemical, day, month, year, hour, minute, am_pm
 */
$app->post('/call_handy_mama', function() use ($app) {


            // check for required params
          verifyRequiredParams(array('insect_type', 'house_size', 'furniture_name', 'too_much_disturbance', 'can_we_move_furniture', 'cleaning_after_work', 'spray_chemical', 'day', 'month', 'year', 'hour', 'minute', 'am_pm'));

            $response = array();

            // reading post params
            $insect_type = $app->request->post('insect_type');
            $house_size = $app->request->post('house_size');
            $furniture_name = $app->request->post('furniture_name');
            $too_much_disturbance = $app->request->post('too_much_disturbance');
            $can_we_move_furniture = $app->request->post('can_we_move_furniture');
            $cleaning_after_work = $app->request->post('cleaning_after_work');
            $spray_chemical = $app->request->post('spray_chemical');
            $day = $app->request->post('day');
            $month = $app->request->post('month');
            $year = $app->request->post('year');
            $hour = $app->request->post('hour');
            $minute = $app->request->post('minute');
            $am_pm = $app->request->post('am_pm');



            $db = new DbHandler();
            $res = $db->store_caller_data($insect_type, $house_size, $furniture_name, $too_much_disturbance, $can_we_move_furniture, $cleaning_after_work, $spray_chemical, $day, $month, $year, $hour, $minute, $am_pm);

            if ($res == "ORDER_CREATED_SUCCESSFULLY") {
                $response["error"] = false;
                $response["message"] = "Your order successfully placed";
                echoRespnse(200, $response);
            } else if ($res == "ORDER_CREATE_FAILED") {
                $response["error"] = true;
                $response["message"] = "Oops! An error occurred";
                echoRespnse(400, $response);
            }
        });

$app->run();

 ?>
