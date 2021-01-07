<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

function msg($success,$status,$message,$extra = []){
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message
    ],$extra);
}

require __DIR__.'/../classes/Database.php';

$db_connection = new Database();
$conn = $db_connection->dbConnection();


$returnData = [];

try{
            
    $blogs_query = "SELECT * FROM `blogs` WHERE `is_active`=:is_active ORDER BY id DESC LIMIT 3";
    $stmt = $conn->prepare($blogs_query);
    $stmt->bindValue(':is_active', 1);
    $stmt->execute();
    
    if($stmt->rowCount()):
      $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

     $returnData = [
       'success' => 1,
       'message' => 'Blogs List',
       'data' => $blogs,
        ];

    else:
                $returnData = msg(0,422,'Data not found');
            endif;
        }
        catch(PDOException $e){
            $returnData = msg(0,500,$e->getMessage());
    }

echo json_encode($returnData);