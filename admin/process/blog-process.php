<?php
  // INCLUDING DATABASE AND MAKING OBJECT
require __DIR__ . '/../../classes/Database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();
$GLOBALS['conn'] = $conn;

//Create Blog
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if($_POST['action'] == 'delete'){
        deleteBlog();
    }else{
        addUpdateBlog($_POST['edit-id']);
    }
}

function addUpdateBlog($id='')
{
        $filename = '';
        $blog = [];   
        if($id){
            //Get blog detail
            $blog = getBlogDetail($id);
            $filename = $blog['file'];
        }

        if($_FILES['file']['size'] > 0){
            if (0 < $_FILES['file']['error'])
            {
                echo 'Error: ' . $_FILES['file']['error'] . '<br>';
            }
            else
            {
                $oldFileName = ($blog) ? $blog['file'] : '';
                if($oldFileName){
                    unlink('../uploads/blogs/' . $oldFileName);
                }
                $filename = uniqid() . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], '../uploads/blogs/' . $filename);
            }
        }

        $title = filter_var($_POST["title"], FILTER_SANITIZE_STRING);
        $description = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
      //  $file = filter_var($_FILES['file']['name'], FILTER_SANITIZE_STRING);

        $errors = [];

        if (empty($title))
        {
            $errors['title'] = "Title is required";
        }

        if (empty($description))
        {
            $errors['description'] = "Description is required";
        }

        // if (empty($filename))
        // {
        //     $errors['file'] = "File is required";
        // }

        if (empty($errors))
        {
           $conn = $GLOBALS['conn'];
            try
            {
                if(!$id){
                    //Create new blog
                    $date = date('Y-m-d h:i:s');
                    $insert_query = "INSERT INTO `blogs`(`title`,`description`,`file`,`created_at`) VALUES(:title,:description,:file,:created_date)";

                    $insert_stmt = $conn->prepare($insert_query);

                    // DATA BINDING
                    $insert_stmt->bindValue(':title', htmlspecialchars(strip_tags($title)) , PDO::PARAM_STR);
                    $insert_stmt->bindValue(':description', $description, PDO::PARAM_STR);
                    $insert_stmt->bindValue(':file', $filename, PDO::PARAM_STR);
                    $insert_stmt->bindValue(':created_date', $date, PDO::PARAM_STR);

                    $insert_stmt->execute();
                    header("Location: ../blog-list.php");
                }else{
                    //Update blog
                    $data = [
                         'title' => $title,
                         'description' => $description,
                         'file' => $filename,
                         'id' => $id
                        ];
                    $update_query = "UPDATE blogs SET title = :title, description = :description, file = :file WHERE id = :id";
                    $stmt = $conn->prepare($update_query)->execute($data);
                    header("Location: ../blog-list.php");  
                }
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
    }
}

function getBlogs(){
    $conn = $GLOBALS['conn'];
    $blogs_query = "SELECT * FROM `blogs` WHERE `is_active`=:is_active ORDER BY id DESC";
    $stmt = $conn->prepare($blogs_query);
    $stmt->bindValue(':is_active', 1);
    $stmt->execute();
    $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $blogs;
}

function deleteBlog(){
     $id = $_POST['id'];
     $data = [
         'is_active' => 0,
         'id' => $id,
     ];
     $query = "UPDATE blogs SET is_active = :is_active WHERE id = :id";
     $stmt = $GLOBALS['conn']->prepare($query)->execute($data);
     echo 1;
}

function getBlogDetail($id){
    $conn = $GLOBALS['conn'];
    $blog_query = "SELECT * FROM `blogs` WHERE `id`=:id";
    $stmt = $conn->prepare($blog_query);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $blog = $stmt->fetch(PDO::FETCH_ASSOC);
    return $blog;
}