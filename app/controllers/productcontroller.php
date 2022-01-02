<?php
require __DIR__ . '/../services/productservice.php';

class ProductController
{

    private $productService;

    function __construct()
    {
        $this->productService = new ProductService();
    }

    public function index()
    {
        $model = $this->productService->index();

        require __DIR__ . '/../views/products/index.php';
    }

    //API SECTION
    public function adminindex()
    {
        require __DIR__ . '/../views/admin/products/index.php';
    }

    public function create()
    {
        require __DIR__ . '/../views/admin/products/create.php';
    }

    public function edit()
    {
        require __DIR__ . '/../views/admin/products/edit.php';
    }

}
