<?php 

include_once "../config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['action'])) {
    $authController = new AuthController();
    
    switch ($_POST['action']) {
        case 'login':
            if (isset($_POST['global_token'], $_SESSION['global_token']) 
                && $_POST['global_token'] === $_SESSION['global_token']) {
                $email = strip_tags($_POST['email']);
                $password = strip_tags($_POST['password']);
                $authController->login($email, $password);
            } else {
                echo json_encode(['error' => 'Token de seguridad no coincide.']);
                http_response_code(400);
            }
            break;
        case 'logout':
            $authController->logout();
            break;
        default:
            echo json_encode(['error' => 'Acción no válida.']);
            http_response_code(400);
    }
}

class AuthController {
    public function login($email = null, $password = null) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'email' => $email,
                'password' => $password
            ),
            CURLOPT_HTTPHEADER => array(),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);

        if (isset($response->data->name)) {
            $_SESSION['user_data'] = $response->data;
            $_SESSION['user_id'] = $response->data->id;
            echo json_encode([
                'success' => true,
                'message' => 'Inicio de sesión exitoso',
                'user_data' => $response->data
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Credenciales incorrectas. Inténtalo de nuevo.'
            ]);
            http_response_code(401);
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        echo json_encode(['success' => true, 'message' => 'Sesión cerrada correctamente']);
    }

    public function globalToken() {
        if (!isset($_SESSION['global_token'])) {
            $_SESSION['global_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['global_token'];
    }
}
?>
