<?php

    class CurrentUser
    {
        public $accountid=0;
        public $username ='';
        public $role='';
        public $accountstate = 0;

        public $userid = 0;
        public $user_name='';
        public $email ='';
        public $schoolno= 0;
        public $roomno ='-1';

        function __construct($currentuser,$user_t) {

            $this->accountid = $currentuser['AccountId'];
            $this->username = $currentuser['UserName'];
            $this->role = $currentuser['Role'];
            $this->accountstate = $currentuser['accountstate'];

            $this->userid = $user_t['UserId'] ?? $user_t['TeacherId'] ?? $user_t['studentParentNo'];
            //echo "<script>alert('{$this->userid}')</script>";
            $this->user_name = $user_t['User_Name'] ?? $user_t['TeacherName'] ?? $user_t['studentParentName'];
            $this->email = $user_t['Email'];
            $this->schoolno = $user_t['SchoolNo'];
            $this->roomno = $user_t['RoomNo'] ?? '';

        }


        /*public function verify($user)
        {
            if ($user['username'] == '1234' && $user['password'] == '1234') {
              
               return true;

            } else {

              return false;

            }
            
        }*/

        public function printfields() {

            
            echo 'accountid = ' . $this->accountid . '<br />';
            echo 'username = ' . $this->username . '<br />';
            echo 'role =' . $this->role . '<br />';
            echo 'accountstate =' . $this->accountstate . '<br />';

            echo 'userid =' . $this->userid . '<br />';
            echo 'user_name =' . $this->user_name . '<br />';
            echo 'email =' . $this->email . '<br />';
            echo 'school =' . $this->schoolno . '<br />';
            
            
        }


    }
?>