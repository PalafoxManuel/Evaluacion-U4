<?php 

session_start();

if (session_status() !== PHP_SESSION_ACTIVE) {
    echo json_encode(['error' => 'No hay una sesión activa. Por favor, inicie sesión.']);
    http_response_code(401);
    exit();
}

if (isset($_POST['action'])) {
    if (!isset($_POST['global_token'], $_SESSION['global_token']) || $_POST['global_token'] !== $_SESSION['global_token']) {
        http_response_code(400);
        exit(json_encode(['error' => 'Token de seguridad no coincide.']));
    }
    $LevelsController = new LevelsController();

    switch ($_POST['action']) {
        case 'create_level':
            $name = strip_tags($_POST['name']);
            $percentage_discount = strip_tags($_POST['percentage_discount']);
            $levelsController->create($name, $percentage_discount);
            break;

        case 'update_level':
            $id = strip_tags($_POST['id']);
            $name = strip_tags($_POST['name']);
            $percentage_discount = strip_tags($_POST['percentage_discount']);
            $levelsController->update($id, $name, $percentage_discount);
            break;
 
        case 'delete_level':
            $id = strip_tags($_POST['id']);
            $levelsController->delete($id);
            break;
                
        case 'get_level':
            return $levelsController->get();
            break;
                    
        case 'get_level_by_id':
            $level_id = strip_tags($_POST['level_id']);
            return $levelsController->getLevelById($level_id);
            break;
        default:
            echo json_encode(['error' => 'Acción no válida.']);
            http_response_code(400);
            break;
    }
}

class LevelsController {
    public function get() {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/levels/';
        
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
                'message' => 'Niveles obtenidos correctamente.',
                'data' => $responseData['data'],
            ];
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al obtener los niveles.';
            http_response_code($httpCode);
            return ['error' => $errorMsg];
        }
    }

    public function getLevelById($level_id) {
        $curl = curl_init();
        $url = "https://crud.jonathansoto.mx/api/levels/" . $level_id;

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
                'message' => 'Nivel obtenido correctamente.',
                'data' => $responseData['data'],
            ];
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al obtener el nivel.';
            http_response_code($httpCode);
            return ['error' => $errorMsg];
        }
    }

    public function create($name, $percentage_discount) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/levels';

        $postData = [
            'name' => $name,
            'percentage_discount' => $percentage_discount,
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
            return [
                'success' => true,
                'message' => 'Nivel creado correctamente.',
                'data' => $responseData['data'],
            ];
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al crear el nivel.';
            http_response_code($httpCode);
            return ['error' => $errorMsg];
        }
    }

    public function update($id, $name, $percentage_discount) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/levels';

        $postData = [
            'id' => $id,
            'name' => $name,
            'percentage_discount' => $percentage_discount,
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
            return [
                'success' => true,
                'message' => 'Nivel actualizado correctamente.',
                'data' => $responseData['data'],
            ];
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al actualizar el nivel.';
            http_response_code($httpCode);
            return ['error' => $errorMsg];
        }
    }

    public function delete($id) {
        $curl = curl_init();
        $url = "https://crud.jonathansoto.mx/api/levels/$id";

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
            return [
                'success' => true,
                'message' => 'Nivel eliminado correctamente.',
            ];
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al eliminar el nivel.';
            http_response_code($httpCode);
            return ['error' => $errorMsg];
        }
    }
}

?>