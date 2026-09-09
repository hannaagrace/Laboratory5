<?php


defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');


class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->call->library('session');

        if (!$this->session->has_userdata('logged_in')) {
            header('Location: /login');
            exit;
        }

        $this->call->model('ProductModel');
    }

    public function index()
    {
        $data['products'] = $this->ProductModel->all();

        $this->call->view('products/index', $data);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'product_name' => $_POST['product_name'],
                'description'  => $_POST['description'],
                'price'        => $_POST['price'],
                'quantity'     => $_POST['quantity']
            ];

            $this->ProductModel->insert($data);

            header('Location: /products');
            exit;
        }

        $this->call->view('products/create');
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'product_name' => $_POST['product_name'],
                'description'  => $_POST['description'],
                'price'        => $_POST['price'],
                'quantity'     => $_POST['quantity']
            ];

            $this->ProductModel->update($id, $data);

            header('Location: /products');
            exit;
        }

        $data['product'] = $this->ProductModel->find($id);

        $this->call->view('products/edit', $data);
    }

    public function delete($id)
    {
        $this->ProductModel->delete($id);

        header('Location: /products');
        exit;
    }
}