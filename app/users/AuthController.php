<?php 

include_once dirname(__DIR__) . '/config.php';

/*
DOCUMENTACION 

Funciones principales:

1. login($email, $password):
   - Realiza una solicitud a la API para autenticar al usuario con 
   el email y la contraseña proporcionados.
   - Si las credenciales son correctas, guarda los datos del usuario 
   en la sesión (`$_SESSION['user_data']`).
   - Retorna un mensaje de éxito o error según la autenticación.

2. logout():
   - Cierra la sesión del usuario actual eliminando 
   los datos de `$_SESSION`.
   - Devuelve un mensaje de confirmación de cierre de sesión.

3. showPerfil():
   - Retorna los datos del usuario autenticado actualmente, 
   usando la información guardada en la sesión (`$_SESSION['user_data']`).
   - Si no hay un usuario autenticado, devuelve un mensaje de error.

4. globalToken():
   - Genera y retorna un token de sesión único (`global_token`) 
   si no existe ya en la sesión.
   - Este token es utilizado para validar solicitudes de seguridad 
   en el formulario.

Uso:
- Este controlador se activa a través de un `switch` que maneja diferentes acciones 
(`login`, `logout`, `viewProfile`, `globalToken`), determinadas por el valor de `$_POST['action']`.
- Antes de ejecutar una acción, el código verifica si la sesión 
y el token de seguridad (`global_token`) son válidos para asegurar 
la autenticidad de la solicitud.
*/

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
                http_response_code(400);
                return ['success' => false, 'error' => 'Token de seguridad no coincide.'];
            }
            break;
        case 'logout':
            $authController->logout();
            break;
        case 'view_profile':
            $profileData = $authController->showPerfil();
            return $profileData;           
        case 'generate_token':
            $authController->globalToken();
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
             
            header("Location: " . BASE_PATH . "views/home.php");
        } else {
            http_response_code(401);
            return [
                'success' => false,
                'error' => 'Credenciales incorrectas. Inténtalo de nuevo.'
            ];
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header("Location: " . BASE_PATH . "index.php");
    }

    public function showPerfil() {
        if (isset($_SESSION['user_data'])) {
            return $_SESSION['user_data'];
        } else {
            return null;
        }
    }
      
    public function globalToken() {
        if (!isset($_SESSION['global_token'])) {
            $_SESSION['global_token'] = bin2hex(random_bytes(32));
        }
        return [
            'success' => true,
            'data' => $_SESSION['global_token']
        ];
    }
}
?>
