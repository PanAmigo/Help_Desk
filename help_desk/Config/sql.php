<?php
  $create[]="
  CREATE TABLE `Company` (
    `Id_company` int(11) NOT NULL,
    `name` varchar(9999) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;";

  $create[].="
  CREATE TABLE `Status_type` (
    `Id_status` int(11) NOT NULL,
    `status` varchar(1000) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;";

  $create[].="
  CREATE TABLE `Ticket` (
    `Id_ticket` int(11) NOT NULL,
    `Id_reporter` int(11) NOT NULL,
    `filing_date` datetime NOT NULL DEFAULT current_timestamp(),
    `last_update` datetime NOT NULL DEFAULT current_timestamp(),
    `Id_operator` int(11) DEFAULT NULL,
    `Id_status` int(11) NOT NULL DEFAULT 1,
    `content` varchar(9999) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;";

  $create[].="
  CREATE TABLE `Ticket_details` (
    `Id_details` int(11) NOT NULL,
    `response` varchar(9999) NOT NULL,
    `date` datetime NOT NULL DEFAULT current_timestamp(),
    `id_user` int(11) NOT NULL,
    `Id_ticket` int(11) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;";

  $create[].="
  CREATE TABLE `User` (
    `Id_User` int(5) NOT NULL,
    `login` varchar(32) NOT NULL,
    `password` varchar(2000) NOT NULL,
    `Id_type` int(11) NOT NULL,
    `Name` varchar(1000) NOT NULL,
    `Id_company` int(11) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;";

  $create[].=" 
  CREATE TABLE `User_type` (
    `Id_type` int(1) NOT NULL,
    `name` varchar(10) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;";

  $create[].="
  ALTER TABLE `Company`
    ADD PRIMARY KEY (`Id_company`);";
  
  $create[].="
  ALTER TABLE `Status_type`
    ADD PRIMARY KEY (`Id_status`);";

  $create[].=" 
  ALTER TABLE `Ticket`
    ADD PRIMARY KEY (`Id_ticket`),
    ADD KEY `Id_operator` (`Id_operator`),
    ADD KEY `Id_reporter` (`Id_reporter`),
    ADD KEY `Id_status` (`Id_status`);";

  $create[].=" 
  ALTER TABLE `Ticket_details`
    ADD PRIMARY KEY (`Id_details`),
    ADD KEY `id_user` (`id_user`),
    ADD KEY `Id_ticket` (`Id_ticket`);";
  $create[].="
  ALTER TABLE `User`
    ADD PRIMARY KEY (`Id_User`),
    ADD KEY `Id_type` (`Id_type`) USING BTREE,
    ADD KEY `Id_company` (`Id_company`);";
  $create[].="
  ALTER TABLE `User_type`
    ADD PRIMARY KEY (`Id_type`);";
  $create[].=" 
  ALTER TABLE `Company`
    MODIFY `Id_company` int(11) NOT NULL AUTO_INCREMENT;";
  $create[].="
  ALTER TABLE `Status_type`
    MODIFY `Id_status` int(11) NOT NULL AUTO_INCREMENT;";
  $create[].="
  ALTER TABLE `Ticket`
    MODIFY `Id_ticket` int(11) NOT NULL AUTO_INCREMENT; ";
  $create[].="
  ALTER TABLE `Ticket_details`
    MODIFY `Id_details` int(11) NOT NULL AUTO_INCREMENT;";
  $create[].="
  ALTER TABLE `User`
    MODIFY `Id_User` int(5) NOT NULL AUTO_INCREMENT;";
  $create[].="
  ALTER TABLE `User_type`
    MODIFY `Id_type` int(1) NOT NULL AUTO_INCREMENT;";
  $create[].="
  ALTER TABLE `Ticket`
    ADD CONSTRAINT `Ticket_ibfk_1` FOREIGN KEY (`Id_operator`) REFERENCES `User` (`Id_User`),
    ADD CONSTRAINT `Ticket_ibfk_2` FOREIGN KEY (`Id_reporter`) REFERENCES `User` (`Id_User`),
    ADD CONSTRAINT `Ticket_ibfk_3` FOREIGN KEY (`Id_status`) REFERENCES `Status_type` (`Id_status`);";
  $create[].="
  ALTER TABLE `Ticket_details`
    ADD CONSTRAINT `Ticket_details_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `User` (`Id_User`),
    ADD CONSTRAINT `Ticket_details_ibfk_2` FOREIGN KEY (`Id_ticket`) REFERENCES `Ticket` (`Id_ticket`);";
  $create[].="
  ALTER TABLE `User`
    ADD CONSTRAINT `User_ibfk_1` FOREIGN KEY (`Id_type`) REFERENCES `User_type` (`Id_type`),
    ADD CONSTRAINT `User_ibfk_2` FOREIGN KEY (`Id_company`) REFERENCES `Company` (`Id_company`);";
?>