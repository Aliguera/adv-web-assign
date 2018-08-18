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
            $query = 'SELECT email, password, fullname, user_level
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
    }
?>