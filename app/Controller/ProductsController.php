<?php

App::uses('AppController','Controller');

class ProductsController extends AppController{
    public $helpers = array('Html','Form');
    public $component = array('Session');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->deny();
    }

    public function index() {
        // Check if the user is logged in
        if (!$this->Auth->loggedIn()) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $this->set('products', $this->Product->find('all'));
    }

    public function view($id) {
        // Check if the user is logged in
        if (!$this->Auth->loggedIn()) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $product = $this->Product->findById($id);
        if (!$product) {
            throw new NotFoundException('Product not found');
        }
        $this->set('product', $product);
    }

    public function add() {
        // Check if the user is logged in
        if (!$this->Auth->loggedIn()) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        if ($this->request->is('post')) {
            $this->Product->create();
            if ($this->Product->save($this->request->data)) {
                $this->Session->setFlash('Product added successfully', 'default', array('class' => 'success-message'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Error adding product', 'default', array('class' => 'error-message'));
            }
        }
    }

    public function delete($id) {
        // Check if the user is logged in
        if (!$this->Auth->loggedIn()) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Product->delete($id)) {
            $this->Session->setFlash('Product deleted successfully', 'default', array('class' => 'success-message'));
            $this->redirect(array('action' => 'index'));
        }
    }

}