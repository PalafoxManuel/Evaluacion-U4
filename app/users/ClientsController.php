<?php

include_once dirname(__DIR__) . '/config.php';
session_start();

if (session_status() !== PHP_SESSION_ACTIVE) {
    echo json_encode(['error' => 'No hay una sesión activa. Por favor, inicie sesión.']);
    http_response_code(401);
    exit();
}

if (isset($_POST['action'])) {
    if (!isset($_POST['global_token'], $_SESSION['global_token']) || $_POST['global_token'] !== $_SESSION['global_token']) {
        echo json_encode(['error' => 'Token de seguridad no coincide.']);
        http_response_code(400);
        exit();
    }
    $clientsController = new ClientsController();

    switch ($_POST['action']) {
        case 'create_client':
            $name = strip_tags($_POST['name']);
            $email = strip_tags($_POST['email']);
            $phone_number = strip_tags($_POST['phone_number']);
            $is_suscribed = isset($_POST['is_suscribed']) ? (int)$_POST['is_suscribed'] : 0;
            $level_id = strip_tags($_POST['level_id']);
            $clientController->create($name, $email, $phone_number, $is_suscribed, $level_id);
            break;

        case 'update_client':
            $id = strip_tags($_POST['id']);
            $name = strip_tags($_POST['name']);
            $email = strip_tags($_POST['email']);
            $phone_number = strip_tags($_POST['phone_number']);
            $is_suscribed = isset($_POST['is_suscribed']) ? (int)$_POST['is_suscribed'] : 0;
            $level_id = strip_tags($_POST['level_id']);
            $clientController->update($id, $name, $email, $phone_number, $is_suscribed, $level_id);
            break;

        case 'delete_client':
            $client_id = strip_tags($_POST['client_id']);
            $clientController->delete($client_id);
            break;

        case 'get_all_client':
            $clientController->get();
            break;

        case 'get_client_by_id':
            $client_id = strip_tags($_POST['client_id']);
            $clientController->getClientById($client_id);
            break;

        case 'get_client_widgets':
            $client_id = strip_tags($_POST['client_id']);
            return $clientsController->getClientWidgets($client_id);
            break;

        default:
            echo json_encode(['error' => 'Acción no válida.']);
            http_response_code(400);
            break;
    }
}

class ClientsController {
    public function get() {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/clients';

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
            return ['success' => true, 'message' => 'Clientes obtenidos correctamente.', 'data' => $responseData['data']];
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al obtener los clientes';
            http_response_code($httpCode);
            return ['error' => $errorMsg];
        }
    }

    public function getClientById($client_id) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/clients/';

        curl_setopt_array($curl, [
            CURLOPT_URL => $url . $client_id,
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
            return ['success' => true, 'message' => 'Cliente obtenido correctamente.', 'data' => $responseData['data']];
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al obtener el cliente';
            http_response_code($httpCode);
            return ['error' => $errorMsg];
        }
    }

    public function create($name, $email, $phone_number, $is_suscribed, $level_id) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/clients';

        $postData = [
            'name' => $name,
            'email' => $email,
            'phone_number' => $phone_number,
            'is_suscribed' => $is_suscribed,
            'level_id' => $level_id
        ];

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($postData),
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['user_data']->token,
                'Content-Type: application/x-www-form-urlencoded'
            ],
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $responseData = json_decode($response, true);

        if ($httpCode === 201 && isset($responseData['code']) && $responseData['code'] === 4) {
            header("Location: " . BASE_PATH . "views/customer/index.php");
            exit();
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al crear el cliente';
            http_response_code($httpCode);
            echo json_encode(['error' => $errorMsg]);
        }
    }

    public function update($id, $name, $email, $phone_number, $is_suscribed, $level_id) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/clients';

        $postData = [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'phone_number' => $phone_number,
            'is_suscribed' => $is_suscribed,
            'level_id' => $level_id
        ];

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => http_build_query($postData),
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['user_data']->token,
                'Content-Type: application/x-www-form-urlencoded'
            ],
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $responseData = json_decode($response, true);

        if ($httpCode === 200 && isset($responseData['code']) && $responseData['code'] === 4) {
            header("Location: " . BASE_PATH . "views/customer/index.php");
            exit();
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al actualizar el cliente';
            http_response_code($httpCode);
            echo json_encode(['error' => $errorMsg]);
        }
    }

    public function delete($client_id) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/clients/' . $client_id;

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
            header("Location: " . BASE_PATH . "views/customer/index.php");
            exit();
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al eliminar el cliente';
            http_response_code($httpCode);
            echo json_encode(['error' => $errorMsg]);
        }
    }

    public function getClientWidgets($client_id) {
        $clientDetails = $this->getClientById($client_id);

        if (isset($clientDetails['error'])) {
            return $clientDetails; // Devuelve el error si algo falló
        }

        $clientData = $clientDetails['data'];
        $orders = $clientData['orders']; // Lista de órdenes del cliente

        // Inicializa los totales por estado
        $statusTotals = [
            1 => ['status' => 'Pendiente de pago', 'total' => 0],
            2 => ['status' => 'Pagada', 'total' => 0],
            3 => ['status' => 'Enviada', 'total' => 0],
            4 => ['status' => 'Abandonada', 'total' => 0],
            5 => ['status' => 'Pendiente de enviar', 'total' => 0],
            6 => ['status' => 'Cancelada', 'total' => 0],
        ];

        // Paso 2: Recorre las órdenes y acumula los totales por estado
        foreach ($orders as $order) {
            $status_id = $order['order_status_id'];
            if (isset($statusTotals[$status_id])) {
                $statusTotals[$status_id]['total'] += $order['total'];
            }
        }

        // Paso 3: Devuelve los widgets con los totales por estado
        return [
            'success' => true,
            'message' => 'Widgets generados correctamente.',
            'data' => [
                'client_info' => $clientData,
                'widgets' => $statusTotals, // Widgets con los totales por estado
            ],
        ];
    }
}
