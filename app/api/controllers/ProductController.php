<?php

class ProductController
{
    private $productService;

    function __construct()
    {
        $this->productService = new ProductService();
    }


    public function processRequest(string $method, ?string $id) : void
    {
        if($id == null) {
            if($method == 'GET') {

               echo json_encode($this->productService->index());

            } else if($method == "POST") {
                
            $data = (array) json_decode(file_get_contents("php://input"), true);
            
            $errors = $this->getValidationErrors($data);

            if(! empty($errors)) {
                $this->respondUnprocessableEntity($errors);
                return;
            }
            
            $id = $this->productService->create($data);

            $this->respondCreated($id);

            } else {
                $this->respondMethodNotAllowed("GET, POST");
            }
        } else {
            $task = $this->productService->detail($id);

            if($task === false) {
                $this->respondNotFound($id);
                return;
            }

            switch($method) {
                case "GET":
                    echo json_encode($task);
                    break;

                case "PATCH":

                    $data = (array) json_decode(file_get_contents("php://input"), true);
            
                    $errors = $this->getValidationErrors($data, false);
        
                    if(! empty($errors)) {
                        $this->respondUnprocessableEntity($errors);
                        return;
                    }

                    $rows = $this->productService->update($id, $data);
                    echo json_encode(["message" => "Product updated", "rows" => $rows]);
                    break;

                case "DELETE":
                    $rows = $this->productService->delete($id);
                    echo json_encode(["message" => "Product deleted", "rows" => $rows]);
                    break;
                default: 
                    $this->respondMethodNotAllowed("GET, PATCH, DELETE");
            }
        }
    }

    private function respondUnprocessableEntity(array $errors): void {
        http_response_code(422);
        echo json_encode(["errors" => $errors]);
    }

    private function respondMethodNotAllowed(string $allowed_methods): void {
        http_response_code(405);
        header("Allow: $allowed_methods");
    }

    private function respondNotFound(string $id): void {
        http_response_code(404);
        echo json_encode(["message" => "Product with ID $id not found"]);
    }

    private function respondCreated(string $id): void {
        http_response_code(201);
        echo json_encode(["message" => "Product created", "id" => $id]);
    }

    private function getValidationErrors(array $data, bool $is_new = true): array {
        $errors = [];
        if($is_new && empty($data["name"])) {
            $errors[] = "name is required";
        }

        if($is_new && empty($data["price"])) {
            $errors[] = "price is required";
        }

        if($is_new && empty($data["stock"])) {
            $errors[] = "stock is required";
        }

        if($is_new && empty($data["img"])) {
            $errors[] = "image is required";
        }

        if($is_new && empty($data["description"])) {
            $errors[] = "description is required";
        }

        return $errors;
    }
}
