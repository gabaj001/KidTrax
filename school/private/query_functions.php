<?php

  
  // ------------------------ uplade date 12/9/2017
  // Teacher Functions
  function find_all_teachers() {

    global $db;
    global $schoolno;
    $sql ="SELECT th.TeacherId, th.TeacherName, th.Email, th.SchoolNo,";
    $sql .="ac.AccountId,ac.UserName,ac.PassWord,ac.CreateDate,ac.Role,";
    $sql .="ac.accountstate ";
    $sql .="FROM teacher th LEFT JOIN account ac ";
    $sql .="ON th.AccountId = ac.AccountId ";
    $sql .="WHERE th.SchoolNo=" . $schoolno;
    $sql .= " ORDER BY th.TeacherName ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;

  }

  function find_teacher_by_id($id) {

    global $db;
    global $schoolno;

    //$sql = "SELECT * FROM teacher ";
    //echo "<script>alert('{$schoolno}')</script>";
    $sql ="SELECT th.TeacherId, th.TeacherName, th.Email, th.SchoolNo,";
    $sql .="ac.AccountId,ac.UserName,ac.PassWord,ac.CreateDate,ac.Role,";
    $sql .="ac.accountstate ";
    $sql .="FROM teacher th LEFT JOIN account ac ";
    $sql .="ON th.AccountId = ac.AccountId ";
    $sql .= " WHERE th.TeacherId=" . db_escape($db,$id) ;

    //$sql .="WHERE th.SchoolNo=1" . $schoolno;
    //echo $sql;
    $result = mysqli_query($db,$sql);
    confirm_result_set($result);
    $teacher = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $teacher;
  }

  function find_teacher_by_Accountid($id) {

    global $db;
    global $schoolno;

    //$sql = "SELECT * FROM teacher ";
    //echo "<script>alert('{$schoolno}')</script>";
    $sql ="SELECT th.TeacherId, th.TeacherName, th.Email, th.SchoolNo,";
    $sql .="ac.AccountId,ac.UserName,ac.PassWord,ac.CreateDate,ac.Role,";
    $sql .="ac.accountstate ";
    $sql .="FROM teacher th INNER JOIN account ac ";
    $sql .="ON th.AccountId = ac.AccountId ";
    $sql .= " WHERE ac.AccountId=" . db_escape($db,$id) ;

    //$sql .="WHERE th.SchoolNo=1" . $schoolno;
    //echo $sql;
    $result = mysqli_query($db,$sql);
    confirm_result_set($result);
    $teacher = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $teacher;
  }


function update_teacher($teacher) {
        global $db;
        //global $schoolno;

        /*$error = validate_teacher($teacher);
        if (!empty($error)) {
            //phpAlert($error); 
            return $error;

        }*/

        $sql = "UPDATE  teacher SET ";
        $sql .= "Email='" . db_escape($db,$teacher['email']) . "', ";
        $sql .= "AccountId='" . db_escape($db,$teacher['accountid']) . "' ";
        $sql .= "WHERE TeacherId='" . db_escape($db,$teacher['teacherid']) . "' ";
        $sql .= "AND SchoolNo=" . db_escape($db,$teacher['schoolno']);
        $sql .= " LIMIT 1";
        echo $sql;
        $result = mysqli_query($db,$sql);

        if($result)
        {
            return true;
            
        } else {

            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }

  }
 

  function delete_teacher($id) {
  
            global $db;
            $sql = "DELETE FROM teachers ";
            $sql .= "WHERE id='" . db_escape($db,$id) . "' ";
            $sql .= "LIMIT 1";

            $result = mysqli_query($db,$sql);
            if($result) {
                return true;
            } else {

                echo mysqli_error($db);
                db_disconnect($db);
                exit;

            }
  }

function validate_teacher($teacher) {

      $errors = [];
      
      // User Name
      if(is_blank($teacher['teachername'])) {
        $errors[] = "Name cannot be blank.";
      } elseif(!has_length($teacher['teachername'], ['min' => 6, 'max' => 15])) {
        $errors[] = "Name must be between 6 and 15 characters.";
      }

      // User Name
      if(is_blank($teacher['password'])) {
        $errors[] = "password cannot be blank.";
      } elseif(!has_length($teacher['teachername'], ['min' => 6, 'max' => 15])) {
        $errors[] = "Password must be between 6 and 15 characters.";
      }

      if(has_valid_email_format($teacher['password'])) {

        $errors[] = "Invalid Email.";
      }
      
      return $errors;
}
 
 // ----------------- Parents

 function find_all_parents()
 {

    global $db;
    global $schoolno;

    $sql ="SELECT pn.studentParentNo,std.studentID,std.studentName,";
    $sql .="pn.studentParentName, pn.Relationship, pn.parentPhone,";
    $sql .="pn.Email, pn.AccountId, ac.UserName,ac.PassWord,ac.CreateDate,";
    $sql .="ac.Role,ac.accountstate ";
    $sql .="FROM parentinfo pn ";
    $sql .="LEFT JOIN account ac ";
    $sql .= "ON pn.AccountId = ac.AccountId ";
    $sql .= "INNER JOIN stdbelong bl ";
    $sql .= "ON pn.studentParentNo = bl.StudentParentNo ";
    $sql .= "INNER JOIN studentinfo std ";
    $sql .= "ON bl.StudentID = std.studentID ";
    $sql .= "WHERE std.SchoolNo =" . $schoolno;
    $sql .= " GROUP BY pn.studentParentName";
    //$sql .= " ORDER BY pn.studentParentName ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;

 }

 function find_parent_by_id($id)
 {

    global $db;
    //global $schoolno;

    $sql ="SELECT pn.studentParentNo,std.studentID,std.studentName,";
    $sql .="pn.studentParentName, pn.Relationship, pn.parentPhone,";
    $sql .="pn.Email, pn.AccountId, ac.UserName,ac.PassWord,ac.CreateDate,";
    $sql .="ac.Role,ac.accountstate ";
    $sql .="FROM parentinfo pn ";
    $sql .="LEFT JOIN account ac ";
    $sql .= "ON pn.AccountId = ac.AccountId ";
    $sql .= "INNER JOIN stdbelong bl ";
    $sql .= "ON pn.studentParentNo = bl.StudentParentNo ";
    $sql .= "INNER JOIN studentinfo std ";
    $sql .= "ON bl.StudentID = std.studentID ";
    $sql .= "WHERE  pn.studentParentNo=" . db_escape($db,$id);
    //$sql .= " AND std.SchoolNo =" . $schoolno;
    
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $parent = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $parent;

 }

 function find_parents_by_School($schoolno)
 {

    global $db;
    //global $schoolno;

    $sql ="SELECT pn.studentParentNo,std.studentID,std.studentName,";
    $sql .="pn.studentParentName, pn.Relationship, pn.parentPhone,";
    $sql .="pn.Email, pn.AccountId, ac.UserName,ac.PassWord,ac.CreateDate,";
    $sql .="ac.Role,ac.accountstate ";
    $sql .="FROM parentinfo pn ";
    $sql .="LEFT JOIN account ac ";
    $sql .= "ON pn.AccountId = ac.AccountId ";
    $sql .= "INNER JOIN stdbelong bl ";
    $sql .= "ON pn.studentParentNo = bl.StudentParentNo ";
    $sql .= "INNER JOIN studentinfo std ";
    $sql .= "ON bl.StudentID = std.studentID ";
    $sql .= "WHERE std.SchoolNo =" . $schoolno;
    $sql .= " GROUP BY pn.studentParentName";
    //$sql .= " ORDER BY pn.studentParentName ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
 }
 
 function update_parent($parent) 
 {

        global $db;
       

        /*$error = validate_teacher($teacher);
        if (!empty($error)) {
            //phpAlert($error); 
            return $error;

        }*/

        $sql = "UPDATE  parentinfo SET ";
        $sql .= "Email='" . db_escape($db,$parent['email']) . "', ";
        $sql .= "AccountId='" . db_escape($db,$parent['accountid']) . "' ";
        $sql .= "WHERE studentParentNo='" . db_escape($db,$parent['studentparentno']) . "' ";
        $sql .= " LIMIT 1";
        //echo $sql;
        $result = mysqli_query($db,$sql);

        if($result)
        {
            return true;
            
        } else {

            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }



 }

 //------------------ count mangement ------------------

   function createaccount($user)
  {

        global $db;
        /*$error = validate_teacher($user);
        if (!empty($error)) {

            //phpAlert($error); 
            return $error;

        }*/

        $sql  = "INSERT INTO account(UserName, PassWord,"; 
        $sql .="CreateDate, Role,accountstate) "; 
        $sql .="VALUES (";
        $sql .= "'" .  db_escape($db,$user['username']) . "',";  
        $sql .= "'" .  db_escape($db,$user['password']) . "',";
        $sql .= "'" . db_escape($db,$user['createdate']) . "',";
        $sql .= "'" . db_escape($db,$user['role']) . "',";
        $sql .= "'" . db_escape($db,$user['accountstate']) . "'";
        $sql .= ")";
        
        $result = mysqli_query($db,$sql);
        $accountid = mysqli_insert_id($db);
        $user['accountid'] = $accountid;

        if($user['role']=='teacher')
        {
          update_teacher($user);
        } else if($user['role']=='parent') {

          update_parent($user);

        } else if($user['role']=='staffusers')
        {
            update_staffuser($user);
        } else if($user['role']=='schooladmin')
        {
            
              create_new_user($user);
            
            
        }

        if($result) {
          return true;
        }
        else {

            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }

  }

  function update_schooladmin($user)
  {
    
       global $db;

       $sql  = "UPDATE  users SET ";
       $sql .= " User_Name ='" .  $user['user_name'] . "'";
       $sql .= ",Email='" . $user['email'] . "'";
       $sql .= ",AccountId=" . $user['accountid'];
       $sql .= ",SchoolNo=" . $user['schoolno'];
       $sql .= " WHERE UserId =" . db_escape($db,$user['userid']);

       //echo $sql . '<br />';

       $result = mysqli_query($db,$sql);
       if($result) {
          return true;
        }
        else {

            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }

  
        
    
  }

  function create_new_user($user)
  {

       global $db;

       $sql  = "INSERT INTO users(User_Name, Email, AccountId, SchoolNo) ";
       $sql .= "VALUES ('" . $user['user_name'] . "','" ;
       $sql .=  $user['email'] . "'," ;
       $sql .=  $user['accountid'] . ",";
       $sql .=  $user['schoolno'] . ")";

       //echo $sql;

       $result = mysqli_query($db,$sql);
       if($result) {
          return true;
        }
        else {

            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }

  }

  function editaccount($user)
  {

        global $db;
        /*$error = validate_teacher($teacher);
        if (!empty($error)) {
            //phpAlert($error); 
            return $error;

        }*/

        $sql  = "UPDATE account SET ";
        $sql .= "UserName='" . db_escape($db,$user['username']) . "',";
        $sql .= "PassWord='" . db_escape($db,$user['password']) . "',";
        $sql .= " accountstate=" . db_escape($db,$user['accountstate']);
        $sql .= " WHERE AccountId=" . db_escape($db,$user['accountid']);
        //echo $sql;
        $result = mysqli_query($db,$sql);
        //$teacher['accountid'] = $accountid;
        if ($user['role'] == 'schooladmin')
        {
            update_schooladmin($user);
        }
        else if($user['role']=='teacher')
        {
          update_teacher($user);

        } else {

          update_parent($user);

        }

        if($result) {
          return true;
        }
        else {

            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }

  }

  function find_all_staff()
  {

      global $db;
      global $schoolno;

      $sql  = "SELECT usr.UserId,usr.user_Name,usr.Email,usr.AccountId,";
      $sql .="usr.SchoolNo,ac.AccountId, ac.UserName, ac.PassWord,";
      $sql .="ac.CreateDate, ac.Role, ac.accountstate ";
      $sql .="FROM users usr ";
      $sql .="INNER JOIN account ac ";
      $sql .="ON usr.AccountId = usr.AccountId ";
      $sql .="AND ac.Role='" . 'staffusers' . "' ";
      $sql .="AND usr.SchoolNo=" . $schoolno;

      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;

  }

 function find_User_by_School($schoolno)
 {

      global $db;
      

      $sql  = "SELECT usr.UserId,usr.User_Name,usr.Email,usr.AccountId,";
      $sql .="usr.SchoolNo,ac.AccountId, ac.UserName, ac.PassWord,";
      $sql .="ac.CreateDate, ac.Role, ac.accountstate ";
      $sql .="FROM users usr ";
      $sql .="INNER JOIN account ac ";
      $sql .="ON usr.AccountId = ac.AccountId ";
      $sql .="WHERE ac.Role='" . 'schooladmin' . "' ";
      $sql .="AND usr.SchoolNo=" . $schoolno;
      //echo $sql;
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;


 }


  function find_staffuser_by_id($id,$schoolno) 
  {

      global $db;
      

      $sql  = "SELECT usr.UserId,usr.User_Name,usr.Email,usr.AccountId,";
      $sql .="usr.SchoolNo,ac.AccountId, ac.UserName, ac.PassWord,";
      $sql .="ac.CreateDate, ac.Role, ac.accountstate ";
      $sql .="FROM users usr ";
      $sql .="INNER JOIN account ac ";
      $sql .="ON usr.AccountId = ac.AccountId ";
      $sql .="WHERE ac.Role='" . 'schooladmin' . "' ";
      $sql .="AND usr.SchoolNo=" .  db_escape($db,$schoolno);
      $sql .= " AND usr.UserId =" .  db_escape($db,$id);
      //echo $sql;
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $user = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $user;

 
 
  }


  function update_staffuser($user) {

  }

  function find_all_schooladmin($schoolno)
  {

      global $db;
      

      $sql  = "SELECT usr.UserId,usr.user_Name,usr.Email,usr.AccountId,";
      $sql .="usr.SchoolNo,ac.AccountId, ac.UserName, ac.PassWord,";
      $sql .="ac.CreateDate, ac.Role, ac.accountstate ";
      $sql .="FROM users usr ";
      $sql .="INNER JOIN account ac ";
      $sql .="ON usr.AccountId = usr.AccountId ";
      $sql .="AND ac.Role='" . 'schooladmin' . "' ";
      $sql .="AND usr.SchoolNo=" . $schoolno;

      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;

  }

  function find_schooladmin_by_id($id) {

      return null;
  }

 

  function find_user($accountid)
  {
      global $db;
      


  }

  function find_user_by_id($id) {

    global $db;
    global $schoolno;

    $sql ="SELECT usr.UserId, usr.User_Name, usr.Email,";
    $sql .="usr.AccountId, usr.SchoolNo,ac.UserName,";
    $sql .="ac.PassWord, ac.CreateDate,ac.Role, ac.accountstate ";
    $sql .="FROM users usr ";
    $sql .="INNER JOIN account ac ";
    $sql .="ON usr.AccountId = ac.AccountId ";
    $sql .="WHERE usr.AccountId=" . db_escape($db,$id);


    $result = mysqli_query($db,$sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $user;


  }

  function find_useraccount($user) {

    global $db;
    global $schoolno;
    $sql ="SELECT AccountId,UserName,PassWord,Role,accountstate ";
    $sql .="FROM account ";
    $sql .="WHERE accountstate = 1 ";
    $sql .="AND UserName = '" . db_escape($db,$user['username']) . "'";
    $sql .= " LIMIT 1";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $crusr = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    
    if ($crusr) {

        if (password_verify($user['password'], $crusr['PassWord'])) 
        {
                
                return $crusr;
                
        }

    }

    

    return null;

  }

    function edituser($user)
    {
        global $db;

        /*$error = validate_teacher($teacher);
        if (!empty($error)) {
            //phpAlert($error); 
            return $error;

        }*/

        $sql = "UPDATE  users SET ";
        $sql .= "User_Name='" . db_escape($db,$user['user_name']) . "', ";
        $sql .= "Email='" . db_escape($db,$user['email']) . "' ";
        $sql .= "WHERE AccountId=" . db_escape($db,$user['accountid']);
        $sql .= " LIMIT 1";
        //echo $sql;
        $result = mysqli_query($db,$sql);

        if($result)
        {
            return true;
            
        } else {

            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }


    }

    function editusername($user)
  {

        global $db;
        /*$error = validate_teacher($teacher);
        if (!empty($error)) {
            //phpAlert($error); 
            return $error;

        }*/

        $sql  = "UPDATE account SET ";
        $sql .= "UserName='" . db_escape($db,$user['username']) . "',";
        $sql .= "accountstate=" . db_escape($db,$user['accountstate']);
        $sql .= " WHERE AccountId=" . db_escape($db,$user['accountid']);
        //echo $sql;
        $result = mysqli_query($db,$sql);
        //$teacher['accountid'] = $accountid;
        
        if($user['role']=='teacher')
        {
          update_teacher($user);

        } else {

          update_parent($user);

        }

        if($result) {
          return true;
        }
        else {

            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }

  }

  function find_all_schools() {

    global $db;
    $sql ="SELECT SchoolNo, SchoolName, schoolAddress, PhoneNo,";
    $sql .="schoolPresident, schooldistrict, Email_address ";
    $sql .="FROM school";
    $sql .= " ORDER BY SchoolName ASC, schooldistrict ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;

  }

  function find_teachers_by_School($schoolno)
  {

    global $db;
    
    $sql ="SELECT th.TeacherId, th.TeacherName, th.Email, th.SchoolNo,";
    $sql .="ac.AccountId,ac.UserName,ac.PassWord,ac.CreateDate,ac.Role,";
    $sql .="ac.accountstate ";
    $sql .="FROM teacher th LEFT JOIN account ac ";
    $sql .="ON th.AccountId = ac.AccountId ";
    $sql .="WHERE th.SchoolNo=" . $schoolno;
    $sql .= " ORDER BY th.TeacherName ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;

  }

    function find_all_period($schoolno)
    {
        global $db;
    
        $sql ="SELECT PeriodNo, StartTime, EndTime,";
        $sql .="SchoolNo,TypeCode ";
        $sql .="FROM classperiod ";
        $sql .="WHERE SchoolNo =" . $schoolno;
        $sql .= " ORDER BY PeriodNo ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;

    }

    function find_teacher_period($id,$schoolno)
    {
        global $db;

        $sql ="SELECT tc.TeacherId,  cls.Term_ser,prd.PeriodNo";
        $sql .=",CASE ";
        $sql .="WHEN locate('P',prd.TypeCode) = 1 THEN REPLACE(prd.TypeCode,'P','Period ') ";
        $sql .="WHEN locate('E',prd.TypeCode) = 1 THEN REPLACE(prd.TypeCode,'E','Encoure ') ";        
        $sql .="ELSE 'NONE' ";
        $sql .="END AS 'periodtitle' ";
        $sql .="FROM teacher tc ";
        $sql .="INNER JOIN classroom cls ";
        $sql .="ON tc.TeacherId = cls.TeacherID ";
        $sql .="INNER JOIN classperiod prd ";
        $sql .="ON cls.PeriodNo = prd.PeriodNo ";      
        $sql .="WHERE prd.SchoolNo =" . db_escape($db,$schoolno);
        $sql .=" AND tc.TeacherId =" . db_escape($db,$id);
        $sql .= " ORDER BY PeriodNo ASC";

        //echo $sql;

        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;

    }

    function find_room_by_teacher($id,$schoolno) {

        global $db;

        $currentTerm = find_currentTerm($schoolno);
        $sql ="SELECT cls.RoomNo, cls.ClassGrade,";
        $sql .="cls.TeacherID,cls.SchoolNo, cls.Term_ser,";
        $sql .="tc.TeacherId,";
        $sql .="tc.TeacherName ";
        $sql .="FROM classroom cls "; 
        $sql .="LEFT JOIN teacher tc ";
        $sql .="ON cls.TeacherID = tc.TeacherID ";
        $sql .="WHERE tc.TeacherID =" .  db_escape($db,$id);
        $sql .=" AND cls.SchoolNo =" .  db_escape($db,$schoolno);
        $sql .=" AND cls.Term_ser = " . $currentTerm['Term_ser'];
        //echo $sql;
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $classdata = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        return $classdata;
    }

        function find_period($id) {

            /*$sql ="SELECT cls.SessionNo, cls.RoomNo, cls.ClassGrade,";
            $sql .="cls.TeacherID, cls.SubjectId, cls.PeriodNo,";
            $sql .="cls.SchoolNo, cls.Term_ser, tc.TeacherId,";
            $sql .="tc.TeacherName, tc.Email, tc.AccountId ,";
            $sql .="sub.SubjectName ";
            $sql .="FROM classroom cls "; 
            $sql .="LEFT JOIN teacher tc ";
            $sql .="ON cls.TeacherID = tc.TeacherID ";
            $sql .="INNER JOIN subject sub ";
            $sql .="ON tc.SubjectId = sub.SubjectId ";
            $result = mysqli_query($db, $sql);
            confirm_result_set($result);
            $classdata = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            return $classdata;*/
    }

    function teacher_subjects($id,$schoolno)
    {
        global $db;

        $sql ="SELECT tc.TeacherID, tc.TeacherName, tc.SchoolNo,";
        $sql .="sub.SubjectId,sub.SubjectName ";
        $sql .="FROM teacher tc ";
        $sql .="INNER JOIN subject sub "; 
        $sql .="ON tc.SubjectId = sub.SubjectId ";
        $sql .="WHERE tc.TeacherID =" .  db_escape($db,$id);
        $sql .=" AND tc.SchoolNo =" .  db_escape($db,$schoolno);
        //echo $sql;
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;        

    }


    function find_currentTerm($schoolno) {

        global $db;

        $sql ="SELECT Term_ser, TermNo, StartDate, EndDate,";
        $sql .="SchoolNo, SchoolYearNo ";
        $sql .="FROM term "; 
        $sql .="WHERE SchoolNo =" .  db_escape($db,$schoolno);
        $sql .= " AND NOW() BETWEEN startdate and enddate";
        //echo $sql;
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $termdata = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $termdata;

        
    }

    function get_student_attendance($id,$schoolno,$studentsessionno,$cdate)
    {
        global $db;
        //date_format(date(starttime),'%d-%m-%Y')
        $sql ="SELECT Attendance_ser, Time_attendance, ";
        $sql .=" date_format(date(Date_ttendance),'%m-%d-%Y') AS dtatt,";
        
        $sql .="StudentId, SchoolNo, studentsessionNo ";
        $sql .=" FROM classattendance ";
        $sql .="WHERE StudentId=" . db_escape($db,$id);
        $sql .=" AND SchoolNo=" . db_escape($db,$schoolno);
        $sql .=" AND studentsessionNo=" . db_escape($db,$studentsessionno);
        $sql .=" AND date_format(date(Date_ttendance),'%m-%d-%Y') = date_format(date('" . $cdate . "'),'%m-%d-%Y') ";
        //echo $sql . '<br />';
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);

        //$rowcount=mysqli_num_rows($result);
        //echo $rowcount . '<br />';

        $student_att = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $student_att;


    }

    function roomperiod($roomno,$subjectid,$periodno,$schoolno,$cdate)
    {
        global $db;

        $sql ="SELECT stdinfo.studentID, stdinfo.studentName, stdinfo.gender,"; 
        $sql .="stdinfo.currentGrade, stdinfo.SchoolNo,";
        $sql .="stdcls.studentsessionNo,stdcls.SessionNo,clsrm.RoomNo,";
        $sql .="clsrm.PeriodNo,clsrm.Term_ser,";
        $sql .="clspr.StartTime,clspr.EndTime ";
        $sql .="FROM studentinfo stdinfo ";
        $sql .="INNER JOIN studentclass stdcls ";
        $sql .="ON stdinfo.studentID = stdcls.StudentId ";
        $sql .="INNER JOIN classroom clsrm ";
        $sql .="ON clsrm.SessionNo = stdcls.SessionNo ";
        $sql .="INNER JOIN classperiod clspr ";
        $sql .="ON clsrm.PeriodNo = clspr.PeriodNo ";
        $sql .="WHERE clsrm.RoomNo = " . db_escape($db,$roomno);
        $sql .=" AND clsrm.PeriodNo = " . db_escape($db,$periodno);
        $sql .=" AND stdinfo.SchoolNo = " . db_escape($db,$schoolno);
        $term_ser = find_currentTerm($schoolno);
        $sql .=" AND clsrm.Term_ser = " . db_escape($db,$term_ser['Term_ser']);
        $sql .=" AND clsrm.SubjectId = " . db_escape($db,$subjectid);
        //echo $sql;
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
       
        $students = array();

        $count = 0;
        while($rs = mysqli_fetch_assoc($result))
        {
            $students[$count]['studentid'] = $rs['studentID'];
            $students[$count]['studentname'] = $rs['studentName'];
            $students[$count]['starttime'] = $rs['StartTime'];
            $students[$count]['endtime'] = $rs['EndTime'];

            $att = get_student_attendance($rs['studentID'],$rs['SchoolNo'],
                                          $rs['studentsessionNo'],$cdate);
            if ($att) {
                $students[$count]['time_attendance'] = $att['Time_attendance'] ;
                $students[$count]['date_ttendance'] = $att['dtatt'];
            } else {

                    $students[$count]['time_attendance'] =  'None';
                    $students[$count]['date_ttendance'] =  'None';

            }
            $students[$count]['studentsessionno'] = $rs['studentsessionNo'];
            $count++;
             

        }

        mysqli_free_result($result);
        return $students;

        

    }

    function getCurrentdate()
    {
        global $db;

        $result = mysqli_query($db, "SELECT CURDATE() as curdate");
        confirm_result_set($result);
        $currentdate = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $currentdate;

    }

    function find_student_activities($id,$schoolno,$cdate)
    {

        global $db;

        $sql ="SELECT stdinfo.studentID,stdinfo.studentName,";
        $sql .="stdinfo.currentGrade,stdactv.StudentActivity_ser,";
        $sql .=" stdactv.placeName,stdactv.ActivityTime, stdactv.ActivityDate,";
        $sql .="stdactv.TimeState, stdactv.studentRFIDTag, stdactv.SchoolNo,";
        $sql .="CASE stdactv.TimeState";
        $sql .=" WHEN 1 THEN 'Arriving on time'";
        $sql .=" WHEN 2 THEN 'Arriving on time'";
        $sql .=" WHEN 3 THEN 'Arriving late'";
        $sql .=" WHEN 4 THEN 'Departing on time'";
        $sql .=" WHEN 5 THEN 'Departing late'";
        $sql .=" ELSE ''";
        $sql .=" END  as actvstate ";
        $sql .="FROM studentinfo stdinfo ";
        $sql .="INNER JOIN studentactivity stdactv ";
        $sql .="ON stdinfo.studentRFIDTag = stdactv.studentRFIDTag ";
        $sql .=" WHERE stdinfo.studentID = " . db_escape($db,$id);

        if ($schoolno!=null)
           $sql .=" AND stdactv.SchoolNo= " . db_escape($db,$schoolno);
           
        $sql .=" AND date_format(date(stdactv.ActivityDate),'%m-%d-%Y') =";
        $sql .=" date_format(date('" . $cdate . "'),'%m-%d-%Y') ";
        $sql .= " ORDER BY stdactv.ActivityTime,stdactv.ActivityDate ASC";
        //echo $sql;
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;

    }

    function find_student_activities_for_parent($id,$schoolno,$cdate)
    {

        global $db;

        $sql ="SELECT stdinfo.studentID,stdinfo.studentName,";
        $sql .="stdinfo.currentGrade,stdactv.StudentActivity_ser,";
        $sql .=" stdactv.placeName,stdactv.ActivityTime, stdactv.ActivityDate,";
        $sql .="stdactv.TimeState, stdactv.studentRFIDTag, stdactv.SchoolNo,";
        $sql .="CASE stdactv.TimeState";
        $sql .=" WHEN 1 THEN 'Arriving on time'";
        $sql .=" WHEN 2 THEN 'Arriving on time'";
        $sql .=" WHEN 3 THEN 'Arriving late'";
        $sql .=" WHEN 4 THEN 'Departing on time'";
        $sql .=" WHEN 5 THEN 'Departing late'";
        $sql .=" ELSE ''";
        $sql .=" END  as actvstate ";
        $sql .="FROM studentinfo stdinfo ";
        $sql .="INNER JOIN studentactivity stdactv ";
        $sql .="ON stdinfo.studentRFIDTag = stdactv.studentRFIDTag ";
        $sql .=" WHERE stdinfo.studentID = " . db_escape($db,$id);
        
        if ($schoolno!=null)
           $sql .=" AND stdactv.SchoolNo= " . db_escape($db,$schoolno);
           
        $sql .=" AND date_format(date(stdactv.ActivityDate),'%m-%d-%Y') =";
        $sql .=" date_format(date('" . $cdate . "'),'%m-%d-%Y') ";
        $sql .= " ORDER BY stdactv.ActivityTime DESC";
        //echo $sql;
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;

    }

    function find_parent_by_Accountid($id)
    {

        global $db;
        

    
        $sql ="SELECT prnt.studentParentNo, prnt.studentParentName,prnt.AccountId, ";
        $sql .="ac.AccountId,ac.UserName,ac.PassWord,ac.CreateDate,ac.Role,";
        $sql .="ac.accountstate ";
        $sql .="FROM parentinfo prnt INNER JOIN account ac ";
        $sql .="ON prnt.AccountId = ac.AccountId ";
        $sql .= " WHERE ac.AccountId=" . db_escape($db,$id) ;

        //$sql .="WHERE th.SchoolNo=1" . $schoolno;
        //echo $sql;
        $result = mysqli_query($db,$sql);
        confirm_result_set($result);
        $parent = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $parent;
    }

    function parent_children($id) 
    {

      global $db;
      

      $sql ="SELECT std.studentID, std.studentName, std.currentGrade,";
      $sql .= "std.studentRFIDTag,std.SchoolNo, std.BusNo,blg.StudentID,";
      $sql .= "blg.StudentParentNo,prnifo.studentParentNo,";
      $sql .= "prnifo.studentParentName, prnifo.Relationship, prnifo.AccountId ";
      $sql .= "FROM studentinfo std INNER JOIN stdbelong blg ";
      $sql .= " ON std.studentID = blg.StudentID ";
      $sql .= "INNER JOIN parentinfo prnifo ";
      $sql .= "ON blg.StudentParentNo = prnifo.studentParentNo ";
      $sql .= "WHERE blg.StudentParentNo=" . db_escape($db,$id);
      //echo $sql;
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;

    }

    function parent_children_bus($id,$cdate,$tripstate)
    {

      global $db;
      

      $sql ="SELECT std.studentID, std.studentName, std.currentGrade,";
      $sql .= "std.studentRFIDTag,std.SchoolNo, std.BusNo,blg.StudentID,";
      $sql .= "blg.StudentParentNo,prnifo.studentParentNo,";
      $sql .= "prnifo.studentParentName, prnifo.Relationship, prnifo.AccountId ";
      $sql .= "FROM studentinfo std INNER JOIN stdbelong blg ";
      $sql .= " ON std.studentID = blg.StudentID ";
      $sql .= "INNER JOIN parentinfo prnifo ";
      $sql .= "ON blg.StudentParentNo = prnifo.studentParentNo ";
      $sql .= "WHERE blg.StudentParentNo=" . db_escape($db,$id);
      //echo $sql;
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      
      $students = array();

      $count = 0;

      while($rs = mysqli_fetch_assoc($result))
      {
         $students[$count]['studentname'] = $rs['studentName'];
         $students[$count]['busno'] = $rs['BusNo'];
         $students[$count]['schoolno'] = $rs['SchoolNo'];
         $minatt = kid_time_in($rs['studentID'],$cdate,$tripstate);
          if ($minatt) {
                $students[$count]['time_attendance'] = $minatt['Time_attendance'] ;
                $students[$count]['date_attendance'] = $minatt['Date_attendance'];
                $students[$count]['lat1'] = $minatt['lat'];
                 $students[$count]['lon1'] = $minatt['lon'];
          } else {

                    $students[$count]['time_attendance'] =  'None';
                    $students[$count]['date_attendance'] =  'None';
                    $students[$count]['lat1'] = 0;
                    $students[$count]['lon1'] = 0;
          }

          $maxatt = kid_time_out($rs['studentID'],$cdate,$tripstate);

          if ($maxatt) {
                $students[$count]['time_attendance_out'] = $maxatt['Time_attendance'] ;
                $students[$count]['lat2'] = $maxatt['lat'];
                $students[$count]['lon2'] = $maxatt['lon'];
          } else {

                    $students[$count]['time_attendance_out'] =  'None';
                    $students[$count]['lat2']=  0;
                    $students[$count]['lon2'] = 0;

          }


         $count++;
      }
      mysqli_free_result($result);
      return $students;

    }

    function kid_time_in($studid,$cdate,$tripstate)
    {
        global $db;

        $sql ="SELECT Attendance_ser, Time_attendance, Date_attendance, StudentId,";
        $sql .= "SchoolNo, BusNo, StopId, Trip_State, `lat`, lon ";
        $sql .= "FROM roundtripbusattendance ";
        $sql .= "WHERE Attendance_ser=(SELECT MIN(Attendance_ser) ";
        $sql .= "FROM roundtripbusattendance ";
        $sql .= "WHERE StudentId =" .  $studid . " and Date_attendance='" . $cdate . "')";
        $sql .= " AND Trip_State =" .  $tripstate . " LIMIT 1"; 

        $result = mysqli_query($db, $sql);
        confirm_result_set($result);

        //$rowcount=mysqli_num_rows($result);
        //echo $sql . '<br />';

        $student_att = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $student_att;


    }

    function kid_time_out($studid,$cdate,$tripstate)
    {
        global $db;

        $sql ="SELECT Attendance_ser, Time_attendance, Date_attendance, StudentId,";
        $sql .= "SchoolNo, BusNo, StopId, Trip_State, `lat`, lon ";
        $sql .= "FROM roundtripbusattendance ";
        $sql .= "WHERE Attendance_ser=(SELECT MAX(Attendance_ser) ";
        $sql .= "FROM roundtripbusattendance ";
        $sql .= "WHERE StudentId =" .  $studid . " and Date_attendance='" . $cdate . "')";
        $sql .= " AND Trip_State =" .  $tripstate . " LIMIT 1"; 

        $result = mysqli_query($db, $sql);
        confirm_result_set($result);

        //$rowcount=mysqli_num_rows($result);
        //echo $sql . '<br />';

        $student_att = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $student_att;


    }

    function student_schedule($id,$cdate)
    {

        global $db;
        $sql ="SELECT stdcls.studentsessionNo, stdcls.StudentId, stdcls.SessionNo,"; 
        $sql .= "stdinfo.studentName,stdinfo.currentGrade, stdinfo.studentRFIDTag,"; 
        $sql .= "stdinfo.SchoolNo,clsrm.RoomNo,clsrm.SubjectId,clsrm.PeriodNo,";
        $sql .= "clsrm.SessionNo,clsrm.Term_ser,sb.SubjectName,";
        $sql .= "clspr.StartTime,clspr.EndTime ";
        $sql .= "FROM studentclass stdcls ";
        $sql .= "INNER JOIN studentinfo stdinfo ";
        $sql .= "On stdcls.StudentId = stdinfo.studentID ";
        $sql .= "INNER JOIN classroom clsrm ";
        $sql .= "ON stdcls.SessionNo = clsrm.SessionNo ";
        $sql .= "INNER JOIN subject sb ";
        $sql .= "ON clsrm.SubjectId = sb.SubjectId ";
        $sql .= "INNER JOIN classperiod clspr ";
        $sql .= "ON clsrm.PeriodNo = clspr.PeriodNo ";
        $sql .= " AND stdcls.StudentId = " . db_escape($db,$id);
        //echo $sql;
        $result = mysqli_query($db, $sql);

        $students = array();

        $count = 0;
        while($rs = mysqli_fetch_assoc($result))
        {
            //echo "yes";
            $students[$count]['studentid'] = $rs['StudentId'];
            $students[$count]['studentname'] = $rs['studentName'];
            $students[$count]['subjectname'] = $rs['SubjectName'];
            $students[$count]['starttime'] = $rs['StartTime'];
            $students[$count]['endtime'] = $rs['EndTime'];

            $att = get_student_attendance($rs['StudentId'],$rs['SchoolNo'],
                                          $rs['studentsessionNo'],$cdate);
            if ($att) {
                $students[$count]['time_attendance'] = $att['Time_attendance'] ;
                $students[$count]['date_ttendance'] = $att['dtatt'];
            } else {

                    $students[$count]['time_attendance'] =  'None';
                    $students[$count]['date_ttendance'] =  'None';

            }
            $students[$count]['studentsessionno'] = $rs['studentsessionNo'];
            $count++;
             

        }

        mysqli_free_result($result);
        return $students;
 
    }

    function student_schools()
    {
        global $db;

        $sql ="SELECT stdinfo.studentID,";
        $sql .="scl.SchoolNo, scl.SchoolName ";
        $sql .="FROM studentinfo stdinfo ";
        $sql .="INNER JOIN school scl ";
        $sql .="ON stdinfo.SchoolNo = scl.SchoolNo ";
        
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
        

    }

    function roominschool($schoolno)
    {
        global $db;
        $sql ="SELECT cls.RoomNo,cls.Term_ser,tc.TeacherId,tc.TeacherName,prd.PeriodNo";
        $sql .=",CASE ";
        $sql .="WHEN locate('P',prd.TypeCode) = 1 THEN REPLACE(prd.TypeCode,'P','Period ') ";
        $sql .="WHEN locate('E',prd.TypeCode) = 1 THEN REPLACE(prd.TypeCode,'E','Encoure ') ";
        $sql .="ELSE 'NONE' ";
        $sql .="END AS 'periodtitle' ";
        //$sql .=", CONCAT( cls.RoomNo,'-',periodtitle) as classandprd ";
        $sql .="FROM teacher tc ";
        $sql .="INNER JOIN classroom cls ";
        $sql .="ON tc.TeacherId = cls.TeacherID ";
        $sql .="INNER JOIN classperiod prd ";
        $sql .="ON cls.PeriodNo = prd.PeriodNo ";
        $sql .="WHERE cls.SchoolNo=" . $schoolno;
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;


    }


    function roominfo($selroom,$schoolno,$cdate)
    {

        global $db;

        $pos = strpos($selroom,"-");
	    $roomno = substr($selroom,0,$pos);
	    $periodno = substr($selroom,$pos+1);

        $sql ="SELECT clsrm.SessionNo, clsrm.RoomNo, clsrm.ClassGrade,"; 
        $sql .="clsrm.TeacherID, clsrm.SubjectId, clsrm.PeriodNo,";
        $sql .="sb.SubjectName,clsrm.SchoolNo, Term_ser,tc.TeacherName "; 
        $sql .="FROM classroom clsrm ";
        $sql .="INNER JOIN subject sb ";
        $sql .="ON clsrm.SubjectId = sb.SubjectId ";
        $sql .="INNER JOIN teacher tc ";
        $sql .="ON clsrm.TeacherId = tc.TeacherId ";
        $sql .="WHERE clsrm.RoomNo ='" .  $roomno . "'";
        $sql .=" AND clsrm.PeriodNo=" . $periodno;
        $sql .=" AND clsrm.SchoolNo=" . $schoolno;

        //echo $sql;

       $result = mysqli_query($db,$sql);
       confirm_result_set($result);
       $room_info = mysqli_fetch_assoc($result);
       mysqli_free_result($result);
       return $room_info;


    }

    function roomclass($selroom,$selsubjectid,$selperiod,$schoolno,$cdate)
    {

        global $db;

        $pos = strpos($selroom,"-");
	    $roomno = substr($selroom,0,$pos);
	    $periodno = substr($selroom,$pos+1);

        $sql ="SELECT stdinfo.studentID, stdinfo.studentName, stdinfo.gender,"; 
        $sql .="stdinfo.currentGrade, stdinfo.SchoolNo,";
        $sql .="stdcls.studentsessionNo,stdcls.SessionNo,clsrm.RoomNo,";
        $sql .="clsrm.PeriodNo,clsrm.Term_ser,";
        $sql .="clspr.StartTime,clspr.EndTime ";
        $sql .="FROM studentinfo stdinfo ";
        $sql .="INNER JOIN studentclass stdcls ";
        $sql .="ON stdinfo.studentID = stdcls.StudentId ";
        $sql .="INNER JOIN classroom clsrm ";
        $sql .="ON clsrm.SessionNo = stdcls.SessionNo ";
        $sql .="INNER JOIN classperiod clspr ";
        $sql .="ON clsrm.PeriodNo = clspr.PeriodNo ";
        $sql .="WHERE clsrm.RoomNo = " . db_escape($db,$roomno);
        $sql .=" AND clsrm.PeriodNo = " . db_escape($db,$periodno);
        $sql .=" AND stdinfo.SchoolNo = " . db_escape($db,$schoolno);
        $term_ser = find_currentTerm($schoolno);
        $sql .=" AND clsrm.Term_ser = " . db_escape($db,$term_ser['Term_ser']);
        //$sql .=" AND clsrm.SubjectId = " . db_escape($db,$subjectid);
        //echo $sql;
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
       
        $students = array();

        $count = 0;
        while($rs = mysqli_fetch_assoc($result))
        {
            $students[$count]['studentid'] = $rs['studentID'];
            $students[$count]['studentname'] = $rs['studentName'];
            $students[$count]['starttime'] = $rs['StartTime'];
            $students[$count]['endtime'] = $rs['EndTime'];

            $att = get_student_attendance($rs['studentID'],$rs['SchoolNo'],
                                          $rs['studentsessionNo'],$cdate);
            if ($att) {
                $students[$count]['time_attendance'] = $att['Time_attendance'] ;
                $students[$count]['date_ttendance'] = $att['dtatt'];
            } else {

                    $students[$count]['time_attendance'] =  'None';
                    $students[$count]['date_ttendance'] =  'None';

            }
            $students[$count]['studentsessionno'] = $rs['studentsessionNo'];
            $count++;
             

        }

        mysqli_free_result($result);
        return $students;

    }

    function businfo($schoolno)
    {
    
      global $db;

      $sql ="SELECT BusNo, DriverName, SchoolNo, lat, lon, latlondate, latlontime,TripState ";
      $sql .="FROM schoolbus ";
      $sql .=" WHERE SchoolNo=" . $schoolno;
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;


    }

    function businfo_by_date($schoolno,$cdate)
    {
    
      global $db;

      $sql ="SELECT BusNo, DriverName, SchoolNo, lat, lon, latlondate, latlontime,TripState ";
      $sql .="FROM schoolbus ";
      $sql .=" WHERE SchoolNo=" . $schoolno;
      $sql .=" AND date_format(date(latlondate),'%m-%d-%Y') = date_format(date('" . db_escape($db,$cdate) . "'),'%m-%d-%Y') ";      
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      return $result;


    }




    function studnt_in_bus($schoolno,$busno,$cdate,$tripstate)
    {

        global $db;



        $sql ="SELECT studentID, studentName, gender,";
        $sql .="currentGrade, studentRFIDTag,";
        $sql .=" SchoolNo, BusNo ";
        $sql .=" FROM studentinfo stdinfo"; 
        $sql .=" WHERE SchoolNo=" . $schoolno;
        $sql .=" AND BusNo =" . $busno;
        
        
        //echo $sql;
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
       
        $students = array();

        $count = 0;
        while($rs = mysqli_fetch_assoc($result))
        {
            $students[$count]['studentid'] = $rs['studentID'];
            $students[$count]['studentname'] = $rs['studentName'];
  

            $att = get_student_bus_attendance($busno,$schoolno,$cdate,$rs['studentID'],$tripstate);

            if ($att) {
                $students[$count]['time_attendance'] = $att['Time_attendance'] ;
                $students[$count]['date_attendance'] = $att['dtatt'];
            } else {

                    $students[$count]['time_attendance'] =  'None';
                    $students[$count]['date_attendance'] =  'None';

            }
            
            $count++;
             

        }

        mysqli_free_result($result);
        return $students;
  

    }

    function get_student_bus_attendance($busno,$schoolno,$cdate,$id,$tripstate)
    {
        global $db;
        
        $sql ="SELECT Attendance_ser, Time_attendance, ";
        $sql .=" date_format(date(Date_attendance),'%m-%d-%Y') AS dtatt,";
        $sql .="StudentId, SchoolNo";
        $sql .=" FROM roundtripbusattendance ";
        $sql .="WHERE StudentId=" . db_escape($db,$id);
        $sql .=" AND SchoolNo=" . db_escape($db,$schoolno);
        $sql .=" AND BusNo=" . db_escape($db,$busno);
        $sql .=" AND date_format(date(Date_attendance),'%m-%d-%Y') = date_format(date('" . db_escape($db,$cdate) . "'),'%m-%d-%Y') ";
        $sql .=" AND Trip_State=" . db_escape($db,$tripstate);
        
        //echo $sql . '<br />';
        
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);

        
        

        $student_att = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $student_att;

    }

    function isfound()
    {
        return  "style='color:black;'";
    }

    function test()     
    {
        $phpArray = array(
          0 => "Mon", 
          1 => "Tue", 
          2 => "Wed", 
          3 => "Thu",
          4 => "Fri", 
          5 => "Sat",
          6 => "Sun",

        );
        return $phpArray;
    }    

    function findstudentinbus($studentinfo)    
    {
        global $db;

        //$values = explode("-",$studentinfo);

        $sql ="SELECT bus.BusNo, bus.SchoolNo,bus.latlondate,bus.TripState,";
        $sql .="trips.Date_attendance, trips.StudentId, trips.SchoolNo,"; 
        $sql .="trips.BusNo, trips.Trip_State "; 
        $sql .="FROM schoolbus bus ";
        $sql .="INNER JOIN roundtripbusattendance trips ";
        $sql .="ON bus.BusNo = trips.BusNo";
        $sql .=" AND bus.SchoolNo = trips.SchoolNo";
        $sql .=" AND bus.latlondate = trips.Date_attendance";
        $sql .=" AND bus.TripState = trips.Trip_State";
        $sql .=" WHERE trips.StudentId=". db_escape($db,$studentinfo);

        $result = mysqli_query($db, $sql);
        //echo mysqli_num_rows($result);
        confirm_result_set($result);
        $student_bus = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $student_bus;


    }                    

?>
