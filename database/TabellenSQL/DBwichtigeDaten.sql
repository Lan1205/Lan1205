--
-- Daten für Tabelle `bearbeitung`
--

INSERT INTO `bearbeitung` (`bearbeitungID`, `bezeichnung`, `kurzform`) VALUES
(0, 'Ohne', ' '),
(1, 'Extra grooved', '-'),
(2, 'Siped', '|'),
(3, 'Extra grooved und siped', '+');

-- --------------------------------------------------------
--
-- Daten für Tabelle `mischung`
--

INSERT INTO `mischung` (`rennID`, `mischungID`, `mischung`, `bezeichnung`, `kontingent`) VALUES
(6, 4, 'Cold', '1', 30),
(6, 5, 'Medium', '2', 5),
(6, 6, 'Hot', '3', 42),
(6, 7, 'Itermediate', '4', 55),
(6, 8, 'Dry wet', '5', 13),
(6, 9, 'Heavy wet', '7', 20);