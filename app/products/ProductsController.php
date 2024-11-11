<?php 
include_once 'config.php';

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
    $productsController = new ProductsController();

    switch ($_POST['action']) {
        case 'create_product':
            $name = strip_tags($_POST['name']);
            $slug = strip_tags($_POST['slug']);
            $description = strip_tags($_POST['description']);
            $features = strip_tags($_POST['features']);
            $brand_id = strip_tags($_POST['brand_id']);
            $category = isset($_POST['category']) ? $_POST['category'] : [];
            $tags = isset($_POST['tags']) ? $_POST['tags'] : [];
            $price = strip_tags($_POST['price']);
            $original_price = strip_tags($_POST['original_price']);
            $stock = strip_tags($_POST['stock']);
            $sku = strip_tags($_POST['sku']);

            if (isset($_FILES['cover']) && $_FILES['cover']['error'] == 0) {
                $cover = $_FILES['cover'];
            } else {
                echo json_encode(['error' => 'El archivo de imagen no se subió correctamente.']);
                exit();
            }

            $productsController->create($name, $slug, $description, $features, $cover, $brand_id, [$category], $tags, $price, $original_price, $stock, $sku);
            break;

        case 'delete_product':
            $productId = strip_tags($_POST['product_id']);
            $productsController->remove($productId);
            break;

        case 'update_product':
            $productId = strip_tags($_POST['product_id']);
            $name = strip_tags($_POST['name']);
            $slug = strip_tags($_POST['slug']);
            $description = strip_tags($_POST['description']);
            $features = strip_tags($_POST['features']);
            $brand_id = strip_tags($_POST['brand_id']);
            $categories = isset($_POST['categories']) ? $_POST['categories'] : [];
            $tags = isset($_POST['tags']) ? $_POST['tags'] : [];

            $productsController->update($productId, $name, $slug, $description, $features, $brand_id, $categories, $tags);
            break;

        case 'get_all_products':
            $productsController->get();
            break;

        case 'get_product_by_id':
            $productId = strip_tags($_POST['product_id']);
            $productsController->getProductById($productId);
            break;

        case 'get_products_by_category':
            $categorySlug = strip_tags($_POST['category_slug']);
            $productsController->getProductsByCategory($categorySlug);
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
        $url = 'https://crud.jonathansoto.mx/api/products';
    
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['user_data']->token
            ],
        ]);
    
        $response = curl_exec($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);
    
        if (isset($responseData['code']) && $responseData['code'] === 4) {
            echo json_encode(['success' => true, 'data' => $responseData['data']]);
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al obtener los productos';
            echo json_encode(['success' => false, 'error' => $errorMsg]);
            http_response_code(400);
        }
    }

    public function getProductById($product_id) {
        $curl = curl_init();
    
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/' . $product_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['user_data']->token
            ],
        ]);
    
        $response = curl_exec($curl);
    
        if (curl_errno($curl)) {
            curl_close($curl);
            echo json_encode(['error' => 'Error de conexión: ' . curl_error($curl)]);
            http_response_code(500);
            return;
        }
    
        curl_close($curl);
        $responseData = json_decode($response, true);
    
        if (isset($responseData['code']) && $responseData['code'] === 4) {
            echo json_encode(['success' => true, 'data' => $responseData['data']]);
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al obtener el producto';
            echo json_encode(['success' => false, 'error' => $errorMsg]);
            http_response_code(400);
        }
    }    

    public function getProductsByCategory($categorySlug) {
        $curl = curl_init();
    
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/categories/' . $categorySlug,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['user_data']->token
            ],
        ]);
    
        $response = curl_exec($curl);
    
        if (curl_errno($curl)) {
            curl_close($curl);
            echo json_encode(['error' => 'Error de conexión: ' . curl_error($curl)]);
            http_response_code(500);
            return;
        }
    
        curl_close($curl);
        $responseData = json_decode($response, true);
    
        if (isset($responseData['code']) && $responseData['code'] === 4) {
            echo json_encode(['success' => true, 'data' => $responseData['data']]);
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al obtener productos por categoría';
            echo json_encode(['success' => false, 'error' => $errorMsg]);
            http_response_code(400);
        }
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

    public function update($product_id, $name, $slug, $description, $features, $brand_id, $categories = [], $tags = []) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/products';
    
        $postData = [
            'id' => $product_id,
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'features' => $features,
            'brand_id' => $brand_id
        ];
    
        foreach ($categories as $index => $category) {
            $postData["categories[$index]"] = $category;
        }
        foreach ($tags as $index => $tag) {
            $postData["tags[$index]"] = $tag;
        }
    
        $postData = http_build_query($postData);
        $headers = [
            'Authorization: Bearer ' . $_SESSION['user_data']->token,
            'Content-Type: application/x-www-form-urlencoded'
        ];
    
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
    
        if (isset($responseData['code']) && $responseData['code'] === 4) {
            echo json_encode(['success' => true, 'message' => 'Producto actualizado exitosamente', 'data' => $responseData['data']]);
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido';
            echo json_encode(['error' => $errorMsg]);
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
