<?php 

include_once "../config.php";

if (session_status() !== PHP_SESSION_ACTIVE) {
    echo json_encode(['error' => 'No hay una sesión activa. Por favor, inicie sesión.']);
    http_response_code(401);
    exit();
}

if (!isset($_POST['global_token'], $_SESSION['global_token']) || $_POST['global_token'] !== $_SESSION['global_token']) {
    echo json_encode(['error' => 'Token de seguridad no coincide.']);
    http_response_code(400);
    exit();
}

if (isset($_POST['action'])) {
    $brandsController = new BrandsController();

    switch ($_POST['action']) {
        case 'create_brand':
            $name = $_POST['name'] ?? null;
            $description = $_POST['description'] ?? null;
            $slug = $_POST['slug'] ?? null;
            if ($name && $description && $slug) {
                $response = $brandsController->create($name, $description, $slug);
                echo json_encode($response);
            } else {
                echo json_encode(['error' => 'Datos insuficientes para crear la marca.']);
                http_response_code(400);
            }
            break;

        case 'update_brand':
            $id = $_POST['id'] ?? null;
            $name = $_POST['name'] ?? null;
            $description = $_POST['description'] ?? null;
            $slug = $_POST['slug'] ?? null;
            if ($id && $name && $description && $slug) {
                $response = $brandsController->update($id, $name, $description, $slug);
                echo json_encode($response);
            } else {
                echo json_encode(['error' => 'Datos insuficientes para actualizar la marca.']);
                http_response_code(400);
            }
            break;

        case 'delete_brand':
            $id = $_POST['id'] ?? null;
            if ($id) {
                $response = $brandsController->deleteBrand($id);
                echo json_encode($response);
            } else {
                echo json_encode(['error' => 'ID no proporcionado para eliminar la marca.']);
                http_response_code(400);
            }
            break;

        default:
            echo json_encode(['error' => 'Acción no válida.']);
            http_response_code(400);
            break;
    }
}

class BrandsController{
    public function getBrands() {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/brands',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $_SESSION['user_data']->token]
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response);
        return $data->data ?? [];
    }

    public function getBrandById($brand_id) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/brands/';
    
        curl_setopt_array($curl, [
            CURLOPT_URL => $url . $brand_id,
            CURLOPT_RETURNTRANSFER => true,
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
            $errorMsg = $responseData['message'] ?? 'Error desconocido al obtener la marca';
            http_response_code(400);
            return ['success' => false, 'error' => $errorMsg];
        }
    }
    
    public function create($name, $description, $slug) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/brands';

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => [
                'name' => $name,
                'description' => $description,
                'slug' => $slug,
            ],
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['user_data']->token,
            ],
        ]);
    
        $response = curl_exec($curl);
        curl_close($curl);
    
        $responseData = json_decode($response, true);
    
        if (isset($responseData['code']) && $responseData['code'] === 4) {
            return ['success' => true, 'message' => $responseData['message'], 'data' => $responseData['data']];
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al crear la marca';
            http_response_code(400);
            return ['success' => false, 'error' => $errorMsg];
        }
    }

    public function update($id, $name, $description, $slug) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/brands';
    
        $postData = http_build_query([
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'slug' => $slug,
        ]);
    
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['user_data']->token,
                'Content-Type: application/x-www-form-urlencoded',
            ],
        ]);
    
        $response = curl_exec($curl);
        curl_close($curl);
    
        $responseData = json_decode($response, true);
    
        if (isset($responseData['code']) && $responseData['code'] === 4) {
            return ['success' => true, 'message' => $responseData['message'], 'data' => $responseData['data']];
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al actualizar la marca';
            http_response_code(400);
            return ['success' => false, 'error' => $errorMsg];
        }
    }

    public function deleteBrand($id) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/brands/';
    
        curl_setopt_array($curl, [
            CURLOPT_URL => $url . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['user_data']->token,
            ],
        ]);
    
        $response = curl_exec($curl);
        curl_close($curl);
    
        $responseData = json_decode($response, true);
    
        if (isset($responseData['code']) && $responseData['code'] === 2) {
            return ['success' => true, 'message' => $responseData['message']];
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al eliminar la marca';
            http_response_code(400);
            return ['success' => false, 'error' => $errorMsg];
        }
    }
}

?>