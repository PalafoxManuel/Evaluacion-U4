<?php 

include_once dirname(__DIR__) . '/config.php';
session_start();

if (session_status() !== PHP_SESSION_ACTIVE) {
    http_response_code(401);
    exit(json_encode(['error' => 'No hay una sesión activa. Por favor, inicie sesión.']));
}

if (!isset($_POST['global_token'], $_SESSION['global_token']) || $_POST['global_token'] !== $_SESSION['global_token']) {
    http_response_code(400);
    exit(json_encode(['error' => 'Token de seguridad no coincide.']));
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
                $productsController->create(
                    $name, $slug, $description, $features, $cover, $brand_id, 
                    [$category], $tags, $price, $original_price, $stock, $sku
                );
            } else {
                http_response_code(400);
                exit(json_encode(['error' => 'El archivo de imagen no se subió correctamente.']));
            }
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

        case 'delete_product':
            $productId = strip_tags($_POST['product_id']);
            $productsController->remove($productId);
            break;

        case 'get_all_products':
            $products = $productsController->get();
            http_response_code(200);
            exit(json_encode(['success' => true, 'data' => $products]));
            break;

        case 'get_product_by_id':
            $productId = strip_tags($_POST['product_id']);
            $product = $productsController->getProductById($productId);
            http_response_code(200);
            exit(json_encode(['success' => true, 'data' => $product]));
            break;

        case 'get_products_by_category':
            $categorySlug = strip_tags($_POST['category_slug']);
            $productsByCategory = $productsController->getProductsByCategory($categorySlug);
            http_response_code(200);
            exit(json_encode(['success' => true, 'data' => $productsByCategory]));
            break;

        default:
            http_response_code(400);
            exit(json_encode(['error' => 'Acción no válida.']));
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
            return $responseData['data'];
        } else {
            $errorMsg = $responseData['message'] ?? 'Error desconocido al obtener los productos';
            http_response_code(400);
            return ['error' => $errorMsg];
        }
    }    

    public function getProductById($product_id) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/products/';
        
        curl_setopt_array($curl, [
            CURLOPT_URL => $url . $product_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['user_data']->token
            ],
        ]);
    
        $response = curl_exec($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);
    
        if (isset($responseData['code']) && $responseData['code'] === 4) {
            return $responseData['data'];
        } else {
            http_response_code(400);
            return ['error' => 'Error desconocido al obtener el producto'];
        }
    }

    public function getProductsByCategory($categorySlug) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/products/categories/';
        
        curl_setopt_array($curl, [
            CURLOPT_URL => $url . $categorySlug,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $_SESSION['user_data']->token
            ],
        ]);
    
        $response = curl_exec($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);
    
        if (isset($responseData['code']) && $responseData['code'] === 4) {
            return $responseData['data'];
        } else {
            http_response_code(400);
            return ['error' => 'Error desconocido al obtener productos por categoría'];
        }
    }    

    public function create($name, $slug, $description, $features, $cover, $brand_id, $categories, $tags) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/products';
    
        $postData = [
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'features' => $features,
            'cover' => new CURLFile($cover['tmp_name'], $cover['type'], $cover['name']),
            'brand_id' => $brand_id
        ];
    
        foreach ($categories as $index => $category) {
            $postData["categories[$index]"] = $category;
        }
        foreach ($tags as $index => $tag) {
            $postData["tags[$index]"] = $tag;
        }
    
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
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
        $responseData = json_decode($response, true);
    
        if (isset($responseData['code']) && $responseData['code'] == 4) {
            header("Location: " . BASE_PATH . "views/products/index.php");
            exit();
        } else {
            http_response_code(400);
            exit(json_encode(['error' => 'Error desconocido al crear el producto']));
        }
    }

    public function update($product_id, $name, $slug, $description, $features, $brand_id, $categories = [], $tags = []) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/products';
    
        $postData = http_build_query([
            'id' => $product_id,
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'features' => $features,
            'brand_id' => $brand_id
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
            header("Location: " . BASE_PATH . "views/products/index.php");
            exit();
        } else {
            http_response_code(400);
            exit(json_encode(['error' => 'Error desconocido al actualizar el producto']));
        }
    }

    public function remove($product_id) {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/products/' . $product_id;
    
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
            header("Location: " . BASE_PATH . "views/products/index.php");
            exit();
        } else {
            http_response_code(400);
            exit(json_encode(['error' => 'Error desconocido al eliminar el producto']));
        }
    }
}
