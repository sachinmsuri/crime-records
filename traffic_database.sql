-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 24, 2021 at 10:24 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coursework2`
--

-- --------------------------------------------------------

--
-- Table structure for table `Fines`
--

CREATE TABLE `Fines` (
  `Fine_ID` int(11) NOT NULL,
  `Fine_Amount` int(11) NOT NULL,
  `Fine_Points` int(11) NOT NULL,
  `Incident_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Fines`
--

INSERT INTO `Fines` (`Fine_ID`, `Fine_Amount`, `Fine_Points`, `Incident_ID`) VALUES
(1, 2000, 6, 3),
(2, 50, 0, 2),
(3, 500, 3, 4),
(9, 100, 4, 5),
(11, 999, 5, 43),
(12, 500, 9, 36),
(13, 100, 3, 37),
(14, 250, 0, 43);

-- --------------------------------------------------------

--
-- Table structure for table `Incident`
--

CREATE TABLE `Incident` (
  `Incident_ID` int(11) NOT NULL,
  `Vehicle_ID` int(11) DEFAULT NULL,
  `People_ID` int(11) DEFAULT NULL,
  `Incident_Date` date NOT NULL,
  `Incident_Report` varchar(500) NOT NULL,
  `Offence_ID` int(11) DEFAULT NULL,
  `Officer_username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Incident`
--

INSERT INTO `Incident` (`Incident_ID`, `Vehicle_ID`, `People_ID`, `Incident_Date`, `Incident_Report`, `Offence_ID`, `Officer_username`) VALUES
(1, 15, 4, '2017-12-19', '40mph in a 30 limit with no seatbelt', 13, 'Regan'),
(2, 20, 8, '2017-11-01', 'Double parked', 4, 'Regan'),
(3, 13, 4, '2017-09-17', '110mph on motorway', 1, 'Carter'),
(4, 14, 2, '2017-08-22', 'Failure to stop at a red light - travelling 25mph', 8, 'Carter'),
(5, 13, 4, '2017-10-17', 'Not wearing a seatbelt on the M1 lols', 12, 'Regan'),
(36, 119, 28, '2020-08-01', 'Talking on the mobile phone will driving on the M25 motorway', 11, 'Carter'),
(37, 120, 29, '2017-09-09', 'Hit a pedestrian at a zebra crossing', 10, 'Regan'),
(38, 121, 30, '2020-09-09', 'Driving off after hitting another car', 11, 'Carter'),
(40, 121, 30, '2020-09-09', 'Parking in a private car parking space', 4, 'Regan'),
(42, 126, 35, '2021-01-05', 'Parking at a Mcdonalds drive through', 4, 'Carter'),
(43, 127, 36, '2021-01-06', 'Texting at eating on a motorway', 11, 'Carter'),
(44, 128, 37, '2021-01-07', 'Driving without a valid license', 6, 'Carter'),
(45, 128, 37, '2021-01-07', 'Driving while intoxicated and drove into a lamp', 5, 'Carter'),
(46, 130, 39, '2021-01-09', 'Lost control of a vehicle at a round about and hit a deer', 10, 'Regan'),
(47, 132, 42, '2021-01-03', 'Driving on the M4 with no seatbelt', 3, 'Regan');

-- --------------------------------------------------------

--
-- Table structure for table `Offence`
--

CREATE TABLE `Offence` (
  `Offence_ID` int(11) NOT NULL,
  `Offence_description` varchar(50) NOT NULL,
  `Offence_maxFine` int(11) NOT NULL,
  `Offence_maxPoints` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Offence`
--

INSERT INTO `Offence` (`Offence_ID`, `Offence_description`, `Offence_maxFine`, `Offence_maxPoints`) VALUES
(1, 'Speeding', 1000, 3),
(2, 'Speeding on a motorway', 2500, 6),
(3, 'Seat belt offence', 500, 0),
(4, 'Illegal parking', 500, 0),
(5, 'Drink driving', 10000, 11),
(6, 'Driving without a licence', 10000, 0),
(7, 'Driving without a licence', 10000, 0),
(8, 'Traffic light offences', 1000, 3),
(9, 'Cycling on pavement', 500, 0),
(10, 'Failure to have control of vehicle', 1000, 3),
(11, 'Dangerous driving', 1000, 11),
(12, 'Careless driving', 5000, 6),
(13, 'Dangerous cycling', 2500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Ownership`
--

CREATE TABLE `Ownership` (
  `People_ID` int(11) NOT NULL,
  `Vehicle_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ownership`
--

INSERT INTO `Ownership` (`People_ID`, `Vehicle_ID`) VALUES
(3, 12),
(8, 20),
(4, 15),
(4, 13),
(1, 16),
(2, 14),
(5, 17),
(6, 18),
(7, 21),
(1, 106),
(16, 107),
(17, 109),
(25, 116),
(26, 117),
(27, 118),
(28, 119),
(29, 120),
(30, 121),
(31, 122),
(32, 123),
(33, 124),
(34, 125),
(35, 126),
(36, 127),
(37, 128),
(38, 129),
(39, 130),
(40, 131),
(41, 130),
(42, 132);

-- --------------------------------------------------------

--
-- Table structure for table `People`
--

CREATE TABLE `People` (
  `People_ID` int(11) NOT NULL,
  `People_name` varchar(50) NOT NULL,
  `People_address` varchar(50) DEFAULT NULL,
  `People_licence` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `People`
--

INSERT INTO `People` (`People_ID`, `People_name`, `People_address`, `People_licence`) VALUES
(1, 'James Smith', '23 Barnsdale Road, Leicester', 'SMITH92LDOFJJ829'),
(2, 'Jennifer Allen', '46 Bramcote Drive, Nottingham', 'ALLEN88K23KLR9B3'),
(3, 'John Myers', '323 Derby Road, Nottingham', 'MYERS99JDW8REWL3'),
(4, 'James Smith', '26 Devonshire Avenue, Nottingham', 'SMITHR004JFS20TR'),
(5, 'Terry Brown', '7 Clarke Rd, Nottingham', 'BROWND3PJJ39DLFG'),
(6, 'Mary Adams', '38 Thurman St, Nottingham', 'ADAMSH9O3JRHH107'),
(7, 'Neil Becker', '6 Fairfax Close, Nottingham', 'BECKE88UPR840F9R'),
(8, 'Angela Smith', '30 Avenue Road, Grantham', 'SMITH222LE9FJ5DS'),
(16, 'Sachin Suri', '9 Mans Road, London', 'SURI1235UP980838'),
(17, 'Manpreet Singh', '123 Pluto Road, Outer Space', 'SINGH87364JDJ2J7'),
(25, 'Jack Bauer', '79 High Road, London', 'BAUER7890JHBS8D1'),
(26, 'Ekin Su', 'Bank House, Newton Avenue', 'SU739DHFNB27SGD0'),
(27, 'Zelda Manning', '20 Neverland, Walton Road', 'MANNING652GH762F'),
(28, 'Samuel Jackson', '56 Snakes, Plane Road, London', 'JACKSON9827HDVFG'),
(29, 'Terry Brown', 'Sky Plant Road, Birmingham', 'BROWN8726GHD783G'),
(30, 'Kelly Rowland', '616 Newton Space, Manchester', 'ROWLOAND76827HD6'),
(31, 'Marshell Mathers', '212 Paradise Island, Kent', 'MATHERS738HD8726'),
(32, 'Randy Orton', '56 West Rood, Surrey', 'ORTON82HS6352GD6'),
(33, 'Giacomo Konstantin', '7 Christ Road, Bristol', 'KONSTANTIN82903D'),
(34, 'Rambo Stallone', 'The Isle Row, London', 'STALLONE8273G638'),
(35, 'Louis Armstrong', 'Newton Town Rd, Winchester', 'ARMST8390398H734'),
(36, 'Samuel Jackson', 'The Pall Mall, Cambridge', 'JACKS89209KJ2736'),
(37, 'Albert Li', 'WW5, Oxford', 'LI98714525364729'),
(38, 'Nikhil Kapoor', '67 Foxtons, Warwick', 'KAPOO765GFAS30PL'),
(39, 'Bruce Wayne', 'The Batcave, Kings Cross', 'WAYNE90123DHGV7H'),
(40, 'Sachin Brings', '90 Fairfax Close, Nottingham', 'BRINGS872GHN9876'),
(41, 'Gurneet Smithson', 'Fight Island, London', 'SMITHS9033328479'),
(42, 'Jack Bigman', '100 South Drive, Hampshire', 'BIGMAN987GHMN765');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `Username` varchar(25) CHARACTER SET latin1 NOT NULL,
  `User_Password` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `Name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `User_type` varchar(25) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`Username`, `User_Password`, `Name`, `User_type`) VALUES
('Carter', 'fuzz42', 'Sam Cleverly', 'Officer'),
('haskins', 'copper99', 'Jack Ma', 'Admin'),
('Jlam', 'spam957', 'Justin Lam', 'Officer'),
('Regan', 'plod123', 'Oliver Newton', 'Officer'),
('Suri', 'new123', 'Sachin Suri', 'Officer'),
('Tomj', 'stranger99', 'Tom Jones', 'Officer'),
('w_stig', 'freefall999', 'Wilbert Stiglitz', 'Officer');

-- --------------------------------------------------------

--
-- Table structure for table `Vehicle`
--

CREATE TABLE `Vehicle` (
  `Vehicle_ID` int(11) NOT NULL,
  `Vehicle_type` varchar(20) NOT NULL,
  `Vehicle_colour` varchar(20) NOT NULL,
  `Vehicle_licence` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Vehicle`
--

INSERT INTO `Vehicle` (`Vehicle_ID`, `Vehicle_type`, `Vehicle_colour`, `Vehicle_licence`) VALUES
(12, 'Ford Fiesta', 'Blue', 'LB15AJL'),
(13, 'Ferrari 458', 'Red', 'MY64PRE'),
(14, 'Vauxhall Astra', 'Silver', 'FD65WPQ'),
(15, 'Honda Civic', 'Red', 'FJ17AUG'),
(16, 'Toyota Prius', 'Silver', 'FP16KKE'),
(17, 'Ford Mondeo', 'Black', 'FP66KLM'),
(18, 'Ford Focus', 'White', 'DJ14SLE'),
(20, 'Nissan Pulsar', 'Red', 'NY64KWD'),
(21, 'Renault Scenic', 'Silver', 'BC16OEA'),
(22, 'Mercedes SLS', 'Silver', 'XX10XXX'),
(106, 'Ferrari Spider', 'Red', 'GU25SRQ'),
(107, 'Ford Focus', 'Green', 'GX34OOO'),
(109, 'Pagani Zonda', 'Black', 'SA12URY'),
(116, 'Lamborghini Urus', 'Red', 'AS1XP41'),
(117, 'Tesla Model S', 'Black', 'GUN2569'),
(118, 'Aston Martin', 'Black', 'RAM1234'),
(119, 'Citroen Lime', 'Green', 'SN23POX'),
(120, 'Aston Martin DB5', 'Red', 'MAF4D56'),
(121, 'Jaguar EType', 'Black', 'FK99ABC'),
(122, 'Honda Civic', 'Black', 'HU78IUJ'),
(123, 'Range Rover Sport', 'Red', 'ASS105A'),
(124, 'Renault Astra', 'Red', 'AFO69JL'),
(125, 'Tesla Model X', 'Green', 'SA97HAM'),
(126, 'Audi TT', 'Green', 'BN89FOT'),
(127, 'Mercedes A Class', 'Black', 'DF65POP'),
(128, 'Jaguar F-Type', 'Green', 'WWE7896'),
(129, 'Mercedes G-Wagon', 'Purple', 'AD90777'),
(130, 'Alfa Romeo STG', 'Purple', 'REG1234'),
(131, 'BMW M5', 'Red', 'FD82SAK'),
(132, 'Ford Mustang', 'Green', 'KK99UMB');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Fines`
--
ALTER TABLE `Fines`
  ADD PRIMARY KEY (`Fine_ID`),
  ADD KEY `Incident_ID` (`Incident_ID`);

--
-- Indexes for table `Incident`
--
ALTER TABLE `Incident`
  ADD PRIMARY KEY (`Incident_ID`),
  ADD KEY `fk_incident_vehicle` (`Vehicle_ID`),
  ADD KEY `fk_incident_people` (`People_ID`),
  ADD KEY `fk_incident_offence` (`Offence_ID`),
  ADD KEY `fk_incident_username` (`Incident_ID`);

--
-- Indexes for table `Offence`
--
ALTER TABLE `Offence`
  ADD PRIMARY KEY (`Offence_ID`);

--
-- Indexes for table `Ownership`
--
ALTER TABLE `Ownership`
  ADD KEY `fk_people` (`People_ID`),
  ADD KEY `fk_vehicle` (`Vehicle_ID`);

--
-- Indexes for table `People`
--
ALTER TABLE `People`
  ADD PRIMARY KEY (`People_ID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `Vehicle`
--
ALTER TABLE `Vehicle`
  ADD PRIMARY KEY (`Vehicle_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Fines`
--
ALTER TABLE `Fines`
  MODIFY `Fine_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `Incident`
--
ALTER TABLE `Incident`
  MODIFY `Incident_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `Offence`
--
ALTER TABLE `Offence`
  MODIFY `Offence_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `People`
--
ALTER TABLE `People`
  MODIFY `People_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `Vehicle`
--
ALTER TABLE `Vehicle`
  MODIFY `Vehicle_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Fines`
--
ALTER TABLE `Fines`
  ADD CONSTRAINT `fk_fines` FOREIGN KEY (`Incident_ID`) REFERENCES `Incident` (`Incident_ID`);

--
-- Constraints for table `Incident`
--
ALTER TABLE `Incident`
  ADD CONSTRAINT `fk_incident_offence` FOREIGN KEY (`Offence_ID`) REFERENCES `Offence` (`Offence_ID`),
  ADD CONSTRAINT `fk_incident_people` FOREIGN KEY (`People_ID`) REFERENCES `People` (`People_ID`),
  ADD CONSTRAINT `fk_incident_vehicle` FOREIGN KEY (`Vehicle_ID`) REFERENCES `Vehicle` (`Vehicle_ID`);

--
-- Constraints for table `Ownership`
--
ALTER TABLE `Ownership`
  ADD CONSTRAINT `fk_person` FOREIGN KEY (`People_ID`) REFERENCES `People` (`People_ID`),
  ADD CONSTRAINT `fk_vehicle` FOREIGN KEY (`Vehicle_ID`) REFERENCES `Vehicle` (`Vehicle_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
