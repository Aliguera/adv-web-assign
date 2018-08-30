<?php
    class Organization extends Database {
        public $organizations = array();
        public $organization_profile = array();
        public $organization_details = array();
        public $errors = array();
        public function __construct(){
            parent::__construct();
        }
        
        public function create($email, $password, $name, $description, $abn, $address, $org_image, $phone){
            //create array to store errors
            $errors = array();
            //validate email
            if(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
                $errors['email'] = 'invalid email address';
            }
            //check password length
            if (strlen($password) < 6){
                $errors['password'] = 'minimum 6 characters';
            }
            
            if($org_image == "") {
                $org_image = "organzation_default.png";
            } else {
                $org_image = $org_image['name'];
            }
            
            //check if there are no errors
            if(count($errors) == 0){
                //proceed and create account
                $query = "INSERT INTO organizations
                    (email, password, name, description, profile_image, abn, address, phone, created_at)
                    VALUES
                    (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $statement = $this -> connection -> prepare($query);
                $statement -> bind_param('sssssiss', $email, $hash, $name, $description, $org_image, $abn, $address, $phone);
                $success = $statement -> execute() ? true : false;
                if ($success == false && $this -> connection -> errno == '1062') {
                    $errors['email'] = 'Email address already used';
                    $this -> errors = $errors;
                }
                return $success;
            } else {
                $this -> errors = $errors;
                return false;
            }
        }
        
        public function authenticate($email, $password) {
            $query = 'SELECT email, password, name, description, abn, address
                      FROM organizations 
                      WHERE email = ?';
                      $statement = $this -> connection -> prepare($query);
                      $statement -> bind_param('s', $email);
                      $statement -> execute();
                      $result = $statement -> get_result();
                      if( $result -> num_rows == 0) {
                          //account does not exist
                          return false;
                      } else {
                          $organization = $result -> fetch_assoc();
                          $email = $organization['email'];
                          $hash = $organization['password'];
                          $name = $organization['name'];
                          $description = $organization['description'];
                          $abn = $organization['abn'];
                          $address = $organization['address'];
                          $match = password_verify( $password, $hash );
                          if ( $match == true ) {
                              //password is correct
                              return true;
                          } else {
                              //wrong password
                              return false;
                          }
                      }
        }
        
        public function getOrganizations() {
            $query = "  SELECT 
                        id,
                        name,
                        description,
                        profile_image
                        FROM `organizations`";
                        
            $statement = $this -> connection -> prepare($query);
            $statement -> execute();
            $result = $statement -> get_result();
            while( $row = $result -> fetch_assoc() ) {
                array_push( $this -> organizations, $row );
            }
            
            return $this -> organizations;
        }
        
        public function getOrganizationProfile() {
            $query = "  SELECT 
                        name,
                        description,
                        address,
                        abn,
                        profile_image,
                        phone
                        FROM `organizations`
                        WHERE email = ?";
                        
            $statement = $this -> connection -> prepare($query);
            $statement -> bind_param('s', $_SESSION['organization_email']);
            $statement -> execute();
            $result = $statement -> get_result();
            if( $result -> num_rows == 0) {
                //account does not exist
                return false;
            } else {
                $organization = $result -> fetch_assoc();
                $name = $organization['name'];
                $description = $organization['description'];
                $abn = $organization['abn'];
                $address = $organization['address'];
                $profile_image = $organization['profile_image'];
                $phone = $organization['phone'];
                array_push( $this -> organization_profile, $name, $description, $abn, $address, $profile_image, $phone);
                return $this -> organization_profile;
            }
        }
        
        public function getOrganizationDetails($id) {
            $query = "  SELECT 
                        name,
                        description,
                        address,
                        phone,
						title,
						need_description,
						need_created_at
                        FROM `organizations`
                        INNER JOIN needs
                        ON (? = needs.company_id_fk)
                        ORDER BY need_created_at DESC";
                        
            $statement = $this -> connection -> prepare($query);
            $statement -> bind_param('s', $id);
            $statement -> execute();
            $result = $statement -> get_result();
            while( $row = $result -> fetch_assoc() ) {
                array_push( $this -> organization_details, $row );
            }
            
            return $this -> organization_details;
            
            // if( $result -> num_rows == 0) {
            //     //account does not exist
            //     return false;
            // } else {
            //     $organization = $result -> fetch_assoc();
            //     $org_name = $organization['name'];
            //     $org_description = $organization['description'];
            //     $org_address = $organization['address'];
            //     $org_phone = $organization['phone'];
            //     $need_title = $organization['title'];
            //     $need_description = $organization['description'];
            //     array_push( $this -> organization_profile, $org_name, $org_description, $org_address, $org_phone, $need_title, $need_description);
            //     return $this -> organization_profile;
            // }
        }
        
    }
?>