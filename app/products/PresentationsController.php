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

if (isset($_POST['action'])) {
    $productsController = new ProductsController();

    switch ($_POST['action']) {
        case 'create_product':
            break;

        case 'delete_product':
            break;

        case 'update_product':
            break;

        case 'get_all_products':
            return $productsController->get();
            break;

        case 'get_product_by_id':
            $productId = strip_tags($_POST['product_id']);
            return $productsController->getProductById($productId);
            break;

        case 'get_products_by_category':
            $categorySlug = strip_tags($_POST['category_slug']);
            return $productsController->getProductsByCategory($categorySlug);
            break;

        default:
            echo json_encode(['error' => 'Acción no válida.']);
            http_response_code(400);
            break;
    }
}


class PresentationsController{
    public function getOfProduct(){

    }

    public function getPresentationById(){

    }

    public function create(){

    }

    public function update(){

    }

    public function updatePrice(){

    }

    public function delete(){

    }
}

?>