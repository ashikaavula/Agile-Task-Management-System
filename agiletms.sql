-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2016 at 05:32 AM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agiletms`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllTasks` (IN `projectID` INT(11))  BEGIN
Select t.taskId, t.Title, stat.StatusName, P.PriorityName, u.Title, S.Title from tasks t INNER JOIN userstories u on t.UserStoryId = u.UserStoryId INNER JOIN productbacklog pb on u.ProductBacklogId = pb.ProductBacklogId INNER JOIN status stat on stat.StatusId = t.TaskStatus INNER JOIN UserStoriestoSprint US ON t.UserStoryId=US.UserStoryId INNER JOIN Sprint S ON US.sprintId = S.SprintId INNER JOIN Priority P ON t.Priority = P.PriorityId where pb.ProjectId= projectID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTasks` (IN `projectID` INT(11), IN `userId` INT(11))  BEGIN
Select t.taskId, t.Title, stat.StatusName, P.PriorityName, u.Title, S.Title from tasks t INNER JOIN userstories u on t.UserStoryId = u.UserStoryId INNER JOIN productbacklog pb on u.ProductBacklogId = pb.ProductBacklogId INNER JOIN status stat on stat.StatusId = t.TaskStatus INNER JOIN UserStoriestoSprint US ON t.UserStoryId=US.UserStoryId INNER JOIN Sprint S ON US.sprintId = S.SprintId INNER JOIN Priority P ON t.Priority = P.PriorityId where pb.ProjectId= projectID  and t.AssignedTo = userId ;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `Id` int(11) NOT NULL,
  `TaskId` int(11) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `ChangeDesc` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`Id`, `TaskId`, `Status`, `ChangeDesc`) VALUES
(2, 18, 2, 'Task changed from In-Progress to completed');

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

CREATE TABLE `priority` (
  `PriorityId` int(10) NOT NULL,
  `PriorityName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`PriorityId`, `PriorityName`) VALUES
(1, 'High'),
(2, 'Medium'),
(3, 'Low');

-- --------------------------------------------------------

--
-- Table structure for table `productbacklog`
--

CREATE TABLE `productbacklog` (
  `ProductBacklogId` int(10) NOT NULL,
  `ProjectId` int(10) NOT NULL,
  `Title` varchar(50) DEFAULT NULL,
  `Description` varchar(200) DEFAULT NULL,
  `CreatedBy` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productbacklog`
--

INSERT INTO `productbacklog` (`ProductBacklogId`, `ProjectId`, `Title`, `Description`, `CreatedBy`) VALUES
(4, 1, 'Product1_Backlog', NULL, 43756),
(5, 9, 'Main product backlog', 'Agile TMS product backlog', 1000),
(6, 10, 'Main backlog', '', 1002);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `ProjectId` int(10) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` varchar(200) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT '1',
  `CreatedBy` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`ProjectId`, `Title`, `Description`, `StartDate`, `EndDate`, `IsActive`, `CreatedBy`) VALUES
(1, 'AntiLock Braking System', 'Developing the software which is embedded into the cars for advanced braking system on any kind of roads and under different temperatures', '2016-09-01', '2016-12-01', 1, 97363),
(2, 'Logical Node Audit', 'Auditing information of various network elements in the client NMS and also monitoring the functionality of the live network', '2014-10-01', '2017-12-01', 1, 97363),
(3, 'Network Rings Creation', 'Gathering the requirements from the client and creating the logical ring diagrams for the networks which has nodes and links', '2014-02-15', '2018-12-10', 1, 97363),
(4, 'syso-Mobile App Developmet', 'Developing a mobile application for the company syso', '2014-04-20', '2015-04-10', 1, 97363),
(7, 'Infosys Hadoop implementation', 'Implementation of Hadoop to Infosys employee database.', '2016-10-27', '2016-12-15', 1, 97363),
(8, 'ASUS testing project', 'testing', '2016-10-26', '2016-11-17', 0, 97363),
(9, 'Agile task management system', '', '2016-10-01', '2016-12-01', 1, NULL),
(10, 'Mobile management system', 'Mobile number management system', '2016-11-01', '2017-01-26', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sprint`
--

CREATE TABLE `sprint` (
  `SprintId` int(10) NOT NULL,
  `ProjectId` int(10) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date DEFAULT NULL,
  `CreatedBy` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sprint`
--

INSERT INTO `sprint` (`SprintId`, `ProjectId`, `Title`, `StartDate`, `EndDate`, `CreatedBy`) VALUES
(1, 1, 'Sprint 1', '2016-11-01', '2017-08-17', 17832),
(2, 1, 'Sprint 2', '2016-11-18', '2017-01-13', 43756),
(3, 9, 'Sprint 1', '2016-11-08', '2016-12-21', 1000),
(4, 10, 'Sprint 1', '2016-11-01', '2016-11-30', 1002),
(5, 10, 'Sprint 2', '2016-11-21', '2017-02-24', 1001);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `StatusId` int(10) NOT NULL,
  `StatusName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`StatusId`, `StatusName`) VALUES
(1, 'Assigned'),
(2, 'In-Progress'),
(3, 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `TaskId` int(10) NOT NULL,
  `UserStoryId` int(10) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` varchar(200) DEFAULT NULL,
  `AssignedTo` int(10) DEFAULT NULL,
  `TaskStatus` int(10) NOT NULL DEFAULT '1',
  `Priority` int(10) DEFAULT NULL,
  `CreatedBy` int(10) DEFAULT NULL,
  `Deadline` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`TaskId`, `UserStoryId`, `Title`, `Description`, `AssignedTo`, `TaskStatus`, `Priority`, `CreatedBy`, `Deadline`) VALUES
(1, 1, 'change profile pic functionality', 'browse photo and upload pic', 17832, 3, 1, 97363, '2016-11-24'),
(2, 1, 'Status display', 'Status display view yes/no functionality', 43756, 2, 2, 97363, NULL),
(14, 1, 'Create profile page', 'profile page to be created', 43862, 1, 1, 43756, NULL),
(15, 8, 'create form', 'form for user stories', 1007, 1, 1, 1000, NULL),
(16, 9, 'Create user profile', 'User profile should be created with all the options', 1008, 1, 3, 1002, NULL),
(17, 8, 'Sign up procedure', 'Create a member sign up procedure', 1007, 1, 2, 1000, NULL),
(18, 8, 'Sign in to be converted to procs', 'procs to be written ', 1001, 3, 1, 1000, NULL),
(19, 9, 'Fix image upload bug', 'Image upload bug in profile page to be corrected', 1008, 1, 1, 1001, '2016-11-30');

--
-- Triggers `tasks`
--
DELIMITER $$
CREATE TRIGGER `before_tasks_update` BEFORE UPDATE ON `tasks` FOR EACH ROW BEGIN
DECLARE Stat int;
DECLARE SChange varchar(50);
IF ( NEW.TaskStatus = 2 && OLD.TaskStatus = 1 ) THEN
            SET @Stat = OLD.TaskStatus;
            SET @SChange = "Task changed from Assigned to In-Progress";
ELSEIF (NEW.TaskStatus = 3 && OLD.TaskStatus = 2 ) THEN
            SET @Stat = OLD.TaskStatus;
            SET @SChange = "Task changed from In-Progress to completed";
ELSEIF (NEW.TaskStatus = 2 && OLD.TaskStatus = 3 ) THEN
            SET @Stat = OLD.TaskStatus;
            SET @SChange = "Task changed from completed to In-Progress";
            
END IF;

INSERT INTO Notification (TaskId,Status,ChangeDesc) VALUES (OLD.TaskId,@Stat,@SChange);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `EmpId` int(10) NOT NULL,
  `FirstName` varchar(30) DEFAULT NULL,
  `LastName` varchar(30) DEFAULT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `EmailId` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`EmpId`, `FirstName`, `LastName`, `Username`, `Password`, `EmailId`) VALUES
(1000, 'Nithin', 'Venugopal', 'Nithin', 'abc123', 'nithin.venugopal@gmail.com'),
(1001, 'Yugandhara', 'Kulkarni', 'Yugandhara', 'abc123', 'yugandhara.kulkarni@gmail.com'),
(1002, 'Shanmukh', 'Anand', 'Shanmukh', 'abc123', 'shanmukh.anand@gmail.com'),
(1003, 'Ashika', 'Avula', 'Ashika', 'abc123', 'ashika.avula@gmail.com'),
(1004, 'Manasa', 'Rao', 'Manasa', 'abc123', 'manasa.rao@gmail.com'),
(1005, 'Nithya', 'Dubey', 'Nithya', 'abc123', 'nithya.dubey@gmail.com'),
(1006, 'Anil', 'Kumar', 'Anil', 'abc123', 'anil.kumar@gmail.com'),
(1007, 'Ramya', 'Chowdary', 'Ramya', 'abc123', 'ramya.chowdary@gmail.com'),
(1008, 'Rahul', 'Shetty', 'Rahul', 'abc123', 'rahul.shetty@gmail.com'),
(1009, 'Ranbir', 'Kapoor', 'Ranbir', 'abc123', 'ranbir.kapoor@gmail.com'),
(1010, 'Anushka', 'Sharma', 'Anushka', 'abc123', 'anushka.sharma@gmail.com'),
(1011, 'Suraj', 'Gutti', 'Suraj', 'abc123', 'suraj.gutti@gmail.com'),
(1012, 'Sharath', 'Puppala', 'Sharath', 'abc123', 'sharath.puppala@gmail.com'),
(1013, 'Shanthi', 'Sri', 'Shanthi', 'abc123', 'shanthi.sri@gmail.com'),
(1014, 'Anvesha', 'Banerjee', 'Anvesha', 'abc123', 'anvesha.banerjee@gmail.com'),
(1015, 'Ayush', 'Sinha', 'Ayush', 'abc123', 'ayush.sinha@gmail.com'),
(1016, 'Shruthi', 'Rao', 'Shruthi', 'abc123', 'shruthi.rao@gmail.com'),
(1017, 'Aditya', 'Gupta', 'Aditya', 'abc123', 'aditya.gupta@gmail.com'),
(1018, 'Pravalika', 'Jakkampudi', 'Pravalika', 'abc123', 'pravalika.jakkampudi@gmail.com'),
(1019, 'Jyothi', 'Reddy', 'Jyothi', 'abc123', 'jyothi.reddy@gmail.com'),
(1020, 'Radha', 'Krishna', 'Radha', 'abc123', 'radha.krishna@gmail.com'),
(1021, 'Indu', 'Varma', 'Indu', 'abc123', 'indu.varma@gmail.com'),
(1022, 'Koushik', 'Chowdary', 'Koushik', 'abc123', 'koushik.chowdary@gmail.com'),
(1023, 'Grace', 'John', 'Grace', 'abc123', 'grace.john@gmail.com'),
(1024, 'Veda', 'Priya', 'Veda', 'abc123', 'veda.priya@gmail.com'),
(1025, 'Vamsi', 'Rao', 'Vamsi', 'abc123', 'vamsi.rao@gmail.com'),
(17832, 'Olivia', 'Sugarman', 'olivsuga', 'abc123', 'oliviasugar@gmail.com'),
(43756, 'John', 'Gordie', 'johng', 'abc123', 'johng@gmail.com'),
(43859, 'Amy', 'allen', 'amyallen', 'abc123', 'amyallen@gmail.com'),
(43862, 'Nancy', 'Tyagi', 'nanctyag', 'abc123', 'nancytyagi@gmail.com'),
(67232, 'Christine', 'Johnson', 'chrisjohn', 'abc123', 'christinejohn@gmail.com'),
(97363, 'Samantha', 'Barbara', 'samabarb', 'abc123', 'samanthabar@gmail.com'),
(97367, 'Jamie', 'Palmer', 'jamiep', 'abc123', 'jamiep@gmail.com'),
(662669, 'Amy', 'Scavada', 'amys', 'abc123', 'amyscavada@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE `userrole` (
  `RoleId` int(10) NOT NULL,
  `RoleName` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userrole`
--

INSERT INTO `userrole` (`RoleId`, `RoleName`) VALUES
(1, 'Administrator'),
(2, 'Product owner'),
(3, 'Scrum master'),
(4, 'Team member');

-- --------------------------------------------------------

--
-- Table structure for table `userstories`
--

CREATE TABLE `userstories` (
  `UserStoryId` int(10) NOT NULL,
  `ProductBacklogId` int(10) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` varchar(200) DEFAULT NULL,
  `StoryPoints` varchar(500) DEFAULT NULL,
  `CreatedBy` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userstories`
--

INSERT INTO `userstories` (`UserStoryId`, `ProductBacklogId`, `Title`, `Description`, `StoryPoints`, `CreatedBy`) VALUES
(1, 4, 'Profile page', 'Create profile page', 'Include profile photo, profile details, edit and update profile', 17832),
(3, 4, 'Roles for profile', 'include role permission for profile', 'Only manager can see his reportee roles in profile', 17832),
(6, 4, 'Custom request approval', 'Approval workflow to be create', 'Each custom request should go through 2 level approval', 43756),
(7, 4, 'Sales activity', 'activity of the sales to be added', 'owner information, sale information, sale status to be added', 43756),
(8, 5, 'As a scrum master, I want to create user stories', 'User stories creation', 'Need to be multi tabbed,\r\ngive two buttons', 1000),
(9, 6, 'User story 1', 'description', 'points', 1002),
(10, 6, 'Email notification option', 'Build email notification functionality', '1) maintain mailing list 2) add unsubscribe', 1001),
(11, 6, 'App notification', 'build general app notification functionality', 'Option to put custom messages to be present', 1001);

-- --------------------------------------------------------

--
-- Table structure for table `userstoriestosprint`
--

CREATE TABLE `userstoriestosprint` (
  `UserStoryId` int(11) NOT NULL,
  `SprintId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userstoriestosprint`
--

INSERT INTO `userstoriestosprint` (`UserStoryId`, `SprintId`) VALUES
(1, 1),
(3, 1),
(6, 2),
(8, 3),
(9, 4),
(10, 5),
(11, 4);

-- --------------------------------------------------------

--
-- Table structure for table `usertoproject`
--

CREATE TABLE `usertoproject` (
  `UtoRId` int(10) NOT NULL,
  `ProjectId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertoproject`
--

INSERT INTO `usertoproject` (`UtoRId`, `ProjectId`) VALUES
(2, 1),
(3, 1),
(5, 1),
(7, 1),
(11, 9),
(17, 9),
(18, 9),
(41, 9),
(42, 9),
(12, 10),
(13, 10),
(23, 10),
(24, 10);

-- --------------------------------------------------------

--
-- Table structure for table `usertorole`
--

CREATE TABLE `usertorole` (
  `Id` int(10) NOT NULL,
  `EmpId` int(10) NOT NULL,
  `RoleId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertorole`
--

INSERT INTO `usertorole` (`Id`, `EmpId`, `RoleId`) VALUES
(11, 1000, 3),
(12, 1001, 3),
(41, 1001, 4),
(13, 1002, 3),
(14, 1003, 3),
(15, 1004, 3),
(42, 1005, 2),
(17, 1006, 4),
(21, 1006, 4),
(18, 1007, 4),
(22, 1007, 4),
(19, 1008, 4),
(23, 1008, 4),
(20, 1009, 4),
(24, 1009, 4),
(25, 1010, 4),
(26, 1011, 4),
(27, 1012, 4),
(28, 1013, 4),
(29, 1014, 4),
(30, 1015, 4),
(31, 1016, 4),
(32, 1017, 4),
(33, 1018, 4),
(34, 1019, 4),
(35, 1020, 4),
(36, 1021, 4),
(37, 1022, 4),
(38, 1023, 4),
(39, 1024, 4),
(40, 1025, 4),
(1, 17832, 2),
(2, 17832, 4),
(3, 43756, 3),
(4, 43859, 1),
(5, 43862, 3),
(6, 67232, 3),
(7, 67232, 4),
(8, 97363, 1),
(9, 97367, 3),
(10, 662669, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `TaskId` (`TaskId`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `priority`
--
ALTER TABLE `priority`
  ADD PRIMARY KEY (`PriorityId`);

--
-- Indexes for table `productbacklog`
--
ALTER TABLE `productbacklog`
  ADD PRIMARY KEY (`ProductBacklogId`),
  ADD KEY `CreatedBy` (`CreatedBy`),
  ADD KEY `ProjectForProductBacklog` (`ProjectId`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`ProjectId`),
  ADD KEY `CreatedBy` (`CreatedBy`);

--
-- Indexes for table `sprint`
--
ALTER TABLE `sprint`
  ADD PRIMARY KEY (`SprintId`),
  ADD KEY `CreatedBy` (`CreatedBy`),
  ADD KEY `ProjectforSprint` (`ProjectId`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`StatusId`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`TaskId`),
  ADD KEY `UserStoryid` (`UserStoryId`),
  ADD KEY `AssignedTo` (`AssignedTo`),
  ADD KEY `TaskStatus` (`TaskStatus`),
  ADD KEY `Priority` (`Priority`),
  ADD KEY `CreatedBy` (`CreatedBy`);
ALTER TABLE `tasks` ADD FULLTEXT KEY `title_tasks` (`Title`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`EmpId`),
  ADD KEY `user_username` (`Username`);

--
-- Indexes for table `userrole`
--
ALTER TABLE `userrole`
  ADD PRIMARY KEY (`RoleId`);

--
-- Indexes for table `userstories`
--
ALTER TABLE `userstories`
  ADD PRIMARY KEY (`UserStoryId`),
  ADD KEY `CreatedBy` (`CreatedBy`),
  ADD KEY `ProductBonUs` (`ProductBacklogId`);

--
-- Indexes for table `userstoriestosprint`
--
ALTER TABLE `userstoriestosprint`
  ADD PRIMARY KEY (`UserStoryId`,`SprintId`),
  ADD KEY `SprintId` (`SprintId`);

--
-- Indexes for table `usertoproject`
--
ALTER TABLE `usertoproject`
  ADD PRIMARY KEY (`UtoRId`,`ProjectId`),
  ADD KEY `ProjectId` (`ProjectId`);

--
-- Indexes for table `usertorole`
--
ALTER TABLE `usertorole`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `RoleId` (`RoleId`),
  ADD KEY `userrole_remp` (`EmpId`,`RoleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `priority`
--
ALTER TABLE `priority`
  MODIFY `PriorityId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `productbacklog`
--
ALTER TABLE `productbacklog`
  MODIFY `ProductBacklogId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `ProjectId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `sprint`
--
ALTER TABLE `sprint`
  MODIFY `SprintId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `StatusId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `TaskId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `userrole`
--
ALTER TABLE `userrole`
  MODIFY `RoleId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `userstories`
--
ALTER TABLE `userstories`
  MODIFY `UserStoryId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `usertorole`
--
ALTER TABLE `usertorole`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `productbacklog`
--
ALTER TABLE `productbacklog`
  ADD CONSTRAINT `productbacklog_ibfk_1` FOREIGN KEY (`ProjectId`) REFERENCES `project` (`ProjectId`),
  ADD CONSTRAINT `productbacklog_ibfk_2` FOREIGN KEY (`CreatedBy`) REFERENCES `user` (`EmpId`);

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`CreatedBy`) REFERENCES `user` (`EmpId`);

--
-- Constraints for table `sprint`
--
ALTER TABLE `sprint`
  ADD CONSTRAINT `sprint_ibfk_1` FOREIGN KEY (`ProjectId`) REFERENCES `project` (`ProjectId`),
  ADD CONSTRAINT `sprint_ibfk_2` FOREIGN KEY (`CreatedBy`) REFERENCES `user` (`EmpId`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`UserStoryId`) REFERENCES `userstories` (`UserStoryId`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`AssignedTo`) REFERENCES `user` (`EmpId`),
  ADD CONSTRAINT `tasks_ibfk_3` FOREIGN KEY (`TaskStatus`) REFERENCES `status` (`StatusId`),
  ADD CONSTRAINT `tasks_ibfk_4` FOREIGN KEY (`Priority`) REFERENCES `priority` (`PriorityId`),
  ADD CONSTRAINT `tasks_ibfk_5` FOREIGN KEY (`CreatedBy`) REFERENCES `user` (`EmpId`);

--
-- Constraints for table `userstories`
--
ALTER TABLE `userstories`
  ADD CONSTRAINT `userstories_ibfk_1` FOREIGN KEY (`ProductBacklogId`) REFERENCES `productbacklog` (`ProductBacklogId`),
  ADD CONSTRAINT `userstories_ibfk_3` FOREIGN KEY (`CreatedBy`) REFERENCES `user` (`EmpId`);

--
-- Constraints for table `usertoproject`
--
ALTER TABLE `usertoproject`
  ADD CONSTRAINT `usertoproject_ibfk_1` FOREIGN KEY (`UtoRId`) REFERENCES `usertorole` (`Id`),
  ADD CONSTRAINT `usertoproject_ibfk_2` FOREIGN KEY (`ProjectId`) REFERENCES `project` (`ProjectId`);

--
-- Constraints for table `usertorole`
--
ALTER TABLE `usertorole`
  ADD CONSTRAINT `usertorole_ibfk_1` FOREIGN KEY (`EmpId`) REFERENCES `user` (`EmpId`),
  ADD CONSTRAINT `usertorole_ibfk_2` FOREIGN KEY (`RoleId`) REFERENCES `userrole` (`RoleId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
