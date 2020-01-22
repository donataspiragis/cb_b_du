<?php
namespace DataBase;
include_once 'Connection.php';
try
{
    $database = new Connection();
    $db = $database->openConnection();

    //Examople of table
//    $sql = "CREATE TABLE `languages` (
//      `id` int(11) NOT NULL,
//      `Tag` varchar(255) NOT NULL,
//      `Title` varchar(255) NOT NULL,
//      `CreationDate` DATETIME,
//      `Archived` BOOLEAN,
//      PRIMARY KEY(`id`)
//    )";
//    $db->exec($sql);

    function getName($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }


    $date = "2020-12-12";
$sql = '';
    //INSERT YOUR TABLES HERE
    for($i = 0; $i < 10; $i++){
        for($s = 0; $s < 10; $s++){
            $rndvalue[$s] =getName(rand(5,10));
        }
        $sql = "INSERT INTO user(`name`, `surname`, `email`, `password`, `password_reminder`, `role`, `created_on`, `last_log`, `user_discount`)
VALUES ('$rndvalue[0]','$rndvalue[1]','$rndvalue[2]','$rndvalue[3]','$rndvalue[4]','0','$date','$date','0')";
        $db->exec($sql);
    }
    for($i = 0; $i < 10; $i++){
        for($s = 0; $s < 10; $s++){
            $rndvalue[$s] =getName(rand(5,10));
        }
        $sql = "INSERT INTO courses(`name`, `about`, `status`, `picture`, `created_on`, `edited_on`) 
VALUES ('$rndvalue[0]','$rndvalue[1]','true','$rndvalue[2]','$date','$date')";
        $db->exec($sql);
    }
    for($i = 0; $i < 10; $i++){
        for($s = 0; $s < 10; $s++){
            $rndvalue[$s] =getName(rand(5,10));
        }
        $sql = "INSERT INTO lectures(`video_url`, `created_on`) 
VALUES ('$rndvalue[0]','$date')";
        $db->exec($sql);
    }
    for($i = 0; $i < 10; $i++){
        for($s = 0; $s < 10; $s++){
            $rndvalue[$s] =rand(1,8);
        }
        $sql = "INSERT INTO lectureslist(`lecture_id`, `order`, `course_id`) 
VALUES ('$rndvalue[0]','$rndvalue[1]','$rndvalue[2]')";
        $db->exec($sql);
    }
    for($i = 0; $i < 10; $i++){
        for($s = 0; $s < 10; $s++){
            $rndvalue[$s] =rand(1,8);
        }
        $price = rand(18,99);
        $ids = $i + 1;
        $sql = "INSERT INTO offer(`price`, `valid_from`, `valid_to`, `discount_offer`, `created_on`, `course_id`) 
VALUES ('$price','$date','$date','0','$date','$ids')";
        $db->exec($sql);
    }
    for($i = 0; $i < 10; $i++){
        for($s = 0; $s < 10; $s++){
            $rndvalue[$s] =rand(1,8);
        }
        $price = rand(18,99);
        $ids = $i + 1;
        $sql = "INSERT INTO invoices(`price`, `created_on`) 
VALUES ('$price','$date')";
        $db->exec($sql);
    }

    for($i = 0; $i < 10; $i++){
        for($s = 0; $s < 10; $s++){
            $rndvalue[$s] =rand(1,8);
        }
        $off = rand(1,9);
        $uss = rand(1,9);
        $coss = rand(1,9);
        $inv = $i + 1;
        $ids = $i + 1;
        $sql = "INSERT INTO orders(`offer_id`, `user_id`, `course_id`, `invoice_id`, `created_on`) 
VALUES ('$off','$uss','$coss',$inv,'$date')";
        $db->exec($sql);
    }





    // use exec() because no results are returned

    echo "Tables created successfully";
    $database->closeConnection();
}
catch (PDOException $e)
{
    echo "There is some problem in connection: " . $e->getMessage();
}
?>
