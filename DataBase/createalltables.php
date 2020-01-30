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
$sql = "CREATE TABLE `courses` (
  `ID` int(11) NOT NULL,
  `name` varchar(26) NOT NULL,
  `about` LONGTEXT NOT NULL,
  `status` varchar(26) NOT NULL,
  `picture` TEXT NOT NULL,
  `created_on` DATETIME  NOT NULL,
  `edited_on` DATETIME  NULL
)";
$db->exec($sql);
$sql = "CREATE TABLE `lectures` (
  `ID` int(11) NOT NULL,
  `video_url` LONGTEXT NOT NULL,
  `created_on` DATETIME  NOT NULL
)";
$db->exec($sql);
    $sql = "CREATE TABLE `lectureslist` (
  `ID` int(11) NOT NULL,
`lecture_id` int(11) NOT NULL,
`order_num` varchar(11) NULL,
  `course_id` int(11) NOT NULL
)";
    $db->exec($sql);
$sql = "CREATE TABLE `offer` (
  `ID` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `valid_from` DATETIME ,
  `valid_to` DATETIME ,
  `discount_offer` int(11) NOT NULL,
  `created_on` DATETIME  NOT NULL,
  `course_id` int(11) NOT NULL
)";
$db->exec($sql);
$sql = "CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `course_id` int(26) NOT NULL,
    `invoice_id` int(26) NOT NULL,
    `payment_status` varchar(255) NOT NULL,
  `created_on` DATETIME NOT NULL
)";
$db->exec($sql);
$sql = "CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `name` varchar(26) NOT NULL,
  `surname` varchar(26) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_reminder` varchar(255) NULL ,
  `role` int(11) NOT NULL,
  `created_on` DATETIME  NOT NULL,
  `last_log` DATETIME  NULL,
  `user_discount` int(11) NOT NULL
)";
$db->exec($sql);
    $sql = "CREATE TABLE `all` (
  `ID` int(11) NOT NULL,
    `name` varchar(26) NOT NULL,
  `description` LONGTEXT NOT NULL,
    `price` int(11) NOT NULL,
    `created_on` DATETIME NOT NULL
)";
    $db->exec($sql);
    $sql = "CREATE TABLE `invoices` (
  `ID` int(11) NOT NULL,
    `price` int(11) NOT NULL,
    `created_on` DATETIME NOT NULL
)";
    $db->exec($sql);


////ALTER

$sql = "ALTER TABLE `courses`
  ADD PRIMARY KEY (`ID`);";
$db->exec($sql);

$sql = "ALTER TABLE `lectures`
  ADD PRIMARY KEY (`ID`);";
$db->exec($sql);
    $sql = "ALTER TABLE `lectureslist`
  ADD PRIMARY KEY (`ID`);";
    $db->exec($sql);
$sql = "ALTER TABLE `offer`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `course_id` (`course_id`);
";
$db->exec($sql);
$sql = "ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `invoice_id` (`invoice_id`);";
$db->exec($sql);
$sql = "ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);";
$db->exec($sql);
    $sql = "ALTER TABLE `invoices`
  ADD PRIMARY KEY (`ID`);";
    $db->exec($sql);

$sql = "ALTER TABLE `courses`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
$sql .= "ALTER TABLE `lectures`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
    $sql .= "ALTER TABLE `lectureslist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
$sql .= "ALTER TABLE `offer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
$sql .= "ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
$sql .= "ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
    $sql .= "ALTER TABLE `invoices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
$db->exec($sql);


    $sql = "ALTER TABLE `lectureslist`
  ADD CONSTRAINT `lectureslist_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`ID`),
  ADD CONSTRAINT `lectureslist_ibfk_2` FOREIGN KEY (`lecture_id`) REFERENCES `lectures` (`ID`);";
    $db->exec($sql);
$sql = "ALTER TABLE `offer`
  ADD CONSTRAINT `offer_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`ID`);
";
$db->exec($sql);
$sql = "ALTER TABLE `orders`
    ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`ID`),
        ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`ID`),
    ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `courses` (`ID`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`ID`);
";
$db->exec($sql);



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
