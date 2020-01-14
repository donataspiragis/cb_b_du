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
  `about` varchar(26) NOT NULL,
  `status` varchar(26) NOT NULL,
  `picture` varchar(26) NOT NULL,
  `created_on` date NOT NULL,
  `lecture_id` int(11) NOT NULL
)";
$db->exec($sql);
$sql = "CREATE TABLE `lectures` (
  `ID` int(11) NOT NULL,
  `video_url` varchar(26) NOT NULL,
  `order` varchar(26) NOT NULL,
  `created_on` date NOT NULL,
  `some` int(11) NOT NULL
)";
$db->exec($sql);
$sql = "CREATE TABLE `offer` (
  `ID` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `valid_to` int(11) NOT NULL,
  `discount_offer` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
)";
$db->exec($sql);
$sql = "CREATE TABLE `payments` (
  `ID` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_on` date NOT NULL
)";
$db->exec($sql);
$sql = "CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `name` varchar(26) NOT NULL,
  `surname` varchar(26) NOT NULL,
  `email` varchar(26) NOT NULL,
  `password` varchar(26) NOT NULL,
  `role` int(26) NOT NULL,
  `curse_id` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `last_log` date NOT NULL,
  `user_discount` int(11) NOT NULL
)";
$db->exec($sql);



////ALTER

$sql = "ALTER TABLE `courses`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `lecture_id` (`lecture_id`);";
$db->exec($sql);

$sql = "ALTER TABLE `lectures`
  ADD PRIMARY KEY (`ID`);";
$db->exec($sql);
$sql = "ALTER TABLE `offer`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `course_id` (`course_id`);
";
$db->exec($sql);
$sql = "ALTER TABLE `payments`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `user_id` (`offer_id`);";
$db->exec($sql);
$sql = "ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `user_disc_id` (`user_discount`),
  ADD KEY `curse_id` (`curse_id`);";
$db->exec($sql);

$sql = "ALTER TABLE `courses`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
$sql .= "ALTER TABLE `lectures`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
$sql .= "ALTER TABLE `offer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
$sql .= "ALTER TABLE `payments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
$sql .= "ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
$db->exec($sql);


$sql = "ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`lecture_id`) REFERENCES `lectures` (`ID`);";
$db->exec($sql);
$sql = "ALTER TABLE `lectures`
  ADD CONSTRAINT `lectures_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `courses` (`lecture_id`);";
$db->exec($sql);
$sql = "ALTER TABLE `offer`
  ADD CONSTRAINT `offer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `offer_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`ID`);
";
$db->exec($sql);
$sql = "ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`ID`);
";
$db->exec($sql);
$sql = "ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `payments` (`offer_id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`curse_id`) REFERENCES `courses` (`ID`);
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
