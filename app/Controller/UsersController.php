<?php

App::uses('AppController','Controller');
App::uses('AuthComponent','Controller/Component');
class UsersController extends AppController{
    public $components = array('Session' , 'Auth');
    public $uses = array('User');
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(['login','view']);
    }

    public function signup()
    {
        if($this->request->is('post'))
        {
            $this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
            $this->User->create();
            if($this->User->save($this->request->data))
            {
                $this->Session->setFlash('User registered successfully!','flash_success');
                return $this->redirect(array('controller' => 'users' , 'action' => 'login'));
            }
            else{
                $this->Session->setFlash('Error registering user!');
            }
        }
    }

    public function login()
    {
        if($this->request->is('post'))
        {
            $this->User->recursive = -1;
            $user = $this->User->findByUsername($this->request->data['User']['username']);
            if($user && AuthComponent::password($this->request->data['User']['password']) == $user['User']['password'])
            {
                unset($User['User']['password']);
                $this->Session->write('User',$this->Auth->user());
                $this->redirect($this->Auth->redirect(array('controller' => 'products' , 'action' , 'index')));
            }
            else{
                $this->Session->setFlash('Invalid username or password','flsah_error');
            }
        }
    }

    public function logout() {
        $this->Session->destroy();
        $this->redirect(array('controller' => 'user' , 'action' => 'login'));
    }
}