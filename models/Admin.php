<?php

class Admin
{
    public static function checkAdmin()
        /**
         * проверка авторизации админа
         */
    {
        if((!empty($_SESSION['adminId'])) or (!empty($_SESSION['adminLogin']))){
            return true;
        } else {
            return false;
        }
    }

    public static function registerAdmin($login, $pass)
        /**
         * метод регистрации админа
         */
    {
        $db = DB::dbConnection();
        $pass = md5(md5($pass));

        $sql = "INSERT INTO `blog.loc`.admin SET adminLogin = '$login', adminPassword = '$pass'";
        $result = $db->query($sql);
        if($result){
            return true;
        } else {
            return false;
        }
    }

    public static function validateAdminRegister($login, $pass)
        /**
         * валидация регистрации админа
         */
    {
        $errors = [];

        if (strlen($login) < 4) {
            $errors[] = 'Short login (less than 4 characters).';
        }

        if (self::checkAdminLogin($login)) {
            $errors[] = 'Login is already taken.';
        }

        if (preg_match('#^[a-zA-Z][a-zA-Z0-9-_\.]{4,20}$#', $login) == false) {
            $errors[] = 'Only Latin letters and numbers are allowed.';
        }

        if (strlen($pass) < 5 OR mb_strlen($pass) < 5) {
            $errors[] = 'Too short password (less than 5 characters).';
        }
        return $errors;
    }

    private static function checkAdminLogin($login)
        /**
         * проверка на занятость @login для админа
         */
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT adminLogin FROM `blog.loc`.admin WHERE adminLogin = '$login'")->fetch();

        return $result;
    }

    public static function authAdmin($login, $password)
        /**
         * метод авторизации администратора
         */
    {
        $db = DB::dbConnection();
        $password = md5(md5($password));

        $sql = "SELECT id, adminLogin, adminPassword FROM `blog.loc`.admin WHERE adminLogin = '$login' AND adminPassword = '$password'";
        $result = $db->query($sql)->fetch();

        if ($result) {
            $_SESSION['adminId'] = $result['id'];
            $_SESSION['adminLogin'] = $result['adminLogin'];
            return true;
        } else {
            return false;
        }
    }

    public static function getAllCategory()
        /**
         * получаем массив со всеми категориями и данными по категориям
         */
    {
        $db = DB::dbConnection();

        $categories = [];
        $sql = "SELECT * FROM `blog.loc`.category";
        $result = $db->query($sql);

        for($i = 1; $row = $result->fetch(); $i++){
            $categories[$i]['id'] = $row['id'];
            $categories[$i]['categoryName'] = $row['categoryName'];
            $categories[$i]['categoryAvailability'] = $row['categoryAvailability'];
            $categories[$i]['categoryTotalArticles'] = self::getTotalArticlesInCategory($row['categoryName']);
            if($row['categoryAvailability'] == 1){
                $categories[$i]['commandHide'] = 'hide';
                $categories[$i]['iconHide'] = 'icon fa-eye-slash';
            } else {
                $categories[$i]['commandHide'] = 'open';
                $categories[$i]['iconHide'] = 'icon fa-eye';
            }
            if($row['id'] == '8'){
                $categories[$i]['class'] = 'disabled';
            }
        }

        return $categories;
    }

    public static function getTotalArticlesInCategory($categoryName)
        /**
         * получаем общее количество статей в категории
         */
    {
        $db = DB::dbConnection();

        $sql = "SELECT COUNT(stateName) as total FROM `blog.loc`.news WHERE stateCategory = '$categoryName'";
        $result = $db->query($sql)->fetch();

        return $result['total'];
    }

    public static function hideCategory($id)
        /**
         * скрыть категорию по @id и находящиеся в ней статьи,
         * нельзя удалять/открывать/скрывать категорию с @id=8, т.к в неё попадают все статьи после удаления категории.
         */
    {
        if($id == 8){
            return false;
        }

        $db = DB::dbConnection();

        $categoryName = self::getCategoryName($id);

        $sql = "UPDATE `blog.loc`.category SET categoryAvailability = 0 WHERE id = '$id'";
        $db->query($sql);

        $sql = "UPDATE `blog.loc`.news SET status = 0 WHERE stateCategory = '$categoryName'";
        $db->query($sql);
    }

    public static function openCategory($id)
        /**
         * открыть категорию по @id и находящиеся в ней статьи
         * нельзя удалять/открывать/скрывать категорию с @id=8, т.к в неё попадают все статьи после удаления категории.
         */
    {
        if($id == 8){
            return false;
        }

        $db = DB::dbConnection();

        $categoryName = self::getCategoryName($id);

        $sql = "UPDATE `blog.loc`.category SET categoryAvailability = 1 WHERE id = '$id'";
        $db->query($sql);

        $sql = "UPDATE `blog.loc`.news SET status = 1 WHERE stateCategory = '$categoryName'";
        $db->query($sql);
    }

    private static function getCategoryName($id)
        /**
         * получить название категории по ее @id
         */
    {
        $db = DB::dbConnection();

        $sql = "SELECT categoryName FROM `blog.loc`.category WHERE id = '$id'";
        $result = $db->query($sql)->fetch();
        return $result['categoryName'];
    }

    public static function addCategory($categoryName)
        /**
         * добавление новой категории
         */
    {
        $db = DB::dbConnection();

        $sql = "INSERT INTO `blog.loc`.category (categoryName, categoryAvailability) VALUES ('$categoryName', '1')";
        $db->query($sql);
    }

    public static function deleteCategory($id)
        /**
         * удаление категории по @id
         */
    {
        $db = DB::dbConnection();

        $categoryName = self::getCategoryName($id);

        $sql = "UPDATE `blog.loc`.news SET stateCategory = 'deleted' AND status = '0' WHERE stateCategory = '$categoryName'";
        $db->query($sql);

        $sql = "DELETE FROM `blog.loc`.category WHERE id = '$id'";
        $db->query($sql);
    }

    public static function getAllNews()
        /**
         * получить массив со всеми новостями
         */
    {
        $db = DB::dbConnection();

        $sql = "SELECT * FROM `blog.loc`.news";
        $result = $db->query($sql);

        $news = [];
        for($i = 1; $row = $result->fetch(); $i++){
            $news[$i]['id'] = $row['id'];
            $news[$i]['author'] = $row['author'];
            $news[$i]['state'] = $row['state'];
            $news[$i]['stateName'] = $row['stateName'];
            $news[$i]['stateDescription'] = $row['stateDescription'];
            $news[$i]['stateDate'] = $row['stateDate'];
            $news[$i]['stateCategory'] = $row['stateCategory'];
            $news[$i]['likes'] = $row['likes'];
            $news[$i]['status'] = $row['status'];
            $news[$i]['imagePath'] = $row['imagePath'];
            if($row['status'] == 1){
                $news[$i]['commandHide'] = 'hide';
                $news[$i]['iconHide'] = 'icon fa-eye-slash';
            } else {
                $news[$i]['commandHide'] = 'open';
                $news[$i]['iconHide'] = 'icon fa-eye';
            }
        }
        return $news;
    }

    public static function hideNews($id)
        /**
         * скрыть новость по @id
         */
    {
        $db = DB::dbConnection();

        $sql = "UPDATE `blog.loc`.news SET status = 0 WHERE id = '$id'";
        $db->query($sql);
    }

    public static function openNews($id)
        /**
         * открыть новость по @id
         */
    {
        $db = DB::dbConnection();

        $sql = "UPDATE `blog.loc`.news SET status = 1 WHERE id = '$id'";
        $db->query($sql);
    }

    public static function deleteNews($id)
        /**
         * удалить новость по @id и удалить ВСЮ таблицу с комментариями для этой новости
         * также удаляет загруженную картинку
         */
    {
        $db = DB::dbConnection();

        self::deleteImageById($id);
        $sql = "DELETE FROM `blog.loc`.news WHERE id = '$id'";
        $db->query($sql);
        $sql = "DROP TABLE `blog.loc_comments`.`{$id}_comments`";
        $db->query($sql);
    }

    public static function getNewsById($id)
        /**
         * Получить статью по @id
         */
    {
        $db = DB::dbConnection();

        $sql = "SELECT * FROM `blog.loc`.news WHERE id = '$id'";
        return $db->query($sql)->fetch();
    }

    public static function editNews($stateName, $stateDescription, $author, $date, $category, $state, $finalImageName, $id)
        /**
         * редактирование статьи через админку
         */
    {
        $db = DB::dbConnection();

        if($finalImageName != false) {
            $sql = "UPDATE `blog.loc`.news SET stateName = '$stateName', stateDescription = '$stateDescription', author = '$author', stateDate = '$date', stateCategory = '$category', state = '$state', imagePath = '$finalImageName' WHERE id = '$id'";
            $edit = $db->query($sql);
        }

        if($finalImageName == false){
            $sql = "UPDATE `blog.loc`.news SET stateName = '$stateName', stateDescription = '$stateDescription', author = '$author', stateDate = '$date', stateCategory = '$category', state = '$state' WHERE id = '$id'";
            $edit = $db->query($sql);
        }

        if($edit){
            return true;
        } else {
            return false;
        }
    }

    public static function setDefaultImage($id)
        /**
         * устанавливает значение @imagePath = @default.jpg и удаляет имеющуюся картинку.
         */
    {
        $db = DB::dbConnection();

        $sql = "SELECT imagePath FROM `blog.loc`.news WHERE id = '$id'";
        $result = $db->query($sql)->fetch();
        $image = $result['imagePath'];

        if($image == 'default.jpg'){
            return true;
        } else {
            $sql = "UPDATE `blog.loc`.news SET imagePath = 'default.jpg' WHERE id = '$id'";
            self::deleteImageById($id);
            $db->query($sql);
        }
    }

    private static function deleteImageById($id)
        /**
         * Удаляет @image по @id
         */
    {
        $db = DB::dbConnection();
        $sql = "SELECT imagePath FROM `blog.loc`.news WHERE id = '$id'";
        $result = $db->query($sql)->fetch();
        $filePath = $result['imagePath'];
        unlink(ROOT . "/views/images/$filePath");
    }

    public static function getTotalCommentsAndLikes()
        /**
         * получаем общее количество @comments и @likes для каждой статьи
         */
    {
        $db = DB::dbConnection();

        $likes = [];
        $sql = "SELECT id, likes, stateName FROM `blog.loc`.news";
        $result = $db->query($sql);

        for($i = 1; $row = $result->fetch(); $i++){
            $likes[$i]['id'] = $row['id'];
            $likes[$i]['stateName'] = $row['stateName'];
            $likes[$i]['totalLike'] = $row['likes'];
            $likes[$i]['totalComments'] = self::getTotalComments($row['id']);
        }

        return $likes;
    }

    private static function getTotalComments($id)
        /**
         * получаем общее количество @comments по @id
         */
    {
        $db = DB::dbConnection();
        $sql = "SELECT COUNT(`comment`) as 'comments' FROM `blog.loc_comments`.`{$id}_comments`";
        return $db->query($sql)->fetchColumn();
    }

    public static function setLikes($quantity, $id)
        /**
         * устанавливаем значение @likes для статьи по @id
         */
    {
        $db = DB::dbConnection();
        $sql = "UPDATE `blog.loc`.news SET likes = '$quantity' WHERE id = '$id'";
        $db->query($sql);
    }

    public static function getAllComments($id)
        /**
         * получаем все комментарии по @id
         */
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT * FROM `blog.loc_comments`.`{$id}_comments` ORDER BY `publishedDate` DESC");
            $comments = [];
            for ($i = 0; $row = $result->fetch(); $i++) {
                $comments[$i]['id'] = $row['id'];
                $comments[$i]['author'] = $row['author'];
                $comments[$i]['comment'] = $row['comment'];
                $comments[$i]['publishedDate'] = $row['publishedDate'];
                $comments[$i]['status'] = $row['status'];
                if ($row['status'] == 1) {
                    $comments[$i]['commandHide'] = 'hide';
                    $comments[$i]['iconHide'] = 'icon fa-eye-slash';
                } else {
                    $comments[$i]['commandHide'] = 'open';
                    $comments[$i]['iconHide'] = 'icon fa-eye';
                }
                // $comments[$i]['userId'] = User::getAuthorId($row['author']);
            }
            return $comments;
    }

    public static function openComment($tableId, $commentId)
        /**
         * открыть @comment в @tableId по @id комментария
         */
    {
        $db = DB::dbConnection();

        $sql = "UPDATE `blog.loc_comments`.`{$tableId}_comments` SET `status` = 1 WHERE `id` = '$commentId'";
        $db->query($sql);
    }

    public static function hideComment($tableId, $commentId)
        /**
         * скрыть @comment в @tableId по @id комментария
         */
    {
        $db = DB::dbConnection();

        $sql = "UPDATE `blog.loc_comments`.`{$tableId}_comments` SET `status` = 0 WHERE `id` = '$commentId'";
        $db->query($sql);
    }

    public static function deleteComment($tableId, $commentId)
        /**
         * удалить комментарий по @id
         */
    {
        $db = DB::dbConnection();

        $sql = "DELETE FROM `blog.loc_comments`.`{$tableId}_comments` WHERE `id` = '$commentId'";
        $db->query($sql);
    }

    public static function getAllUsers()
        /**
         * получаем массив со всеми пользователями
         */
    {
        $db = DB::dbConnection();

        $sql = "SELECT * FROM `blog.loc`.users";
        $result = $db->query($sql);

        $users = [];
        for($i = 1; $row = $result->fetch(); $i++){
            $users[$i]['userName'] = $row['userName'];
            $users[$i]['userSurname'] = $row['userSurname'];
            $users[$i]['userId'] = $row['id'];
            $users[$i]['userLogin'] = $row['userLogin'];
            $users[$i]['userEmail'] = $row['userEmail'];
            $users[$i]['userMessageSelf'] = $row['userMessageSelf'];
            $users[$i]['userPseudonym'] = $row['userPseudonym'];
        }
        return $users;
    }

    public static function getUserDetails($userId)
        /**
         * получаем информацию о пользователе
         */
    {
        $db = DB::dbConnection();

        $sql = "SELECT * FROM `blog.loc`.users WHERE id = '$userId'";
        return $db->query($sql)->fetch();
    }

    public static function getUserPosts($userId)
        /**
         * получаем опубликованные новости пользователя
         */
    {
        return true;
    }
}