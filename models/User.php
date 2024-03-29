<?php

class User
{
    public static function formValidate($login, $email, $password, $repeatPassword, $messageSelf, $captcha, $pseudonym)
        /**
         * проводим валидацию @login, @email, @password, @message, @captcha, @pseudonym
         */
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
        /**
         * проверка @pseudonym на занятость
         */
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT userPseudonym FROM `blog.loc`.users WHERE userPseudonym = '$pseudonym'")->fetch();

        return $result;
    }

    private static function checkEmail($email)
        /**
         * проверка @email На занятость
         */
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT userEmail FROM `blog.loc`.users WHERE userEmail = '$email'")->fetch();

        return $result;
    }

    private static function checkLogin($login)
        /**
         * проверка @login На занятость
         */
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT userLogin FROM `blog.loc`.users WHERE userLogin = '$login'")->fetch();

        return $result;
    }

    public static function register($userName, $userSurname, $userLogin, $userEmail, $userPassword, $userMessageSelf, $userPseudonym, $finalImageName)
        /**
         * регистрация, хешируем пароль, создаем запись в таблице пользователей
         */
    {
        $db = DB::dbConnection();

        $userPassword = md5(md5($userPassword));

        $sql = "INSERT INTO `blog.loc`.users (userName, userSurname, userLogin, userEmail, userPassword, userMessageSelf, userPseudonym, userAvatar) VALUES (:userName, :userSurname, :userLogin, :userEmail, :userPassword, :userMessageSelf, :userPseudonym, :userAvatar)";
        $result = $db->prepare($sql);

        $result->bindParam(':userName', $userName, PDO::PARAM_STR);
        $result->bindParam(':userSurname', $userSurname, PDO::PARAM_STR);
        $result->bindParam(':userLogin', $userLogin, PDO::PARAM_STR);
        $result->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
        $result->bindParam(':userPassword', $userPassword, PDO::PARAM_STR);
        $result->bindParam(':userMessageSelf', $userMessageSelf, PDO::PARAM_STR);
        $result->bindParam(':userPseudonym', $userPseudonym, PDO::PARAM_STR);
        $result->bindParam(':userAvatar', $finalImageName, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function getUserId($login)
        /**
         * получаем @userId по его @login
         */
    {
        $db = DB::dbConnection();
        $id = '';

        $result = $db->query("SELECT id FROM `blog.loc`.users WHERE userLogin = '$login'")->fetch();
        $id = $result['id'];

        return $id;
    }

    public static function userAuth($login)
        /**
         * проводим авторизацию, получаем @userId, @userLogin, @userPseudonym
         */
    {
        $_SESSION['userId'] = self::getUserId($login);
        $_SESSION['userLogin'] = $login;
        $_SESSION['userPseudonym'] = self::getUserPseudonym($login);
    }

    public static function checkAuth()
        /**
         * проверяет авторизован ли пользователь
         */
    {
        if (!empty($_SESSION['userId']) OR !empty($_SESSION['userLogin'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkLoginData($login, $password)
        /**
         * проверка введенных данных пользователя для входа. Если все верно то вызывается метод авторизации.
         */
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
        /**
         * получает @pseudonym пользователя по его @login
         */
    {
        $db = DB::dbConnection();
        $id = '';

        $result = $db->query("SELECT userPseudonym FROM `blog.loc`.users WHERE userLogin = '$login'")->fetch();
        $id = $result['userPseudonym'];

        return $id;
    }

    public static function getUserData()
        /**
         * получаем данные о пользователе @name, @surname, @login, @email, @pseudonym
         */
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT userName, userSurname, userLogin, userEmail, userPseudonym, userMessageSelf, userAvatar FROM `blog.loc`.users WHERE id = '{$_SESSION['userId']}'")->fetch();

        return $result;
    }

    public static function changeData($userName, $userSurname, $userMessageSelf)
        /**
         * меняем данные пользователя - @name, @surname, @messageSelf
         */
    {
        $db = DB::dbConnection();
        $sql = "UPDATE `blog.loc`.users SET userName = :userName, userSurname = :userSurname, userMessageSelf = :userMessageSelf WHERE id = '{$_SESSION['userId']}'";

        $result = $db->prepare($sql);

        $result->bindParam(':userName', $userName, PDO::PARAM_STR);
        $result->bindParam(':userSurname', $userSurname, PDO::PARAM_STR);
        $result->bindParam(':userMessageSelf', $userMessageSelf, PDO::PARAM_STR);

        return $result->execute();

    }

    public static function validateMessage($userMessageSelf)
        /**
         * проверка @messageSelf
         */
    {
        $errors = [];

        if (strlen($userMessageSelf) < 20) {
            $errors[] = 'Please tell us more about yourself. It will be very interesting for us!';
        }

        return $errors;
    }

    public static function getUserPublication($pseudonym)
        /**
         * получаем публикации пользователя по его @pseudonym
         */
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
        /**
         * валидация @password при замене пароля
         */
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
        /**
         * метод изменяющий пароль
         */
    {
        $db = DB::dbConnection();
        $password = md5(md5($password));

        $sql = "UPDATE `blog.loc`.users SET userPassword = :userPassword WHERE id = '{$_SESSION['userId']}'";
        $result = $db->prepare($sql);

        $result->bindParam(':userPassword', $password, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function createMessage($options)
        /**
         * метод для отображения блоков внутри html странички личного кабинет, в @options автоматически попадает часть из url по типу того, что хотим заменить. На основе этого строится итоговый @message для пользователя
         */
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

        if($options == 'changeAvatar'){
            $_SESSION['message'] = 'Your avatar has been successfully changed. (please wait 3 seconds, a redirect will occur)';
            $message = $_SESSION['message'];
        }

        unset($_SESSION['message']);

        return $message;
    }

    public static function validateLogin($login)
        /**
         * валидация @login
         */
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
        /**
         * изменение @login
         */
    {
        $db = DB::dbConnection();

        $sql = "UPDATE `blog.loc`.users SET userLogin = :userLogin WHERE id = '{$_SESSION['userId']}'";

        $result = $db->prepare($sql);
        $result->bindParam(':userLogin', $login, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function validateEmail($email)
        /**
         * валидация @email
         */
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
        /**
         * изменение @email
         */
    {
        $db = DB::dbConnection();

        $sql = "UPDATE `blog.loc`.users SET userEmail = :userEmail WHERE id = '{$_SESSION['userId']}'";

        $result = $db->prepare($sql);
        $result->bindParam(':userEmail', $email, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function validateArticle($stateName, $stateDescription, $state)
        /**
         * проверка статьи, на кол-во символов, имя, допустимые символы, и проверка загружаемой картинки.
         */
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
        /**
         * проверка @stateName На занятость
         */
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT stateName FROM `blog.loc`.news WHERE stateName = '$stateName'")->fetch();

        return $result;
    }

    public static function addArticle($stateName, $stateDescription, $state, $stateCategory, $finalImageName)
        /**
         * метод, добавляющий статью в базу данных
         */
    {
        $db = DB::dbConnection();
        $stateDate = date("Y-m-d", time());

        $sql = "INSERT INTO `blog.loc`.news (author, state, stateName, stateDescription, stateDate, stateCategory, imagePath) VALUES (:author, :state, :stateName, :stateDescription, :stateDate, :stateCategory, :finalImageName)";
        $result = $db->prepare($sql);

        $result->bindParam(':author', $_SESSION['userPseudonym'], PDO::PARAM_STR);
        $result->bindParam(':state', $state, PDO::PARAM_STR);
        $result->bindParam(':stateName', $stateName, PDO::PARAM_STR);
        $result->bindParam(':stateDescription', $stateDescription, PDO::PARAM_STR);
        $result->bindParam(':stateDate', $stateDate, PDO::PARAM_STR);
        $result->bindParam(':stateCategory', $stateCategory, PDO::PARAM_STR);
        $result->bindParam(':finalImageName', $finalImageName, PDO::PARAM_STR);

        if($result->execute()){
            $id = $db->lastInsertId();
            return $id;
        } else {
            return false;
        }
    }

    public static function getAuthorId($author)
        /**
         * получаем @id автора по @author
         */
    {
        $db = DB::dbConnection();
        $id = '';

        $result = $db->query("SELECT id FROM `blog.loc`.users WHERE userPseudonym = '$author'")->fetch();
        $id = $result['id'];

        return $id;
    }

    public static function getProfileUserData($id)
        /**
         * получаем данные профиля @name, @surname, @email, @pseudonym, @messageSelf, @avatar
         */
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT userName, userSurname, userEmail, userPseudonym, userMessageSelf, userAvatar FROM `blog.loc`.users WHERE id = '$id'")->fetch();

        if(empty($result)){
            return false;
        }

        return $result;
    }

    public static function createLikesTable($pseudonym)
        /**
         * создание таблицы лайков по @pseudonym пользователя
         */
    {
        $db = DB::dbConnection();
        $query = "CREATE TABLE `blog.loc_likes`.`{$pseudonym}_likes` ( 
                  `id` INT NOT NULL AUTO_INCREMENT ,
                  `news_id` INT NOT NULL UNIQUE , 
                  `user_likes` INT NOT NULL DEFAULT '0' ,
                   PRIMARY KEY (`id`))
                   ENGINE = InnoDB;";

        $db->query($query);
    }

    public static function createCommentsTable($tableId)
        /**
         * создание таблицы комментариев по @tableId статьи
         */
    {
        $db = DB::dbConnection();
        $query = "CREATE TABLE `blog.loc_comments`.`{$tableId}_comments` (
                  `id` INT NOT NULL AUTO_INCREMENT ,
                  `author` VARCHAR(255) NOT NULL ,
                  `comment` TEXT NOT NULL ,
                  `publishedDate` DATETIME NOT NULL ,
                  `status` INT NULL DEFAULT 1 , 
                  PRIMARY KEY (`id`))
                  ENGINE = InnoDB; ";

        $db->query($query);
    }

    public static function getPublicationId($stateName)
        /**
         * получаем @id публикации по ее @stateName
         */
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT id FROM `blog.loc`.news WHERE stateName = '$stateName'")->fetch();
        $id = $result['id'];

        return $id;
    }

    public static function editValidateArticle($editStateDescription, $editState)
        /**
         * проверка изминений статьи и картинки при редактировании
         */
    {
        $errors = [];

        if(preg_match('#^[\w\s]{4,255}$#', $editStateDescription) == false) {
            $errors[] = 'For the description of the article, only Latin letters and numbers are allowed.';
        }

        if(strlen($editStateDescription) < 4){
            $errors[] = 'Short description of the article (less than 4 characters).';
        }

        if(strlen($editStateDescription) > 255){
            $errors[] = 'Too long article description (more than 255 characters).';
        }

        if(strlen($editState) < 300){
            $errors[] = 'Too short article (less than 300 characters).';
        }

        if(strlen($editState) > 10000){
            $errors[] = 'Too long article (more than 10000 characters)';
        }
        return $errors;
    }

    public static function editArticle($editStateDescription, $editState, $id, $finalImageName)
        /**
         * изминение статьи пользователем
         */
    {
        $db = DB::dbConnection();

        if($finalImageName != false) {
            $sql = "UPDATE `blog.loc`.news SET stateDescription = :editStateDescription, state = :editState, imagePath = :finalImagePath WHERE id = '$id'";
            $result = $db->prepare($sql);

            $result->bindParam(':editStateDescription', $editStateDescription, PDO::PARAM_STR);
            $result->bindParam(':editState', $editState, PDO::PARAM_STR);
            $result->bindParam(':finalImagePath', $finalImageName, PDO::PARAM_STR);

        } else {
            $sql = "UPDATE `blog.loc`.news SET stateDescription = :editStateDescription, state = :editState WHERE id = '$id'";
            $result = $db->prepare($sql);

            $result->bindParam(':editStateDescription', $editStateDescription, PDO::PARAM_STR);
            $result->bindParam(':editState', $editState, PDO::PARAM_STR);
        }

        if($result->execute()){
            return true;
        } else {
            return false;
        }
    }

    public static function getUserEmail()
        /**
         * получаем @email авторизованного пользователя
         */
    {
        if(self::checkAuth()){
            $db = DB::dbConnection();
            $sql = "SELECT userEmail FROM `blog.loc`.users WHERE userPseudonym='{$_SESSION['userPseudonym']}'";
            $result = $db->query($sql)->fetch();
            return $result['userEmail'];
        } else {
            return false;
        }
    }

    public static function validateEmailForContact($email)
        /**
         * валидация введенного @email для обратной связи
         */
    {
        $errors = [];

        if (filter_var($email, FILTER_VALIDATE_EMAIL) != true) {
            $errors[] = 'Incorrect email.';
        }

        return $errors;
    }

    public static function uploadImage($tmpImage, $imageName, $imageFormat)
        /**
         * метод перемещающий загруженный файл
         */
    {
        move_uploaded_file($tmpImage, ROOT . '/views/images/' . $imageName . $imageFormat);
    }

    private static function checkFileName($finalImageName, $fileType)
        /**
         * проверка @fileName для загружаемого файла
         */
    {
        $db = DB::dbConnection();

        if($fileType == 'image'){
            $sql = "SELECT imagePath FROM `blog.loc`.news WHERE imagePath = '$finalImageName'";
        } elseif($fileType == 'avatar'){
            $sql = "SELECT userAvatar FROM `blog.loc`.users WHERE userAvatar = '$finalImageName'";
        }
        $result = $db->query($sql)->fetch();
        return $result;
    }

    public static function getUserAvatar($author)
        /**
         * получаем аватарку пользователя
         */
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT userAvatar FROM `blog.loc`.users WHERE userPseudonym = '$author'")->fetch();

        return $result['userAvatar'];
    }

    public static function fileValidate( $tmpImage, $imageSize, $finalImageName, $fileUpload, $imageType)
        /**
         * проверка файла
         */
    {
        $errors = [];
        if($fileUpload) {
            $file = finfo_open(FILEINFO_MIME_TYPE); //создаем ресурс файл инфо
            $mime = (string)finfo_file($file, $tmpImage); //получаем mime тип

            if (strpos($mime, 'image') === false) { //проверяем Mime Тип
                $errors[] = 'Only image files can be uploaded';
            }

            //проверяем допустимые размеры картинки
            $limitBytes = 1024 * 1024 * 5;
            if($imageType == 'image') {
                $limitWidth = 1500;
                $limitHeight = 1000;
            } elseif ($imageType == 'avatar'){
                $limitWidth = 256;
                $limitHeight = 256;
            }

            if (filesize($tmpImage) > $limitBytes) {
                $errors[] = 'Image size must not exceed 5 MB.';
            }

            if ($imageSize[1] > $limitHeight) {
                $errors[] = "Image height should not exceed $limitHeight pixels.";
            }

            if ($imageSize[0] > $limitWidth) {
                $errors[] = "Image width should not exceed $limitWidth pixels.";
            }

            if (self::checkFileName($finalImageName, $imageType)) {
                $errors[] = 'A file with the same name already exists. Please rename the file and try uploading again';
            }
        }
        return $errors;
    }

    public static function changeAvatar($filePath)
        /**
         * метод замены аватара пользователя
         */
    {
        $db = DB::dbConnection();

        $sql = "UPDATE `blog.loc`.users SET userAvatar = :userAvatar WHERE id = '{$_SESSION['userId']}'";

        $result = $db->prepare($sql);
        $result->bindParam(':userAvatar', $filePath, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function deleteImageWhileEdit($id, $imageType)
        /**
         * метод удаляющий @stateImage при редактировании профиля или статьи
         */
    {
        $db = DB::dbConnection();
        $checkImage = self::checkImageOnDefault($id, $imageType);

        if($imageType == 'avatar') {
            if($checkImage == 'noAvatar.jpg') {
                return false;
            } else {
                $sql = "SELECT userAvatar FROM `blog.loc`.users WHERE id = '$id'";
                $result = $db->query($sql)->fetch();
                $filePath = $result['userAvatar'];
                $sql = "UPDATE `blog.loc`.users SET userAvatar = 'noAvatar.jpg' WHERE id = '$id'";
                $result = $db->query($sql);
                }
            } elseif($imageType == 'image'){
                if($checkImage == 'default.jpg') {
                    return false;
                } else {
                    $sql = "SELECT imagePath FROM `blog.loc`.news WHERE id = '$id'";
                    $result = $db->query($sql)->fetch();
                    $filePath = $result['imagePath'];
                    $sql = $sql = "UPDATE `blog.loc`.news SET imagePath = 'default.jpg' WHERE id = '$id'";
                    $result = $db->query($sql);
                }
        }
        unlink(ROOT . "/views/images/$filePath");
    }

    private static function checkImageOnDefault($id, $type)
        /**
         * проверка картинки на значение 'default'
         */
    {
        $db = DB::dbConnection();
        if($type == 'image') {
            $sql = "SELECT imagePath FROM `blog.loc`.news WHERE id = '$id'";
            $result = $db->query($sql)->fetch();
            return $result['imagePath'];
        }
        if($type == 'avatar'){
            $sql = "SELECT userAvatar FROM `blog.loc`.users WHERE id = '$id'";
            $result = $db->query($sql)->fetch();
            return $result['userAvatar'];
        }
    }

    public static function getBanInfo($userPseudonym)
        /**
         * забанен ли пользователь с @userPseudonym
         */
    {
        $db = DB::dbConnection();
        $sql = "SELECT userPseudonym, banStatus FROM `blog.loc`.bans WHERE userPseudonym ='$userPseudonym'";
        $result = $db->query($sql)->fetch();

        if($result['banStatus'] == '0' or empty($result['banStatus']) or $result['banStatus'] == NULL){
            return false;
        } else {
            return true;
        }
    }
}