<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}
$tempColumns = array (
	'tx_jheesv2typo3_publishing_house' => array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:jhe_esv2typo3/locallang_db.xml:tx_dam.tx_jheesv2typo3_publishing_house',		
		'config' => array (
			'type' => 'input',	
			'size' => '30',	
			'eval' => 'trim',
		)
	),
	'tx_jheesv2typo3_place_publishing' => array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:jhe_esv2typo3/locallang_db.xml:tx_dam.tx_jheesv2typo3_place_publishing',		
		'config' => array (
			'type' => 'input',	
			'size' => '30',	
			'eval' => 'trim',
		)
	),
	'tx_jheesv2typo3_doiprefix' => array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:jhe_esv2typo3/locallang_db.xml:tx_dam.tx_jheesv2typo3_doiprefix',		
		'config' => array (
			'type' => 'input',	
			'size' => '30',	
			'eval' => 'trim',
		)
	),
	'tx_jheesv2typo3_doklink' => array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:jhe_esv2typo3/locallang_db.xml:tx_dam.tx_jheesv2typo3_doklink',		
		'config' => array (
			'type'     => 'input',
			'size'     => '15',
			'max'      => '255',
			'checkbox' => '',
			'eval'     => 'trim',
			'wizards'  => array(
				'_PADDING' => 2,
				'link'     => array(
					'type'         => 'popup',
					'title'        => 'Link',
					'icon'         => 'link_popup.gif',
					'script'       => 'browse_links.php?mode=wizard',
					'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
				)
			)
		)
	),
	'tx_jheesv2typo3_contenttype' => array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:jhe_esv2typo3/locallang_db.xml:tx_dam.tx_jheesv2typo3_contenttype',		
		'config' => array (
			'type' => 'input',	
			'size' => '30',	
			'eval' => 'trim',
		)
	),
	'tx_jheesv2typo3_field_of_reference' => array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:jhe_esv2typo3/locallang_db.xml:tx_dam.tx_jheesv2typo3_field_of_reference',		
		'config' => array (
			'type' => 'input',	
			'size' => '30',	
			'eval' => 'trim',
		)
	),
	'tx_jheesv2typo3_state_of_law' => array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:jhe_esv2typo3/locallang_db.xml:tx_dam.tx_jheesv2typo3_state_of_law',		
		'config' => array (
			'type' => 'input',	
			'size' => '30',	
			'eval' => 'trim',
		)
	),
	'tx_jheesv2typo3_area_of_validity' => array (
		'exclude' => 0,		
		'label' => 'LLL:EXT:jhe_esv2typo3/locallang_db.xml:tx_dam.tx_jheesv2typo3_area_of_validity',
		'config' => array (
			'type' => 'input',	
			'size' => '30',	
			'eval' => 'trim',
		)
	),
	'tx_jheesv2typo3_name_of_law' => array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:jhe_esv2typo3/locallang_db.xml:tx_dam.tx_jheesv2typo3_name_of_law',		
		'config' => array (
			'type' => 'input',	
			'size' => '30',	
			'eval' => 'trim',
		)
	),
	'tx_jheesv2typo3_short_name_of_law' => array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:jhe_esv2typo3/locallang_db.xml:tx_dam.tx_jheesv2typo3_short_name_of_law',		
		'config' => array (
			'type' => 'input',	
			'size' => '30',	
			'eval' => 'trim',
		)
	),
	'tx_jheesv2typo3_abbreviation_of_law' => array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:jhe_esv2typo3/locallang_db.xml:tx_dam.tx_jheesv2typo3_abbreviation_of_law',		
		'config' => array (
			'type' => 'input',	
			'size' => '30',	
			'eval' => 'trim',
		)
	),
        'tx_jheesv2typo3_field_of_law' => array (
		'exclude' => 0,
		'label' => 'LLL:EXT:jhe_esv2typo3/locallang_db.xml:tx_dam.tx_jheesv2typo3_field_of_law',
		'config' => array (
			'type' => 'input',
			'size' => '30',
			'eval' => 'trim',
		)
	),
	'tx_jheesv2typo3_date_of_issue' => array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:jhe_esv2typo3/locallang_db.xml:tx_dam.tx_jheesv2typo3_date_of_issue',		
		'config' => array (
			'type'     => 'input',
			'size'     => '8',
			'max'      => '20',
			'eval'     => 'date',
			'checkbox' => '0',
			'default'  => '0'
		)
	),
	'tx_jheesv2typo3_source_of_proclamation' => array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:jhe_esv2typo3/locallang_db.xml:tx_dam.tx_jheesv2typo3_source_of_proclamation',		
		'config' => array (
			'type' => 'input',	
			'size' => '30',	
			'eval' => 'trim',
		)
	),
	'tx_jheesv2typo3_modification_date' => array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:jhe_esv2typo3/locallang_db.xml:tx_dam.tx_jheesv2typo3_modification_date',		
		'config' => array (
			'type'     => 'input',
			'size'     => '8',
			'max'      => '20',
			'eval'     => 'date',
			'checkbox' => '0',
			'default'  => '0'
		)
	),
	'tx_jheesv2typo3_source_of_modification' => array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:jhe_esv2typo3/locallang_db.xml:tx_dam.tx_jheesv2typo3_source_of_modification',		
		'config' => array (
			'type' => 'input',	
			'size' => '30',	
			'eval' => 'trim',
		)
	),
	'tx_jheesv2typo3_modification_publication_date' => array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:jhe_esv2typo3/locallang_db.xml:tx_dam.tx_jheesv2typo3_modification_publication_date',		
		'config' => array (
			'type'     => 'input',
			'size'     => '8',
			'max'      => '20',
			'eval'     => 'date',
			'checkbox' => '0',
			'default'  => '0'
		)
	),
	'tx_jheesv2typo3_commencement' => array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:jhe_esv2typo3/locallang_db.xml:tx_dam.tx_jheesv2typo3_commencement',		
		'config' => array (
			'type'     => 'input',
			'size'     => '8',
			'max'      => '20',
			'eval'     => 'date',
			'checkbox' => '0',
			'default'  => '0'
		)
	),
);


t3lib_div::loadTCA('tx_dam');
t3lib_extMgm::addTCAcolumns('tx_dam',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('tx_dam','tx_jheesv2typo3_publishing_house;;;;1-1-1, tx_jheesv2typo3_place_publishing, tx_jheesv2typo3_doiprefix, tx_jheesv2typo3_doklink, tx_jheesv2typo3_contenttype, tx_jheesv2typo3_field_of_reference, tx_jheesv2typo3_state_of_law, tx_jheesv2typo3_field_of_law, tx_jheesv2typo3_name_of_law, tx_jheesv2typo3_short_name_of_law, tx_jheesv2typo3_abbreviation_of_law, tx_jheesv2typo3_date_of_issue, tx_jheesv2typo3_source_of_proclamation, tx_jheesv2typo3_modification_date, tx_jheesv2typo3_source_of_modification, tx_jheesv2typo3_modification_publication_date, tx_jheesv2typo3_commencement');


t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key';


t3lib_extMgm::addPlugin(array(
	'LLL:EXT:jhe_esv2typo3/locallang_db.xml:tt_content.list_type_pi1',
	$_EXTKEY . '_pi1',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');


if (TYPO3_MODE == 'BE') {
	t3lib_extMgm::addModulePath('web_txjheesv2typo3M1', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');
		
	t3lib_extMgm::addModule('web', 'txjheesv2typo3M1', '', t3lib_extMgm::extPath($_EXTKEY) . 'mod1/');
}
?>