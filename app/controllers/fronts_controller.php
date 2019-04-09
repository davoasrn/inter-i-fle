<?php
class FrontsController extends AppController{
	var $name = "Fronts";
	var $uses = array('User','Networkadmin','City','Province','Studio');  
	var $helpers = array('Html', 'Form', 'Javascript','Ajax','Cropimage');
	var $components = array('Email','RequestHandler', 'JqImgcrop'); 
//	var $paginate = array('order' => array ('User.	modified'=>'DESC'), 'limit'=>'10');
	var $paginate = array(
        'limit' => 10,
	 'order' => array('User.ID' => 'DESC')
    );
	function beforeFilter()
	{
		$this->__validateLoginStatus();                                       
	}

    function __validateLoginStatus()
    {
        if($this->action != 'login' && $this->action != 'logout' && $this->action != 'forgotPassword')
        {

	    if($this->Session->check('userid')){
		$userid = $this->Session->read('userid');
		$networkAdminDetail = $this->Networkadmin->find('first',array('conditions'=>array("Networkadmin.ID_USER"=> $userid)));
		//echo "das";
		//echo "<pre>";
		//print_r($networkAdminDetail);die;
		$this->Session->write('Networkadmin.NAME',$networkAdminDetail['Networkadmin']['NAME']);
		$this->Session->write('Networkadmin.SURNAME',$networkAdminDetail['Networkadmin']['SURNAME']);
		$this->Session->write('Networkadmin.INTERFILETEXT',$networkAdminDetail['Networkadmin']['INTERFILETEXT']);
	      }

            if($this->Session->check('Admin') == false && $this->Session->check('User') == false)
            {
		//$this->Session->setFlash('Il link che hai seguito è necessario aver effettuato il login.');
                //$this->redirect('login');                
            }
        }
    }
	
	function index(){
		$this->redirect('login');
	}
	/******************** Administrator Section Start *******************************/
	
	function admin_home(){
		$id = $_SESSION['userid'];
		if(!$id){
		      $this->redirect('login');
		}
		$this->layout = 'home';
		$detail = $this->paginate('Networkadmin');
		$this->set("detail",$detail);
	}
    	function __isLoggedIn(){
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
	}
	
	function editadmin($userid = Null){
		//echo $userid;
		$this->layout = 'home_popup';
		$this->set("id",$userid);
		$dataa = $this->Province->find("list", array('fields'=>array('Province.ID','Province.NAME')));
		$this->set("dataa",$dataa);
		if(!empty($this->data))
		{ 
				$this->User->id	=	$userid;
				//pr($this->data);die;
				/*if(trim($this->data['User']['PASSWORD']) == '')
				{
				    unset($this->data['User']['PASSWORD']);
				}
				if(ISSET($this->data['User']['PASSWORD']) && trim($this->data['User']['PASSWORD']) != '')
				{
				    $this->data['User']['PASSWORD'] = $this->data['User']['PASSWORD']; 
				}*/

				if($this->User->validates($this->data)){  

					if(trim($this->data['Networkadmin']['BIRTHDATE']) == 'DD-MM-YYYY' || trim($this->data['Networkadmin']['BIRTHDATE']) == ''){ echo 'unset';
							unset($this->data['Networkadmin']['BIRTHDATE']);
						  }else{
//echo 'here'; print_r($this->data);die;
						$date = strtotime($this->data['Networkadmin']['BIRTHDATE']);  
						$datee = date('Y-m-d',$date );
						$this->data['Networkadmin']['BIRTHDATE'] = $datee;
						}
 // print_r($this->data);die;


					if($this->User->save($this->data)){
						$this->Networkadmin->id	=	$this->data['Networkadmin']['ID'];
						if($this->Networkadmin->save($this->data['Networkadmin'])){
						    echo "<script type='text/javascript'>
						    parent.$.fancybox.close();  
						    window.parent.location.reload();
						    </script>";
						    //$this->Session->setFlash('Dati aggiornati con successo');
						}else{
						  //print_r($this->data);
						  $conditionForCity = array("City.ID_PROVINCE ={$this->data['Networkadmin']['ID_PROVINCE']}");
						  $data = $this->City->find("list", array('conditions'=>$conditionForCity,'fields'=>array('City.ID','City.NAME'),'order'=>'City.NAME ASC'));
						  $this->set("data",$data);

						  $this->render();
						}
						
					}
				}else{
					//$this->Session->setFlash("Errore durante l'aggiornamento!");
					$this->render();
				}
				//pr($this);
		}else{
			    //$this->data	= $this->Networkadmin->read();	
			    
			    $this->User->id	= $userid;
			    $this->data	= $this->User->read();
			   
	    }
 
	      $conditionForCity = array("City.ID_PROVINCE ={$this->data['Networkadmin']['ID_PROVINCE']}");
	      if($this->data['Networkadmin']['ID_PROVINCE'])
	      {
			      $PROVINCE =	$this->data['Networkadmin']['ID_PROVINCE'];
	      }
	      $conditionForCity = array("City.ID_PROVINCE = $PROVINCE");
	      $data = $this->City->find("list", array('conditions'=>$conditionForCity,'fields'=>array('City.ID','City.NAME'),'order'=>'City.NAME ASC'));
	      $this->set("data",$data);

	      //pr($this->data);
	      if($this->data['Networkadmin']['BIRTHDATE'] == '0000-00-00' || $this->data['Networkadmin']['BIRTHDATE'] == ''){ unset($this->data['Networkadmin']['BIRTHDATE']);}else{
		    
		  $date=strtotime($this->data['Networkadmin']['BIRTHDATE']); 
		  $this->data['Networkadmin']['BIRTHDATE']=date('d-m-Y',$date); 
	      }

//print_r($this->data);
	}
	
	function addadmin(){
		$this->Session->read('userid');
		$this->layout = 'home_popup';
		$dataa = $this->Province->find("list", array('fields'=>array('Province.ID','Province.NAME')));
		$this->set("dataa",$dataa);
		$PROVINCE=1;
		//pr($this->data);
		if($this->data['Networkadmin']['ID_PROVINCE'])
		{
				$PROVINCE =	$this->data['Networkadmin']['ID_PROVINCE'];
		}
		$conditionForCity = array("City.ID_PROVINCE = $PROVINCE");
		$data = $this->City->find("list", array('conditions'=>$conditionForCity,'fields'=>array('City.ID','City.NAME'),'order'=>'City.NAME ASC'));
		$this->set("data",$data);
		if($this->data){  
					//pr($this->data['USER']);
					
					if($this->User->validates($this->data)){
						if($this->data['Networkadmin']['BIRTHDATE'] != 'DD-MM-YYYY'){
						$date = strtotime($this->data['Networkadmin']['BIRTHDATE']);  
						$datee = date('Y-m-d',$date );
						$this->data['Networkadmin']['BIRTHDATE'] = $datee;
						}else{
							unset($this->data['Networkadmin']['BIRTHDATE']);
						  }

						if(trim($this->data['User']['PASSWORD'])!=''){
							$this->data['User']['PASSWORD']	= $this->data['User']['PASSWORD'];	
						}
						 // print_r($this->data);die;
						if($this->User->saveAll($this->data)){
							echo "<script type='text/javascript'>
							parent.$.fancybox.close();  
							window.parent.location.reload();
							</script>";
							//$this->Session->setFlash('I dati inseriti con successo ..!');
						}
					}
				unset($this->data['User']['PASSWORD']);
 
		}
	}
	function findCity($id=NULL)
	{	
		$this->layout = '';
		if(!empty($id))
		{
			$counrtyCode=$id;
		}
		//CADE FOR SUBCATEGORY DROPDOWN
		$conditionForCity = array("City.ID_PROVINCE =".$counrtyCode);
		$DropDownOption = '';
		$cityRecord=$this->City->find('list', array('conditions'=>$conditionForCity,'fields' => array('City.ID','City.NAME'),'order'=>'City.NAME ASC'));
		foreach($cityRecord as $ky=>$vl)
		{
			$DropDownOption .='<option  value="'.$ky.'">'.$vl.'</option>';
		}
		echo $DropDownOption;
		die();
	}
	
	function deleteadmin($id = Null){
		if(!empty($id)){
				$this->Networkadmin->delete($id);
				$this->redirect('admin_home');
		}
			
	}
	 /******************** Administrator Section End *******************************/
	 
	/*** Function for Admin Login ***/
	function login(){
		$this->layout = 'login';
		if($this->Session->check('Admin')){
			$this->redirect('admin_home');
		}
		$this->set('CodiceStudio', 'Codice Studio');
		$this->set('username', 'Username');
		$this->set('password','Password');

		if(!empty($this->data)){ 
			//pr($this->User);die;
			$data = $this->data;
			$sname = strtolower($data['User']['StudioName']);
			$username = $data['User']['username'];
			$password = $data['User']['password'];
			//echo $data['User']['password'];die;
			$this->set('CodiceStudio', $this->data['User']['StudioName']);	
			$this->set('username',$this->data['User']['username']);
			$this->set('password',$this->data['User']['password']);

			/* Studio condition*/
			if($sname!= 'interfile'){$this->Session->setFlash('Inserisci il nome diritto di Studio');}  
			/* Studio condition*/ 
			

			/* user name condition*/
			$userDetailUsername = $this->User->find('first',array('conditions'=>array("BINARY User.USERNAME ='$username'")));
			if(empty($userDetailUsername)){$this->Session->setFlash('Immettere il nome utente giusto');}  
			/* user name condition*/ 

			/* Password condition */
			//$userDetailPassword = $this->User->find('first',array('conditions'=>array("User.PASSWORD ='$password'")));
			if($data['User']['password'] == 'Password'){ $this->Session->setFlash('Si prega di inserire la password');}  
			/* Password condition*/ 


			if($sname== 'interfile')
			{
				$userDetail = $this->User->find('first',array('conditions'=>array("BINARY User.USERNAME ='$username'", "User.PASSWORD"=>$password)));

			}
			//pr($userDetail);die;
			if(empty($userDetail)){
					
					
					$this->Session->setFlash('Credenziali errate');
					
					//$this->redirect('/fronts/login');
				}
				else if(!empty($userDetail)){ //pr($userDetail);die('herer');
					if($userDetail['User']['PASSWORD'] == $password && $sname!='') { 
						// check for super admin
							$userid = $userDetail['User']['ID'];
							$networkAdminDetail = $this->Networkadmin->find('first',array('conditions'=>array("Networkadmin.ID_USER"=> $userid)));
							//echo "das";
							//echo "<pre>";
							//print_r($networkAdminDetail);die;
							$this->Session->write('Networkadmin.NAME',$networkAdminDetail['Networkadmin']['NAME']);
							$this->Session->write('Networkadmin.SURNAME',$networkAdminDetail['Networkadmin']['SURNAME']);
							$this->Session->read('Networkadmin.SURNAME');
							$this->Session->read('Networkadmin.SURNAME');
							$this->Session->write('Networkadmin.INTERFILETEXT',$networkAdminDetail['Networkadmin']['INTERFILETEXT']);
							
							$this->Session->write('Adminstatus', '1');
							$this->Session->write('Adminstatus', '1');
							$this->Session->write('Admin', $username);
							$this->Session->write('userid', $userid);
							$this->Session->write('ID_STUDIO', $userDetail['User']['ID_STUDIO']);
							//$this->Session->setFlash('È stato correttamente loggato');
							$this->redirect('/fronts/admin_home');
							exit;
					}
					else{ 
						//$this->Session->setFlash('Credenziali errate', 'default', array('class' => 'errMsgLogin'));
					}
				}
			} // data endif

		
	} // login endss
	

	/******************** Studi Section Start ******************************/
	
	function studi(){
			$this->layout = 'home';
			$detail = $this->Studio->find('all');
			$this->set("detail",$detail);
	
	}
	function addstudi(){
		$this->layout = 'home_popup';
		echo $this->Session->read('ID_STUDIO');
		$dataa = $this->City->find("list", array('fields'=>array('City.ID','City.NAME')));
		$this->set("dataa",$dataa);
		if($this->data){  //pr($this->data);die; 
					$this->data['Studio']['ID_USER'] = $this->Session->read('ID_STUDIO');
				if($this->Studio->save($this->data)){
						$this->Session->setFlash('I dati inseriti con successo ..!');
					$this->redirect('admin_home');
				}
		}
	}
	/********************* Studi Section End ******************************/
	function dashboard(){
		$this->layout = 'front';
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}		
	}
	
	function logout(){
		$this->Session->destroy();
		//$this->Session->setFlash('È stato effettuato il logout.');
		$this->redirect('/fronts/login');
	}//ends here
	
	/*function createRandomPassword() 
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
	}
	
	function forgotPassword(){
		if($this->Session->read('Admin')){
			$this->redirect('login');
		}
		$this->layout = 'login';
		if(!empty($this->data)){
			$data = $this->data;
			$email = $data['USER']['email'];
			//Checks for existing email
			$userDetail = $this->User->find('first',array('conditions'=>array("User.email"=> $email)));
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
	} // forgetPassword ends here*/
	
 /**** start 25-oct-2012 ****/
	
	
	function forgotPassword(){
		 $this->layout = 'login';
		/*if($this->Session->read('User')){
			$this->redirect('index');
		}*/
	
		if(!empty($this->data)){
			$data = $this->data;

			$email = $data['USER']['email'];
			//Checks for existing email
			  $userDetail = $this->Networkadmin->find('first',array('conditions'=>array("Networkadmin.EMAIL"=> $email)));
			// print_R($userDetail);die();
			if(trim($email)==""){
				 
				$this->Session->setFlash('Inserisci indirizzo E-mail.');
				 $this->redirect('/fronts/login');
				
			}
			else{ 
				
				$userID = $userDetail['Networkadmin']['ID_USER'];
             	//$data = $this->data;
				//$email_to = $data['Networkadmin']['EMAIL'];
				if($userDetail['Networkadmin']['EMAIL'] == ($email)){
				    
					//$password= $this->createRandomPassword();
					//$new_password=md5($password);
					$this->User->id = $userID;
					//$this->data['User']['auth_access'] = $password;
					//$this->data['User']['PASSWORD'] = trim($new_password);
					if($this->User->save($this->data)){
						//Default Mail component is called, to send mail. We are setting the variables for sending email
						$this->Email->to = $userDetail['Networkadmin']['EMAIL'];
						
						$this->Email->subject = 'INTERFILE: Invia username/password';
						$this->Email->replyTo = 'admin@admin.com';
						$this->Email->from = "Admin <demo@mail.com>";
						//Here, the element in /views/elements/email/html/ is called to create the HTML body
						$this->Email->template = 'forgot_password'; // note no '.ctp'
						//Send as 'html', 'text' or 'both' (default is 'text')
						$this->Email->sendAs = 'both'; // because we like to send pretty mail
						//Set view variables as normal
						$this->set('userDetail', $userDetail);
						//$this->set('password', $userDetail['Networkadmin']['PASSWORD']);
						//Do not pass any args to send()
						if($this->Email->send()){
							$this->Session->setFlash('Le credenziali sono state inviate all indirizzo e-mail.');
					        $this->redirect('/fronts/login');
							
						}
					}
				}
				else{ 
					$this->Session->setFlash('Nessun utente è stato trovato con l e-mail fornito.');
					 $this->redirect('/fronts/login');
				}
			}
		}

	}

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
	}

	
	
	
	
	/***** end 25-oct-2012 ****/
	
	
	
	
	/***** end 25-oct-2012 ****/

	/*
	 * Function to add users
	 * */
	function addUser(){
		$this->layout = 'front';
		$statusArray = array(1 => 'Activated', 0 => 'Deactivated');
		$this->set('statusArray', $statusArray);
		
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
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
	}//Ends here
	

	/*
		Edit Product
		*/	
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
		$this->layout = 'front';
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
			echo "<br/>id =".$ids;
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
				      $this->redirect(array('controller'=>'fronts','action'=>'manageBanner'));
			      }
	      return $result;
	      }
}
