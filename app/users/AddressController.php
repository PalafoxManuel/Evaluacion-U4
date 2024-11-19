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
    $addressController = new AddressController();

    switch ($_POST['action']) {
        case 'create_address':
            $first_name = strip_tags($_POST['first_name']);
            $last_name = strip_tags($_POST['last_name']);
            $street_and_use_number = strip_tags($_POST['street_and_use_number']);
            $postal_code = strip_tags($_POST['postal_code']);
            $city = strip_tags($_POST['city']);
            $province = strip_tags($_POST['province']);
            $phone_number = strip_tags($_POST['phone_number']);
            $is_billing_address = (int)$_POST['is_billing_address'];
            $client_id = strip_tags($_POST['client_id']);
            $addressController->create($first_name, $last_name, $street_and_use_number, $postal_code, $city, $province, $phone_number, $is_billing_address, $client_id);
            break;

        case 'update_address':
            $id = strip_tags($_POST['id']);
            $first_name = strip_tags($_POST['first_name']);
            $last_name = strip_tags($_POST['last_name']);
            $street_and_use_number = strip_tags($_POST['street_and_use_number']);
            $postal_code = strip_tags($_POST['postal_code']);
            $city = strip_tags($_POST['city']);
            $province = strip_tags($_POST['province']);
            $phone_number = strip_tags($_POST['phone_number']);
            $is_billing_address = (int)$_POST['is_billing_address'];
            $client_id = strip_tags($_POST['client_id']);
            $addressController->update($id, $first_name, $last_name, $street_and_use_number, $postal_code, $city, $province, $phone_number, $is_billing_address, $client_id);
            break;

        case 'delete_address':
            $id = strip_tags($_POST['address_id']);
            $addressController->delete($id);
            break;

        case 'get_address_by_id':
            $address_id = strip_tags($_POST['address_id']);
            return $addressController->getAddressById($address_id);
            break;

        default:
            echo json_encode(['error' => 'Acción no válida.']);
            http_response_code(400);
            break;
    }
}

class AddressController{
    public function getAddressById($address_id) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/addresses/';

        curl_setopt_array($curl, [
            CURLOPT_URL => $url  . $address_id,
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
            return ['success' => true, 'message' => 'Dirección obtenida correctamente.', 'data' => $responseData['data']];
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al obtener la dirección';
            http_response_code($httpCode);
            return ['error' => $errorMsg];
        }
    }

    public function create($first_name, $last_name, $street_and_use_number, $postal_code, $city, $province, $phone_number, $is_billing_address, $client_id) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/addresses';

        $postData = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'street_and_use_number' => $street_and_use_number,
            'postal_code' => $postal_code,
            'city' => $city,
            'province' => $province,
            'phone_number' => $phone_number,
            'is_billing_address' => $is_billing_address,
            'client_id' => $client_id
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

        if ($httpCode === 200 && isset($responseData['code']) && $responseData['code'] === 4) {
            header("Location: " . BASE_PATH . "views/customer/index.php");
            exit();
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al crear la dirección';
            http_response_code($httpCode);
            echo json_encode(['error' => $errorMsg]);
        }
    }

    public function update($id, $first_name, $last_name, $street_and_use_number, $postal_code, $city, $province, $phone_number, $is_billing_address, $client_id) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/addresses';

        $postData = [
            'id' => $id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'street_and_use_number' => $street_and_use_number,
            'postal_code' => $postal_code,
            'city' => $city,
            'province' => $province,
            'phone_number' => $phone_number,
            'is_billing_address' => $is_billing_address,
            'client_id' => $client_id
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
            $errorMsg = $responseData['message'] ?? 'Error desconocido al actualizar la dirección';
            http_response_code($httpCode);
            echo json_encode(['error' => $errorMsg]);
        }
    }

    public function delete($id) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/addresses/' . $id;

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
            $errorMsg = $responseData['message'] ?? 'Error desconocido al eliminar la dirección';
            http_response_code($httpCode);
            echo json_encode(['error' => $errorMsg]);
        }
    }
}
?>