<?php
    class Organization extends Database {
        public $organizations = array();
        public $organization_profile = array();
        public $organization_details = array();
        public $organization_needs = array();
        public $organization_needs_user = array();
        public $organization_needs_new = array();
        public $organization_carousel = array();
        public $organization_profile_needs = array();
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
                        id,
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
                $id = $organization['id'];
                array_push( $this -> organization_profile, $name, $description, $abn, $address, $profile_image, $phone, $id);
                return $this -> organization_profile;
            }
        }
        
        public function getOrganizationDetails($id) {
            $query = "  SELECT 
                        name,
                        description,
                        address,
                        phone
                        FROM `organizations`
                        WHERE organizations.id = ?";
                        
            $statement = $this -> connection -> prepare($query);
            $statement -> bind_param('s', $id);
            $statement -> execute();
            $result = $statement -> get_result();
            while( $row = $result -> fetch_assoc() ) {
                array_push( $this -> organization_details, $row );
            }
            
            return $this -> organization_details;
        }
        
        public function getOrganizationNeeds($organization_id) {
             $query =   "SELECT
                                needs.id,
                                needs.title,
                                needs.description,
                                needs.created_at
                                FROM needs
                                RIGHT JOIN organizations
                                ON (needs.company_id_fk = organizations.id)
                                WHERE
                                organizations.id = ?
                                ORDER BY needs.created_at DESC";
                            
            $statement = $this -> connection -> prepare($query);
            $statement -> bind_param('s', $organization_id);
            $statement -> execute();
            $result = $statement -> get_result();
            while( $row = $result -> fetch_assoc() ) {
                array_push( $this -> organization_profile_needs, $row );
            }
            
            return $this -> organization_profile_needs;
        }
        
        public function getOrganizationNeedsUser($organization_id, $user_id) {
                // $query =   "SELECT
                //             needs.id,
                //             needs.title,
                //             needs.description,
                //             needs.created_at,
                //             users_needs_helps.created_at
                //             FROM needs
                //             LEFT JOIN users_needs_helps
                //             ON (needs.id = users_needs_helps.need_id_fk)
                //             RIGHT JOIN organizations
                //             ON (needs.company_id_fk = organizations.id)
                //             WHERE
                //             organizations.id = ?
                //             ORDER BY needs.created_at DESC";
                
    //             $query = "SELECT
    //                         needs.id,
    //                         needs.title,
    //                         needs.description,
    //                         needs.created_at,
    //                         users_needs_helps.created_at,
				// 			users_needs_helps.user_id_fk
    //                         FROM needs
    //                         LEFT JOIN users_needs_helps
    //                         ON (needs.id = users_needs_helps.need_id_fk)
    //                         RIGHT JOIN organizations
    //                         ON (needs.company_id_fk = organizations.id)
    //                         WHERE
    //                         organizations.id = ?
    //                         ORDER BY needs.created_at DESC";
    
                    $query = "  SELECT needs.id, needs.title, needs.description, needs.created_at, users_needs_helps.user_id_fk FROM users_needs_helps
                                RIGHT JOIN
                                needs
                                ON users_needs_helps.need_id_fk = needs.id
                                WHERE needs.company_id_fk = ? AND users_needs_helps.user_id_fk = ?
                                ORDER BY needs.created_at DESC";
                        
            $statement = $this -> connection -> prepare($query);
            $statement -> bind_param('ss', $organization_id, $user_id);
            $statement -> execute();
            $result = $statement -> get_result();
            while( $row = $result -> fetch_assoc() ) {
                array_push( $this -> organization_needs_user, $row );
            }
            
            $query2 = "         SELECT needs.id, needs.title, needs.description, needs.created_at FROM needs
                                RIGHT JOIN
                                organizations
                                ON needs.company_id_fk = organizations.id
                                WHERE needs.company_id_fk = ?
                                ORDER BY needs.created_at DESC";
                        
            $statement2 = $this -> connection -> prepare($query2);
            $statement2 -> bind_param('s', $organization_id);
            $statement2 -> execute();
            $result2 = $statement2 -> get_result();
            while( $row2 = $result2 -> fetch_assoc() ) {
                array_push( $this -> organization_needs, $row2 );
            }
            
            for ($i = 0; $i < count($this -> organization_needs_user); $i++) {
                $key = array_search($this -> organization_needs_user[$i]['title'], array_column($this -> organization_needs, 'title'));
                array_splice($this -> organization_needs, $key, 1);
            }
        
            
            for ($i = 0; $i < count($this -> organization_needs); $i++) {
                array_push($this -> organization_needs_new, $this -> organization_needs[$i]);
            }
            
            for ($i = 0; $i < count($this -> organization_needs_user); $i++) {
                array_push($this -> organization_needs_new, $this -> organization_needs_user[$i]);
            }
            
            // $organization_needs_user
            
            return $this -> organization_needs_new;
        }
        
        public function getCarouselImages($organization_id) {
            $query = "SELECT
                      title,
                      description,
                      carousel_image,
                      active
                      FROM
                      organization_carousel_images
                      WHERE
                      organization_id_fk = ?";
            
            $statement = $this -> connection -> prepare($query);
            $statement -> bind_param('s', $organization_id);
            $statement -> execute();
            $result = $statement -> get_result();
            while( $row = $result -> fetch_assoc() ) {
                array_push( $this -> organization_carousel, $row );
            }
            
            return $this -> organization_carousel;
        }
        
        public function addCarouselImage($title, $description, $carousel_image, $active, $organization_id) {
            $query = "INSERT INTO organization_carousel_images
                    (title, description, carousel_image, active, organization_id_fk, created_at)
                    VALUES
                    (?, ?, ?, ?, ?,NOW())";
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $statement = $this -> connection -> prepare($query);
                $statement -> bind_param('sssbs', $title, $description, $carousel_image, $active, $organization_id);
                $success = $statement -> execute() ? true : false;
                return $success;
        }
        
    }
?>