<?php

class User
{
    public static function formValidate($login, $email, $password, $repeatPassword, $messageSelf, $captcha, $pseudonym)
    {
        $errors = [];

        if (strlen($login) < 4) {
            $errors[] = 'Short login (less than 4 characters).';
        }

        if (self::checkLogin($login)) {
            $errors[] = 'Login is already taken.';
        }

        if (preg_match('#^[a-zA-Z][a-zA-Z0-9-_\.]{4,20}$#', $login) == false) {
            $errors[] = 'Only Latin letters and numbers are allowed.';
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL) != true) {
            $errors[] = 'Incorrect email.';
        }

        if (self::checkEmail($email)) {
            $errors[] = 'The user with the given email is already registered.';
        }

        if ($password != $repeatPassword) {
            $errors[] = 'The passwords you entered do not match.';
        }

        if (strlen($password) < 5 OR mb_strlen($password) < 5) {
            $errors[] = 'Too short password (less than 5 characters).';
        }

        if (strlen($messageSelf) < 20 OR mb_strlen($messageSelf) < 20) {
            $errors[] = 'Please tell us more about yourself. It will be very interesting for us!';
        }

        if (empty($captcha)) {
            $errors[] = 'Confirm that you are not a robot.';
        }

        if (strlen($pseudonym) < 4) {
            $errors[] = 'Short alias (less than 4 characters).';
        }

        if (preg_match('#^[a-zA-Z][a-zA-Z0-9-_\.]{4,20}$#', $pseudonym) == false) {
            $errors[] = 'Only Latin letters and numbers are allowed for the alias.';
        }

        if (self::checkPseudonym($pseudonym)) {
            $errors[] = 'The alias you entered is already in use.';
        }

        return $errors;
    }

    private static function checkPseudonym($pseudonym)
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT userPseudonym FROM `blog.loc`.users WHERE userPseudonym = '$pseudonym'")->fetch();

        return $result;
    }

    private static function checkEmail($email)
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT userEmail FROM `blog.loc`.users WHERE userEmail = '$email'")->fetch();

        return $result;
    }

    private static function checkLogin($login)
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT userLogin FROM `blog.loc`.users WHERE userLogin = '$login'")->fetch();

        return $result;
    }

    public static function register($userName, $userSurname, $userLogin, $userEmail, $userPassword, $userMessageSelf, $userPseudonym)
    {
        $db = DB::dbConnection();

        $userPassword = md5(md5($userPassword));

        $sql = "INSERT INTO `blog.loc`.users (userName, userSurname, userLogin, userEmail, userPassword, userMessageSelf, userPseudonym) VALUES (:userName, :userSurname, :userLogin, :userEmail, :userPassword, :userMessageSelf, :userPseudonym)";
        $result = $db->prepare($sql);

        $result->bindParam(':userName', $userName, PDO::PARAM_STR);
        $result->bindParam(':userSurname', $userSurname, PDO::PARAM_STR);
        $result->bindParam(':userLogin', $userLogin, PDO::PARAM_STR);
        $result->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
        $result->bindParam(':userPassword', $userPassword, PDO::PARAM_STR);
        $result->bindParam(':userMessageSelf', $userMessageSelf, PDO::PARAM_STR);
        $result->bindParam(':userPseudonym', $userPseudonym, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function getUserId($login)
    {
        $db = DB::dbConnection();
        $id = '';

        $result = $db->query("SELECT id FROM `blog.loc`.users WHERE userLogin = '$login'")->fetch();
        $id = $result['id'];

        return $id;
    }

    public static function userAuth($login)
    {
        $_SESSION['userId'] = self::getUserId($login);
        $_SESSION['userLogin'] = $login;
        $_SESSION['userPseudonym'] = self::getUserPseudonym($login);
    }

    public static function checkAuth()
    {
        if (!empty($_SESSION['userId']) OR !empty($_SESSION['userLogin'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkLoginData($login, $password)
    {
        $db = DB::dbConnection();

        $sql = "SELECT id, userLogin, userPassword FROM `blog.loc`.users WHERE userLogin = :login AND userPassword = :password";
        $result = $db->prepare($sql);

        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();

        $in = $result->fetch();

        if ($in) {
            self::userAuth($login);
            return true;
        }

        return false;
    }

    private static function getUserPseudonym($login)
    {
        $db = DB::dbConnection();
        $id = '';

        $result = $db->query("SELECT userPseudonym FROM `blog.loc`.users WHERE userLogin = '$login'")->fetch();
        $id = $result['userPseudonym'];

        return $id;
    }

    public static function getUserData()
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT userName, userSurname, userLogin, userEmail, userPseudonym, userMessageSelf FROM `blog.loc`.users WHERE id = '{$_SESSION['userId']}'")->fetch();

        return $result;
    }

    public static function changeData($userName, $userSurname, $userMessageSelf)
    {
        $db = DB::dbConnection();
        $sql = "UPDATE `blog.loc`.users SET userName = :userName, userSurname = :userSurname, userMessageSelf = :userMessageSelf WHERE id = '{$_SESSION['userId']}'";

        $result = $db->prepare($sql);

        $result->bindParam(':userName', $userName, PDO::PARAM_STR);
        $result->bindParam(':userSurname', $userSurname, PDO::PARAM_STR);
        $result->bindParam(':userMessageSelf', $userMessageSelf, PDO::PARAM_STR);

        return $result->execute();

    }

    public static function validateMessage($userMessageSelf){
        $errors = [];

        if (strlen($userMessageSelf) < 20) {
            $errors[] = 'Please tell us more about yourself. It will be very interesting for us!';
        }

        return $errors;
    }

    public static function getUserPublication($pseudonym)
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT id, stateName, stateDescription, stateCategory FROM `blog.loc`.news WHERE author = '$pseudonym' AND status = '1'");

        $userPublications = [];

        for($i = 0; $row = $result->fetch(); $i++){
            $userPublications[$i]['id'] = $row['id'];
            $userPublications[$i]['stateName'] = $row['stateName'];
            $userPublications[$i]['stateDescription'] = substr($row['stateDescription'], '0', '30') . '...';
            $userPublications[$i]['stateCategory'] = $row['stateCategory'];
        }
        return $userPublications;
    }

    public static function validateChangePassword($password, $repeatPassword)
    {
        $errors = [];

        if ($password != $repeatPassword) {
            $errors[] = 'The passwords you entered do not match.';
        }

        if (strlen($password) < 5 OR mb_strlen($password) < 5) {
            $errors[] = 'Too short password (less than 5 characters).';
        }

        return $errors;
    }

    public static function changePassword($password)
    {
        $db = DB::dbConnection();
        $password = md5(md5($password));

        $sql = "UPDATE `blog.loc`.users SET userPassword = :userPassword WHERE id = '{$_SESSION['userId']}'";
        $result = $db->prepare($sql);

        $result->bindParam(':userPassword', $password, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function createMessage($options)
    {
        if($options == 'changeForm'){
            $_SESSION['message'] = 'Your data has been successfully changed. (please wait 3 seconds, a redirect will occur)';
            $message = $_SESSION['message'];
        }

        if($options == 'changePassword'){
            $_SESSION['message'] = 'Your password has been successfully changed. (please wait 3 seconds, a redirect will occur)';
            $message = $_SESSION['message'];
        }

        if($options == 'changeLogin'){
            $_SESSION['message'] = 'Your login has been successfully changed. (please wait 3 seconds, a redirect will occur)';
            $message = $_SESSION['message'];
        }

        if($options == 'changeEmail'){
            $_SESSION['message'] = 'Your email has been successfully changed. (please wait 3 seconds, a redirect will occur)';
            $message = $_SESSION['message'];
        }

        unset($_SESSION['message']);

        return $message;
    }

    public static function validateLogin($login)
    {
        $errors = [];

        if (strlen($login) < 4) {
            $errors[] = 'Short login (less than 4 characters).';
        }

        if (self::checkLogin($login)) {
            $errors[] = 'Login is already taken.';
        }

        if (preg_match('#^[a-zA-Z][a-zA-Z0-9-_\.]{4,20}$#', $login) == false) {
            $errors[] = 'Only Latin letters and numbers are allowed.';
        }

        return $errors;
    }

    public static function changeLogin($login)
    {
        $db = DB::dbConnection();

        $sql = "UPDATE `blog.loc`.users SET userLogin = :userLogin WHERE id = '{$_SESSION['userId']}'";

        $result = $db->prepare($sql);
        $result->bindParam(':userLogin', $login, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function validateEmail($email)
    {
        $errors = [];

        if (filter_var($email, FILTER_VALIDATE_EMAIL) != true) {
            $errors[] = 'Incorrect email.';
        }

        if (self::checkEmail($email)) {
            $errors[] = 'The user with the given email is already registered.';
        }

        return $errors;
    }

    public static function changeEmail($email)
    {
        $db = DB::dbConnection();

        $sql = "UPDATE `blog.loc`.users SET userEmail = :userEmail WHERE id = '{$_SESSION['userId']}'";

        $result = $db->prepare($sql);
        $result->bindParam(':userEmail', $email, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function validateArticle($stateName, $stateDescription, $state)
    {
        $errors = [];

        if(preg_match('#^[\w\s]{4,30}$#', $stateName) == false) {
            $errors[] = 'For the title of the article only Latin letters and numbers are allowed.';
        }

        if(strlen($stateName) < 4){
            $errors[] = 'Short title of the article (less than 4 characters).';
        }

        if(strlen($stateName) > 30){
            $errors[] = 'Too long article title (more than 30 characters).';
        }

        if(self::checkStateName($stateName)){
            $errors[] = 'This article title is already in use';
        }

        if(preg_match('#^[\w\s]{4,255}$#', $stateDescription) == false) {
            $errors[] = 'For the description of the article, only Latin letters and numbers are allowed.';
        }

        if(strlen($stateDescription) < 4){
            $errors[] = 'Short description of the article (less than 4 characters).';
        }

        if(strlen($stateDescription) > 255){
            $errors[] = 'Too long article description (more than 255 characters).';
        }

        if(strlen($state) < 300){
            $errors[] = 'Too short article (less than 300 characters).';
        }

        if(strlen($state) > 10000){
            $errors[] = 'Too long article (more than 10000 characters)';
        }

        return $errors;
    }

    private static function checkStateName($stateName)
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT stateName FROM `blog.loc`.news WHERE stateName = '$stateName'")->fetch();

        return $result;
    }

    public static function addArticle($stateName, $stateDescription, $state, $stateCategory)
    {
        $db = DB::dbConnection();
        $stateDate = date("Y-m-d", time());

        $sql = "INSERT INTO `blog.loc`.news (author, state, stateName, stateDescription, stateDate, stateCategory) VALUES (:author, :state, :stateName, :stateDescription, :stateDate, :stateCategory)";
        $result = $db->prepare($sql);

        $result->bindParam(':author', $_SESSION['userPseudonym'], PDO::PARAM_STR);
        $result->bindParam(':state', $state, PDO::PARAM_STR);
        $result->bindParam(':stateName', $stateName, PDO::PARAM_STR);
        $result->bindParam(':stateDescription', $stateDescription, PDO::PARAM_STR);
        $result->bindParam(':stateDate', $stateDate, PDO::PARAM_STR);
        $result->bindParam(':stateCategory', $stateCategory, PDO::PARAM_STR);

        if($result->execute()){
            $id = $db->lastInsertId();
            return $id;
        } else {
            return false;
        }
    }

    public static function getAuthorId($author)
    {
        $db = DB::dbConnection();
        $id = '';

        $result = $db->query("SELECT id FROM `blog.loc`.users WHERE userPseudonym = '$author'")->fetch();
        $id = $result['id'];

        return $id;
    }

    public static function getProfileUserData($id)
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT userName, userSurname, userEmail, userPseudonym, userMessageSelf FROM `blog.loc`.users WHERE id = '$id'")->fetch();

        if(empty($result)){
            return false;
        }

        return $result;
    }

    public static function createLikesTable($pseudonym)
    {
        $db = DB::dbConnection();
        $query = "CREATE TABLE `blog.loc`.`{$pseudonym}_likes` ( 
                  `id` INT NOT NULL AUTO_INCREMENT ,
                  `news_id` INT NOT NULL , 
                  `user_likes` INT NOT NULL DEFAULT '0' ,
                   PRIMARY KEY (`id`))
                   ENGINE = InnoDB;";

        $db->query($query);
    }

    public static function createCommentsTable($tableId)
    {
        $db = DB::dbConnection();
        $query = "CREATE TABLE `blog.loc`.`{$tableId}_comments` (
                  `id` INT NOT NULL AUTO_INCREMENT ,
                  `author` VARCHAR(255) NOT NULL ,
                  `comment` TEXT NOT NULL ,
                  `publishedDate` DATE NOT NULL ,
                  `status` INT NULL DEFAULT 1 , 
                  PRIMARY KEY (`id`))
                  ENGINE = InnoDB; ";

        $db->query($query);
    }

    public static function getPublicationId($stateName)
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT id FROM `blog.loc`.news WHERE stateName = '$stateName'")->fetch();
        $id = $result['id'];

        return $id;
    }
}