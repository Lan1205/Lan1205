CREATE TABLE `mischung` (
  `rennID` int(11) NOT NULL,
  `mischungID` int(11) NOT NULL AUTO_INCREMENT,
  `mischung` varchar(50) NOT NULL,
  `bezeichnung` varchar(5) NOT NULL,
  `kontingent` int(11) NOT NULL,
  PRIMARY KEY (mischungID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
