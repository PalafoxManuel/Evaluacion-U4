<?php

include_once dirname(__DIR__) . '/config.php';
session_start();

if (session_status() !== PHP_SESSION_ACTIVE) {
    http_response_code(401);
    exit(json_encode(['error' => 'No hay una sesión activa. Por favor, inicie sesión.']));
}

if (isset($_POST['action'])) {
    if (!isset($_POST['global_token'], $_SESSION['global_token']) || $_POST['global_token'] !== $_SESSION['global_token']) {
        http_response_code(400);
        exit(json_encode(['error' => 'Token de seguridad no coincide.']));
    }
    $presentationsController = new PresentationsController();

    switch ($_POST['action']) {
        case 'create_presentation':
            $description = $_POST['description'] ?? null;
            $code = $_POST['code'] ?? null;
            $weightInGrams = $_POST['weight_in_grams'] ?? null;
            $status = $_POST['status'] ?? null;
            $cover = $_FILES['cover'] ?? null;
            $stock = $_POST['stock'] ?? null;
            $stockMin = $_POST['stock_min'] ?? null;
            $stockMax = $_POST['stock_max'] ?? null;
            $productId = $_POST['product_id'] ?? null;
            $price = $_POST['price'] ?? null;

            if ($description && $code && $weightInGrams && $status && $cover && $stock && $stockMin && $stockMax && $productId && $price) {
                $presentationsController->create($description, $code, $weightInGrams, $status, $cover, $stock, $stockMin, $stockMax, $productId, $price);
            } else {
                http_response_code(400);
                exit(json_encode(['error' => 'Datos insuficientes para crear la presentación.']));
            }
            break;

        case 'update_presentation':
            $id = $_POST['id'] ?? null;
            $description = $_POST['description'] ?? null;
            $code = $_POST['code'] ?? null;
            $weightInGrams = $_POST['weight_in_grams'] ?? null;
            $status = $_POST['status'] ?? null;
            $stock = $_POST['stock'] ?? null;
            $stockMin = $_POST['stock_min'] ?? null;
            $stockMax = $_POST['stock_max'] ?? null;
            $productId = $_POST['product_id'] ?? null;
            $amount = $_POST['amount'] ?? null;

            if ($id && $description && $code && $weightInGrams && $status && $stock && $stockMin && $stockMax && $productId && $amount) {
                $presentationsController->update($id, $description, $code, $weightInGrams, $status, $stock, $stockMin, $stockMax, $productId, $amount);
            } else {
                http_response_code(400);
                exit(json_encode(['error' => 'Datos insuficientes para actualizar la presentación.']));
            }
            break;

        case 'update_price':
            $id = $_POST['id'] ?? null;
            $amount = $_POST['amount'] ?? null;

            if ($id && $amount) {
                $presentationsController->updatePrice($id, $amount);
            } else {
                http_response_code(400);
                exit(json_encode(['error' => 'Datos insuficientes para actualizar el precio.']));
            }
            break;

        case 'delete_presentation':
            $id = $_POST['id'] ?? null;

            if ($id) {
                $presentationsController->delete($id);
            } else {
                http_response_code(400);
                exit(json_encode(['error' => 'ID no proporcionado para eliminar la presentación.']));
            }
            break;

        case 'get_presentations_by_product':
            $productId = $_POST['product_id'] ?? null;

            if ($productId) {
                return $presentationsController->getPresentationsByProductId($productId);
            } else {
                http_response_code(400);
                exit(json_encode(['error' => 'ID de producto no proporcionado para obtener las presentaciones.']));
            }
            break;

        case 'get_presentation_by_id':
            $presentationId = $_POST['id'] ?? null;

            if ($presentationId) {
                return $presentationsController->getPresentationById($presentationId);
            } else {
                http_response_code(400);
                exit(json_encode(['error' => 'ID de presentación no proporcionado.']));
            }
            break;

        default:
            http_response_code(400);
            exit(json_encode(['error' => 'Acción no válida.']));
    }
}


class PresentationsController{
    public function getPresentationsByProductId($productId) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/presentations/product/';

        curl_setopt_array($curl, [
            CURLOPT_URL => $url . $productId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['user_data']->token
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        $responseData = json_decode($response, true);

        if (isset($responseData['code']) && $responseData['code'] === 4) {
            return ['success' => true, 'data' => $responseData['data']];
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al consultar las presentaciones';
            http_response_code(400);
            return ['success' => false, 'error' => $errorMsg];
        }
    }

    public function getPresentationById($presentationId) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/presentations/';

        curl_setopt_array($curl, [
            CURLOPT_URL => $url . $presentationId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['user_data']->token
            ],
        ]);
    
        $response = curl_exec($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);
    
        if (isset($responseData['code']) && $responseData['code'] === 4) {
            return ['success' => true, 'data' => $responseData['data']];
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al consultar la presentación';
            http_response_code(400);
            return ['success' => false, 'error' => $errorMsg];
        }
    }

    public function create($description, $code, $weightInGrams, $status, $cover, $stock, $stockMin, $stockMax, $productId, $price) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/presentations';
    
        $postData = [
            'description' => $description,
            'code' => $code,
            'weight_in_grams' => $weightInGrams,
            'status' => $status,
            'cover' => new CURLFile($cover['tmp_name'], $cover['type'], $cover['name']),
            'stock' => $stock,
            'stock_min' => $stockMin,
            'stock_max' => $stockMax,
            'product_id' => $productId,
            'amount' => $price
        ];
    
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['user_data']->token,
                'Content-Type: multipart/form-data'
            ],
        ]);
    
        $response = curl_exec($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);
    
        if (isset($responseData['code']) && $responseData['code'] === 4) {
            header("Location: " . BASE_PATH . "views/products/presentation.php");
            exit();
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al crear la presentación';
            http_response_code(400);
            return ['success' => false, 'error' => $errorMsg];
        }
    }
    

    public function update($id, $description, $code, $weightInGrams, $status, $stock, $stockMin, $stockMax, $productId, $amount) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/presentations';
    
        $postData = http_build_query([
            'id' => $id,
            'description' => $description,
            'code' => $code,
            'weight_in_grams' => $weightInGrams,
            'status' => $status,
            'stock' => $stock,
            'stock_min' => $stockMin,
            'stock_max' => $stockMax,
            'product_id' => $productId,
            'amount' => $amount
        ]);
    
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['user_data']->token,
                'Content-Type: application/x-www-form-urlencoded'
            ],
        ]);
    
        $response = curl_exec($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);
    
        if (isset($responseData['code']) && $responseData['code'] === 4) {
            header("Location: " . BASE_PATH . "views/products/presentation.php");
            exit();
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al actualizar la presentación';
            http_response_code(400);
            return ['success' => false, 'error' => $errorMsg];
        }
    }
    

    public function updatePrice($id, $amount) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/presentations/set_new_price';
    
        $postData = http_build_query([
            'id' => $id,
            'amount' => $amount
        ]);
    
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['user_data']->token,
                'Content-Type: application/x-www-form-urlencoded'
            ],
        ]);
    
        $response = curl_exec($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);
    
        if (isset($responseData['code']) && $responseData['code'] === 4) {
            header("Location: " . BASE_PATH . "views/products/presentation.php");
            exit();
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al actualizar el precio';
            http_response_code(400);
            return ['success' => false, 'error' => $errorMsg];
        }
    }

    public function delete($id) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/presentations/' . $id;
    
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['user_data']->token
            ],
        ]);
    
        $response = curl_exec($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);

        if (isset($responseData['code']) && $responseData['code'] === 2) {
            header("Location: " . BASE_PATH . "views/products/presentation.php");
            exit();
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al eliminar la presentación';
            http_response_code(400);
            return ['success' => false, 'error' => $errorMsg];
        }
    }
}

?>