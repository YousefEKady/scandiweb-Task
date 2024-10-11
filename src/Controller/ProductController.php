<?php
namespace Youssef\ScandiwebTask\Controller;
use Youssef\ScandiwebTask\Model\ProductMethods;
use Youssef\ScandiwebTask\Classes\Request;
use Youssef\ScandiwebTask\Classes\Validation\Validation;
use Youssef\ScandiwebTask\Classes\Session;
class ProductController
{
    public function index()
    {
        // Fetch all products from the database
        $productModel = new ProductMethods();
        $products = $productModel->fetchAll();
        // Path to the view
        $view = __DIR__ . '/../View/product-list.php';
        include(__DIR__ . '/../View/layout.php');
    }

    public function create()
    {
        // Render the add product form
        $view = __DIR__ . '/../View/add-product.php';
        include(__DIR__ . '/../View/layout.php');
    }

    public function store()
    {
        // Handle form submission
        $request = new Request();
        $validation = new Validation();
        $session = new Session();
        $productModel = new ProductMethods();

        // Check if the form was submitted
        $request->check($request->post("submit"));

        // Data
        $sku = $request->filter($request->post("sku"));
        $name = $request->filter($request->post("name"));
        $price = $request->filter($request->post("price"));
        $type = $request->filter($request->post("type"));
        $size = $request->filter($request->post("size"));
        $height = $request->filter($request->post("height"));
        $width = $request->filter($request->post("width"));
        $length = $request->filter($request->post("length"));
        $weight = $request->filter($request->post("weight"));

        // Validation
        $validation->endValidate("sku", $sku, ["Required"]);
        $validation->endValidate("name", $name, ["Required", "Str"]);
        $validation->endValidate("price", $price, ["Required"]);
        $validation->endValidate("type", $type, ["Required"]);

        if ($type === "DVD") {
            $validation->endValidate("size", $size, ["Required"]);
        } elseif ($type === "Furniture") {
            $validation->endValidate("height", $height, ["Required"]);
            $validation->endValidate("width", $width, ["Required"]);
            $validation->endValidate("length", $length, ["Required"]);
        } elseif ($type === "Book") {
            $validation->endValidate("weight", $weight, ["Required"]);
        }

        // Gather any validation errors
        $errors = $validation->getError();

        if (!$productModel->isSkuUnique($sku)) {
            $errors[] = "SKU '$sku' already exists. Please choose a different SKU.";
        }

        // If there are no errors, proceed to create the product
        if (empty($errors)) {
            // Create the product
            $productModel->createProduct($sku, $name, $price, $type, $size, $weight, $height, $width, $length);
            $request->headerLocation("/scandiwebTask/public/product/index");
            exit;
        } else {
            $session::set("errors", $errors);
            $request->headerLocation("/scandiwebTask/public/product/create");
            exit;
        }
    }

    public function delete()
    {
        $request = new Request();
        $session = new Session();
        $productModel = new ProductMethods();

        // Ensure that at least one checkbox was selected
        if ($request->post("sku")) {
            $skus = $request->post("sku");

            foreach ($skus as $sku) {
                $productModel->deleteProduct($sku);
            }
        }
        // Redirect to the product list page
        $request->headerLocation("/scandiwebTask/public/product/index");
    }
}