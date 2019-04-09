<?php
class AdminsController extends AppController{
	var $name = "Admins";
	var $uses = array('Admin','User','Content','Category','Product','Banner');  
	var $helpers = array('Html', 'Form', 'Javascript','Ajax','Cropimage');
	var $components = array('Email','RequestHandler', 'JqImgcrop'); 
//	var $paginate = array('order' => array ('User.	modified'=>'DESC'), 'limit'=>'10');
	
	function beforeFilter()
	{
		$this->__validateLoginStatus();                                       
	}

    function __validateLoginStatus()
    {
        if($this->action != 'login' && $this->action != 'logout' && $this->action != 'forgotPassword')
        {
            if($this->Session->check('Admin') == false && $this->Session->check('User') == false)
            {
				$this->Session->setFlash('The URL you have followed requires you login.');
                $this->redirect('login');                
            }
        }
    }
	
	function index(){
		$this->redirect('login');
	}
	
    	function __isLoggedIn(){
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
	}
	 
	/*** Function for Admin Login ***/
	function login(){
		error_reporting(0);
		
		if($this->Session->check('Admin')){
			$this->redirect('manageUsers');
		}
		
		$this->layout = 'login';
		if(!empty($this->data)){
			$data = $this->data;
			$username = $data['Admin']['username'];
			$password = $data['Admin']['password']; 
			
			$userDetail = $this->Admin->find('first',array('conditions'=>array("Admin.username "=> $username, "Admin.password"=>md5($password))));
		if(empty($userDetail)){
					$this->Session->setFlash('Please enter valid Username/Password', 'default', array('class' => 'errMsgLogin'));
				}
				else{ 
					if($userDetail['Admin']['password'] == (md5($password))) { 
						// check for super admin
							$userid = $userDetail['Admin']['id'];
							$this->Session->write('Adminstatus', '1');
							$this->Session->write('Admin', $username);
							$this->Session->write('userid', $userid);
							$this->redirect('/admins/manageUsers');
							exit;
					}
					else{ 
						$this->Session->setFlash('Please enter valid Username/Password', 'default', array('class' => 'errMsgLogin'));
					}
				}
			} // data endif
	} // login endss
	
	function dashboard(){
		$this->layout = 'admin';
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}		
	}
	
	/**  The function to edit the details of a user logged in currently
	*/
	function myProfile(){
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
		$this->layout = 'admin';
		
		if($this->Session->read("Admin.id")){
		
			$id = $this->Session->read("userid");

			$details = $this->Admin->find("first", array("conditions" => array("Admin.id" => $id)));
			$this->set("details",$details);
		}else{
			
		}
		if($this->data){
			$data = $this->data;
		 $this->Admin->set($this->data);
		   if ($this->Admin->validates()) {
			if(!empty($data['Admin']['password']) && !empty($data['Admin']['repassword']) && $data['Admin']['repassword'] != $data['Admin']['password']){
				$this->Session->setFlash('Entered password not matched!', 'default', array('class' => 'errMsg'));
				$this->redirect('myProfile/'.$id);	
			}
			if(!empty($data['Admin']['password'])){
				$data['Admin']['password'] = md5($data['Admin']['password']);
			}else{
				$data['Admin']['password'] = $details['Admin']['password']; 
			}
			
			// die;
				$this->Admin->id = $id ;
				$this->Admin->save($data);
				$this->Session->setFlash('Account updated Successfully', 'default', array('class' => 'errMsgLogin'));
				$this->redirect('myProfile/'.$id);
			
						//$this->User->save($this->data);
					} else {
						
						// do nothing
					}
				}
				
			} 
	
	/*Function to activate/deactivate user*/
	function activateUser(){
		
		if(!empty($this->data['Admin']['id'])){
			$existingStatus = $this->User->find('first', array('conditions' => array('User.id' => $this->data['Admin']['id'])));
			$status = $existingStatus['User']['status'];
			if($status == 1){
				$finalStatus = 0;
			}else{
				$finalStatus = 1;
			}
			$this->User->id = $this->data['Admin']['id'];
			$data['User']['status'] = $finalStatus;
			if($this->User->save($data)){
				echo $data['User']['status']; 
				die;
			}
		}
	}//Ends here
	/*
	 * Function to edit user
	 * */
	function editUser($id = ''){
		$this->layout = 'admin';
		$statusArray = array(1 => 'Activated', 0 => 'Deactivated');
		$this->set('statusArray', $statusArray);
		$this->layout = 'admin';
		if(!empty($id)){
			$userDesc = $this->User->find('first', array('conditions' => array('User.id' => $id)));
			$this->set("info", $userDesc['User']);
		}
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
		$this->User->id = $id;
		//$this->data['User'] = $this->data['Admin'];
		//unset($this->data['Admin']);
		if($this->data){
			    $this->User->set($this->data);
				    if ($this->User->validates()) {
						
						if(isset($this->data['User']['image']['name']) && !empty($this->data['User']['image']['name'])){
							$uploaded = $this->JqImgcrop->uploadImage($this->data['User']['image'], PROFILE_UPLOAD_URL.'upload_userImages/', 'user_'.time().'_'); 
							$this->set('uploaded',$uploaded); 
							$this->data['User']['user_image'] = $uploaded['imageName'];
						}
						//echo "here    ".PROFILE_UPLOAD_URL.'upload_userImages/'.$userDesc['User']['user_image']; die;
						if(isset($userDesc['User']['user_image']) && !empty($userDesc['User']['user_image']))
							$imageToUnlik = PROFILE_UPLOAD_URL.'upload_userImages/'.$userDesc['User']['user_image'];
						if(isset($imageToUnlik) && !empty($this->data['User']['user_image'])){
							@unlink($imageToUnlik);
						}
						
						$userPassword = $this->data['User']['password'];
						$this->Email->to = $this->data['User']['email'];
						//$this->Email->bcc = array($adminEmail);
						$this->Email->subject = 'Account Details Changed';
						$this->Email->replyTo = 'admin@admin.com';
						$this->Email->from = "Admin <your email>";
						//Here, the element in /views/elements/email/html/ is called to create the HTML body
						$this->Email->template = 'user_edited_message'; // note no '.ctp'
						//Send as 'html', 'text' or 'both' (default is 'text')
						$this->Email->sendAs = 'both'; // because we like to send pretty mail
						//Set view variables as normal
						$this->set('userDetails', $this->data['User']);
						
						$this->set("password", $userPassword);
						$user = $this->User->checkExistingUser($this->data['User']['username']);
						//if(!$user){
						//Do not pass any args to send()
						if($this->Email->send()){
							$this->Session->setFlash('Password Sent Successfully!', 'default', array('class' => 'errMsgLogin'));
						}
						//pr($this->data); 
						//pr($this->User); die;
						//die;
						$this->User->save($this->data);
						$this->Session->setFlash('User updated Successfully!', 'default', array('class' => 'errMsgLogin'));
						$this->redirect('manageUsers');
						//$this->redirect('/admins/editUser/'.$id);
					//}//else{
						//$this->Session->setFlash('User already exists!', 'default', array('class' => 'errMsgLogin'));
						//$this->redirect('/admins/editUser/'.$id);
					//}
					} else {
						//die('not validated');
						// do nothing
					}
		}		
	}//Ends here
	/*
	 * Function to destroy user's session and redirect user to log in page
	 * */
	function logout(){
		$this->Session->destroy();
		$this->Session->setFlash('You have successfully logged out.', 'default', array('class' => 'errMsgLogin'));
		$this->redirect('/admins/login');
	}//ends here
	
	/*
	 * Deleting selected records
	 * */
	 function removeUser(){
		 if(isset($this->data['Admin']['idArr']) && !empty($this->data['Admin']['idArr'])){
			$idArr = explode(",", $this->data['Admin']['idArr']);
		}
		if(isset($idArr[1]) && !empty($idArr[1])){
			$message = 'Selected Users removed successfully';
		}else{
			$message = 'Selected User removed successfully';
		}
	
		foreach($idArr as $ids){ 
			$userDesc = $this->User->find('first', array('conditions' => array('User.id' => $ids)));
			$arr[] = $ids;
			if(isset($userDesc['User']['user_image']) && !empty($userDesc['User']['user_image'])){
				$imageToUnlik = PROFILE_UPLOAD_URL.'upload_userImages/'.$userDesc['User']['user_image'];
				unlink($imageToUnlik);
				
			}
		} 
		
		$this->User->recursive = 0;
		
		if($this->User->deleteAll(array('id'=>$arr))){	
			$this->Session->setFlash($message, 'default', array('class' => 'errMsgLogin'));
			$this->redirect('manageUsers');
		}else{
			die('not deleted');
		}
	 }
	 //Ends here
	/*
	* Forget Password. Creates random password and returns the created string
	*/

	function createRandomPassword() 
	{
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
		srand((double)microtime()*1000000);
		$i = 0;
		$pass = '' ;
		while ($i <= 7) 
		{

        $num = rand() % 33;

        $tmp = substr($chars, $num, 1);

        $pass = $pass . $tmp;

        $i++;
		}
  		return $pass;
	}//Ends here	
	/*
	 * Function to send the randomly created password, to user;s email address. Defauls Cake PHP mail component is used to send mail.
	 * */
	function forgotPassword(){
		if($this->Session->read('Admin')){
			$this->redirect('manageUsers');
		}
		$this->layout = 'login';
		if(!empty($this->data)){
			$data = $this->data;
			$email = $data['Admin']['email'];
			//Checks for existing email
			$userDetail = $this->Admin->find('first',array('conditions'=>array("Admin.email"=> $email)));
			if($email==null){
				echo $email;
				$this->Session->setFlash('Please enter email', 'default', array('class' => 'errMsgLogin'));
			}
			else{  
				$userID = $userDetail['Admin']['id'];
             	$data = $this->data;
				$email_to = $data['Admin']['email'];
				if($userDetail['Admin']['email'] == ($email)){
					$password= $this->createRandomPassword();
					$new_password=md5($password);
					$this->Admin->id = $userID;
					$this->data['Admin']['password'] = trim($new_password);
					if($this->Admin->save($this->data)){
						//Default Mail component is called, to send mail. We are setting the variables for sending email
						$this->Email->to = $email_to;
						//$this->Email->bcc = array($adminEmail);
						$this->Email->subject = 'Your password here';
						$this->Email->replyTo = 'admin@admin.com';
						$this->Email->from = "Admin <your email>";
						//Here, the element in /views/elements/email/html/ is called to create the HTML body
						$this->Email->template = 'simple_message'; // note no '.ctp'
						//Send as 'html', 'text' or 'both' (default is 'text')
						$this->Email->sendAs = 'both'; // because we like to send pretty mail
						//Set view variables as normal
						$this->set("userDetail", $userDetail);
						$this->set("password", $password);
						//Do not pass any args to send()
						if($this->Email->send()){
							$this->Session->setFlash('Password Sent Successfully!', 'default', array('class' => 'errMsgLogin'));
							$this->redirect('login');
						}
					}
				}
				else{ 
					$this->Session->setFlash('Please enter valid email', 'default', array('class' => 'errMsgLogin'));
				}
			}
		} // data endif
	} // forgetPassword ends here
	
	/*
	 * Function to add users
	 * */
	function addUser(){
		$this->layout = 'admin';
		$statusArray = array(1 => 'Activated', 0 => 'Deactivated');
		$this->set('statusArray', $statusArray);
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
		//http://bakery.cakephp.org/articles/klagoggle_myopenid_com/2010/08/25/jquery-image-upload-crop
		//unset(
		if($this->data){ 
			
			//pr(PROFILE_UPLOAD_URL); die;
				//$user = $this->checkExistingUser()
			    $this->User->set($this->data);
				    if ($this->User->validates()) {
						//pr($this->data); die;
						$user = $this->User->checkExistingUser($this->data['User']['username']);
						if(!$user){	$userPassword = $this->data['User']['password'];
							$this->data['User']['password'] = md5($this->data['User']['password']);
							$this->data['User']['repassword'] = md5($this->data['User']['repassword']);
							if(isset($this->data['User']['image']['name']) && !empty($this->data['User']['image']['name'])){
								$uploaded = $this->JqImgcrop->uploadImage($this->data['User']['image'], PROFILE_UPLOAD_URL.'upload_userImages/', 'user_'.time().'_'); 
								$this->set('uploaded',$uploaded); 
								$this->data['User']['user_image'] = $uploaded['imageName'];
							}else{
								$this->data['User']['user_image'] = '';
							}
							//pr($this->data['User']['email']); die;
							$this->Email->to = $this->data['User']['email'];
							//$this->Email->bcc = array($adminEmail);
							$this->Email->subject = 'User Created Successfully';
							$this->Email->replyTo = 'admin@admin.com';
							$this->Email->from = "Admin <your email>";
							//Here, the element in /views/elements/email/html/ is called to create the HTML body
							$this->Email->template = 'user_created_message'; // note no '.ctp'
							//Send as 'html', 'text' or 'both' (default is 'text')
							$this->Email->sendAs = 'both'; // because we like to send pretty mail
							//Set view variables as normal
							$this->set('userDetails', $this->data['User']);
							$this->set("password", $userPassword);
							//Do not pass any args to send()
							if($this->Email->send()){
								$this->Session->setFlash('Password Sent Successfully!', 'default', array('class' => 'errMsgLogin'));
							}
							if($this->User->save($this->data)){
							
								$this->Session->setFlash('User added successfully', 'default', array('class' => 'errMsgLogin'));
								$this->redirect('manageUsers');
							}
						}else{
							$this->Session->setFlash('User already exists!', 'default', array('class' => 'errMsgLogin'));
						} 
					
					}else {
						
						// do nothing
					}
		}		
	} //Ends here
	

		function editProduct($id = null){
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
		$this->set('id',$id);
		if(empty($this->data)){
			$this->layout = "home";
			$this->Product->id = $id;
			$this->data = $this->Product->read();
		}
		else{
			$data = $this->data;  
			$data['Product']['name'] = trim($data['Product']['name']);
		        $data['Product']['category_description'] = trim($data['Product']['category_description']);
		
			if(empty($data['Product']['name'])){
				$this->Session->setFlash('name cannot be empty', 'default', array('class' => 'errMsg'));
				$this->redirect('editProduct/'.$id);
			}
			elseif(!eregi("^[a-zA-z]+$",$data['Product']['name'])){
				$this->Session->setFlash('Invalid name', 'default', array('class' => 'errMsg'));
				$this->redirect('editProduct/'.$id);
			}
			if(empty($data['Product']['companyname'])){   
				$this->Session->setFlash('company name cannot be empty', 'default', array('class' => 'errMsg'));
				$this->redirect('editProduct/'.$id);
			}
			elseif(!eregi("^[a-zA-z]+$",$data['Product']['companyname'])){
				$this->Session->setFlash('Invalid company name', 'default', array('class' => 'errMsg'));
				$this->redirect('editProduct/'.$id);
			}
			if(empty($data['Product']['cid'])){   
				$this->Session->setFlash('category name cannot be empty', 'default', array('class' => 'errMsg'));
				$this->redirect('editProduct/'.$id);
			}
						$mainCat=$data['Product']['mainCat'];
			$comma_separated = implode(",",$mainCat);
			$data['Product']['cid']=$comma_separated;
			$this->Product->id = $id ;
			$this->Product->save($data);
			$this->Session->setFlash('Product updated Successfully', 'default', array('class' => 'errMsg'));
			$this->redirect('Manageproducts');
		}

	}



	/*
	 * Function to list users..
	 * */
	function manageUsers($id = null){
		if(!$this->Session->check('Admin') && !$this->Session->check('User')){
			$this->redirect('login');
		}else{
			
		}
		$this->layout = 'admin';
		$users = $this->paginate('User');
		$this->set('users',$users);
	}//Ends here
	/*
	 * Function to display user's details
	 * */
	 function viewUserDetails($id = ''){
		 $this->layout = 'user_details';
		if($id){
			
			$userDetails = $this->User->find('first', array('conditions' => array('User.id' => $id)));
			$this->set('info', $userDetails['User']);
		}
	 }
	 //Ends here
/** Function for Manage Content **/
	function manageContent(){
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
		$this->layout = "home";
		$contents = $this->paginate('Content');
		//pr($contents);die;
		$this->set('contents',$contents);
	}
	
	function Manageproducts(){
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
		$this->layout = "home";
		$products= $this->paginate('Product');
		$this->set('products',$products);
	}

	
	function removeContent($id = null){
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
		
		$data = array();
		$data = $_REQUEST;
		$idArr = explode(",",$data['data']['CheckAll']['idArr']);
		foreach($idArr as $ids){
			echo "<br />id =".$ids;
			$arr[] = $ids;	
		} 
		
		$this->Content->recursive = 0;
		$this->Content->deleteAll(array('id'=>$arr));
	
		$this->Session->setFlash('Article removed successfully', 'default', array('class' => 'errMsgLogin'));
		$this->redirect('ManageContent');
	}	

	function editContent($id = null){
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
		$this->set('id',$id);
		if(empty($this->data)){
			$this->layout = "home";
			$this->Content->id = $id;
			$this->data = $this->Content->read();
		}
		else{
			$data = $this->data;
			if(empty($data['Content']['name'])){
				$this->Session->setFlash('name cannot be empty', 'default', array('class' => 'errMsg'));
				$this->redirect('editContent/'.$id);
			}
			$this->Content->id = $id ;
			$this->Content->save($data);
			$this->Session->setFlash('Content updated Successfully', 'default', array('class' => 'errMsgLogin'));
			$this->redirect('ManageContent');
		}
	}

	

	function addContent(){
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
		$this->layout = "home";
		$data = $this->data;
		//pr($data);die;
		if(!empty($data)){
			if(empty($data['Content']['name'])){
				$this->Session->setFlash('Fields cannot be empty', 'default', array('class' => 'errMsg'));
			}
			elseif(!empty($data['Content']['name'])){
				$getName = $this->Content->findByname($data['Content']['name']);
				if(!empty($getName)){
					$this->Session->setFlash('Name Already Exits', 'default', array('class' => 'errMsg'));
				}			
				else{
						$this->Content->save($data);
						$this->Session->setFlash('Content Added Successfully', 'default', array('class' => 'errMsgLogin'));
						$this->redirect('manageContent');
					}
				}	
			}
		}
		
		
/** Author : Deepak Soni 
	Dated : 14/05/2012
	Description : the sections added for the phase2 emendments
*/
/** The order Method section
*/
	function orderMethods(){
		$this->layout = "home";
		$methods= $this->paginate('Ordermethod');
		$this->set('methods',$methods);
	}
	
	function editordermethod($id){
		$this->layout = "home";
		$ports = $this->Port->find("list");
		$this->set("ports",$ports);
		if($this->data){
			$this->data['Ordermethod']['id'] = $id;
			$this->__HABTMarrayCorrecttion(&$this->data,'Port','port_id');
			if($this->Ordermethod->saveAll($this->data)){
				$this->Session->setFlash('method information updated', 'default', array('class' => 'errMsg'));
				$this->redirect('orderMethods');
			}else{
			
			}	
		}
		$method = $this->Ordermethod->find("first", array("conditions" => array("Ordermethod.id" => $id)));
		$this->set("method", $method);
		$this->set("id", $id);
		$selectedPorts = array();
		foreach($method['Port'] as $meth){
			$selectedPorts[] = $meth['id'];
		}
		$this->set("selectedPorts", $selectedPorts);
	}
	
	function addordermethod(){
		$error ="";
		$this->layout = "home";
		$ports = $this->Port->find("list");
		$this->set("ports",$ports);
		if($this->data){
			$this->__HABTMarrayCorrecttion(&$this->data,'Port','port_id');
			if($this->Ordermethod->saveAll($this->data)){
				$this->Session->setFlash('One New Method Added', 'default', array('class' => 'errMsg'));
				$this->redirect('orderMethods');
			}else{
			
			}
		}
		$this->set("porterror",$error);		
	}
	function deleteordermethod(){
		if($this->data){
			pr($this->data);
		}
		$items = explode(",",$this->data['CheckAll']['idArr']);
		$totleItems = count($items);
		$this->Ordermethod->deleteAll(array('Ordermethod.id' =>$items));
		
		$this->Session->setFlash("$totleItems Method(s) deleted", 'default', array('class' => 'errMsg'));
		$this->redirect('orderMethods');
		die;
	}
	
	function activateMethod($id,$status){
		if($id){
			$this->Ordermethod->id = $id;
			if($this->Ordermethod->saveField('status', $status)){
				$this->redirect('orderMethods');
			}
		}
	}
/** The services provided section
*/	
	function services(){	
		$this->layout = "home";
		$services= $this->paginate('Service');
		$this->set('services',$services);
	}
	
	function editservices($id){
		$this->layout = "home";
		$ports = $this->Port->find("list");
		$this->set("ports",$ports);
		if($this->data){
			$this->data['Service']['id'] = $id;
			$this->__HABTMarrayCorrecttion(&$this->data,'Port','port_id');
			if($this->Service->saveAll($this->data)){
				$this->Session->setFlash('Service information updated', 'default', array('class' => 'errMsg'));
				$this->redirect('services');
			}else{
			
			}			
		}
		$service = $this->Service->find("first", array("conditions" => array("Service.id" => $id)));
		$this->set("service", $service);
		$selectedPorts = array();
		foreach($service['Port'] as $ser){
			$selectedPorts[] = $ser['id'];
		}
		$this->set("selectedPorts", $selectedPorts);
		$this->set("id", $id);
	}
	
	function __HABTMarrayCorrecttion($arr, $key, $keyNext){
		foreach($arr[$key][$keyNext] as $k=>$v){
			$tempArr[][$keyNext] = $v;
		}
		$arr[$key] = $tempArr;
		return $arr;
	}
	
	function addservices(){
		$this->layout = "home";
		$ports = $this->Port->find("list");
		$this->set("ports",$ports);
		if($this->data){
			$this->__HABTMarrayCorrecttion(&$this->data,'Port','port_id');
			if($this->Service->saveAll($this->data)){
				$this->Session->setFlash('One New Service Added', 'default', array('class' => 'errMsg'));
				$this->redirect('services');
			}else{
			
			}
		} 
	}
	
	function deleteservices(){
		if($this->data){
			pr($this->data);
		}
		$items = explode(",",$this->data['CheckAll']['idArr']);
		$totleItems = count($items);
		$this->Service->deleteAll(array('Service.id' =>$items));
		
		$this->Session->setFlash("$totleItems Service(s) deleted", 'default', array('class' => 'errMsg'));
		$this->redirect('services');
		die;
	}
	
	function activateService($id,$status){
	
		if($id){
			$this->Service->id = $id;
			if($this->Service->saveField('status', $status)){
				$this->redirect('services');
			}
		}
	}


/** The Port section
*/	
	function ports(){	
		$this->layout = "home";
		$ports= $this->paginate('Port');
		$this->set('ports',$ports);
	}
	
	function editports($id){
		$this->layout = "home";
		if($this->data){
			$this->data['Port']['id'] = $id;
			$this->Port->save($this->data);
			$this->Session->setFlash('Port information updated', 'default', array('class' => 'errMsg'));
			$this->redirect('ports');
		}
		$port = $this->Port->find("first", array("conditions" => array("Port.id" => $id)));
		$this->set("port", $port);
		$this->set("id", $id);
	}
	
	function addports(){
		$this->layout = "home";
		if($this->data){
			if($this->Port->save($this->data)){
				$this->Session->setFlash('One New Port Added', 'default', array('class' => 'errMsg'));
				$this->redirect('ports');
			}else{
			
			}			
		}		
	}
	function deleteports(){
		if($this->data){
			pr($this->data);
		}
			$items = explode(",",$this->data['CheckAll']['idArr']);
		$totleItems = count($items);
		$this->Port->deleteAll(array('Port.id' =>$items));
		
		$this->Session->setFlash("$totleItems Port(s) deleted", 'default', array('class' => 'errMsg'));
		$this->redirect('ports');
		die;
	}
	
	function activatePort($id,$status){
		if($id){
			$this->Port->id = $id;
			if($this->Port->saveField('status', $status)){
				$this->redirect('ports');
			}
		}
	}

/** The Anatomies section
*/	
	function anatomies(){	
		$this->layout = "home";
		$anatomies= $this->paginate('Anatomy');
		$this->set('anatomies',$anatomies);
	}
	
	function editanatomies($id){
		$this->layout = "home";
		$ports = $this->Port->find("list");
		$this->set("ports",$ports);
		if($this->data){
			$this->data['Anatomy']['id'] = $id;
			$this->__HABTMarrayCorrecttion(&$this->data,'Port','port_id');
			if($this->Anatomy->saveAll($this->data)){
				$this->Session->setFlash('Anatomy information updated', 'default', array('class' => 'errMsg'));
				$this->redirect('anatomies');
			}else{
			
			}			
		}
		$anatomy = $this->Anatomy->find("first", array("conditions" => array("Anatomy.id" => $id)));
		$this->set("anatomy", $anatomy);
		$selectedPorts = array();
		foreach($anatomy['Port'] as $ser){
			$selectedPorts[] = $ser['id'];
		}
		$this->set("selectedPorts", $selectedPorts);
		$this->set("id", $id);
	}
	
	function addanatomies(){
		$this->layout = "home";
		$ports = $this->Port->find("list");
		$this->set("ports",$ports);
		if($this->data){
			$this->__HABTMarrayCorrecttion(&$this->data,'Port','port_id');
			//pr($this->data);die;
			if($this->Anatomy->saveAll($this->data)){
				$this->Session->setFlash('One New Anatomy Added', 'default', array('class' => 'errMsg'));
				$this->redirect('anatomies');
			}else{
			
			}
		}		
	}
	function deleteanatomies(){
		if($this->data){
			pr($this->data);
		}
		$items = explode(",",$this->data['CheckAll']['idArr']);
		$totleItems = count($items);
		$this->Anatomy->deleteAll(array('Anatomy.id' =>$items));
		
		$this->Session->setFlash("$totleItems Anatomy(s) deleted", 'default', array('class' => 'errMsg'));
		$this->redirect('anatomies');
		die;
	}
	
	function activateAnatomy($id,$status){
		if($id){
			$this->Anatomy->id = $id;
			if($this->Anatomy->saveField('status', $status)){
				$this->redirect('anatomies');
			}
		}
	}

/** The Procedures section
*/	
	function procedures(){	
		$this->layout = "home";
		$procedures= $this->paginate('Procedure');
		$this->set('procedures',$procedures);
	}
	
	function editprocedures($id){
		$this->layout = "home";
		$ports = $this->Port->find("list");
		$this->set("ports",$ports);
		if($this->data){
			$this->data['Procedure']['id'] = $id;
			$this->__HABTMarrayCorrecttion(&$this->data,'Port','port_id');
			if($this->Procedure->saveAll($this->data)){
				$this->Session->setFlash('Procedure information updated', 'default', array('class' => 'errMsg'));
				$this->redirect('procedures');
			}else{
			
			}			
		}
		$procedure = $this->Procedure->find("first", array("conditions" => array("Procedure.id" => $id)));
		$this->set("procedure", $procedure);
		$selectedPorts = array();
		foreach($procedure['Port'] as $ser){
			$selectedPorts[] = $ser['id'];
		}
		$this->set("selectedPorts", $selectedPorts);
		$this->set("id", $id);
	}
	
	function addprocedures(){
		$this->layout = "home";
		$ports = $this->Port->find("list");
		$this->set("ports",$ports);
		if($this->data){
			$this->__HABTMarrayCorrecttion(&$this->data,'Port','port_id');
			//pr($this->data);die;
			if($this->Procedure->saveAll($this->data)){
				$this->Session->setFlash('One New Procedure Added', 'default', array('class' => 'errMsg'));
				$this->redirect('procedures');
			}else{
			
			}
		}		
	}
	function deleteprocedures(){
		if($this->data){
			pr($this->data);
		}
		$items = explode(",",$this->data['CheckAll']['idArr']);
		$totleItems = count($items);
		$this->Procedure->deleteAll(array('Procedure.id' =>$items));		
		$this->Session->setFlash("$totleItems Procedure(s) deleted", 'default', array('class' => 'errMsg'));
		$this->redirect('procedures');
		die;
	}
	
	function activateProcedure($id,$status){
		if($id){
			$this->Procedure->id = $id;
			if($this->Procedure->saveField('status', $status)){
				$this->redirect('procedures');
			}
		}
	}
	
	
/** The Categories section
*/	
	function manageBanner(){ 
		
		if(!$this->Session->check('Admin') && !$this->Session->check('User')){
			$this->redirect('login');
		}else{
			
		}
		$this->layout = 'admin';
		if(!empty($this->data)){
			$condition="Banner.banner_name LIKE '%".$this->data['Banner']['banName']."%'";
			$this->paginate=(array('conditions' => $condition,'order'=>array('Banner.banner_name'=>'ASC')));
			$Category = $this->paginate('Banner');
		}else{
			$this->paginate=(array('order'=>array('Banner.banner_name'=>'ASC')));
			$Category = $this->paginate('Banner');
		}
	
		$this->set('Banner',$Category);
		
	}
	
	function addBanner(){
		$this->layout = 'admin';
		$statusArray = array(1 => 'Activated', 0 => 'Deactivated');
		$this->set('statusArray', $statusArray);
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}

		if($this->data){//pr($this->data);die;		
			
			    $this->Banner->set($this->data);
				    if ($this->Banner->validates()) {
						if(isset($this->data['Banner']['image']['name']) && !empty($this->data['Banner']['image']['name'])){
								$uploaded = $this->__uploadFiles($this->data['Banner']['image'], PROFILE_UPLOAD_URL); 
								$this->set('uploaded',$uploaded); 
								$this->data['Banner']['banner_image'] = $uploaded['imageName'];
							}else{
								$this->data['Banner']['banner_image'] = '';
							}
							$this->set('bannerDetails', $this->data['Banner']);
							
							if($this->Banner->save($this->data)){
							
								$this->Session->setFlash('Banner added successfully', 'default', array('class' => 'errMsgLogin'));
								$this->redirect('manageBanner');
							}
						
						} 
					
					}else {
						
						// do nothing
					}
		}
	
	function __uploadFiles($formdata, $path, $itemId = null) {
		      // setup dir names absolute and relative
		      echo $rootPath =$path.'upload_userImages';
		      // list of permitted file types, this is only images but documents can be added
		      $permitted = array('image/gif','image/jpeg','image/pjpeg','image/png','text/csv');
		      $name=$formdata['name'];
		      $filename=$itemId.'_'.$formdata['name'];
		      $ext=explode('.',$formdata['name']);
		      // loop through and deal with the files
		            $typeOK = false;
			      // check filetype is ok
			    $typee = $formdata['type'];
			   foreach($permitted as $type) {
				      if($type == $typee) {
					      $typeOK = true;
					      break;
				      }
			      }
			      // if file type ok upload the file
			      if($typeOK) {
				      // switch based on error code
				      switch($formdata['error']) {
					      case 0: 
						      // check filename already exists
						      if(!file_exists($rootPath.$filename)) {
							      // create full filename
							      // upload the file
							      $success = move_uploaded_file($formdata['tmp_name'], $rootPath.$filename);
						      } else { 
							      // create unique filename and upload file
							      ini_set('date.timezone', 'Europe/London');
							      $now = date('Y-m-d-His');
							      $full_url = $rootPath;
							      $success = move_uploaded_file($formdata['tmp_name'], $rootPath.$filename);
						      }
						      // if upload was successful
						      if($success) {
							      // save the url of the file
							      $result['errors'][] = "Your Files uploaded Successfully";
						      } else {
							      $result['errors'][] = "Error uploaded $name. Please try again.";
						      }
						      break;
					      case 3:
						      // an error occured
						      $result['errors'][] = "Error uploading $name. Please try again.";
						      break;
					      default:
						      // an error occured
						      $result['errors'][] = "System error uploading $name. Contact webmaster.";
						      break;
				      }
			      } else { die('hre');
				      // unacceptable file type
				      $result['errors'][] = "$name cannot be uploaded. Acceptable file types: csv only";
				      $this->Session->setFlash($result['errors'][0]);
				      $this->redirect(array('controller'=>'admins','action'=>'manageBanner'));
			      }
	      return $result;
	      }
}
