<?php 
include_once 'config.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    echo json_encode(['error' => 'No hay una sesión activa. Por favor, inicie sesión.']);
    http_response_code(401);
    exit();
}

if (isset($_POST['action'])) {
    $productsController = new ProductsController();
    
    switch($_POST['action']){
        case 'create_product':
            $name = $_POST['name'];
            $slug = $_POST['slug'];
            $description = $_POST['description'];
            $features = $_POST['features'];
            $brand_id = $_POST['brand_id'];
            $category = $_POST['category'];
            $tags = isset($_POST['tags']) ? $_POST['tags'] : [];
            $price = $_POST['price'];
            $original_price = $_POST['original_price'];
            $stock = $_POST['stock'];
            $sku = $_POST['sku'];

            if (isset($_FILES['cover']) && $_FILES['cover']['error'] == 0) {
                $cover = $_FILES['cover'];
            } else {
                echo json_encode(['error' => 'El archivo de imagen no se subió correctamente.']);
                exit();
            }

            $productsController->create($name, $slug, $description, $features, $cover, $brand_id, [$category], $tags, $price, $original_price, $stock, $sku);
            break;

        case 'delete_product':
            $productId = $_POST['product_id'];
            $productsController->remove($productId);
            break;

        case 'update_product':
            $productId = $_POST['product_id'];
            $name = $_POST['name'];
            $slug = $_POST['slug'];
            $description = $_POST['description'];
            $features = $_POST['features'];
            $cover = isset($_FILES['cover']) && $_FILES['cover']['error'] === 0 ? $_FILES['cover'] : null;
                
            $productsController->update($productId, $name, $slug, $description, $features, $cover);
            break;

        default:
            echo json_encode(['error' => 'Acción no válida.']);
            http_response_code(400);
            break;
    }
}

class ProductsController {

    public function get() { 
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Authorization: Bearer ' . $_SESSION['user_data']->token),
        ));

        $response = curl_exec($curl); 
        curl_close($curl);
        $response = json_decode($response);

        return isset($response->data) ? $response->data : [];
    }

    public function create($name, $slug, $description, $features, $cover, $brand_id, $categories, $tags, $price, $original_price, $stock, $sku) {
        $curl = curl_init();
        $coverFile = new CURLFile($cover['tmp_name'], $cover['type'], $cover['name']);
    
        $postData = [
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'features' => $features,
            'cover' => $coverFile,
            'brand_id' => $brand_id,
            'price' => $price,
            'original_price' => $original_price,
            'stock' => $stock,
            'sku' => $sku
        ];
    
        foreach ($categories as $index => $category) {
            $postData["categories[$index]"] = $category;
        }
    
        foreach ($tags as $index => $tag) {
            $postData["tags[$index]"] = $tag;
        }
    
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
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
            echo json_encode(['success' => true, 'message' => 'Producto creado exitosamente']);
        } else {
            echo json_encode(['error' => $response->message ?? 'Error desconocido']);
            http_response_code(400);
        }
    }      

    public function update($product_id, $name, $slug, $description, $features, $cover = null) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/products';

        if ($cover && is_uploaded_file($cover['tmp_name'])) {
            $postData = [
                'id' => $product_id,
                'name' => $name,
                'slug' => $slug,
                'description' => $description,
                'features' => $features,
                'cover' => new CURLFile($cover['tmp_name'], $cover['type'], $cover['name']),
            ];
            $headers = [
                'Authorization: Bearer ' . $_SESSION['user_data']->token,
                'Content-Type: multipart/form-data',
            ];
        } else {
            $postData = http_build_query([
                'id' => $product_id,
                'name' => $name,
                'slug' => $slug,
                'description' => $description,
                'features' => $features,
            ]);
            $headers = [
                'Authorization: Bearer ' . $_SESSION['user_data']->token,
                'Content-Type: application/x-www-form-urlencoded',
            ];
        }

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => $headers,
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);

        if (isset($responseData['code']) && $responseData['code'] == 4) {
            echo json_encode(['success' => true, 'message' => 'Producto actualizado exitosamente']);
        } else {
            echo json_encode(['error' => $responseData['message'] ?? 'Error desconocido']);
            http_response_code(400);
        }
    }

    public function remove($product_id) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/' . $product_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array('Authorization: Bearer ' . $_SESSION['user_data']->token),
        )); 

        $response = curl_exec($curl); 
        curl_close($curl);
        $response = json_decode($response);

        if (isset($response->code) && $response->code == 2) {
            echo json_encode(['success' => true, 'message' => 'Producto eliminado exitosamente']);
        } else {
            echo json_encode(['error' => $response->message ?? 'Error desconocido']);
            http_response_code(400);
        }
    }
}
?>
