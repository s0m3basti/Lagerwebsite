CREATE TABLE `tbl_stammdaten` (
  `TeilnehmerID` varchar(15) COLLATE utf8_german2_ci NOT NULL,
  `Nachname` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  `Vorname` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  `Geschlecht` varchar(10) COLLATE utf8_german2_ci DEFAULT NULL,
  `Geburtstag` date DEFAULT NULL,
  `LagerAlter` int(2) DEFAULT NULL,
  `Jahr` date DEFAULT NULL,
);

CREATE TABLE `tbl_anmeldedaten` (
  `TeilnehmerID` varchar(15) COLLATE utf8_german2_ci NOT NULL,
  `Schwimmer` varchar(10) COLLATE utf8_german2_ci DEFAULT NULL,
  `Schwimmstufe` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  `Badeerlaubnis` varchar(10) COLLATE utf8_german2_ci DEFAULT NULL,
  `Springen` varchar(10) COLLATE utf8_german2_ci DEFAULT NULL,
  `Ernaehrung` varchar(1000) COLLATE utf8_german2_ci DEFAULT NULL,
  `Krankheit` varchar(1000) COLLATE utf8_german2_ci DEFAULT NULL,
  `Medikamente` varchar(1000) COLLATE utf8_german2_ci DEFAULT NULL,
  `Taschengeld` varchar(5) COLLATE utf8_german2_ci DEFAULT NULL,
  `Versicherung_art` varchar(10) COLLATE utf8_german2_ci DEFAULT NULL,
  `Versicherung_name` varchar(50) COLLATE utf8_german2_ci DEFAULT NULL,
  `KFZ` varchar(5) COLLATE utf8_german2_ci DEFAULT NULL,
  `Ratenzahlung` varchar(5) COLLATE utf8_german2_ci DEFAULT NULL,
  `Raten_anzahl` varchar(2) COLLATE utf8_german2_ci DEFAULT NULL,
  `Shirts` varchar(5) COLLATE utf8_german2_ci DEFAULT NULL,
  `Shirts_anzahl` varchar(5) COLLATE utf8_german2_ci DEFAULT NULL,
  `Shirts_groesse` varchar(10) COLLATE utf8_german2_ci DEFAULT NULL,
  `Datum` date DEFAULT NULL,
  `IP_Adresse` varchar(45) COLLATE utf8_german2_ci DEFAULT NULL
);

CREATE TABLE `tbl_srgb` (
  `TeilnehmerID` varchar(15) COLLATE utf8_german2_ci NOT NULL,
  `Nachname` varchar(50) COLLATE utf8_german2_ci NOT NULL DEFAULT '',
  `Vorname` varchar(50) COLLATE utf8_german2_ci NOT NULL DEFAULT '',
  `Strasse` varchar(100) COLLATE utf8_german2_ci DEFAULT NULL,
  `PLZ` varchar(10) COLLATE utf8_german2_ci DEFAULT NULL,
  `Ort` varchar(50) CHARACTER SET utf8 COLLATE utf8_german2_ci DEFAULT NULL,
  `Tel_pri` varchar(20) COLLATE utf8_german2_ci DEFAULT NULL,
  `Tel_handy` varchar(20) COLLATE utf8_german2_ci DEFAULT NULL,
  `Tel_dienstl` varchar(20) COLLATE utf8_german2_ci DEFAULT NULL,
  `email` varchar(320) COLLATE utf8_german2_ci DEFAULT NULL,
  `mitglied` varchar(5) COLLATE utf8_german2_ci DEFAULT NULL,
  `mitarbeiter` varchar(5) COLLATE utf8_german2_ci DEFAULT NULL,
  `Datum` date NOT NULL,
  `IP_Adresse` varchar(45) COLLATE utf8_german2_ci NOT NULL
)