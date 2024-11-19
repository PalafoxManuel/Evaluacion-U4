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
    $productsController = new ProductsController();

    switch ($_POST['action']) {
        case 'create_order':
            $folio = strip_tags($_POST['folio']);
            $total = strip_tags($_POST['total']);
            $is_paid = (int)$_POST['is_paid'];
            $client_id = strip_tags($_POST['client_id']);
            $address_id = strip_tags($_POST['address_id']);
            $order_status_id = strip_tags($_POST['order_status_id']);
            $payment_type_id = strip_tags($_POST['payment_type_id']);
            $coupon_id = strip_tags($_POST['coupon_id']);
            $presentations = $_POST['presentations'];
            $ordersController->create($folio, $total, $is_paid, $client_id, $address_id, $order_status_id, $payment_type_id, $coupon_id, $presentations);
            break;

        case 'update_order':
            $order_id = strip_tags($_POST['order_id']);
            $order_status_id = strip_tags($_POST['order_status_id']);
            $ordersController->update($order_id, $order_status_id);
            break;

        case 'delete_order':
            $order_id = strip_tags($_POST['order_id']);
            $ordersController->delete($order_id);
            break;

        case 'get_all_order':
            return $ordersController->get();
            break;

        case 'get_order_dates':
            $start_date = strip_tags($_POST['start_date']);
            $end_date = strip_tags($_POST['end_date']);
            return $ordersController->getOrderByDates($start_date, $end_date);
            break;

        case 'get_order_by_id':
            $order_id = strip_tags($_POST['order_id']);
            return $ordersController->getOrderById($order_id);
            break;

        default:
            http_response_code(400);
            exit(json_encode(['error' => 'Acción no válida.']));
    }
}

class OrdersController{
    public function get() {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/orders';
    
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
                'message' => 'Órdenes obtenidas correctamente.', 
                'data' => $responseData['data']
            ];
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al obtener las órdenes';
            http_response_code($httpCode);
            return ['error' => $errorMsg];
        }
    }

    public function getOrderByDates($start_date, $end_date) {
        $curl = curl_init();
        $url = "https://crud.jonathansoto.mx/api/orders/$start_date/$end_date";
    
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
                'message' => 'Órdenes obtenidas por rango de fechas correctamente.', 
                'data' => $responseData['data']
            ];
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al obtener las órdenes por fechas';
            http_response_code($httpCode);
            return ['error' => $errorMsg];
        }
    }

    public function getOrderById($order_id) {
        $curl = curl_init();
        $url = "https://crud.jonathansoto.mx/api/orders/details/" . $order_id;
    
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
                'message' => 'Detalles de la orden obtenidos correctamente.',
                'data' => $responseData['data']
            ];
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al obtener los detalles de la orden';
            http_response_code($httpCode);
            return ['error' => $errorMsg];
        }
    }

    public function create($folio, $total, $is_paid, $client_id, $address_id, $order_status_id, $payment_type_id, $coupon_id, $presentations) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/orders';

        $postData = [
            'folio' => $folio,
            'total' => $total,
            'is_paid' => $is_paid,
            'client_id' => $client_id,
            'address_id' => $address_id,
            'order_status_id' => $order_status_id,
            'payment_type_id' => $payment_type_id,
            'coupon_id' => $coupon_id,
        ];

        foreach ($presentations as $key => $presentation) {
            $postData["presentations[$key][id]"] = $presentation['id'];
            $postData["presentations[$key][quantity]"] = $presentation['quantity'];
        }

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
            header("Location: " . BASE_PATH . "views/orders/orders.php");
            exit();
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al crear la orden';
            http_response_code($httpCode);
            exit(json_encode(['error' => $errorMsg]));
        }
    }

    public function update($order_id, $order_status_id) {
        $curl = curl_init();
        $url = "https://crud.jonathansoto.mx/api/orders";

        $postData = [
            'id' => $order_id,
            'order_status_id' => $order_status_id
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

        if ($httpCode === 200 || $httpCode === 201 && isset($responseData['code']) && $responseData['code'] === 4) {
            header("Location: " . BASE_PATH . "views/orders/orders.php");
            exit();
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al actualizar el estado de la orden';
            http_response_code($httpCode);
            exit(json_encode(['error' => $errorMsg]));
        }
    }

    public function delete($order_id) {
        $curl = curl_init();
        $url = "https://crud.jonathansoto.mx/api/orders/$order_id";

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

        if ($httpCode === 200 || $httpCode === 204 && isset($responseData['code']) && $responseData['code'] === 2) {
            header("Location: " . BASE_PATH . "views/orders/orders.php");
            exit();
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al eliminar la orden';
            http_response_code($httpCode);
            exit(json_encode(['error' => $errorMsg]));
        }
    }
}

?>