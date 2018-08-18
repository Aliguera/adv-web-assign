<?php
    class Admin extends Database {
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
                    (?, ?, ?, NOW(), 2)";
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
                $this -> errors = $errors;
                return false;
            }
        }
        
        public function authenticate($email, $password) {
            $query = 'SELECT email, password, fullname, user_level
                      FROM users 
                      WHERE email = ? AND user_level = 2';
                      $statement = $this -> connection -> prepare($query);
                      $statement -> bind_param('s', $email);
                      $statement -> execute();
                      $result = $statement -> get_result();
                      if( $result -> num_rows == 0) {
                          //account does not exist
                          return false;
                      } else {
                          $admin = $result -> fetch_assoc();
                          $email = $admin['email'];
                          $hash = $admin['password'];
                          $fullname = $admin['fullname'];
                          $user_level = $admin['user_level'];
                          $_SESSION['user_level'] = $user_level;
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
    }
?>