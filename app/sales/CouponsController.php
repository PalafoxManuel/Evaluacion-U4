<?php

include_once dirname(__DIR__) . '/config.php';
session_start();

if (session_status() !== PHP_SESSION_ACTIVE) {
    http_response_code(401);
    exit(json_encode(['error' => 'No hay una sesión activa. Por favor, inicie sesión.']));
}

if (!isset($_POST['global_token'], $_SESSION['global_token']) || $_POST['global_token'] !== $_SESSION['global_token']) {
    http_response_code(400);
    exit(json_encode(['error' => 'Token de seguridad no coincide.']));
}

if (isset($_POST['action'])) {
    $couponsController = new CouponsController();

    switch ($_POST['action']) {
        case 'create_coupon':
            $name = strip_tags($_POST['name']);
            $code = strip_tags($_POST['code']);
            $percentage_discount = strip_tags($_POST['percentage_discount']);
            $amount_discount = strip_tags($_POST['amount_discount']);
            $min_amount_required = strip_tags($_POST['min_amount_required']);
            $min_product_required = strip_tags($_POST['min_product_required']);
            $start_date = strip_tags($_POST['start_date']);
            $end_date = strip_tags($_POST['end_date']);
            $max_uses = strip_tags($_POST['max_uses']);
            $valid_only_first_purchase = (int)$_POST['valid_only_first_purchase'];
            $status = strip_tags($_POST['status']);
            $couponsController->create(
                $name,
                $code,
                $percentage_discount,
                $amount_discount,
                $min_amount_required,
                $min_product_required,
                $start_date,
                $end_date,
                $max_uses,
                $valid_only_first_purchase,
                $status
            );
            break;

        case 'update_coupon':
            $id = strip_tags($_POST['id']);
            $name = strip_tags($_POST['name']);
            $code = strip_tags($_POST['code']);
            $percentage_discount = strip_tags($_POST['percentage_discount']);
            $amount_discount = strip_tags($_POST['amount_discount']);
            $min_amount_required = strip_tags($_POST['min_amount_required']);
            $min_product_required = strip_tags($_POST['min_product_required']);
            $start_date = strip_tags($_POST['start_date']);
            $end_date = strip_tags($_POST['end_date']);
            $max_uses = strip_tags($_POST['max_uses']);
            $valid_only_first_purchase = (int)$_POST['valid_only_first_purchase'];
            $status = strip_tags($_POST['status']);
            $couponsController->update(
                $id,
                $name,
                $code,
                $percentage_discount,
                $amount_discount,
                $min_amount_required,
                $min_product_required,
                $start_date,
                $end_date,
                $max_uses,
                $valid_only_first_purchase,
                $status
            );
            break;

        case 'delete_coupon':
            $id = strip_tags($_POST['id']);
            $couponsController->delete($id);
            break;


        case 'get_all_coupon':
            return $couponsController->get();
            break;

        case 'get_coupon_by_id':
            $coupon_id = strip_tags($_POST['coupon_id']);
            return $couponsController->getCouponById($coupon_id);
            break;

        default:
            http_response_code(400);
            exit(json_encode(['error' => 'Acción no válida.']));
    }
}

class CouponsController{
    public function get() {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/coupons';
    
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['user_data']->token,
            ],
        ]);
    
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $responseData = json_decode($response, true);
    
        if ($httpCode === 200 && isset($responseData['code']) && $responseData['code'] === 4) {
            return [
                'success' => true, 
                'message' => 'Cupones obtenidos correctamente.', 
                'data' => $responseData['data']
            ];
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al obtener los cupones.';
            http_response_code($httpCode);
            return ['error' => $errorMsg];
        }
    }

    public function getCouponById($coupon_id) {
        $curl = curl_init();
        $url = "https://crud.jonathansoto.mx/api/coupons/" . $coupon_id;
    
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['user_data']->token,
            ],
        ]);
    
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $responseData = json_decode($response, true);
    
        if ($httpCode === 200 && isset($responseData['code']) && $responseData['code'] === 4) {
            return [
                'success' => true,
                'message' => 'Cupón obtenido correctamente.',
                'data' => $responseData['data']
            ];
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al obtener el cupón.';
            http_response_code($httpCode);
            return ['error' => $errorMsg];
        }
    }

    public function create($name, $code, $percentage_discount, $amount_discount, $min_amount_required, $min_product_required, $start_date, $end_date, $max_uses, $valid_only_first_purchase, $status) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/coupons';
    
        $postData = [
            'name' => $name,
            'code' => $code,
            'percentage_discount' => $percentage_discount,
            'amount_discount' => $amount_discount,
            'min_amount_required' => $min_amount_required,
            'min_product_required' => $min_product_required,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'max_uses' => $max_uses,
            'valid_only_first_purchase' => $valid_only_first_purchase,
            'status' => $status
        ];
    
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['user_data']->token,
                'Content-Type: multipart/form-data',
            ],
        ]);
    
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $responseData = json_decode($response, true);
    
        if ($httpCode === 201 && isset($responseData['code']) && $responseData['code'] === 4) {
            header("Location: " . BASE_PATH . "views/coupons/coupons.php");
            exit();
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al crear el cupón.';
            http_response_code($httpCode);
            exit(json_encode(['error' => $errorMsg]));
        }
    }

    public function update($id, $name, $code, $percentage_discount, $amount_discount, $min_amount_required, $min_product_required, $start_date, $end_date, $max_uses, $valid_only_first_purchase, $status) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/coupons';
    
        $postData = [
            'id' => $id,
            'name' => $name,
            'code' => $code,
            'percentage_discount' => $percentage_discount,
            'amount_discount' => $amount_discount,
            'min_amount_required' => $min_amount_required,
            'min_product_required' => $min_product_required,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'max_uses' => $max_uses,
            'valid_only_first_purchase' => $valid_only_first_purchase,
            'status' => $status
        ];
    
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => http_build_query($postData),
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['user_data']->token,
                'Content-Type: application/x-www-form-urlencoded',
            ],
        ]);
    
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $responseData = json_decode($response, true);
    
        if ($httpCode === 200 && isset($responseData['code']) && $responseData['code'] === 4) {
            header("Location: " . BASE_PATH . "views/coupons/coupons.php");
            exit();
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al actualizar el cupón.';
            http_response_code($httpCode);
            exit(json_encode(['error' => $errorMsg]));
        }
    }

    public function delete($id) {
        $curl = curl_init();
        $url = "https://crud.jonathansoto.mx/api/coupons/$id";
    
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['user_data']->token,
            ],
        ]);
    
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $responseData = json_decode($response, true);
    
        if ($httpCode === 200 && isset($responseData['code']) && $responseData['code'] === 2) {
            header("Location: " . BASE_PATH . "views/coupons/coupons.php");
            exit();
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al eliminar el cupón.';
            http_response_code($httpCode);
            exit(json_encode(['error' => $errorMsg]));
        }
    }
    
}

?>