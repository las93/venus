<?php

/**
 * Manage Template
 *
 * @category  	lib
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/venus/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/venus
 * @link      	https://github.com/las93
 * @since     	1.0
 */

namespace Venus\lib;

/**
 * This class manage the Template
 *
 * @category  	lib
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/venus/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/venus
 * @link      	https://github.com/las93
 * @since     	1.0
 */

class Template {

	/**
	 * version
	 *
	 * @var    int
	 */

	const VERSION = '2.0';

	/**
	 * Array of var to assign at the template
	 *
	 * @access private
	 * @var    array
	 */

	private $_aVar = array();

	/**
	 * Template name
	 *
	 * @access private
	 * @var    string
	 */

	private $_sTemplateName = '';

	/**
	 * Cache time
	 *
	 * @access private
	 * @var    int
	 */

	private $_iCacheTime = 3600;

	/**
	 * Caching
	 *
	 * @access private
	 * @var    int
	 */

	private $_iCaching = 0;

	/**
	 * version to use
	 *
	 * @access private
	 * @var    int
	 */

	private $_iVersion = 1;

	/**
	 * Left delimiter
	 *
	 * @access private
	 * @var    string
	 */

	private $_sLeftDelimiter = '{literal}';

	/**
	 * Right delimiter
	 *
	 * @access private
	 * @var    string
	 */

	private $_sRightDelimiter = '{/literal}';

	/**
	 * Right delimiter
	 *
	 * @access private
	 * @var    \Venus\lib\Template
	 */

	private $_oTemplateLink = null;

	/**
	 * constructor of class
	 *
	 * @access public
	 * @param  string $sName name of the template
	 * @return \Venus\lib\Template
	 */

	public function __construct($sName = null) {

		$oMobileDetect = new \Mobile_Detect;

		if ($oMobileDetect->isMobile()) {

			if ($sName && is_string($sName) && strstr($sName, '.tpl')) {

				$sMobileTpl = str_replace('lib', '', __DIR__).str_replace('.tpl', 'Mobile.tpl', $sName);
				if (file_exists($sMobileTpl)) { $sName = str_replace('.tpl', 'Mobile.tpl', $sName); }
			}
		}

		if ($sName !== null) { $this->_sTemplateName = $sName; }
	}

	/**
	 * caching templates
	 *
	 * @access public
	 * @param  int $iValue caching kind
	 * @return \Venus\lib\Template
	 */

	public function caching($iValue) {

		$this->_iCaching = $iValue;
		return $this;
	}

	/**
	 * create link
	 *
	 * @access public
	 * @param  \Venus\lib\Template $oTemplate datas to add
	 * @return \Venus\lib\Template
	 */

	public function createData(\Venus\lib\Template $oTemplate = null) {

		$oNewTemplate = new \Venus\lib\Template;

		if ($oTemplate !== null) {

			$oNewTemplate = $oTemplate->assignAll($this->_aVar);
			$this->_oTemplateLink = $oTemplate;
		}

		return $oNewTemplate;
	}

	/**
	 * set the version to use
	 *
	 * @access public
	 * @param  int $iVersion version to use
	 * @return \Venus\lib\Template
	 */

	public function setVersion($iVersion) {

		$this->_iVersion = $iVersion;
		return $this;
	}

	/**
	 * caching templates
	 *
	 * @access public
	 * @param  int $iValue caching kind
	 * @return \Venus\lib\Template
	 */

	public function time($iValue) {

		$this->_iCacheTime = $iValue;
		return $this;
	}

	/**
	 * assign a variable for the template
	 *
	 * @access public
	 * @param  string $sName name of the variable
	 * @param  mixed $mValue value of the variable
	 * @return \Venus\lib\Template
	 */

	public function assign($sName, $mValue) {

		$this->_aVar[$sName] = $mValue;
		return $this;
	}

	/**
	 * assign all variable for the template
	 *
	 * @access public
	 * @param  mixed $mValue value of the variable
	 * @return \Venus\lib\Template
	 */

	public function assignAll($mValue) {

		$this->_aVar = $mValue;
		return $this;
	}

	/**
	 * get all assign variables
	 *
	 * @access public
	 * @return mixed
	 */

	public function getAllAssign() {

		return $this->_aVar;
	}

	/**
	 * set a left delimiter
	 *
	 * @access public
	 * @param  string $sValue value of delimiter
	 * @return \Venus\lib\Template
	 */

	public function setLeftDelimiter($sValue) {

		$this->_sLeftDelimiter = $sValue;
		return $this;
	}

	/**
	 * set a rigth delimiter
	 *
	 * @access public
	 * @param  string $sValue value of delimiter
	 * @return \Venus\lib\Template
	 */

	public function setRightDelimiter($sValue) {

		$this->_sRightDelimiter = $sValue;
		return $this;
	}

	/**
	 * get a left delimiter
	 *
	 * @access public
	 * @return string
	 */

	public function getLeftDelimiter() {

		return $this->_sLeftDelimiter;
	}

	/**
	 * get a rigth delimiter
	 *
	 * @access public
	 * @return string
	 */

	public function getRightDelimiter() {

		return $this->_sRightDelimiter;
	}

	/**
	 * show the template
	 *
	 * @access public
	 * @param  string $sName name of the template
	 * @param  \Venus\lib\Template $oTemplate datas to add
	 * @return bool
	 */

	public function display($sName = null, \Venus\lib\Template $oTemplate = null) {

		if ($oTemplate !== null) {

			if ($this->_oTemplateLink !== null) {

				$aVar = $this->getAllAssign();
				$aVar = array_merge($aVar, $this->_oTemplateLink->getAllAssign());
				$this->assignAll($aVar);
			}
		}

		$sTemplate = $this->fetch($sName);
		echo $sTemplate;
	}

	/**
	 * fetch the template
	 *
	 * @access public
	 * @param  string $sName name of the template
	 * @param  bool $bMainCall main call or not
	 * @return string
	 */

	public function fetch($sName = null, $bMainCall = true) {

		$oMobileDetect = new \Mobile_Detect;

		if ($oMobileDetect->isMobile()) {

			if ($sName) {

				$sMobileTpl = str_replace('lib', '', __DIR__).str_replace('.tpl', 'Mobile.tpl', $sName);
				if (file_exists($sMobileTpl)) { $sName = str_replace('.tpl', 'Mobile.tpl', $sName); }
			}

			if (isset($this->_aVar['model'])) {

				$sMobileTpl = str_replace('lib', '', __DIR__).str_replace('.tpl', 'Mobile.tpl', $this->_aVar['model']);
				if (file_exists($sMobileTpl)) { $this->_aVar['model'] = str_replace('.tpl', 'Mobile.tpl', $this->_aVar['model']); }
			}
		}

		if ($sName !== null) { $this->_sTemplateName = $sName; }

		ob_start();

		//if ($this->_iCaching == 1) {

			if (!strstr($this->_sTemplateName, 'View')) {

				$iFileModificationTime = filemtime(str_replace('lib', '', __DIR__).'src'.DIRECTORY_SEPARATOR.PORTAIL.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR.$this->_sTemplateName);
			}
			else {

				$iFileModificationTime = filemtime(str_replace('lib', '', __DIR__).$this->_sTemplateName);
			}

			$sTmpDirectory = str_replace('private'.DIRECTORY_SEPARATOR.'lib', 'data'.DIRECTORY_SEPARATOR.'cache', __DIR__).DIRECTORY_SEPARATOR;

			if (file_exists($sTmpDirectory.$this->_getEncodeTemplateName($this->_sTemplateName).'.cac.php')) {

				$iCacheModificationTime = filemtime($sTmpDirectory.$this->_getEncodeTemplateName($this->_sTemplateName).'.cac.php');
			}
			else {

				$iCacheModificationTime = 0;
			}

			if ($iCacheModificationTime < $iFileModificationTime) {

				$sTemplate = file_get_contents(str_replace('lib', '', __DIR__).$this->_sTemplateName);
				$this->_transform($sTemplate, $this->_sTemplateName, $bMainCall, true);
			}
			else {

				$sTemplate = file_get_contents(str_replace('lib', '', __DIR__).$this->_sTemplateName);
				$this->_transform($sTemplate, $this->_sTemplateName, $bMainCall, false);
			}
		//}
		/*else {

			$sTemplate = file_get_contents(str_replace('lib', '', __DIR__).$this->_sTemplateName);
			$this->_transform($sTemplate, $this->_sTemplateName, $bMainCall);
		}*/

	//	\lib\Benchmark::setPointInLog('END '.$this->_sTemplateName);

		return ob_get_clean();
	}

	/**
	 * assign a variable for the template
	 *
	 * @access private
	 * @param  string $sContent content
	 * @param  string $sTemplateName tempalte name
	 * @param  boolean $bFirst if you call this for the first time
	 * @return bool
	 */

	private function _transform($sContent, $sTemplateName, $bFirst = false, $bDoCompilation = true) {

		if (strstr($sContent, '{* version=2;')) { $this->_iVersion = 2; }

		if ($this->_iVersion === 1) {

			//*****************************************************************************************************************************
			// EX version
			// @deprecated
			//*****************************************************************************************************************************

			// session_start();

			if (!isset($_SERVER['PHP_AUTH_USER'])) { $_SERVER['PHP_AUTH_USER'] = ''; }
			if (!isset($_SESSION)) { $_SESSION = array(); }

			$aProtectedVar = $this->_aVar;
			$aProtectedVar['app']['security'] = array();
			$aProtectedVar['app']['user'] = array('username' => $_SERVER['PHP_AUTH_USER']);
			$aProtectedVar['app']['request'] = $_POST;
			$aProtectedVar['app']['get'] = $_GET;
			$aProtectedVar['app']['session'] = $_SESSION;
			$aProtectedVar['app']['environment'] = $_SERVER;
			$aProtectedVar['app']['debug'] = array();

			$sTmpDirectory = str_replace('private'.DIRECTORY_SEPARATOR.'lib', 'data'.DIRECTORY_SEPARATOR.'cache', __DIR__).DIRECTORY_SEPARATOR;
			// if (DIRECTORY_SEPARATOR != '/') { $sBeforeCharacter = '\\\\'; }
			// else { $sBeforeCharacter = ''; }
			$sTmpDirectory = str_replace('\\', '\\\\\\', $sTmpDirectory);

			$sViewDirectory = str_replace('lib', 'src'.DIRECTORY_SEPARATOR.PORTAIL.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR, __DIR__).DIRECTORY_SEPARATOR;
			$sViewDirectory = str_replace('\\', '\\\\\\', $sViewDirectory);

			$sContent = preg_replace('|\{\*|', '<?php /*', $sContent);
			$sContent = preg_replace('|\*\}|', '*/ ?>', $sContent);

			/** @todo I must test that */

			if (preg_match('|\{include \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)\}|', $sContent, $aMatch)) {

				$this->sTmpDirectory = $sTmpDirectory;
				$sContent = preg_replace_callback('|\{include \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)\}|m', array($this, '_includeTransform'), $sContent);
			}

			if (preg_match('|\{include model\}|', $sContent)) {  

					$sContent = preg_replace('|\{include model\}|', '<?php $aProtectedVar[\'model\'] = preg_replace("#^.+[^a-zA-Z0-9_-]([a-zA-Z0-9_-]+\.tpl)$#msi", "\$1", $aProtectedVar[\'model\']); $oMobileDetect = new \Mobile_Detect; if ($oMobileDetect->isMobile() && file_exists("'.$sTmpDirectory.'".md5(str_replace(".tpl", "Mobile.tpl", str_replace("\\\\\\\\", "/", $aProtectedVar[\'model\']))).".cac.php")) { include "'.$sTmpDirectory.'".md5(str_replace(".tpl", "Mobile.tpl", str_replace("\\\\\\\\", "/", $aProtectedVar[\'model\']))).".cac.php"; } else { include "'.$sTmpDirectory.'".md5(str_replace("\\\\\\\\", "/", $aProtectedVar[\'model\'])).".cac.php"; } ?>', $sContent);

					$oMobileDetect = new \Mobile_Detect;

					if ($oMobileDetect->isMobile() && file_exists(str_replace('lib', 'src/'.PORTAIL.'/View/', __DIR__).str_replace('.tpl', 'Mobile.tpl', $aProtectedVar['model']))) {

						$this->_transform(file_get_contents(str_replace('lib', 'src/'.PORTAIL.'/View/', __DIR__).str_replace('.tpl', 'Mobile.tpl', $aProtectedVar['model'])), str_replace('.tpl', 'Mobile.tpl', $aProtectedVar['model']));
					}
					else {

						$sModelname = str_replace(array('src/'.PORTAIL.'/View/', 'src\\'.PORTAIL.'\View\\'), array('', ''), $aProtectedVar['model']);
						$this->_transform(file_get_contents(str_replace('lib', 'src/'.PORTAIL.'/View/', __DIR__).$sModelname), $sModelname);
					}
				}  

			if (preg_match('|\{include [\'"]([^\'"]+)[\'"]\}|', $sContent)) {

				$this->sTmpDirectory = $sTmpDirectory;
				/*$sContent = preg_replace('|\{include [\'"]([^\'"]+)[\'"]\}|', '<?php include "'.$sViewDirectory.'"."$1"; ?>', $sContent);*/
				$sContent = preg_replace_callback('|\{include [\'"]([^\'"]+)[\'"]\}|m', array($this, '_includeTransform2'), $sContent);
			}

			/** @todo I must test that */

			$sContent = preg_replace('|\{include \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*) assign \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)\}|', '<?php $aProtectedVar[\'$3\']$4 = file_get_contents("'.$sTmpDirectory.'".$aProtectedVar[\'$1\']$2); ?>', $sContent);
			$sContent = preg_replace('|\{include [\'"]([^\'"]+)[\'"] assign \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)\}|', '<?php $aProtectedVar[\'$2\']$3 = file_get_contents("'.$sTmpDirectory.'"."$1"); ?>', $sContent);

			$sContent = preg_replace('|\{url [\'"]([^\'"]+)[\'"] *\}|', '<?php $oUrlManager = new \Venus\core\UrlManager; echo $oUrlManager->getUrl(\'$1\', array()); ?>', $sContent);
			$sContent = preg_replace('|\{url [\'"]([^\'"]+)[\'"] \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)\}|', '<?php $oUrlManager = new \Venus\core\UrlManager; echo $oUrlManager->getUrl(\'$1\', $aProtectedVar[\'$2\']$3); ?>', $sContent);
			$sContent = preg_replace('|\{url [\'"]([^\'"]+)[\'"] [\'"]([^\'"]+)[\'"] as \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)\}|', '<?php $oUrlManager = new \Venus\core\UrlManager; echo $oUrlManager->getUrl(\'$1\', array(\'$2\' => $aProtectedVar[\'$3\']$4)); ?>', $sContent);
			$sContent = preg_replace('|\{url [\'"]([^\'"]+)[\'"] [\'"]([^\'"]+)[\'"] as [\'"]([^\'"]+)[\'"]\}|', '<?php $oUrlManager = new \Venus\core\UrlManager; echo $oUrlManager->getUrl(\'$1\', array(\'$2\' => \'$3\')); ?>', $sContent);
			$sContent = preg_replace('|\{dump \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)\}|', '<?php var_dump($aProtectedVar[\'$1\']$2); ?>', $sContent);

			$sContent = preg_replace('|\{foreach \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*) as \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)\}|', '<?php foreach($aProtectedVar[\'$1\']$2 as $aProtectedVar[\'$3\']$4) { ?>', $sContent);
			$sContent = preg_replace('|\{foreach \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*) as \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*) => \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)\}|', '<?php foreach($aProtectedVar[\'$1\']$2 as $aProtectedVar[\'$3\']$4 => $aProtectedVar[\'$5\']$6) { ?>', $sContent);
			$sContent = preg_replace('|\{/foreach\}|', '<?php } ?>', $sContent);

			$sContent = preg_replace('|\{from ([0-9]+) to ([0-9]+)\}|', '<?php for($aProtectedVar[i] = $1 ; $aProtectedVar[i] <= $2 ; $aProtectedVar[i]++) { ?>', $sContent);
			$sContent = preg_replace('|\{from \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)\}|', '<?php for($aProtectedVar[i] = $1 ; $aProtectedVar[i] <= $aProtectedVar[\'$2\']$3 ; $aProtectedVar[i]++) { ?>', $sContent);
			$sContent = preg_replace('|\{/from\}|', '<?php } ?>', $sContent);

			$sContent = preg_replace('|\{loop \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)\}|', '<?php for($aProtectedVar[\'i\'] = 1 ; $aProtectedVar[\'i\'] <= $aProtectedVar[\'$1\']$2 ; $aProtectedVar[\'i\']++) { ?>', $sContent);
			$sContent = preg_replace('|\{loop ([0-9]+)\}|', '<?php for($aProtectedVar[i] = 1 ; $aProtectedVar[\'i\'] <= $1 ; $aProtectedVar[\'i\']++) { ?>', $sContent);
			$sContent = preg_replace('|\{/loop\}|', '<?php } ?>', $sContent);
			$sContent = preg_replace('|\{\$loop\}|', '<?php echo $aProtectedVar[\'i\']; ?>', $sContent);

			$sContent = preg_replace('|\{even \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)\}|', '<?php if ($aProtectedVar[\'$1\']$2 / 2 == round($aProtectedVar[\'$1\']$2 / 2)) { ?>', $sContent);
			$sContent = preg_replace('|\{odd \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)\}|', '<?php if ($aProtectedVar[\'$1\']$2 / 2 != round($aProtectedVar[\'$1\']$2 / 2)) { ?>', $sContent);
			$sContent = preg_replace('|\{/even\}|', '<?php } ?>', $sContent);
			$sContent = preg_replace('|\{/odd\}|', '<?php } ?>', $sContent);

			$sContent = preg_replace('|\{\$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\).+]*) assign \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)+]*)\}|', '<?php $aProtectedVar[\'$1\']$2 = $aProtectedVar[\'$3\']$4; ?>', $sContent);
			$sContent = preg_replace('|\{\$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\).+]*) assign [\'"]?(.*)[\'"]?\}|', '<?php $aProtectedVar[\'$1\']$2 = \'$3\'; ?>', $sContent);
			$sContent = preg_replace('|\{\$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\).+]*)\}|', '<?php echo $aProtectedVar[\'$1\']$2; ?>', $sContent);

			$sContent = preg_replace('|\{count \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)\}|', '<?php echo count($aProtectedVar[\'$1\']$2); ?>', $sContent);
			$sContent = preg_replace('|\{count \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*) assign \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)\}|', '<?php $aProtectedVar[\'$3\']$4 = count($aProtectedVar[\'$1\']$2); ?>', $sContent);

			$sContent = preg_replace('|\{length \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)\}|', '<?php echo strlen($aProtectedVar[\'$1\']$2); ?>', $sContent);
			$sContent = preg_replace('|\{length \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*) assign \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)\}|', '<?php $aProtectedVar[\'$3\']$4 = strlen($aProtectedVar[\'$1\']$2); ?>', $sContent);

			$sContent = preg_replace('|\{\$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*) default [\']{0,1}([^\']+)[\']{0,1}\}|', '<?php if ($aProtectedVar[\'$1\']$2) { echo $aProtectedVar[\'$1\']$2; } else { echo $3; } ?>', $sContent);
			$sContent = preg_replace('|\{date [\']{0,1}([^\']+)[\']{0,1} \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)\}|', '<?php echo date(\'$1\', $aProtectedVar[\'$2\']$3); } ?>', $sContent);

			$sContent = preg_replace('|\{\$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*) url\}|', '<?php echo urlencode($aProtectedVar[\'$1\']$2); ?>', $sContent);
			$sContent = preg_replace('|\{\$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*) html\}|', '<?php echo htmlentities($aProtectedVar[\'$1\']$2); ?>', $sContent);
			$sContent = preg_replace('|\{\$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*) addslashes\}|', '<?php echo addslashes($aProtectedVar[\'$1\']$2); ?>', $sContent);
			$sContent = preg_replace('|\{\$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*) email\}|', '<?php echo preg_replace(\'/[^a-zA-Z-_.@]+/\', \'\', $aProtectedVar[\'$1\']$2); ?>', $sContent);
			$sContent = preg_replace('|\{\$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*) lower\}|', '<?php echo strtolower($aProtectedVar[\'$1\']$2); ?>', $sContent);
			$sContent = preg_replace('|\{\$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*) nl2br\}|', '<?php echo nl2br($aProtectedVar[\'$1\']$2); ?>', $sContent);
			$sContent = preg_replace('|\{\$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*) upper\}|', '<?php echo strtoupper($aProtectedVar[\'$1\']$2); ?>', $sContent);
			$sContent = preg_replace('|\{\$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*) hour\}|', '<?php echo preg_replace("/^[0-9]{4}-[0-9]{2}-[0-9]{2} ([0-9]{2}:[0-9]{2}):[0-9]{2}$/", "\$'.'1", $aProtectedVar[\'$1\']$2); ?>', $sContent);
			$sContent = preg_replace('|\{\$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*) date\}|', '<?php echo preg_replace("/^([0-9]{4}-[0-9]{2}-[0-9]{2}) [0-9]{2}:[0-9]{2}:[0-9]{2}$/", "\$'.'1", $aProtectedVar[\'$1\']$2); ?>', $sContent);

			/*$sContent = preg_replace('|\{truncate \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*) ([0-9]+)\}|', '<?php echo preg_replace("|^(.{$3}[a-zA-Z0-9_-]+).+$|", "\$'.'1...", $aProtectedVar[\'$1\']$2); ?>', $sContent);*/
			$sContent = preg_replace('|\{truncate \$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*) ([0-9]+)\}|', '<?php echo strip_tags(substr($aProtectedVar[\'$1\']$2, 0, preg_replace("/<[^>]+>/", "", $3))."..."); ?>', $sContent);

			$sContent = str_replace('{else}', '<?php } else { ?>', $sContent);
			$sContent = str_replace('{/if}', '<?php } ?>', $sContent);
			$sContent = preg_replace('|\{if is_granted\(\'([a-zA-Z0-9_]+)\'\) *\}|', '<?php $oSecurity = new \Venus\core\Security; if ($oSecurity->getUserRole() == \'$2\') { ?>', $sContent);
			$sContent = preg_replace('|\{if ([^\}]*)\$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)([^\}]*)\$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)([^\}]*)\}|', '<?php if ($1'.'$aProtectedVar[\'$2\']$3'.'$4'.'$aProtectedVar[\'$5\']$6'.'$7) { ?>', $sContent);
			$sContent = preg_replace('|\{elseif ([^\}]*)\$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)([^\}]*)\$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)([^\}]*)\}|', '<?php } else if ($1'.'$aProtectedVar[\'$2\']$3'.'$4'.'$aProtectedVar[\'$5\']$6'.'$7) { ?>', $sContent);
			$sContent = preg_replace('|\{if ([^\}]*)\$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)([^\}]*)\}|', '<?php if ($1'.'$aProtectedVar[\'$2\']$3'.'$4) { ?>', $sContent);
			$sContent = preg_replace('|\{elseif ([^\}]*)\$([a-zA-Z0-9_]+)([a-zA-Z0-9_\->\[\]"\'\(\)]*)([^\}]*)\}|', '<?php } else if ($1'.'$aProtectedVar[\'$2\']$3'.'$4) { ?>', $sContent);

			$sContent = '<?php /**'."\n".
				' * Optimize template of : '.$sTemplateName.'.php'."\n".
				' */'."\n".
				''."\n".
				'?>'."\n".
				$sContent
			;

			file_put_contents($sTmpDirectory.$this->_getEncodeTemplateName($sTemplateName).'.cac.php', $sContent);

			if ($bFirst === true) {

				include($sTmpDirectory.$this->_getEncodeTemplateName($sTemplateName).'.cac.php');
			}
		}
		else {

			//*****************************************************************************************************************************
			// NEW version
			// @deprecated
			//
			// {$foo[section_name]}? http://www.smarty.net/docs/en/language.syntax.variables.tpl
			//*****************************************************************************************************************************

			$sTmpDirectory = str_replace('private'.DIRECTORY_SEPARATOR.'lib', 'data'.DIRECTORY_SEPARATOR.'cache', __DIR__).DIRECTORY_SEPARATOR;
			$sTmpDirectory = str_replace('\\', '\\\\\\', $sTmpDirectory);

			$sViewDirectory = str_replace('lib', 'src'.DIRECTORY_SEPARATOR.PORTAIL.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR, __DIR__).DIRECTORY_SEPARATOR;
			$sViewDirectory = str_replace('\\', '\\\\\\', $sViewDirectory);

			$_aProtectedVar = $this->_aVar;
			$_aProtectedVar['app']['config'] = array();
			$_aProtectedVar['app']['server'] = $_SERVER;
			$_aProtectedVar['app']['get'] = $_GET;
			$_aProtectedVar['app']['post'] = $_POST;
			$_aProtectedVar['app']['cookies'] = $_COOKIE;
			$_aProtectedVar['app']['env'] = $_ENV;
			$_aProtectedVar['app']['session'] = $_COOKIE;
			$_aProtectedVar['app']['request'] = array_merge($_GET, $_POST, $_COOKIE, $_SERVER, $_ENV);
			$_aProtectedVar['app']['now'] = time();
			$_aProtectedVar['app']['const'] = get_defined_constants();
			$_aProtectedVar['app']['capture'] = array();					// link to {capture} -> to do it
			$_aProtectedVar['app']['section'] = array();					// link to {section} -> to do it
			$_aProtectedVar['app']['template'] = $this->_sTemplateName;
			$_aProtectedVar['app']['template_object'] = $this;
			$_aProtectedVar['app']['current_dir'] = $sViewDirectory;
			$_aProtectedVar['app']['version'] = self::VERSION;
			$_aProtectedVar['app']['block'] = array();						// link to {block} -> to do it
			$_aProtectedVar['app']['block']['child'] = null;
			$_aProtectedVar['app']['block']['parent'] = null;
			$_aProtectedVar['app']['ldelim'] = $this->_sLeftDelimiter;
			$_aProtectedVar['app']['rdelim'] = $this->_sRightDelimiter;


			//if ($bDoCompilation === true) {

				//*****************************************************************************************************************************
				// tags: {counter}, {$SCRIPT_NAME}
				//*****************************************************************************************************************************

				$sContent = str_replace('{counter}', '$_aProtectedVar[\'i\']', $sContent);
				$sContent = str_replace('{$SCRIPT_NAME}', '$_aProtectedVar[\'app\'][\'SERVER\'][\'SCRIPT_NAME\']', $sContent);

				//*****************************************************************************************************************************
				// comments: {* this is a comment *}
				//*****************************************************************************************************************************

				$sContent = preg_replace('|\{\*|', '<?php /*', $sContent);
				$sContent = preg_replace('|\*\}|', '*/ ?>', $sContent);

				//*****************************************************************************************************************************
				// escape: {literal}function bazzy {alert('foobar!');}{/literal}
				//*****************************************************************************************************************************

				$sContent = preg_replace('|'.preg_quote($this->getLeftDelimiter()).'|', "\n".'<?php echo <<<EOF'."\n", $sContent);
				$sContent = preg_replace('|'.preg_quote($this->getRightDelimiter()).'|', "\n".'EOF;'."\n".'?>'."\n", $sContent);

				while (preg_match('|(<<<EOF(?:(?<!EOF;).)+?)\$(.+?EOF;)|msi', $sContent)) {

					$sContent = preg_replace('|(<<<EOF(?:(?<!EOF;).)+?)\$(.+?EOF;)|msi', '$1#DOLLAR#$2', $sContent);
				}


				//*****************************************************************************************************************************
				// variables: {$foo}, {$foo[4]}, {$foo.bar}, {$foo.$bar}, {$foo->bar}, {$foo->bar()}, {$foo.bar.baz}, {$foo.$bar.$baz},
				//				{$foo[4].baz}, {$foo[4].$baz}, {$foo.bar.baz[4]}, {$foo->bar($baz,2,$bar)}, {$app.config.foo},
				//				{$app.server.SERVER_NAME}, {$x+$y}, {$foo[$x+3]}, {$foo={counter}+3}, {$foo="this is message {counter}"},
				//				{$foo=$bar+2}, {$foo = strlen($bar)}, {$foo = myfunct( ($x+$y)*3 )}, {$foo.bar=1}, {$foo.bar.baz=1},
				//				{$foo[]=1}, {$foo.a.b.c}, {$foo.a.$b.c}, {$foo.a.{$b+4}.c}, {$foo.a.{$b.c}}, {$foo['bar']}, {$foo['bar'][1]},
				//				{$foo[$x+$x]}, {$foo[$bar[1]]}, $foo_{$bar}, $foo_{$x+$y}, $foo_{$bar}_buh_{$blar}, {$foo_{$x}}, {time()}
				//				{$foo+1}, {$foo*$bar}, {$app.get.page}, {$app.post.page}, {$app.cookies.page}, , {$app.anv.path},
				//				{$app.session.page}, {$app.request.page}, {$app.now}, {$app.const.page}, {$smarty.capture}, {$smarty.section},
				//				{$smarty.template}, {$smarty.current_dir}, {$smarty.version}, {$smarty.template_object}, {$smarty.block.child},
				//				{$smarty.block.parent}, {$smarty.ldelim}, {$smarty.rdelim}
				// particulier ;
				// version 1 forbiden : {$app['security']}, {$app['user']}, {$app['environment']}, {$app['debug']}
				//*****************************************************************************************************************************

				while (preg_match('|\{(.*?)\$([^_\(][a-z0-9_\[\]\->\(\)\+/*\']+)\.([a-z0-9_]+)(.*?)\}|msi', $sContent, $ret)) {

					$sContent = preg_replace('|\{(.*?)\$([^_\(][a-z0-9_\[\]\->\(\)\+/*\']+)\.([a-z0-9_]+)(.*?)\}|msi',
									'{'.'$1'.'$'.'$2[\'$3\']'.'$4'.'}', $sContent);
				}

				/*
				while (preg_match('|\{(.*?)\$([^_][a-z0-9_]*)([a-z0-9_\[\].\->\(\)\+/*\']*)\.([a-z0-9_\[\]]*)(.*?)\}|msi', $sContent)) {

					$sContent = preg_replace('|\{(.*?)\$([^_][a-z0-9_]*)([a-z0-9_\[\].\->\(\)\+/*\']*)\.([a-z0-9_\[\]]*)(.*?)\}|msi',
								'{'.'$1'.'$_aProtectedVar[\'$2\']$3["$4"]'.'$5'.'}', $sContent);
				}
				*/

				while (preg_match('|\{(.*?)\$([^_\(][a-z0-9_]*)([a-z0-9_\[\].\->\(\)\+/*\']*)(.*?)\}|msi', $sContent)) {

					$sContent = preg_replace('|\{(.*?)\$([^_\(][a-z0-9_]*)([a-z0-9_\[\].\->\(\)\+/*\']*)(.*?)\}|msi',
						'{'.'$1'.'$_aProtectedVar[\'$2\']$3'.'$4'.'}', $sContent);
				}

				// {$foo.$bar.baz}

				$sContent = preg_replace('|\{(.*?)\$([^_\(][a-z0-9_]*)([a-z0-9_\[\].\->\(\)\+/*\']*)\.\$([^_][a-z0-9_]*)([a-z0-9_\[\]\->\(\)\+/*\']*)(.*?)\}|msi',
					'{'.'$1'.'$_aProtectedVar[\'$2\']$3[$_aProtectedVar[\'$4\']$5]'.'$6'.'}', $sContent);

				// {$foo.a.{$b.c}}

				$sContent = preg_replace('|\{(.*?)\$([^_\(][a-z0-9_]*)([a-z0-9_\[\].\->\(\)\+/*\']*)\.\{\$([^_][a-z0-9_]*)([a-z0-9_\[\]\->.\(\)\+/*\']*)\}(.*?)\}|msi',
								'{'.'$1'.'$_aProtectedVar[\'$2\']$3[$_aProtectedVar[\'$4\']$5]'.'$6'.'}', $sContent);

				// $foo_{$bar}, $foo_{$x+$y}, $foo_{$bar}_buh_{$blar}, {$foo_{$x}}

				$sContent = preg_replace('|\{(.*?)\$([^_\(][a-z0-9_]*?)_\{([a-z0-9_\+/*\->\$\(\)\[\]]*)([a-z0-9_\[\]\->\(\)\+/*\']*)\}(.*?)\}|msi',
								'{'.'$1'.'$_aProtectedVar[\'$2\'.($3)]'.'$5'.'}', $sContent);

				//*****************************************************************************************************************************
				// var modifiers : {$smarty.now|date_format:'%Y-%m-%d %H:%M:%S'}
				//*****************************************************************************************************************************

				preg_match_all('#\{(\$_aProtectedVar[a-z0-9_\[\].\->\(\)\+/*\']*)\|([^:\}]+)([^\}]*)\}#msi', $sContent, $aMatchs, PREG_SET_ORDER);

				foreach ($aMatchs as $aOne) {

					$sName = ucfirst($aOne[2]);

					$sName = preg_replace('|_([a-z])|e', 'strtoupper("$1")', $sName);

					if (file_exists(__DIR__.DIRECTORY_SEPARATOR.'Template'.DIRECTORY_SEPARATOR.'Modifiers'.DIRECTORY_SEPARATOR.$sName.'.php')) {

						$sClassName = '\Venus\lib\Template\Modifiers\\'.$sName;
						$oFunction = new $sClassName;
						$aAttributes = explode(' ', $aOne[3]);
						preg_match_all('#:([^:]+)#msi', $aOne[3], $aMatchs2, PREG_SET_ORDER);
						$aParams = [];
						$aParams[] = $aOne[1];

						foreach ($aMatchs2 as $sOne2) {

							$aParams[] = $sOne2[1];
						}

						$oFunction->run($aParams);
						$sContent = str_replace($aOne[0], call_user_func_array(array($oFunction, 'replaceBy') , $aParams), $sContent);
					}
				}

				//*****************************************************************************************************************************
				// transformation all : {$ssdsd} in <php echo ; >
				//*****************************************************************************************************************************

				$sContent = preg_replace('|\{(\$[a-z0-9_\[\].\->\(\)\$\+/*\']+)\}|msi', '<?php echo $1; ?>', $sContent);
				$sContent = preg_replace('|\{([a-z0-9_\(\),.]+\(\$[a-z0-9_\[\].\->\(\)\$\+/*\']+[ a-z0-9_\(\),".]+)\}|msi', '<?php echo $1; ?>', $sContent);

				//*****************************************************************************************************************************
				// escape: {ldelim}function{/rdelim}
				//*****************************************************************************************************************************

				$sContent = preg_replace('|<?php echo ldelim; ?>|', '{', $sContent);
				$sContent = preg_replace('|<?php echo rdelim; ?>|', '}', $sContent);

				//*****************************************************************************************************************************
				// variables: {#foo#}
				//*****************************************************************************************************************************

				$sContent = preg_replace('|\{#([a-z0-9_]+)#\}|msi', '<?php echo $_aProtectedVar[\'app\'][\'config\'][\'$1\']; ?>', $sContent);

				//*****************************************************************************************************************************
				// variables: {"foo"}
				//*****************************************************************************************************************************

				$sContent = preg_replace('|\{"([^"]+)"\}|msi', '<?php echo "$1"; ?>', $sContent);

				//*****************************************************************************************************************************
				// variables: {funcname attr1="val1" attr2="val2"}
				//				{assign var=foo value={counter}}
				//				{html_select_date display_days=true}
				//				{mailto address="smarty@example.com"}
				//				{html_options options=$companies selected=$company_id}
				//				{include file="subdir/$tpl_name.tpl"} => exception : class ToInclude
				//				{cycle values="one,two,`$smarty.config.myval`"}
				//				{config_load file='foo.conf'}
				//				{url alias='home' ...}
				//*****************************************************************************************************************************

				preg_match_all('|\{([a-z0-9_]+) +([a-z]+=[^\}]+)\}|msi', $sContent, $aMatchs, PREG_SET_ORDER);

				foreach ($aMatchs as $aOne) {

					$sName = ucfirst($aOne[1]);
					$sName = preg_replace('|_([a-z])|e', 'strtoupper("$1")', $sName);

					if ($sName == 'Include') { $sName = 'ToInclude'; }
					if ($sName == 'Foreach') { $sName = 'ToForeach'; }

					if (file_exists(__DIR__.DIRECTORY_SEPARATOR.'Template'.DIRECTORY_SEPARATOR.'Functions'.DIRECTORY_SEPARATOR.$sName.'.php')) {

						$sClassName = 'Venus\lib\Template\Functions\\'.$sName;
						$oFunction = new $sClassName;
						$aAttributes = explode(' ', $aOne[2]);

						$aParams = [];

						foreach ($aAttributes as $sOne2) {

							$aSplitParams = explode('=', $sOne2);
							$aParams[$aSplitParams[0]] = $aSplitParams[1];
						}

						if ($sName == 'ToInclude') {

							if (preg_match('/_aProtectedVar/', $aParams['file'])) {

								$sModelToCall = str_replace(array("\$_aProtectedVar['", "']", "'", '"'), array('', '' , '', ''), $aParams['file']);
								$aParams['real_name'] = $_aProtectedVar[$sModelToCall];
							}
							else {

								$aParams['real_name'] = str_replace(array("'", '"'), array('', ''), $aParams['file']);
							}
						}

						$oFunction->run($aParams);
						$sContent = str_replace($aOne[0], $oFunction->replaceBy($aParams), $sContent);
					}
				}

				//*****************************************************************************************************************************
				// variables: {include model}
				//*****************************************************************************************************************************

				if (preg_match('|\{include model\}|', $sContent)) {

					$sContent = preg_replace('|\{include model\}|', '<?php $_aProtectedVar[\'model\'] = preg_replace("#^.+[^a-zA-Z0-9_-]([a-zA-Z0-9_-]+\.tpl)$#msi", "\$1", $_aProtectedVar[\'model\']); $oMobileDetect = new \Mobile_Detect; if ($oMobileDetect->isMobile() && file_exists("'.$sTmpDirectory.'".md5(str_replace(".tpl", "Mobile.tpl", str_replace("\\\\\\\\", "/", $_aProtectedVar[\'model\']))).".cac.php")) { include "'.$sTmpDirectory.'".md5(str_replace(".tpl", "Mobile.tpl", str_replace("\\\\\\\\", "/", $_aProtectedVar[\'model\']))).".cac.php"; } else { include "'.$sTmpDirectory.'".md5(str_replace("\\\\\\\\", "/", $_aProtectedVar[\'model\'])).".cac.php"; } ?>', $sContent);

					$oMobileDetect = new \Mobile_Detect;

					if ($oMobileDetect->isMobile() && file_exists(str_replace('lib', 'src/'.PORTAIL.'/View/', __DIR__).str_replace('.tpl', 'Mobile.tpl', $_aProtectedVar['model']))) {

						$this->_transform(file_get_contents(str_replace('lib', 'src/'.PORTAIL.'/View/', __DIR__).str_replace('.tpl', 'Mobile.tpl', $_aProtectedVar['model'])), str_replace('.tpl', 'Mobile.tpl', $_aProtectedVar['model']));
					}
					else {

						$sModelname = str_replace(array('src/'.PORTAIL.'/View/', 'src\\'.PORTAIL.'\View\\'), array('', ''), $_aProtectedVar['model']);
						$this->_transform(file_get_contents(str_replace('lib', 'src/'.PORTAIL.'/View/', __DIR__).$sModelname), $sModelname);
					}
				}

				//*****************************************************************************************************************************
				// variables: {if $foo > 3}{elseif $foo > 3}{else}{/if}
				//				{foreachelse} execute program if the array of foreach is empty
				//				{/foreach} to close foreach
				//*****************************************************************************************************************************

				$sContent = preg_replace('|\{if ([^\}]+)\}|', '<?php if ($1) { ?>', $sContent);
				$sContent = preg_replace('|\{elseif ([^\}]+)\}|', '<?php } else if ($1) { ?>', $sContent);
				$sContent = str_replace(array('{else}', '{foreachelse}'), '<?php } else { ?>', $sContent);
				$sContent = str_replace('{/foreach}', '<?php }} ?>', $sContent);
				$sContent = str_replace(array('{/if}', '{/section}'), '<?php } ?>', $sContent);

				//*****************************************************************************************************************************
				// finition
				//*****************************************************************************************************************************

				//$sContent = preg_replace('|\{|msi', '<?php ', $sContent);
				//$sContent = preg_replace('|\}|msi', ' ? >', $sContent);

				while (preg_match('|(<<<EOF(?:(?<!EOF;).)+?)#DOLLAR#(.+?EOF;)|msi', $sContent)) {

					$sContent = preg_replace('|(<<<EOF(?:(?<!EOF;).)+?)#DOLLAR#(.+?EOF;)|msi', '$1'.'\\\$'.'$2', $sContent);
				}

				$sContent .= '<?php /* '.print_r(str_replace('\\\\\\', '/', $sTmpDirectory).$this->_getEncodeTemplateName($sTemplateName).'.cac.php', true).' */ ?>';
				$sContent .= '<?php /* '.print_r(file_exists(str_replace('\\\\\\', '/', $sTmpDirectory).$this->_getEncodeTemplateName($sTemplateName).'.cac.php'), true).' */ ?>';
				$sContent .= '<?php /* '.print_r(file_put_contents(str_replace('\\\\\\', '/', $sTmpDirectory).$this->_getEncodeTemplateName($sTemplateName).'.cac.php', $sContent), true).' */ ?>';
				$sContent .= '<?php /* '.str_replace('\\\\\\', '/', $sTmpDirectory).' = '.$sTemplateName.' = '.md5($sTemplateName).' */ ?>';
			//}

			if ($bFirst === true) {

				include(str_replace('\\\\\\', '/', $sTmpDirectory).$this->_getEncodeTemplateName($sTemplateName).'.cac.php');
			}
		}
	}

	/**
	 * get the encode name od the template
	 *
	 * @access private
	 * @param  array $aMatch match of preg
	 * @return string
	 */

	private function _includeTransform($aMatch) {

		eval('$oTemplate = new \Venus\lib\Template($this->_aVar[\''.$aMatch[1].'\']'.$aMatch[2].'); $oTemplate->fetch(null, false);');
		return '<?php include "'.$this->sTmpDirectory.'".md5($aProtectedVar[\''.$aMatch[1].'\']'.$aMatch[2].').".cac.php"; ?>';
	}

	/**
	 * get the encode name od the template
	 *
	 * @access private
	 * @param  array $aMatch match of preg
	 * @return string
	 */

	private function _includeTransform2($aMatch) {

		$sViewDirectory = str_replace('lib', 'src'.DIRECTORY_SEPARATOR.PORTAIL.DIRECTORY_SEPARATOR.'View'.DIRECTORY_SEPARATOR, __DIR__);
		$sViewDirectory = str_replace('\\', '\\\\\\', $sViewDirectory);
		//echo '$oTemplate = new \Venus\lib\Template("src".DIRECTORY_SEPARATOR.PORTAIL.DIRECTORY_SEPARATOR."View".DIRECTORY_SEPARATOR."'.$aMatch[1].'"); $oTemplate->fetch(null, false);';
		eval('$oTemplate = new \Venus\lib\Template("src".DIRECTORY_SEPARATOR.PORTAIL.DIRECTORY_SEPARATOR."View".DIRECTORY_SEPARATOR."'.$aMatch[1].'"); $oTemplate->fetch(null, false);');
		//eval('$oTemplate = new \Venus\lib\Template("'.$aMatch[1].'"); $oTemplate->fetch(null, false);');
		return '<?php include "'.$this->sTmpDirectory.'".md5("src".DIRECTORY_SEPARATOR.PORTAIL.DIRECTORY_SEPARATOR."View".DIRECTORY_SEPARATOR."'.$aMatch[1].'").".cac.php"; ?>';
	}

	/**
	 * get the encode name od the template
	 *
	 * @access private
	 * @param  string $sName name of the template
	 * @return string
	 */

	private function _getEncodeTemplateName($sName) {

		$sName = str_replace('\\', '/', $sName);
		$sName = str_replace('/src', 'src', $sName);
		return md5($sName);
	}
}
