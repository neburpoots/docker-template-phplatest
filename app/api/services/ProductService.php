<?php
require dirname(__DIR__) . "/autoload.php";

class ProductService {

    private $productRepository;

    function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function index() {
        return $this->productRepository->index();
    }

    public function detail(string $id) {
        return $this->productRepository->detail($id);
    }

    public function create(array $data) {
        return $this->productRepository->create($data);
    }

    public function update(string $id, array $data) {
        return $this->productRepository->update($id, $data);
    }

    public function delete(string $id) {
        return $this->productRepository->delete($id);
    }
}