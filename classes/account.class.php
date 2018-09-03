<?php
    class Account extends Database {
        public $errors = array();
        public function __construct(){
            parent::__construct();
        }
        
        public function create($email, $password, $fullname){
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
            //check if there are no errors
            if(count($errors) == 0){
                //proceed and create account
                $query = "INSERT INTO users
                    (email, password, fullname, created_at, user_level)
                    VALUES
                    (?, ?, ?, NOW(), 1)";
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $statement = $this -> connection -> prepare($query);
                $statement -> bind_param('sss', $email, $hash, $fullname);
                $success = $statement -> execute() ? true : false;
                if ($success == false && $this -> connection -> errno == '1062') {
                    $errors['email'] = 'Email address already used';
                    $this -> errors = $errors;
                }
                return $success;
            } else {
                return false;
            }
        }
        
        public function authenticate($email, $password) {
            $query = 'SELECT id, email, password, fullname, user_level
                      FROM users 
                      WHERE email = ? AND user_level = 1';
                      $statement = $this -> connection -> prepare($query);
                      $statement -> bind_param('s', $email);
                      $statement -> execute();
                      $result = $statement -> get_result();
                      if( $result -> num_rows == 0) {
                          //account does not exist
                          return false;
                      } else {
                          $account = $result -> fetch_assoc();
                          $id = $account['id'];
                          $email = $account['email'];
                          $hash = $account['password'];
                          $fullname = $account['fullname'];
                          $user_level = $account['user_level'];
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
        
        public function getUserId() {
            $query = "SELECT id
                      FROM users
                      WHERE email = ?";
            
            $statement = $this -> connection -> prepare($query);
            $statement -> bind_param('s', $_SESSION['user_email']);
            $statement -> execute();
            $result = $statement -> get_result();
            $account = $result -> fetch_assoc();
            $user_id = $account['id'];
            return $user_id;
        }
        
        public function setUserInterest($organization_id) {
            $query = "SELECT id
                      FROM users
                      WHERE email = ?";
            
            $statement = $this -> connection -> prepare($query);
            $statement -> bind_param('s', $_SESSION['user_email']);
            $statement -> execute();
            $result = $statement -> get_result();
            $account = $result -> fetch_assoc();
            $user_id = $account['id'];
            
            $user_id_int = (int)$user_id;
            $org_id_int = (int)$organization_id;
            
            $query2 = "INSERT INTO organizations_interests(user_id_fk, organization_id_fk)
                       VALUES (?, ?)";
            $statement2 = $this -> connection -> prepare($query2);
            $statement2 -> bind_param('ii', $user_id_int, $org_id_int);
            $success2 = $statement2 -> execute() ? true : false;
            if ($success2 == false) {
                return false;
            } else {
                return true;
            }
        }
        
        public function checkUserInterest($organization_id) {
            $query = "SELECT id
                      FROM users
                      WHERE email = ?";
            
            $statement = $this -> connection -> prepare($query);
            $statement -> bind_param('s', $_SESSION['user_email']);
            $statement -> execute();
            $result = $statement -> get_result();
            $account = $result -> fetch_assoc();
            $user_id = $account['id'];
            
            $user_id_int = (int)$user_id;
            $org_id_int = (int)$organization_id;
            
            $query2 = "SELECT * FROM organizations_interests
                       WHERE user_id_fk = ? AND organization_id_fk = ?";
            $statement2 = $this -> connection -> prepare($query2);
            $statement2 -> bind_param('ii', $user_id_int, $org_id_int);
            $statement2 -> execute();
            $result = $statement2 -> get_result();
            if( $result -> num_rows == 0) {
                return false;
            } else {
                return true;
            }
        }
        
        public function setUserNeed($need_id) {
            $query = "SELECT id
                      FROM users
                      WHERE email = ?";
            
            $statement = $this -> connection -> prepare($query);
            $statement -> bind_param('s', $_SESSION['user_email']);
            $statement -> execute();
            $result = $statement -> get_result();
            $account = $result -> fetch_assoc();
            $user_id = $account['id'];
            
            $user_id_int = (int)$user_id;
            $need_id_int = (int)$need_id;
            
            $query2 = "INSERT INTO users_needs_helps(user_id_fk, need_id_fk)
                       VALUES (?, ?)";
            $statement2 = $this -> connection -> prepare($query2);
            $statement2 -> bind_param('ii', $user_id_int, $need_id_int);
            $success2 = $statement2 -> execute() ? true : false;
            if ($success2 == false) {
                return false;
            } else {
                return true;
            }
        }
    }
?>