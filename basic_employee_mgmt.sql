-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:1234
-- Generation Time: Jul 06, 2020 at 10:04 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `basic_employee_mgmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `CategoryID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`CategoryID`, `Name`, `Description`) VALUES
(1, 'Full Time', 'More than 40 hours per week'),
(2, 'Part Time', 'More than 3 days and less than 38 hours per week'),
(3, 'Casual', 'More than one day less than 38 hours per week');

-- --------------------------------------------------------

--
-- Table structure for table `Employees`
--

CREATE TABLE `Employees` (
  `ID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `BirthDate` date NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `EmployeeDate` date NOT NULL,
  `Notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Employees`
--

INSERT INTO `Employees` (`ID`, `CategoryID`, `LastName`, `FirstName`, `BirthDate`, `Photo`, `EmployeeDate`, `Notes`) VALUES
(1, 1, 'Nancy', 'Davolio', '1968-12-08', 'EmpID1.jpg', '2010-01-10', 'Education includes a BA in psychology from Colorado State University. She also completed (The Art of the Cold Call). Nancy is a member of Toastmasters International.'),
(2, 1, 'Andrew', 'Fuller', '1952-02-19', 'EmpID2.jpg', '2010-01-10', 'Andrew received his BTS commercial and a Ph.D. in international marketing from the University of Dallas. He is fluent in French and Italian and reads German. He joined the company as a sales representative, was promoted to sales manager and was then named vice president of sales. Andrew is a member of the Sales Management Roundtable, the Seattle Chamber of Commerce, and the Pacific Rim Importers Association.'),
(3, 3, 'Janet', 'Leverling', '1963-08-30', 'EmpID3.jpg', '2011-02-03', 'Janet has a BS degree in chemistry from Boston College). She has also completed a certificate program in food retailing management. Janet was hired as a sales associate and was promoted to sales representative.'),
(4, 2, 'Margaret', 'Peacock', '1958-09-19', 'EmpID4.jpg', '2012-05-30', 'Margaret holds a BA in English literature from Concordia College and an MA from the American Institute of Culinary Arts. She was temporarily assigned to the London office before returning to her permanent post in Seattle.'),
(5, 1, 'Steven', 'Buchanan', '1955-03-04', 'EmpID5.jpg', '2013-07-01', 'Steven Buchanan graduated from St. Andrews University, Scotland, with a BSC degree. Upon joining the company as a sales representative, he spent 6 months in an orientation program at the Seattle office and then returned to his permanent post in London, where he was promoted to sales manager. Mr Buchanan has completed the courses Successful Telemarketing and International Sales Management. He is fluent in French.'),
(6, 3, 'Michael', 'Suyama', '1963-07-02', 'EmpID6.jpg', '2014-10-20', 'ichael is a graduate of Sussex University (MA, economics) and the University of California at Los Angeles (MBA, marketing). He has also taken the courses Multi-Cultural Selling and Time Management for the Sales Professional. He is fluent in Japanese and can read and write French, Portuguese, and Spanish.'),
(7, 2, 'Robert', 'King', '1960-05-29', 'EmpID7.jpg', '2015-12-06', 'Robert King served in the Peace Corps and traveled extensively before completing his degree in English at the University of Michigan and then joining the company. After completing a course entitled Selling in Europe, he was transferred to the London office.'),
(8, 2, 'Laura', 'Callahan', '1958-01-09', 'EmpID8.jpg', '2017-07-19', 'Laura received a BA in psychology from the University of Washington. She has also completed a course in business French. She reads and writes French.'),
(9, 1, 'Anne', 'Dodsworth', '1969-07-02', 'EmpID9.jpg', '2019-06-19', 'Anne has a BA degree in English from St. Lawrence College. She is fluent in French and German.'),
(10, 3, 'West', 'Adam', '1928-09-19', 'EmpID10.jpg', '2020-01-03', 'An old chum.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `Employees`
--
ALTER TABLE `Employees`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Employees`
--
ALTER TABLE `Employees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Employees`
--
ALTER TABLE `Employees`
  ADD CONSTRAINT `Employees_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `Category` (`CategoryID`);
