<?php
    class Organization extends Database {
        public $organizations = array();
        public $organization_profile = array();
        public $errors = array();
        public function __construct(){
            parent::__construct();
        }
        
        public function create($email, $password, $name, $description, $abn, $address, $org_image){
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
                    (email, password, name, description, profile_image, abn, address, created_at)
                    VALUES
                    (?, ?, ?, ?, ?, ?, ?, NOW())";
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $statement = $this -> connection -> prepare($query);
                $statement -> bind_param('sssssis', $email, $hash, $name, $description, $org_image, $abn, $address);
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
                        profile_image
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
                array_push( $this -> organization_profile, $name, $description, $abn, $address, $profile_image);
                return $this -> organization_profile;
            }
        }
    }
?>