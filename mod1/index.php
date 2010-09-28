<?php
	/***************************************************************
	*  Copyright notice
	*
	*  (c) 2010 Jari-Hermann Ernst <jari-hermann.ernst@bad-gmbh.de>
	*  All rights reserved
	*
	*  This script is part of the TYPO3 project. The TYPO3 project is
	*  free software; you can redistribute it and/or modify
	*  it under the terms of the GNU General Public License as published by
	*  the Free Software Foundation; either version 2 of the License, or
	*  (at your option) any later version.
	*
	*  The GNU General Public License can be found at
	*  http://www.gnu.org/copyleft/gpl.html.
	*
	*  This script is distributed in the hope that it will be useful,
	*  but WITHOUT ANY WARRANTY; without even the implied warranty of
	*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	*  GNU General Public License for more details.
	*
	*  This copyright notice MUST APPEAR in all copies of the script!
	***************************************************************/
	/**
	* [CLASS/FUNCTION INDEX of SCRIPT]
	*
	*
	*
	*   57: class  tx_jheesv2typo3_module1 extends t3lib_SCbase
	*   65:     function init()
	*   82:     function menuConfig()
	*  100:     function main()
	*  119:     function jumpToUrl(URL)
	*  169:     function printContent()
	*  180:     function moduleContent()
	*
	* TOTAL FUNCTIONS: 6
	* (This index is automatically created/updated by the extension "extdeveval")
	*
	*/
	 
	 
	$LANG->includeLLFile('EXT:jhe_esv2typo3/mod1/locallang.xml');
	require_once(PATH_t3lib . 'class.t3lib_scbase.php');
	$BE_USER->modAccess($MCONF, 1); // This checks permissions and exits if the users has no permission for entry.
	// DEFAULT initialization of a module [END]
	 
	 
	 
	/**
	* Module 'Erich Schmidt Verlag' for the 'jhe_esv2typo3' extension.
	*
	* @author Jari-Hermann Ernst <jari-hermann.ernst@bad-gmbh.de>
	* @package TYPO3
	* @subpackage tx_jheesv2typo3
	*/
	class tx_jheesv2typo3_module1 extends t3lib_SCbase {
		var $pageinfo;
		 
		/**
		* Initializes the Module
		*
		* @return void
		*/
		function init() {
			global $BE_USER, $LANG, $BACK_PATH, $TCA_DESCR, $TCA, $CLIENT, $TYPO3_CONF_VARS;
			 
			parent::init();
			 
			/*
			if (t3lib_div::_GP('clear_all_cache')) {
			$this->include_once[] = PATH_t3lib.'class.t3lib_tcemain.php';
			}
			*/
		}
		 
		/**
		* Adds items to the->MOD_MENU array. Used for the function menu selector.
		*
		* @return void
		*/
		function menuConfig() {
			global $LANG;
			$this->MOD_MENU = Array (
			'function' => Array (
			'1' => $LANG->getLL('function1'),
				'2' => $LANG->getLL('function2'),
				'3' => $LANG->getLL('function3'),
				)
			);
			parent::menuConfig();
		}
		 
		/**
		* Main function of the module. Write the content to $this->content
		* If you chose "web" as main module, you will need to consider the $this->id parameter which will contain the uid-number of the page clicked in the page tree
		*
		* @return [type]  ...
		*/
		function main() {
			global $BE_USER, $LANG, $BACK_PATH, $TCA_DESCR, $TCA, $CLIENT, $TYPO3_CONF_VARS;
			 
			// Access check!
			// The page will show only if there is a valid page and if this page may be viewed by the user
			$this->pageinfo = t3lib_BEfunc::readPageAccess($this->id, $this->perms_clause);
			$access = is_array($this->pageinfo) ? 1 :
			 0;
			 
			if (($this->id && $access) || ($BE_USER->user['admin'] && !$this->id)) {
				 
				// Draw the header.
				$this->doc = t3lib_div::makeInstance('mediumDoc');
				$this->doc->backPath = $BACK_PATH;
				$this->doc->form = '<form action="" method="post" enctype="multipart/form-data">';
				 
				// JavaScript
				$this->doc->JScode = '
					<script language="javascript" type="text/javascript">
					script_ended = 0;
					function jumpToUrl(URL) {
					document.location = URL;
					}
					</script>
					';
				$this->doc->postCode = '
					<script language="javascript" type="text/javascript">
					script_ended = 1;
					if (top.fsMod) top.fsMod.recentIds["web"] = 0;
					</script>
					';
				 
				$headerSection = $this->doc->getHeader('pages', $this->pageinfo, $this->pageinfo['_thePath']).'<br />'.$LANG->sL('LLL:EXT:lang/locallang_core.xml:labels.path').': '.t3lib_div::fixed_lgd_pre($this->pageinfo['_thePath'], 50);
				 
				$this->content .= $this->doc->startPage($LANG->getLL('title'));
				$this->content .= $this->doc->header($LANG->getLL('title'));
				$this->content .= $this->doc->spacer(5);
				//      $this->content.=$this->doc->section('',$this->doc->funcMenu($headerSection,t3lib_BEfunc::getFuncMenu($this->id,'SET[function]',$this->MOD_SETTINGS['function'],$this->MOD_MENU['function'])));
				$this->content .= $this->doc->divider(5);
				 
				 
				// Render content:
				$this->moduleContent();
				 
				 
				// ShortCut
				if ($BE_USER->mayMakeShortcut()) {
					$this->content .= $this->doc->spacer(20).$this->doc->section('', $this->doc->makeShortcutIcon('id', implode(',', array_keys($this->MOD_MENU)), $this->MCONF['name']));
				}
				 
				$this->content .= $this->doc->spacer(10);
			} else {
				// If no access or if ID == zero
				 
				$this->doc = t3lib_div::makeInstance('mediumDoc');
				$this->doc->backPath = $BACK_PATH;
				 
				$this->content .= $this->doc->startPage($LANG->getLL('title'));
				$this->content .= $this->doc->header($LANG->getLL('title'));
				$this->content .= $this->doc->spacer(5);
				$this->content .= $this->doc->spacer(10);
			}
			 
		}
		 
		/**
		* Prints out the module HTML
		*
		* @return void
		*/
		function printContent() {
			 
			$this->content .= $this->doc->endPage();
			echo $this->content;
		}
		 
		/**
		* Generates the module content
		*
		* @return void
		*/
		function moduleContent() {
			 
			$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['jhe_esv2typo3']);
			 
			$pid = $confArr['litaretureMainFolder'];
			 
			$ftp_server = $confArr['ftpHost'];
			$ftp_path = $confArr['ftpFolder'];
			$ftp_user_name = $confArr['ftpUser'];
			$ftp_user_pass = $confArr['ftpPassword'];
			 
			// Verbindung aufbauen
			$conn_id = ftp_connect($ftp_server);
			 
			// Login mit Benutzername und Passwort
			$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
			 
			// Verbindung überprüfen
			if ((!$conn_id) || (!$login_result)) {
				die("FTP-Verbindungsaufbau ist fehlgeschlagen!");
			}
			 
			// Versuche, in das Daten-Verzeichnis  zu wechseln
			if (!ftp_chdir($conn_id, $ftp_path)) {
				die("Wechsel in das Daten-Verzeichnis ist fehlgeschlagen!");
			}
			 
			//Auslesne der vorhandenen Dateien in ein Array
			$filesArr = ftp_nlist($conn_id, ".");
			 
			//Suche nach Datei mit besonderem Namen im Array $filesArr
			//Format Beginn: 'bad_export' , Ende '.zip'
			foreach ($filesArr as $file) {
				if (substr($file, -4) == '.zip') {
					if (substr($file, 0, 10) == 'bad_export') {
						//Relevante Datei nach '/data' kopieren
						$targetFile = '/html/typo3/typo3conf/ext/jhe_esv2typo3/data/'.$file;
						$backupFile = '/html/typo3/typo3conf/ext/jhe_esv2typo3/data/backup/'.$file;
						if (!ftp_get($conn_id, $targetFile, $file, FTP_BINARY)) {
							die('Datei $file konnte nicht vom FTP-Server $ftp_server geholt werden');
						}
						 
						//Sicherungskopie erstellen
						if (!copy($targetFile, $backupFile)) {
							die('Es konnte keine Sicherungskopie erstellt werden!');
						}
						 
						//Datei entzippen
						if (!system("unzip $targetFile -d /html/typo3/typo3conf/ext/jhe_esv2typo3/data/")) {
							die('Datei $targetFile konnte nicht entpackt werden!<br />');
						}
						 
						//Ursprungsdatei löschen
						if (!unlink($targetFile)) {
							die('Datei $targetFile konnte nicht gelöscht werden!');
						}
						 
						$newDir = substr($file, 0, -4);
						 
						$xmlFiles = t3lib_div::getFilesInDir('/html/typo3/typo3conf/ext/jhe_esv2typo3/data/' . $newDir . '/');
						 
						foreach ($xmlFiles as $xmlFile) {
							$xmlArr = t3lib_div::xml2array(file_get_contents('/html/typo3/typo3conf/ext/jhe_esv2typo3/data/' . $newDir . '/' . $xmlFile));
							 
							$xml2dbMapping = array(
							'esv.verlagsname' => 'tx_jheesv2typo3_publishing_house',
								'esv.verlagsort' => 'tx_jheesv2typo3_place_publishing',
								'esv.copyright' => 'copyright',
								'esv.doipraefix' => 'tx_jheesv2typo3_doiprefix',
								'esv.nodeid' => 'ident',
								'esv.herausgeber' => 'publisher',
								'esv.titel' => 'title',
								'esv.doklink' => 'tx_dam.tx_jheesv2typo3_doklink',
								'esv.inhaltstyp' => 'tx_jheesv2typo3_contenttype',
								'esv.sachgebiet' => 'tx_jheesv2typo3_field_of_reference',
								'esv.gesetzstatus' => 'tx_jheesv2typo3_state_of_law',
								'esv.gesetzbereich' => 'tx_jheesv2typo3_field_of_law',
								'esv.gesetzbezeichnung' => 'tx_jheesv2typo3_name_of_law',
								'esv.gesetzkurzname' => 'tx_jheesv2typo3_short_name_of_law',
								'esv.gesetzabkuerzung' => 'tx_jheesv2typo3_abbreviation_of_law',
								'esv.rechtsgebiet' => 'tx_jheesv2typo3_field_of_law',
								'esv.ausfertigungsdatum' => 'tx_jheesv2typo3_date_of_issue',
								'esv.verkuendungsfundstelle' => 'tx_jheesv2typo3_source_of_proclamation',
								'esv.aenderungsdatum' => 'tx_jheesv2typo3_modification_date',
								'esv.aenderungfundstelle' => 'tx_jheesv2typo3_source_of_modification',
								'esv.aenderungspublikationsdatum' => 'tx_jheesv2typo3_modification_publication_date',
								'esv.inkrafttreten' => 'tx_jheesv2typo3_commencement');
							 
							foreach($xmlArr as $subArr) {
								foreach ($subArr as $k => $v) {
									$i = str_replace(array_keys($xml2dbMapping), $xml2dbMapping, $k);
									$xmlArrChanged[$i] = $v;
								}
							}
							 
							$xmlArrT3 = array(
							'pid' => $pid );
							 
							$xmlArrChanged = array_merge($xmlArrChanged, $xmlArrT3);
							 
							if (!$GLOBALS['TYPO3_DB']->exec_INSERTquery(
							'tx_dam',
								$xmlArrChanged )) {
								die('DB-Insert fehlgeschlagen');
							}
							 
							 
						}
						 
						 
					}
				}
			}
			 
			$source = '/html/typo3/typo3conf/ext/jhe_esv2typo3/data/' . $newDir;
			$destination = '/html/typo3/typo3conf/ext/jhe_esv2typo3/data/done/' . $newDir;
			if (!system("mv $source $destination")) {
				die('Ordner ' . $newDir . ' konnte nach dem Datenbank-Insert nicht in das done-Verzeichnis verschoben werden!');
			}
			 
			// Verbindung schließen
			ftp_close($conn_id);
			 
			 
			 
			 
			 
			 
			 
			$content .= 'GET:'.t3lib_div::view_array($_GET).'<br />'. 'POST:'.t3lib_div::view_array($_POST).'<br />'. '';
			$this->content .= $this->doc->section('', $content, 0, 1);
		}
		 
	}
	 
	 
	 
	if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/jhe_esv2typo3/mod1/index.php']) {
		include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/jhe_esv2typo3/mod1/index.php']);
	}
	 
	 
	 
	 
	// Make instance:
	$SOBE = t3lib_div::makeInstance('tx_jheesv2typo3_module1');
	$SOBE->init();
	 
	// Include files?
	foreach($SOBE->include_once as $INC_FILE) include_once($INC_FILE);
	 
	$SOBE->main();
	$SOBE->printContent();
	 
?>
