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

$tagsController = new TagsController();

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'create_tag':
            $name = $_POST['name'] ?? null;
            $description = $_POST['description'] ?? null;
            $slug = $_POST['slug'] ?? null;
            if ($name && $description && $slug) {
                $response = $tagsController->createTag($name, $description, $slug);
                echo json_encode($response);
            } else {
                echo json_encode(['error' => 'Datos insuficientes para crear la etiqueta.']);
                http_response_code(400);
            }
            break;

        case 'update_tag':
            $id = $_POST['id'] ?? null;
            $name = $_POST['name'] ?? null;
            $description = $_POST['description'] ?? null;
            $slug = $_POST['slug'] ?? null;
            if ($id && $name && $description && $slug) {
                $response = $tagsController->updateTag($id, $name, $description, $slug);
                echo json_encode($response);
            } else {
                echo json_encode(['error' => 'Datos insuficientes para actualizar la etiqueta.']);
                http_response_code(400);
            }
            break;

        case 'delete_tag':
            $id = $_POST['id'] ?? null;
            if ($id) {
                $response = $tagsController->deleteTag($id);
                echo json_encode($response);
            } else {
                echo json_encode(['error' => 'ID no proporcionado para eliminar la etiqueta.']);
                http_response_code(400);
            }
            break;

        case 'get_tags':
            $response = $tagsController->getTags();
            echo json_encode($response);
            break;

        case 'get_tag_by_id':
            $id = $_POST['id'] ?? null;
            if ($id) {
                $response = $tagsController->getTagById($id);
                echo json_encode($response);
            } else {
                echo json_encode(['error' => 'ID no proporcionado para obtener la etiqueta.']);
                http_response_code(400);
            }
            break;

        default:
            echo json_encode(['error' => 'Acción no válida.']);
            http_response_code(400);
            break;
    }
}

class TagsController{
    public function getTags() {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/tags',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $_SESSION['user_data']->token]
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response);
        return $data->data ?? [];
    }

    public function getTagById($tag_id) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/tags/';
        
        curl_setopt_array($curl, [
            CURLOPT_URL => $url . $tag_id,
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
            $errorMsg = $responseData['message'] ?? 'Error desconocido al obtener la etiqueta';
            http_response_code(400);
            return ['success' => false, 'error' => $errorMsg];
        }
    }

    public function createTag($name, $description, $slug) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/tags';
        
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'name' => $name,
                'description' => $description,
                'slug' => $slug
            ],
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
            $errorMsg = $responseData['message'] ?? 'Error desconocido al crear la etiqueta';
            http_response_code(400);
            return ['success' => false, 'error' => $errorMsg];
        }
    }

    public function updateTag($id, $name, $description, $slug) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/tags';

        $postData = http_build_query([
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'slug' => $slug
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
            return ['success' => true, 'data' => $responseData['data']];
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al actualizar la etiqueta';
            http_response_code(400);
            return ['success' => false, 'error' => $errorMsg];
        }
    }

    public function deleteTag($id) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/tags/' . $id;

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
            return ['success' => true, 'message' => $responseData['message']];
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al eliminar la etiqueta';
            http_response_code(400);
            return ['success' => false, 'error' => $errorMsg];
        }
    }
}

?>