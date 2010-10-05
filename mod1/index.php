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
	$access = is_array($this->pageinfo) ? 1 : 0;

        if (($this->id && $access) || ($BE_USER->user['admin'] && !$this->id)) {
            // Draw the header.
            $this->doc = t3lib_div::makeInstance('mediumDoc');
            $this->doc->backPath = $BACK_PATH;
            $this->doc->form = '<form action="" method="post" enctype="multipart/form-data" >';
			 
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
            //$this->content.=$this->doc->section('',$this->doc->funcMenu($headerSection,t3lib_BEfunc::getFuncMenu($this->id,'SET[function]',$this->MOD_SETTINGS['function'],$this->MOD_MENU['function'])));
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
        global $GLOBALS, $LANG, $BACK_PATH;

        $confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['jhe_esv2typo3']);
        $confArr['targetPath'] = t3lib_extMgm::extPath('jhe_esv2typo3'). 'data/';
        $confArr['backupPath'] = t3lib_extMgm::extPath('jhe_esv2typo3'). 'data/backup/';
        $confArr['donePath'] = t3lib_extMgm::extPath('jhe_esv2typo3'). 'data/done/';

        $content .= '<input type="hidden" name="action" value="startImport">';
        $content .= '<input type="submit" value="' . $LANG->getLL('startImport') . '" />';
        $content .= '<br /><br /><br />';

        if(t3lib_div::_POST('action') == 'startImport') {
            $content .= 'Import geht los!<br />';
            $content .= $this->getDataAndPutItToDB($confArr);
        }
        
	//$content .= '<br />GET:'.t3lib_div::view_array($_GET).'<br />'. 'POST:'.t3lib_div::view_array($_POST).'<br />'. '';
        $this->content .= $this->doc->section('', $content, 0, 1);
    }

    public function getDataAndPutItToDB($confArr){
        //Collect all existing ident numbers in DB
        $identArr = $this->getIdentNoFromDBBeforeDBAction();
        
        //Establishing the ftp connection
        if(!$ftp_connection = $this->establishFTPConnection($confArr['ftpHost'], $confArr['ftpUser'], $confArr['ftpPassword'])) {
            $return .= 'Es wurde keine FTP-Verbindung aufgebaut!<br />';
        } else {
            $return .= 'FTP-Verbindung steht!<br />';
        }

        //Try to change to the file directory
        if (!ftp_chdir($ftp_connection, $confArr['ftpFolder'])) {
            $return .= 'Could not change to the given file directory $ftp_path!<br />';
        } else {
            $return .= 'Das Arbeitsverzeichnis auf dem FTP-Server wurde gefunden!<br />';
        }

        //Get all files in data directory
        $filesArr = ftp_nlist($ftp_connection, ".");
        if(count($filesArr) == 0){
            $return .= 'Es befinden sich zur Zeit keine Dateien im Arbeitsverzeichnis!<br />';
            die;
        }

        //Identify zip files in the right format
        $workingArr = $this->searchForFileWithSpecificFormat($filesArr);
        if(count($workingArr) == 0){
            $return .= 'Es befinden sich zur Zeit keine relevanten Dateien im Arbeitsverzeichnis!<br />';
            die;
        }

        //Copy relevant file(s) to '/data'
         foreach($workingArr as $file){
             $res = $this->copyRelevantFilesFromFTP($ftp_connection, $confArr['targetPath'], $file);
         }
         if(!$res) {
             $return .= 'Could not copy $file from $ftp_server!<br />';
         } else {
             $return .= 'Die Datei ' . $file . ' wurde erfolgreich vom FTP-Server heruntergeladen!<br />';
         }

        //Generates backup file(s)
        foreach($workingArr as $file){
            $success = $this->generateBackupFile($confArr['targetPath'], $confArr['backupPath'], $file);
        }
        if(!$success){
            $return .= 'Backing up $file failed!<br />';
        } else {
            $return .= 'Backup von ' . $file . ' wurde erfolgreich angelegt!<br />';
        }

        //Extract zip file(s)
        foreach($workingArr as $file){
            $extract = $this->extractZipFile($confArr['targetPath'], $file);
        }
        if(!$extract){
            $return .= 'Could not extract $targetFile!<br />';
        } else {
            $return .= 'Die Datei ' . $file . ' wurde erfolgreich entzipped!<br />';
        }

        //Delete the original file(s) from this server
        foreach($workingArr as $file){
            $delete = $this->deleteImportedFile($confArr['targetPath'], $file);
        }
        if(!$delete) {
            $return .= 'Could not delete ' . $file . '!<br />';
        } else {
            $return .= 'Die importierte Datei ' . $file . ' wurde erfolreich wieder gelöscht!<br />';
        }

        //new array container for identifying all imported data for later purpose
        $identImportArr = array();
        $countUpdate = 0;
        $countInsert = 0;

        //für jede Datei im entzippten Ordner
        //read in content of all files in newDir to array $xmlFiles
        foreach($workingArr as $file){
            $dir = $this->getDirNameFromZipFile($file);
            $xmlFiles = t3lib_div::getFilesInDir($confArr['targetPath'] . $dir . '/');
            sort($xmlFiles);

            foreach($xmlFiles as $xmlFile){
                //Check if filetype is xml
                if(substr($xmlFile, -4) == '.xml'){
                    //Extract data from each xml file
                    $xmlArr = t3lib_div::xml2array(file_get_contents($confArr['targetPath'] . $dir . '/' . $xmlFile));

                    //Mapping xml structure <-> tx_dam fieldnames
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
                        'esv.inkrafttreten' => 'tx_jheesv2typo3_commencement'
                    );

                    //generate new array for db action
                    foreach($xmlArr as $subArr) {
                        foreach ($subArr as $k => $v) {
                            $i = str_replace(array_keys($xml2dbMapping), $xml2dbMapping, $k);
                            $xmlArrChanged[$i] = $v;
                        }
                    }

                    //get common t3 data for db action
                    $xmlArrT3 = array(
                        'pid' => $confArr['literatureMainFolder'] //@TODO: DATUMSFELDER ANPASSEN; CRDATE UND MODDATE ANPASSEN
                    );

                    //Merge arrays before db action
                    $xmlArrChanged = array_merge($xmlArrChanged, $xmlArrT3);

                    //check for db action
                    if(in_array($xmlArrChanged['ident'], $identArr)){
                        //Update data in db
                        if (!$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_dam','ident = ' .$xmlArrChanged['ident'], $xmlArrChanged )) {
                            die('DB-Update ' . $xmlArrChanged['ident'] . ' fehlgeschlagen');
                        }

                        ////Collect ident numbers of all imported files for later purpose
                        $identImportArr[] = $xmlArrChanged['ident'];

                        //Copy xml file to done directory
                        $this->copyXmlFileToDone($confArr['targetPath'], $confArr['donePath'], $dir, $xmlFile);

                        //Delete extracted xml files
                        $this->deleteOriginalXmlFile($confArr['targetPath'], $dir, $xmlFile);

                        //Count Updates
                        $countUpdate++;

                    } else {
                        //Insert data to db
                        if (!$GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_dam',$xmlArrChanged )) {
                            die('DB-Insert ' . $xmlArrChanged['ident'] . ' fehlgeschlagen');
                        }
                        ////Collect ident numbers of all imported files for later purpose
                        $identImportArr[] = $xmlArrChanged['ident'];

                        //Copy xml file to done directory
                        $this->copyXmlFileToDone($confArr['targetPath'], $confArr['donePath'], $dir, $xmlFile);

                        //Delete extracted xml files
                        $this->deleteOriginalXmlFile($confArr['targetPath'], $dir, $xmlFile);

                        //Count Inserts
                        $countInsert++;

                    }
                } else {
                    //@TODO: Loggen)
                }
            }
            $return .= $countUpdate . ' Updates / ' . $countInsert . ' Inserts<br />';

            //Delete temporary directory if empty after db action
            if(count(t3lib_div::getFilesInDir($confArr['targetPath'] . $dir)) == 0){
                if(!$this->deleteTemporaryDirectory($confArr['targetPath'], $dir)) {
                    $return .= 'Arbeitsverzeichnis ' . $confArr['targetPath'] . $dir . ' konnte nicht gelöscht werden!<br />';
                } else {
                    $return .= 'Arbeitsverzeichnis ' .  $dir . ' wurde erfolgreich gelöscht!<br />';
                }
            }
            
        }

        //Get flag for delete action from configuration
        if($confArr['delete'] == '1'){
            $countDelete = 0;
            //Mark all untouched records as deleted
            $deleteArr = array_diff($identArr, $identImportArr);
            foreach($deleteArr as $deleteFile){
                if (!$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_dam','ident = ' .$deleteFile, array('deleted' => '1'))) {
                    die('DB-Update für Datensatz mit der IdentNo. ' . $deleteFile . ' fehlgeschlagen');
                }
                $countDelete++;
            }
        $return .= 'Es wurden ' . $countDelete . ' Datensätze gelöscht!<br />';

        }

        //Deletes used zip file from ftp server
        foreach($workingArr as $remoteFile){
            if(!ftp_delete($ftp_connection, $confArr['ftpFolder'].$remoteFile)){
                $return .= 'Die Ursprungsdatei konnte auf dem FTP-Server nicht gelöscht werden!<br />';
            } else {
                $return .= 'Die Ursprungsdatei wurde auf dem FTP-Server gelöscht!<br />';
            }
        }
        

        //Close ftp connectiom
        if(!ftp_close($ftp_connection)) {
            $return .= 'Die FTP-Verbindung konnte nicht geschlossen werden!<br />';
        } else {
            $return .= 'Die FTP-Verbindung wurde beendet!<br />';
        }

        return $return;
    }

    //get all ident numbers from actual tx_dam
    private function getIdentNoFromDBBeforeDBAction() {
        $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
            'ident',
            'tx_dam',
            ' deleted = 0 AND hidden = 0'
        );
        
        $identArr = array();
        while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
            $identArr[] = $row['ident'];
        }

        return $identArr;
    }

    // Search for files with specific names in $filesArr
    // File name begins with 'bad_export', ends with '.zip'
    private function searchForFileWithSpecificFormat($filesArr) {
        $cleanedFilesArr = array();
        foreach($filesArr as $file){
            if(substr($file, -4) == '.zip'){
                if (substr($file, 0, 10) == 'bad_export') {
                    $cleanedFilesArr[] = $file;
                }
            }
        }
        return $cleanedFilesArr;
    }

    //Get new directory name from filename for later file operations
    private function getDirNameFromZipFile ($file) {
        return substr($file, 0, -4);
    }

    private function copyRelevantFilesFromFTP($ftp_connection, $targetPath, $file){
        $targetFile = $targetPath . $file;
        if (!ftp_get($ftp_connection, $targetFile, $file, FTP_BINARY)) {
            return false;
        } else {
            return true;
        }
    }

    //Generate backup file
    private function generateBackupFile($targetPath, $backupPath, $file){
        $targetFile = $targetPath . $file;
        $backupFile = $backupPath . $file;
        if (!copy($targetFile, $backupFile)) {
            return false;
        } else {
            return true;
        }
    }
    
    //Extract zip file
    private function extractZipFile($targetPath, $file){
        $targetFile = $targetPath . $file;
        //if(!system("unzip $targetFile -d $targetPath", $retVal)) {
        if(!exec("unzip $targetFile -d $targetPath")) {
            return false;
        } else {
            return true;
        }
    }
    
    //Delete imported file
    private function deleteImportedFile($targetPath, $file){
        $targetFile = $targetPath . $file;
        if(!unlink($targetFile)) {
            return false;
        } else {
            return true;
        }
    }

    function establishFTPConnection($server,$user, $pw){
        // Connect to ftp server
	$conn_id = ftp_connect($server);

        // Login w/ given username and password
        $login_result = ftp_login($conn_id, $user, $pw);

	// Check connection to ftp server
        if ((!$conn_id) || (!$login_result)) {
            die('Establishing the connection to $server failed!');
	}
        
        return $conn_id;
    }

    private function copyXmlFileToDone($targetPath, $donePath, $dir, $file){
        if(!is_dir($donePath . $dir . '/')){
            if(!mkdir($donePath . $dir . '/')){
                die('Kann das Verzeichnis ' . $donePath . $dir . '/ nicht anlegen!');
            }
        } 
        $source = $targetPath . $dir . '/' . $file;
        $destination = $donePath . $dir . '/' . $file;
        if(!copy($source, $destination)){
            die('$file konnte nicht nach $destination verschoben werden!');
        }
    }

    private function deleteOriginalXmlFile($targetPath, $dir, $file){
        $targetFile = $targetPath . $dir . '/' . $file;
        if(!unlink($targetFile)) {
            return false;
        } else {
            return true;
        }
    }

    private function deleteTemporaryDirectory($targetPath, $dir) {
        $targetDir = $targetPath . $dir;
        if(!rmdir($targetDir)) {
            return false;
        } else {
            return true;
        }
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