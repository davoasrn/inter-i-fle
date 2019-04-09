<?php
class GalleriesController extends AppController{
	var $name = "Galleries";
	var $uses = array('Gallery','User');  
	var $helpers = array('Html', 'Form', 'Javascript','Ajax','Cropimage', 'Image');
	var $components = array('Email','RequestHandler', 'JqImgcrop'); 
	var $paginate = array('order' => array ('gallery.modified'=>'DESC'), 'limit'=>'10');
	function beforeFilter()
	{
		$this->__validateLoginStatus();                                       
	}
	function __validateLoginStatus()
    {
        if($this->action != 'login' && $this->action != 'logout' && $this->action != 'forgetPassword')
        {
            if($this->Session->check('Admin') == false && $this->Session->check('User') == false)
            {
				$this->Session->setFlash('The URL you have followed requires you login.');
                $this->redirect('login');                
            }
        }
    }
    
    /*
	 * Function to list images..
	 * */
	function manageGallery(){
		if(!$this->Session->check('Admin') && !$this->Session->check('User')){
			$this->redirect('login');
		}else{
		}
		$this->layout = 'admin';
		$this->paginate = array('conditions' => '', 'limit' => 10, 'page' => 1, 'order'=>'Gallery.modified DESC');
		$images = $this->paginate('Gallery');
		$this->set('images',$images);
	}//Ends here
    
    
    /*
	 * Function to add users
	 * */
	function addImage(){
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
			    $this->Gallery->set($this->data);
				    if ($this->Gallery->validates()) {
						if(isset($this->data['Gallery']['image']['name']) && !empty($this->data['Gallery']['image']['name'])){
								$uploaded = $this->JqImgcrop->uploadImage($this->data['Gallery']['image'], PROFILE_UPLOAD_URL.'image_gallery/', 'image_'.time().'_'); 
								$this->set('uploaded',$uploaded); 
								$this->data['Gallery']['image'] = $uploaded['imageName'];
							}else{
								$this->data['Gallery']['image'] = '';
							}
							
							if($this->Gallery->save($this->data)){
							
								$this->Session->setFlash('Image added successfully!', 'default', array('class' => 'errMsgLogin'));
								$this->redirect('manageGallery');
							}
						else{ 
						} 
					
					}else {
						
						// do nothing
					}
		}		
	}//Ends here
	
	/*
	 * Function to edit user
	 * */
	function editImage($id = ''){
		$this->layout = 'admin';
		$statusArray = array(1 => 'Activated', 0 => 'Deactivated');
		$this->set('statusArray', $statusArray);
		if(!empty($id)){
			$imageDesc = $this->Gallery->find('first', array('conditions' => array('Gallery.id' => $id)));
			$this->set("info", $imageDesc['Gallery']);
		}
		if(!$this->Session->check('Admin')){
			$this->redirect('login');
		}
		$this->Gallery->id = $id;
		//$this->data['User'] = $this->data['Admin'];
		//unset($this->data['Admin']);
		if($this->data){
			    $this->Gallery->set($this->data);
				    if ($this->Gallery->validates()) {
						if(isset($this->data['Gallery']['image']['name']) && !empty($this->data['Gallery']['image']['name'])){
							$uploaded = $this->JqImgcrop->uploadImage($this->data['Gallery']['image'], PROFILE_UPLOAD_URL.'image_gallery/', 'image_'.time().'_'); 
							$this->set('uploaded',$uploaded); 
							$this->data['Gallery']['image'] = $uploaded['imageName'];
						}
						
						if(isset($imageDesc['Gallery']['image']) && !empty($imageDesc['Gallery']['image']))
							$imageToUnlik = PROFILE_UPLOAD_URL.'image_gallery/'.$imageDesc['Gallery']['image'];
						if(isset($imageToUnlik) && !empty($this->data['Gallery']['image'])){
							@unlink($imageToUnlik);
						}
						
						$this->Gallery->save($this->data);
						$this->Session->setFlash('Image updated Successfully!', 'default', array('class' => 'errMsgLogin'));
						$this->redirect('manageGallery');
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
	 * Function to display all the uploaded images in a Nice JQuery Based Nivo Slider
	 * */
	
	function slider(){
		$this->layout = 'admin';
		$this->paginate = array('conditions' => '', 'limit' => 100, 'page' => 1, 'order'=>'Gallery.modified DESC');
		$images = $this->paginate('Gallery');
		$this->set('images', $images);
	}
	//Ends here
	
	/*Function to display the details of image in fancy box*/
	function viewImageDetails($id = ''){
		$this->layout = '';
		$imageDesc = $this->Gallery->find('first', array('conditions' => array('Gallery.id' => $id)));
		$image =  IMAGE_URL.'/image_gallery/'.$imageDesc['Gallery']['image'];
		$this->set('images', $image);
		$this->render('view_image_details'); 
		//echo "<img src='http://localhost/codelib/app/webroot/img/image_gallery/image_1341999306_up.jpg'>"; die;
		//echo "<img src='".$image."'>"; die;
	}
	//Ends here
	
	/*Function to bulk delete images
	 * */
	 function removeImages(){
	 if(isset($this->data['Gallery']['idArr']) && !empty($this->data['Gallery']['idArr'])){
			$idArr = explode(",", $this->data['Gallery']['idArr']);
		}
	if(isset($idArr[1]) && !empty($idArr[1])){
		$message = 'Selected images removed successfully';
	}else{
		$message = 'Selected image removed successfully';
	}
	
		foreach($idArr as $ids){
			$imageDesc = $this->Gallery->find('first', array('conditions' => array('Gallery.id' => $ids)));
			pr($imageDesc);
			$arr[] = $ids;
			if(isset($imageDesc['Gallery']['image']) && !empty($imageDesc['Gallery']['image'])){
				$imageToUnlik = PROFILE_UPLOAD_URL.'image_gallery/'.$imageDesc['Gallery']['image'];
				$thumbnaiImageToUnlik = PROFILE_UPLOAD_URL.'image_gallery/imagecache/'.$imageDesc['Gallery']['image'];
				unlink($thumbnaiImageToUnlik);
				unlink($imageToUnlik);
			}
			//
		} 
		
		$this->Gallery->recursive = 0;
		
		if($this->Gallery->deleteAll(array('id'=>$arr))){	
			$this->Session->setFlash($message, 'default', array('class' => 'errMsgLogin'));
			$this->redirect('manageGallery');
		}else{
			die('not deleted');
		}
	 }
	//Ends here
	
	/*Function to activate/deactivate user*/
	function activateImage(){
		
		if(!empty($this->data['Gallery']['id'])){
			$existingImage = $this->Gallery->find('first', array('conditions' => array('Gallery.id' => $this->data['Gallery']['id'])));
			$status = $existingImage['Gallery']['status'];
			if($status == 1){
				$finalStatus = 0;
			}else{
				$finalStatus = 1;
			}
			$this->Gallery->id = $this->data['Gallery']['id'];
			$data['Gallery']['status'] = $finalStatus;
			if($this->Gallery->save($data)){
				echo $data['Gallery']['status']; 
				die;
			}
		}
	}//Ends here
}
