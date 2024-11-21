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
    $brandsController = new BrandsController();

    switch ($_POST['action']) {
        case 'create_brand':
            $name = $_POST['name'] ?? null;
            $description = $_POST['description'] ?? null;
            $slug = $_POST['slug'] ?? null;

            if ($name && $description && $slug) {
                $brandsController->create($name, $description, $slug);
            } else {
                http_response_code(400);
                exit(json_encode(['error' => 'Datos insuficientes para crear la marca.']));
            }
            break;

        case 'update_brand':
            $id = $_POST['id'] ?? null;
            $name = $_POST['name'] ?? null;
            $description = $_POST['description'] ?? null;
            $slug = $_POST['slug'] ?? null;

            if ($id && $name && $description && $slug) {
                $brandsController->update($id, $name, $description, $slug);
            } else {
                http_response_code(400);
                exit(json_encode(['error' => 'Datos insuficientes para actualizar la marca.']));
            }
            break;

        case 'delete_brand':
            $id = $_POST['id'] ?? null;

            if ($id) {
                $brandsController->deleteBrand($id);
            } else {
                http_response_code(400);
                exit(json_encode(['error' => 'ID no proporcionado para eliminar la marca.']));
            }
            break;

        case 'get_brands':
            $brands = $brandsController->getBrands();
            http_response_code(200);
            exit(json_encode(['success' => true, 'data' => $brands]));
            break;

        case 'get_brand_by_id':
            $id = $_POST['id'] ?? null;
    
            if ($id) {
                $brand = $brandsController->getBrandById($id);
                if ($brand) {
                    http_response_code(200);
                    exit(json_encode(['success' => true, 'data' => $brand]));
                } else {
                    http_response_code(404);
                    exit(json_encode(['error' => 'Marca no encontrada.']));
                }
            } else {
                http_response_code(400);
                exit(json_encode(['error' => 'ID no proporcionado para buscar la marca.']));
            }
            break;

        default:
            http_response_code(400);
            exit(json_encode(['error' => 'Acción no válida.']));
    }
}

class BrandsController {
    public function getBrands() {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/brands',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $_SESSION['user_data']->token],
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
                'Authorization: Bearer ' . $_SESSION['user_data']->token,
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
            header("Location: " . BASE_PATH . "views/catalogs/brands/brands.php");
            exit();
        } else {
            http_response_code(400);
            exit(json_encode(['error' => 'Error desconocido al crear la marca.']));
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
            header("Location: " . BASE_PATH . "views/catalogs/brands/brands.php");
            exit();
        } else {
            http_response_code(400);
            exit(json_encode(['error' => 'Error desconocido al actualizar la marca.']));
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
            header("Location: " . BASE_PATH . "views/catalogs/brands/brands.php");
            exit();
        } else {
            http_response_code(400);
            exit(json_encode(['error' => 'Error desconocido al eliminar la marca.']));
        }
    }
}
