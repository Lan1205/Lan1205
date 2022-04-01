
CREATE TABLE `user` (
  `userID` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT ,
  `lastName` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `phonenumber` text NOT NULL,
  `position` int(11) DEFAULT NULL,
  `email` text NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `user` (`userID`, `lastName`, `firstName`, `birthdate`, `phonenumber`, `position`, `email`, `username`, `password`) VALUES
(null, 'Ghanem', 'Fadi', '1993-11-10', '41567456', 0, 'fadi.ghanem@student.uni-siegen.de', 'fadi', 'fadi'); 