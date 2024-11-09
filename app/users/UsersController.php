<?php 

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

    $UsersController = new UsersController();

    switch ($_POST['action']) {
        case 'create_user':
            $name = strip_tags($_POST['name']);
            $lastname = strip_tags($_POST['lastname']);
            $email = strip_tags($_POST['email']);
            $phone_number = strip_tags($_POST['phone_number']);
            $created_by = strip_tags($_POST['created_by']);
            $role = strip_tags($_POST['role']);
            $password = strip_tags($_POST['password']);
            $profile_photo_file = $_FILES['profile_photo_file'];
            $UsersController->create($name, $lastname, $email, $phone_number, $created_by, $role, $password, $profile_photo_file);
            break;

        case 'update_user':
            
            break;

        case 'delete_user':
            
            break;

        case 'detail_user':
            
            break;

        default:
            echo json_encode(['error' => 'Acción no válida.']);
            http_response_code(400);
            break;
    }
}

class UsersController{
    public function get() {
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['user_data']->token
            ),
        ));
    
        $response = curl_exec($curl);
        curl_close($curl);
    
        $response = json_decode($response);
    
        if (isset($response->data)) {
            echo json_encode(['success' => true, 'data' => $response->data]);
        } else {
            $errorMsg = $response->message ?? 'Error desconocido';
            echo json_encode(['error' => $errorMsg]);
            http_response_code(400);
        }
    }
    

    public function getUserById(){
        
    }

    public function create($name, $lastname, $email, $phone_number, $created_by, $role, $password, $profile_photo_file) {
        $curl = curl_init();

        $postData = [
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email,
            'phone_number' => $phone_number,
            'created_by' => $created_by,
            'role' => $role,
            'password' => $password,
            'profile_photo_file' => new CURLFile($profile_photo_file['tmp_name'], $profile_photo_file['type'], $profile_photo_file['name'])
        ];

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users',
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
        $response = json_decode($response);

        if (isset($response->code) && $response->code == 4) {
            echo json_encode(['success' => true, 'message' => 'Usuario creado exitosamente']);
        } else {
            $errorMsg = $response->message ?? 'Error desconocido';
            echo json_encode(['error' => $errorMsg]);
            http_response_code(400);
        }
    }

    public function update(){

    }

    public function remove(){

    }
}

?>