-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 08. Mai 2022 um 16:23
-- Server-Version: 10.4.21-MariaDB
-- PHP-Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `webentwicklungsprojekt`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `img` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`productID`, `name`, `img`, `type`, `price`) VALUES
(1, 'Bookshelf', '../productpictures/bookshelf.png', 'Shelf', 156.98),
(2, 'Round Table', '../productpictures/roundtable.png', 'Table', 298),
(3, 'Relax Chair', '../productpictures/relaxchair.png', 'Chair', 198);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `salesheader`
--

CREATE TABLE `salesheader` (
  `salesID` int(11) NOT NULL,
  `customerID` int(50) NOT NULL,
  `done` tinyint(1) NOT NULL COMMENT 'done = Abgeschlossene Bestellung\r\nNot Done = Warenkorb',
  `orderDate` date NOT NULL COMMENT 'Zeit der Bestellung/Zahlung'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `salesheader`
--

INSERT INTO `salesheader` (`salesID`, `customerID`, `done`, `orderDate`) VALUES
(1, 1, 0, '0000-00-00'),
(2, 1, 1, '2022-05-01');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `salesline`
--

CREATE TABLE `salesline` (
  `saleslineID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL COMMENT 'Quantity of a product.',
  `salesheaderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `salesline`
--

INSERT INTO `salesline` (`saleslineID`, `productID`, `quantity`, `salesheaderID`) VALUES
(1, 1, 2, 1),
(2, 3, 1, 1),
(3, 2, 1, 1),
(4, 3, 3, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `salutation` varchar(255) CHARACTER SET utf8 NOT NULL,
  `fname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `lname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `streetName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `streetNr` int(11) NOT NULL,
  `zip` int(11) NOT NULL,
  `location` varchar(255) CHARACTER SET utf8 NOT NULL,
  `country` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `paymentOption` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'Zahlungsmöglichkeit: Paypal, Kreditkarte',
  `active` tinyint(1) NOT NULL COMMENT 'Deaktivierung eines Kunden durch den Admin',
  `adminUser` tinyint(1) NOT NULL COMMENT 'Ist Benutzer ein Admin?\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`userID`, `salutation`, `fname`, `lname`, `streetName`, `streetNr`, `zip`, `location`, `country`, `email`, `username`, `password`, `paymentOption`, `active`, `adminUser`) VALUES
(1, 'Mrs.', 'Luisa', 'Müller', 'Andtstraße', 22, 1120, 'Wien', 'AT', 'luisa22@gmail.com', 'luisa', '1234', '', 1, 0),
(2, 'Mrs.', 'Admin', 'Admin', 'Kleine Straße', 10, 1220, 'Wien', 'AT', 'admin@gmail.com', 'admin', '1234', '', 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `voucher`
--

CREATE TABLE `voucher` (
  `voucherID` int(11) NOT NULL,
  `voucherCode` varchar(50) NOT NULL,
  `creationDate` date NOT NULL DEFAULT current_timestamp(),
  `expireDate` date NOT NULL,
  `value` float NOT NULL,
  `redeemed` tinyint(1) NOT NULL COMMENT 'Eingelöst?',
  `userID` int(11) NOT NULL COMMENT 'Besitzer des Gutscheins'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `voucher`
--

INSERT INTO `voucher` (`voucherID`, `voucherCode`, `creationDate`, `expireDate`, `value`, `redeemed`, `userID`) VALUES
(1, '2d5fr', '2022-05-08', '2022-06-25', 50, 0, 1),
(2, '1s5wo', '2022-05-08', '2022-05-04', 100, 1, 1),
(3, '4sd7e', '2022-05-08', '2022-05-01', 10, 0, 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

--
-- Indizes für die Tabelle `salesheader`
--
ALTER TABLE `salesheader`
  ADD PRIMARY KEY (`salesID`),
  ADD KEY `userID_fk` (`customerID`);

--
-- Indizes für die Tabelle `salesline`
--
ALTER TABLE `salesline`
  ADD PRIMARY KEY (`saleslineID`),
  ADD KEY `productID_fk` (`productID`),
  ADD KEY `salesheaderID_fk` (`salesheaderID`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- Indizes für die Tabelle `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`voucherID`),
  ADD KEY `fk_userID` (`userID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `salesheader`
--
ALTER TABLE `salesheader`
  MODIFY `salesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `salesline`
--
ALTER TABLE `salesline`
  MODIFY `saleslineID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `voucher`
--
ALTER TABLE `voucher`
  MODIFY `voucherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `salesheader`
--
ALTER TABLE `salesheader`
  ADD CONSTRAINT `userID_fk` FOREIGN KEY (`customerID`) REFERENCES `users` (`userID`);

--
-- Constraints der Tabelle `salesline`
--
ALTER TABLE `salesline`
  ADD CONSTRAINT `productID_fk` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`),
  ADD CONSTRAINT `salesheaderID_fk` FOREIGN KEY (`salesheaderID`) REFERENCES `salesheader` (`salesID`);

--
-- Constraints der Tabelle `voucher`
--
ALTER TABLE `voucher`
  ADD CONSTRAINT `fk_userID` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
