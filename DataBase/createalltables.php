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

//    INSERT YOUR TABLES HERE


    // use exec() because no results are returned

    echo "Tables created successfully";
    $database->closeConnection();
}
catch (PDOException $e)
{
    echo "There is some problem in connection: " . $e->getMessage();
}
?>
