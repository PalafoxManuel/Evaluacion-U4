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
    $categoriesController = new CategoriesController();

    switch ($_POST['action']) {
        case 'create_category':
            $name = $_POST['name'] ?? null;
            $description = $_POST['description'] ?? null;
            $slug = $_POST['slug'] ?? null;
            $categoryId = $_POST['category_id'] ?? null;

            if ($name && $description && $slug && $categoryId) {
                $categoriesController->create($name, $description, $slug, $categoryId);
            } else {
                http_response_code(400);
                exit(json_encode(['error' => 'Datos insuficientes para crear la categoría.']));
            }
            break;

        case 'update_category':
            $id = $_POST['id'] ?? null;
            $name = $_POST['name'] ?? null;
            $description = $_POST['description'] ?? null;
            $slug = $_POST['slug'] ?? null;
            $categoryId = $_POST['category_id'] ?? null;

            if ($id && $name && $description && $slug && $categoryId) {
                $categoriesController->update($id, $name, $description, $slug, $categoryId);
            } else {
                http_response_code(400);
                exit(json_encode(['error' => 'Datos insuficientes para actualizar la categoría.']));
            }
            break;

        case 'delete_category':
            $id = $_POST['id'] ?? null;

            if ($id) {
                $categoriesController->delete($id);
            } else {
                http_response_code(400);
                exit(json_encode(['error' => 'ID no proporcionado para eliminar la categoría.']));
            }
            break;
        case 'get_categories':
            $categories = $categoriesController->getCategories();
            http_response_code(200);
            exit(json_encode(['success' => true, 'data' => $categories]));
            break;
    
        case 'get_category_by_id':
            $id = $_POST['id'] ?? null;
    
            if ($id) {
                $category = $categoriesController->getCategoriesById($id);
                if ($category) {
                    http_response_code(200);
                    exit(json_encode(['success' => true, 'data' => $category]));
                } else {
                    http_response_code(404);
                    exit(json_encode(['error' => 'Categoría no encontrada.']));
                }
            } else {
                http_response_code(400);
                exit(json_encode(['error' => 'ID no proporcionado para buscar la categoría.']));
            }
            break;

        default:
            http_response_code(400);
            exit(json_encode(['error' => 'Acción no válida.']));
    }
}

class CategoriesController{
    public function getCategories() {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/categories';

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $_SESSION['user_data']->token],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response);
        return $data->data ?? [];
    }

    public function getCategoriesById($id) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/categories/';
    
        curl_setopt_array($curl, [
            CURLOPT_URL => $url . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);
    
        $response = curl_exec($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);

        if (isset($responseData['data'])) {
            return ['success' => true, 'data' => $responseData['data']];
        } else {
            return false;
        }
    }

    public function create($name, $description, $slug, $categoryId) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/categories';

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => [
                'name' => $name,
                'description' => $description,
                'slug' => $slug,
                'category_id' => $categoryId,
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);

        if (isset($responseData['data'])) {
            header("Location: " . BASE_PATH . "views/catalogs/categories/categories.php");
            exit();
        } else {
            http_response_code(400);
            exit(json_encode(['error' => 'Error al crear la categoría.']));
        }
    }

    public function update($id, $name, $description, $slug, $categoryId) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/categories';

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => http_build_query([
                'id' => $id,
                'name' => $name,
                'description' => $description,
                'slug' => $slug,
                'category_id' => $categoryId,
            ]),
            CURLOPT_HTTPHEADER => ['Content-Type: application/x-www-form-urlencoded'],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);

        if (isset($responseData['data'])) {
            header("Location: " . BASE_PATH . "views/catalogs/categories/categories.php");
            exit();
        } else {
            http_response_code(400);
            exit(json_encode(['error' => 'Error al actualizar la categoría.']));
        }
    }

    public function delete($id) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/categories/';

        curl_setopt_array($curl, [
            CURLOPT_URL => $url . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);

        if (isset($responseData['code']) && $responseData['code'] == 2) {
            header("Location: " . BASE_PATH . "views/catalogs/categories/categories.php");
            exit();
        } else {
            http_response_code(400);
            exit(json_encode(['error' => 'Error al eliminar la categoría.']));
        }
    }
}

?>