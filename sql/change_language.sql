
-- De oorspronkelijke tabel hernoemen
ALTER TABLE stockgroups
RENAME TO stockgroups_en;

--nieuwe tabel aanmaken (voor nl)
CREATE TABLE IF NOT EXISTS stockgroups_nl
(
    StockGroupID	INT(11)		NOT NULL,
    StockGroupName	VARCHAR(50) NOT NULL,
    LastEditedBy 	INT(11)		NOT NULL,
    ValidFrom 		DATETIME  	NOT NULL,
    ValidTo 		DATETIME 	NOT NULL,
    ImagePath		VARCHAR(255) NULL,
    PRIMARY KEY (StockGroupID)
    );

--de nieuwe tabel vullen met waarden
INSERT INTO stockgroups_nl
VALUES (1, 'Hebbedingetjes', 1, '2013-01-01 00:00:00', '9999-12-31 23:59:59', 'Chocolate.jpg');

INSERT INTO stockgroups_nl
VALUES (2, 'Kleding', 1, '2013-01-01 00:00:00', '9999-12-31 23:59:59', 'Clothing.jpg');

INSERT INTO stockgroups_nl
VALUES (3, 'Mokken', 1, '2013-01-01 00:00:00', '9999-12-31 23:59:59', 'NULL');

INSERT INTO stockgroups_nl
VALUES (4, 'T-shirt', 1, '2013-01-01 00:00:00', '9999-12-31 23:59:59', 'T-shirts.jpg');

INSERT INTO stockgroups_nl
VALUES (5, 'Vliegtuig Hebbedingetjes', 1, '2013-01-01 00:00:00', '9999-12-31 23:59:59', 'AirlineNovelties.jpg');

INSERT INTO stockgroups_nl
VALUES (6, 'Computer Hebbedingetjes,', 1, '2013-01-01 00:00:00', '9999-12-31 23:59:59', 'ComputerNovelties.jpg');

INSERT INTO stockgroups_nl
VALUES (7, 'USB Hebbedingetjes', 1, '2013-01-01 00:00:00', '9999-12-31 23:59:59', 'USBNovelties.jpg');

INSERT INTO stockgroups_nl
VALUES (8, 'Sloffen', 9, '2013-01-01 00:00:00', '9999-12-31 23:59:59', 'NULL');

INSERT INTO stockgroups_nl
VALUES (9, 'Speelgoed', 1, '2013-01-01 00:00:00', '9999-12-31 23:59:59', 'Toys.jpg');

INSERT INTO stockgroups_nl
VALUES (10, 'Verpakkingsmateriaal', 1, '2013-01-01 00:00:00', '9999-12-31 23:59:59', 'NULL');

--spellingsfouten en wat vertaalwijzigingen
UPDATE stockgroups_nl
SET StockGroupName = 'Computer Hebbedingetjes'
WHERE StockGroupName = 'Computer Hebbedingetjes,';

UPDATE stockgroups_nl
SET StockGroupName = 'Souveniers'
WHERE StockGroupName = 'Hebbedingetjes';

UPDATE stockgroups_nl
SET StockGroupName = 'Vliegtuig Accessoires'
WHERE StockGroupName = 'Vliegtuig Hebbedingetjes';

UPDATE stockgroups_nl
SET StockGroupName = 'Computer Accessoires'
WHERE StockGroupName = 'Computer Hebbedingetjes';

UPDATE stockgroups_nl
SET StockGroupName = 'USB Accessoires'
WHERE StockGroupName = 'USB Hebbedingetjes';

-- verbindingen leggen met de tabel voor nl
ALTER TABLE stockgroups_nl
    ADD FOREIGN KEY (LastEditedBy) REFERENCES people(PersonID);

ALTER TABLE stockitemstockgroups
    ADD FOREIGN KEY (StockGroupID) REFERENCES stockgroups_nl(StockGroupID);

ALTER TABLE specialdeals
    ADD FOREIGN KEY (StockGroupID) REFERENCES stockgroups_nl(StockGroupID);

--nieuwe tabel met vertalingen aanmaken
CREATE TABLE IF NOT EXISTS Translation_table
(
    Name		VARCHAR(50) 		NOT NULL,
    en			VARCHAR(50) 		NOT NULL,
    nl			VARCHAR(50) 		NOT NULL,
    PRIMARY KEY (Name)
    );

-- tabel invullen met waarden
INSERT INTO translation_table (`name`, `en`, `nl`)VALUES
('Kop_overzicht', 'All categories', 'Alle categorieën'),
('Kop_zoeken', 'Search', 'Zoeken'),
('Voorraad_veel_aanwezig', 'Much stock available', 'Veel voorraad aanwezig'),
('Voorraad_afwezig', 'Product unavailable', 'Product niet op voorraad'),
('Voorraad_een_deel1', 'Hurry! Only ', 'Schiet op! Nog'),
('Voorraad_een_deel2', ' item left', ' item op voorraad'),
('Voorraad_minder_dan_vijftig_deel1', 'Hurry! Only ', 'Schiet op! Nog' ),
('Voorraad_minder_dan_vijftig_deel2',' items left', ' items op voorraad'),
('Voorraad_overige_opties', 'items in stock', 'producten op voorraad'),
('Prijs_regel', 'Including VAT', 'Inclusief BTW'),
('Artikelnummer', 'Articlenumber', 'Artikelnummer'),
('Productinformatie-titel_omschrijving', 'Article description', 'Artikelomschrijving'),
('Productinformatie_titel_specificaties', 'Article specifications', 'Artikel specificaties'),
('Productinformatie_specificaties_naam', 'Name', 'Naam'),
('Productinformatie_specificaties_data', 'Data', 'Data'),
('Geen_resultaten1', 'The searched product could not be found', 'Het gezochte product is niet gevonden'),
('Geen_resultaten2', 'Yarr, no results have been found','Oeps, er zijn geen resultaten gevonden'),
('Toevoegen_winkelmandje_button', 'Add to shopping cart', 'Toevoegen aan winkelmandje'),
('Toevoegen_winkelmandje1', 'Product added to ', 'Product is toegevoegd aan '),
('Toevoegen_winkelmandje2', ' shopping cart', 'winkelmandje'),
('Winkelmandje_paginatitel', 'Shopping cart', 'Winkelmandje'),
('Winkelmandje_titel_overzicht', 'Shopping cart contents', 'Overzicht winkelmandje'),
('Winkelmandje_overzicht_afbeelding', 'Image', 'Afbeelding'),
('Winkelmandje_en_checkout_overzicht_naam', 'Name', 'Naam'),
('Winkelmandje_en_checkout_overzicht_aantal', 'Quantity', 'Aantal'),
('Winkelmandje_overzicht_prijs', 'Price(incl. VAT)', 'Prijs(incl. BTW)'),
('Winkelmandje_overzicht_ID', 'ID', 'ID'),
('Winkelmandje_laatste_kolom', 'Delete', 'Verwijderen'),
('Winkelmandje_en_checkout_totaalprijs', 'Total price (incl. VAT)', 'Totaalprijs (incl. BTW)'),
('Winkelmandje_overzicht_button', 'Place order', 'Plaats bestelling'),
('Winkelmanjde_leeg_winkelmandje', 'You can''t place an order with an empty cart', 'Je kan geen bestelling plaatsen met een lege winkelmand'),
('Checkout_paginatitel', 'Pay order', 'Afrekenen bestelling' ),
('Checkout_titel_overzicht', 'Order summary', 'Samenvatting bestelling'),
('Checkout_overzicht_kop_prijs_extra', 'Price per product(incl. VAT):', 'Prijs per product(incl.BTW)'),
('Persoonsgegevens_titel', 'Contact information: ', 'Contact informatie: '),
('Persoonsgegevens_voornaam', 'First name', 'Voornaam'),
('Persoonsgegevens_achternaam', 'Last name', 'Achternaam'),
('Persoonsgegevens_bezorg_postcode','Delivery postal code', 'Bezorg postcode' ),
('Persoonsgegevens_postcode', 'Postal code', 'Postcode'),
('Persoonsgegevens_huisnummer', 'House number', 'Huisnummer'),
('Persoonsgegevens_stad', 'City', 'Stad'),
('Persoonsgegevens_e-mail', 'e.g Example@windesheim.nl', 'bijv. Voorbeeld@windesheim.nl'),
('Persoonsgegevens_telefoonnummer', 'Phone number', 'Telefoonnummer'),
('Persoonsgegevens_bezorgadres', 'Delivery Addres', 'Bezorgadres'),
('Persoonsgegevens_bezorgadres_toevoeging', 'Apartment, suite, etc.', 'Appartement, suite, enz.'),
('Persoonsgegevens_postadres', 'Postal adres', 'Postadres'),
('Persoonsgegevens_postadres_toevoeging', 'Postal address 2', 'Postadres 2'),
('Persoonsgegevens_knop_naar_winkelmand', 'Back to shopping cart', 'Terug naar winkelmand'),
('Persoonsgegevens_knop_naar_iDeal', 'Confirm and continue', 'Bevestig en doorgaan'),
('Betaalpagina_paginatitel', 'iDeal confirmation screen', 'Ideal bevestigingsscherm'),
('Betaalpagina-totaalprijs', 'Amount to pay', 'Te betalen'),
('Betaalpagina-keuze_bank', 'Choose your bank', 'Kies je bank'),
('Betaalpagina_bank_ABN-Amro', 'ABN Amro', 'ABN Amro'),
('Betaalpagina_bank_Bunq', 'Bunq', 'Bunq'),
('Betaalpagina_bank_ING', 'ING', 'ING'),
('Betaalpagina_bank_MoneyYou', 'MoneyYou', 'MoneyYou'),
('Betaalpagina_bank_Rabobank', 'Rabobank', 'Rabobank'),
('Betaalpagina_bank_SNS', 'SNS', 'SNS'),
('Betaalpagina_bank_ASN', 'ASN', 'ASN'),
('Betaalpagina_bank_Knab', 'Knab', 'Knab'),
('Betaalpagina_knop_terug', 'Back', 'Terug'),
('Betaalpagina_knop_betaal', 'Pay', 'Betaal'),
('Betaalbevestigingsscherm_paginatitel', 'Payment is completed screen' ,'Betaling is voltooid scherm'),
('Betaalbevestigingsscherm_tekst', 'The payment has been accepted', 'De betaling is geacepteerd'),
('Betaalbevestigingsscherm_knop_terug_naar_site', 'Return to NerdyGadgets', 'Terug naar NerdyGadgets');

-- extra toevoegingen, spelfouten enzo
UPDATE Translation_table
SET en = 'Price per product(incl. VAT)'
WHERE Name = 'Checkout_overzicht_kop_prijs_extra';

UPDATE Translation_table
SET en = 'shopping cart'
WHERE Name= 'Toevoegen_winkelmandje2';

UPDATE Translation_table
SET nl = 'item op voorraad'
WHERE Name= 'Voorraad_een_deel2';

UPDATE Translation_table
SET nl = 'items op voorraad'
WHERE Name= 'Voorraad_minder_dan_vijftig_deel2';

UPDATE Translation_table
SET en = 'item left'
WHERE Name= 'Voorraad_een_deel2';

UPDATE Translation_table
SET en = 'items left'
WHERE Name= 'Voorraad_minder_dan_vijftig_deel2';

UPDATE Translation_table
SET Name = 'Productinformatie_titel_omschrijving'
WHERE Name = 'Productinformatie-titel_omschrijving';

UPDATE Translation_table
SET nl = 'Alle categorieen'
WHERE Name = 'Kop_overzicht';

UPDATE Translation_table
SET Name = 'Winkelmandje_leeg_winkelmandje'
WHERE Name = 'Winkelmanjde_leeg_winkelmandje';

UPDATE Translation_table
SET en = 'Product added to'
WHERE Name = 'Toevoegen_winkelmandje1';

UPDATE Translation_table
SET nl = 'Product is toegevoegd aan'
WHERE Name = 'Toevoegen_winkelmandje1';

UPDATE Translation_table
SET en = 'Contact information'
WHERE Name = 'Persoonsgegevens_titel';

UPDATE Translation_table
SET en = 'Contact informatie'
WHERE Name = 'Persoonsgegevens_titel';

INSERT INTO Translation_table (`name`, `en`, `nl`)VALUES
('Zoekscherm_hoofdkop', 'Filter', 'Filter'),
('Zoekscherm_kop_zoeken', 'Search', 'Zoeken'),
('Zoekscherm_kop_producten_per_pagina', 'Products per page', 'Producten per pagina'),
('Zoekscherm_kop_sorteren', 'Sort by', 'Sorteren'),
('Zoekscherm_sorteren_optie1', 'Price high to low', 'Prijs hoog naar laag'),
('Zoekscherm_sorteren_optie2', 'Price low to high', 'Prijs laag naar hoog'),
('Zoekscherm_sorteren_optie3', 'Name A-Z', 'Naam A-Z'),
('Zoekscherm_sorteren_optie4', 'Name Z-A', 'Naam Z-A');

-- extra query
UPDATE stockgroups_nl
SET StockGroupName = 'Souvenirs'
WHERE StockGroupName = 'Souveniers';

-- extra query's
UPDATE Translation_table
SET nl = 'Ruime voorraad aanwezig'
WHERE Name= 'Voorraad_veel_aanwezig';

UPDATE Translation_table
SET en = 'Large stock available'
WHERE Name= 'Voorraad_veel_aanwezig';

-- insert into
INSERT INTO Translation_table (`name`, `en`, `nl`)VALUES
    ('Taal_aanpassen_invulveld', 'Select a language', 'Kies je taal' );

-- Nog in TO zetten
UPDATE Translation_table
SET nl = 'Ruime voorraad beschikbaar'
WHERE Name= 'Voorraad_veel_aanwezig';

-- oplossen null waardes -> in TO gezet
UPDATE Stockgroups_nl
SET ImagePath = null
WHERE StockGroupID = 3;

UPDATE Stockgroups_nl
SET ImagePath = null
WHERE StockGroupID = 8;

UPDATE Stockgroups_nl
SET ImagePath = null
WHERE StockGroupID = 10;

INSERT INTO translation_table (`name`, `en`, `nl`)VALUES
('review_button', 'Review this product', 'Schrijf review'),
('review_titel', 'Review', 'Review'),
('Review_titel_in_menu', 'Typ your review', 'Schrijf je Beoordeling'),
('Review_titel_sterren' , 'Rate this product', 'Beoordeel dit product'),
('Review_button_submit', 'Submit', 'Verzend'),
('Review_button_close', 'Close', 'Sluit');