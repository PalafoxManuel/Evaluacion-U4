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
    $tagsController = new TagsController();
    switch ($_POST['action']) {
        case 'create_tag':
            $name = $_POST['name'] ?? null;
            $description = $_POST['description'] ?? null;
            $slug = $_POST['slug'] ?? null;

            if ($name && $description && $slug) {
                $tagsController->create($name, $description, $slug);
            } else {
                http_response_code(400);
                exit(json_encode(['error' => 'Datos insuficientes para crear la etiqueta.']));
            }
            break;

        case 'update_tag':
            $id = $_POST['id'] ?? null;
            $name = $_POST['name'] ?? null;
            $description = $_POST['description'] ?? null;
            $slug = $_POST['slug'] ?? null;

            if ($id && $name && $description && $slug) {
                $tagsController->update($id, $name, $description, $slug);
            } else {
                http_response_code(400);
                exit(json_encode(['error' => 'Datos insuficientes para actualizar la etiqueta.']));
            }
            break;

        case 'delete_tag':
            $id = $_POST['id'] ?? null;

            if ($id) {
                $tagsController->delete($id);
            } else {
                http_response_code(400);
                exit(json_encode(['error' => 'ID no proporcionado para eliminar la etiqueta.']));
            }
            break;

        case 'get_tags':
            $tags = $tagsController->getTags();
            http_response_code(200);
            exit(json_encode(['success' => true, 'data' => $tags]));
            break;

        case 'get_tag_by_id':
            $id = $_POST['id'] ?? null;

            if ($id) {
                $tag = $tagsController->getTagById($id);
                if ($tag) {
                    http_response_code(200);
                    exit(json_encode(['success' => true, 'data' => $tag]));
                } else {
                    http_response_code(404);
                    exit(json_encode(['error' => 'Etiqueta no encontrada.']));
                }
            } else {
                http_response_code(400);
                exit(json_encode(['error' => 'ID no proporcionado para obtener la etiqueta.']));
            }
            break;

        default:
            http_response_code(400);
            exit(json_encode(['error' => 'Acción no válida.']));
    }
}

class TagsController {
    public function getTags() {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/tags',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $_SESSION['user_data']->token],
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
                'Authorization: Bearer ' . $_SESSION['user_data']->token,
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

    public function create($name, $description, $slug) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/tags';
        
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
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
            header("Location: " . BASE_PATH . "views/catalogs/tags/tags.php");
            exit();
        } else {
            http_response_code(400);
            exit(json_encode(['error' => 'Error desconocido al crear la etiqueta.']));
        }
    }

    public function update($id, $name, $description, $slug) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/tags';

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
            header("Location: " . BASE_PATH . "views/catalogs/tags/tags.php");
            exit();
        } else {
            http_response_code(400);
            exit(json_encode(['error' => 'Error desconocido al actualizar la etiqueta.']));
        }
    }

    public function delete($id) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/tags/' . $id;

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
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
            header("Location: " . BASE_PATH . "views/catalogs/tags/tags.php");
            exit();
        } else {
            http_response_code(400);
            exit(json_encode(['error' => 'Error desconocido al eliminar la etiqueta.']));
        }
    }
}
