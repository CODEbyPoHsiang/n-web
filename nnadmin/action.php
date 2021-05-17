<?php
//Database connection by using PHP PDO
// $username = 'root';
// $password = '';
include("DB.php");
$db=DB::getInstance();

if (isset($_POST["action"])) {
    if ($_POST["action"] == "Load") {
        $statement = $db ->prepare("SELECT * FROM neithnet_post ORDER BY  datetime DESC");
        $statement->execute();
        $result = $statement->fetchAll();
        $output = '';
        $output .= '
        <table class="table table-bordered table-striped" >
            <tr>
            <th width="10%" bgcolor="#5B5B5B">文章類型</th>
            <th width="35%" bgcolor="#5B5B5B">文章主題</th>
            <th width="10%" bgcolor="#5B5B5B">文章狀態</th>
            <th width="15%" bgcolor="#5B5B5B">公告日期</th>
            <th colspan = 3 bgcolor="#5B5B5B">操作</th>
            </tr>
        ';
        foreach ($result as $row) {
            if ($row["is_show"] ==="Yes") {
                $status = "顯示";
            }
            if ($row["is_show"] ==="No") {
                $status ="隱藏";
            }
            if ($row["is_show"] ==="") {
                $status ="未設定";
            }
            
            $output .= '
            <tr>
            <td>'.$row["category"].'</td>
            <td>'.$row["subject"].'</td>
            <td>'.$status.'</td>
            <td>'.$row["datetime"].'</td>
            <td><button type="button" id="'.$row["id"].'" class="btn btn-success btn  info"><i class="fa fa-info-circle" aria-hidden="true"></i>
            詳細</button></td>
            <td><button type="button" id="'.$row["id"].'" class="btn btn-warning btn update "><i class="fas fa-edit"></i>
            編輯</button></td>
            <td><button type="button" id="'.$row["id"].'" class="btn btn-danger btn  delete"><i class="far fa-trash-alt"></i>
            刪除</button></td>
            </tr>
            ';
        }
       
        $output .= '</table>';
        echo $output;
    }

    //新增
    if ($_POST["action"] == "Create") {
        $statement = $db ->prepare("
   INSERT INTO neithnet_post (category, subject, content, datetime, is_show, created_at, updated_at) 
   VALUES (:category, :subject, :content, :datetime, :is_show, DATETIME('now','localtime'), DATETIME('now','localtime'))
  ");
        $result = $statement->execute(
            array(
    ':category' => $_POST["category"],
    ':subject' => $_POST["subject"],
    ':content' => $_POST["content"],
    ':datetime' => $_POST["datetime"],
    ':is_show' => $_POST["is_show"],
   )
        );
        // if (!empty($result)) {
        //     echo 'Data Inserted';
        // }
    }

    //選取
    if ($_POST["action"] == "Select") {
        $output = array();
        $statement = $db ->prepare(
            "SELECT * FROM neithnet_post 
   WHERE id = '".$_POST["id"]."' 
   LIMIT 1"
        );
        $statement->execute();
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $output["category"] = $row["category"];
            $output["subject"] = $row["subject"];
            $output["content"] = $row["content"];
            $output["datetime"] = $row["datetime"];
            $output["is_show"] = $row["is_show"];
        }
        echo json_encode($output);
    }

    //詳細
    if ($_POST["action"] == "Info") {
        $output = array();
        $statement = $db ->prepare(
            "SELECT * FROM neithnet_post 
   WHERE id = '".$_POST["id"]."' 
   LIMIT 1"
        );
        $statement->execute();
        $result = $statement->fetchAll();
        $output = '';
        
        foreach ($result as $row) {
            // if ($row["is_show"] =="Yes") {
            //     $is_show = "顯示";
            // } elseif ($row["is_show"] =="No") {
            //     $is_show = "隱藏";
            // }
        
            
            $output .= '
            <table class="table table-bordered table-striped" >
            <tr>
            <th colspan= 2 bgcolor="#5B5B5B">內容</td>
            </tr>
            <tr>
            <th colspan= 2">'.$row["content"].'</td>
            </tr>
            </table>
            <p class="text-muted"style="text-align:right;">更新時間：'.$row["updated_at"].'</p>
            ';
        }
       
        // echo $output;
        echo html_entity_decode($output);
    }


    //編輯
    if ($_POST["action"] == "Update") {
        $statement = $db ->prepare(
            "UPDATE neithnet_post 
   SET category = :category, subject = :subject, content = :content, datetime = :datetime , is_show = :is_show,  updated_at = DATETIME('now','localtime')
   WHERE id = :id
   "
        );
        $result = $statement->execute(
            array(
    ':category' => $_POST["category"],
    ':subject' => $_POST["subject"],
    ':content' => $_POST["content"],
    ':datetime' => $_POST["datetime"],
    ':is_show' => $_POST["is_show"],
    ':id'   => $_POST["id"]
   )
        );
        // if (!empty($result)) {
        //     echo 'Data Updated';
        // }
    }

    //刪除
    if ($_POST["action"] == "Delete") {
        $statement = $db ->prepare(
            "DELETE FROM neithnet_post WHERE id = :id"
        );
        $result = $statement->execute(
            array(
    ':id' => $_POST["id"]
   )
        );
        // if (!empty($result)) {
        //     echo 'Data Deleted';
        // }
    }
}
