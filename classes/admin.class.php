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
        
        // public function login($email, $password){
        //     //create array to store errors
        //     $errors = array();
        //     //validate email
        //     // if(filter_var($email, FILTER_VALIDADE_EMAIL) == false) {
        //     //     $errors['email'] = 'invalid email address';
        //     // }
        //     //check password length
        //     // if (strlen($password) < 6){
        //     //     $errors['password'] = 'minimum 6 characters';
        //     // }
        //     if (strlen($password) < 6){
        //         echo 'Error: password is too short!';
        //     }
        //     //check if there are no errors
        //     if(count($errors) == 0){
        //         //proceed and create account
        //         $query = "SELECT * FROM users WHERE email = ? AND password = ?";
        //         // $hash = password_hash($password, PASSWORD_DEFAULT);
        //         $statement = $this -> connection -> prepare($query);
        //         // $statement -> bind_param('ss', $email, $hash);
        //         $statement -> bind_param('ss', $email, $password);
        //         $success = $statement -> execute() ? true : false;
        //         return $success;
        //     } else {
        //         return false;
        //     }
        // }
    }
?>