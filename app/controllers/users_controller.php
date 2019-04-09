<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html','Form');
	var $components = array('Auth', 'Session','Email');
	      
	function beforeFilter() {
	  $this->Auth->authenticate = ClassRegistry::init('User');
	  //pr($this->Session->read());
	  $this->Auth->allow('register','login','forgot','home','admin_login');
	}

	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	/*
	Function Name: 
	Req arg : 
	Response : 
	*/	 

	 function login() {

		//print_r($this); exit;
		//$this->layout = 'inner';
		
		if (!empty($this->data) && $this->Auth->user()) {
			print_r($this->data); exit;
			$this->User->id = $this->Auth->user('id');
			$this->redirect($this->Auth->redirect());
		}
	 }
	function admin_login(){
	pr($this->data);
	if (!empty($this->data) && $this->Auth->user()){
		 if($this->data['User']['username']=='admin'){
			$this->User->set($this->data);	
			$result = $this->User->check_user_data($this->data);  
                 if( $result !== FALSE ) {  
                     $this->User->id= $this->Auth->user('id');
			$this->redirect($this->Auth->redirect());  		
			}else {  
                     $this->Session->setFlash('Either your Username of Password is incorrect');  
                 }  
		}
		}
	}
	/*function admin_login() {
	if(!empty($this->data)) { 
		pr($this->data);die;
			 if($this->data['User']['username']=='admin')
			   {
			
			//die("hii");
             	// set the form data to enable validation  
            	 $this->User->set( $this->data );  
             	// see if the data validates  
                 // check user is valid  
                 $result = $this->User->check_user_data($this->data);  
 		 // print_r($result); 
                 if( $result !== FALSE ) {  
					 //die("hii");
                     // update login time  
            
                     // save to session  
                     $this->Session->write('User',$result);  
                     $this->Session->setFlash('You have successfully logged in');  
                     $this->redirect(array('controller'=>'users','action'=>'index','user'=>true));  
                 } else {  
                     $this->Session->setFlash('Either your Username of Password is incorrect');  
                 }  
            // }  
        }
        else
        {
			echo "you are not admin";
		}   
	}
	}*/
 
	function logout() {
	  $this->redirect($this->Auth->logout());
	}
	function register() {
	 if (!empty($this->data)) {
		 //pr($this->data); die;
		 $userName = $this->data['User']['username'];
		 $status = $this->User->checkExistingUser($userName);
		 if(! $status){
			$this->Session->setFlash("User with the same username already exists! Please choose another username!!");
		 }
	 //pr($this->data);exit;
	      $this->User->create();
	      if($this->User->save($this->data))
	      {
		$this->Session->setFlash("Account created!");
		//$this->redirect('/');
	      }
	    }

	  }
	function forgot() {
	    if(!empty($this->data)) {
		    $result = $this->User->find('first', array('conditions' => array('User.username' => $this->data['User']['username'])));	
		    //pr($specificallyThisOne);exit;
		    if(!$result) $result=$this->data['User']['username'];
		    
		    pr($result);exit;
		   
		 }
	
	}
	function home(){
		$this->layout	='front';
	}
}
