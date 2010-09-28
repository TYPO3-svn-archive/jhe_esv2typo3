#
# Table structure for table 'tx_dam'
#
CREATE TABLE tx_dam (
	tx_jheesv2typo3_publishing_house varchar(255) DEFAULT '' NOT NULL,
	tx_jheesv2typo3_place_publishing varchar(255) DEFAULT '' NOT NULL,
	tx_jheesv2typo3_doiprefix varchar(255) DEFAULT '' NOT NULL,
	tx_jheesv2typo3_doklink tinytext,
	tx_jheesv2typo3_contenttype varchar(255) DEFAULT '' NOT NULL,
	tx_jheesv2typo3_field_of_reference varchar(255) DEFAULT '' NOT NULL,
	tx_jheesv2typo3_state_of_law varchar(255) DEFAULT '' NOT NULL,
	tx_jheesv2typo3_area_of_validity varchar(255) DEFAULT '' NOT NULL,
	tx_jheesv2typo3_name_of_law varchar(255) DEFAULT '' NOT NULL,
	tx_jheesv2typo3_short_name_of_law varchar(255) DEFAULT '' NOT NULL,
	tx_jheesv2typo3_abbreviation_of_law varchar(255) DEFAULT '' NOT NULL,
	tx_jheesv2typo3_field_of_law varchar(255) DEFAULT '' NOT NULL,
        tx_jheesv2typo3_field_of_law varchar(255) DEFAULT '' NOT NULL,
	tx_jheesv2typo3_date_of_issue int(11) DEFAULT '0' NOT NULL,
	tx_jheesv2typo3_source_of_proclamation varchar(255) DEFAULT '' NOT NULL,
	tx_jheesv2typo3_modification_date int(11) DEFAULT '0' NOT NULL,
	tx_jheesv2typo3_source_of_modification varchar(255) DEFAULT '' NOT NULL,
	tx_jheesv2typo3_modification_publication_date int(11) DEFAULT '0' NOT NULL,
	tx_jheesv2typo3_commencement int(11) DEFAULT '0' NOT NULL
);