<?php
require_once _DIR_.'/../models/Property.php';
require_once _DIR_.'/../models/PropertyImage.php';

class PropertyController extends Controller {

    public function add() {
        session_start();
        if(!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
            header('Location: /login'); exit;
        }

        if($_SERVER['REQUEST_METHOD']==='POST') {
            $propertyModel = new Property();
            $propertyModel->create([
                'landlord_id'=>$_SESSION['user_id'],
                'title'=>$_POST['title'],
                'description'=>$_POST['description'],
                'city'=>$_POST['city'],
                'monthly_rent'=>$_POST['monthly_rent'],
                'full_address'=>$_POST['full_address'],
                'floor'=>$_POST['floor'],
                'bedrooms'=>$_POST['bedrooms'],
                'bathrooms'=>$_POST['bathrooms'],
                'area_sqft'=>$_POST['area_sqft'],
                'status'=>'pending'
            ]);

            $property_id = $propertyModel->db->conn->lastInsertId();
            if(isset($_FILES['images'])) {
                $images = $_FILES['images'];
                $propertyImageModel = new PropertyImage();
                for($i=0;$i<count($images['name']);$i++){
                    if($images['error'][$i]===0){
                        $filename = time().'_'.$images['name'][$i];
                        $destination = '../public/uploads/'.$filename;
                        move_uploaded_file($images['tmp_name'][$i], $destination);
                        $propertyImageModel->create($property_id, 'uploads/'.$filename);
                    }
                }
            }
            header('Location: /property/list');
        } else {
            $this->view('property/add');
        }
    }

    public function list() {
        session_start();
        if(!isset($_SESSION['user_id'])) { header('Location: /login'); exit; }
        $propertyModel = new Property();
        if($_SESSION['role_id']==1) {
            $properties = $propertyModel->getAvailableProperties();
        } else {
            $properties = $propertyModel->getPropertiesByLandlord($_SESSION['user_id']);
        }
        $this->view('property/list', ['properties'=>$properties]);
    }
}