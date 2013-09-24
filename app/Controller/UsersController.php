<?php
class UsersController extends AppController {

    public $name = 'Users';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
    }

    public function isAuthorized($user) {
        if(in_array($this->action, array('edit', 'delete', 'index'))) {
            if($user['role'] == 'admin') {
                return true;
            }
            if($user['id'] != $this->request->params['pass'][0]) {
                return false;
            }
        }
        return true;
    }

    public function changeRole($username, $role) {
            $user = $this->User->findByUsername($username);
            if($user['User']['role'] == 'regular') {
                $role = 'admin';
            } else {
                $role = 'regular';
            }
            $user['User']['role'] = $role;
            $this->User->save($user);
            $this->redirect(array('action' => 'index'));
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->User->find('all'));
    }

    public function login() {
        if($this->request->is('post')) {
            if($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash('Your username/password combination was incorrect.');
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function view($id = null) {
        $this->User->id = $id;

        if(!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }

        if(!$id) {
            $this->Session->setFlash('Invalid User');
            $this->redirect(array('action' => 'index'));
        }
        $this->set('user', $this->User->read());
    }

    public function add() {
        if($this->request->is('post')) {
            if($this->request->data['User']['password']) {
                $this->request->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
            }
            if($this->User->save($this->request->data)) {
                $this->Session->setFlash('The user has been saved');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The user could not be saved. Please try again.');
            }
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;

        if(!$this->User->exists()) {
            throw new NotFoundException('Invalid User');
        }

        if($this->request->is('post') || $this->request->is('put')) {
            if($this->User->save($this->request->data)) {
                $this->Session->setFlash('The user has been saved');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The user could not be saved. Please try again.');
            }
        } else {
            $this->request->data = $this->User->read();
        }
    }

    public function delete($id = null) {
        if($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if(!$id) {
            $this->Session->setFlash('Invalid id for user');
            $this->redirect(array('action' => 'index'));
        }

        if($this->User->delete($id)) {
            $this->Session->setFlash('User deleted');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('User was not deleted');
        $this->redirect(array('action' => 'index'));
    }
}