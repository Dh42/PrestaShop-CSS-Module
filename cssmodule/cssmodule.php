<?php

/*

* 2007-2012 PrestaShop

*

* NOTICE OF LICENSE

*

* This source file is subject to the Academic Free License (AFL 3.0)

* that is bundled with this package in the file LICENSE.txt.

* It is also available through the world-wide-web at this URL:

* http://opensource.org/licenses/afl-3.0.php

* If you did not receive a copy of the license and are unable to

* obtain it through the world-wide-web, please send an email

* to license@prestashop.com so we can send you a copy immediately.

* DISCLAIMER

*

* Do not edit or add to this file if you wish to upgrade PrestaShop to newer

* versions in the future. If you wish to customize PrestaShop for your

* needs please refer to http://www.prestashop.com for more information.

*

*  @author PrestaShop SA <contact@prestashop.com>

*  @copyright  2007-2012 PrestaShop SA

*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)

*  International Registered Trademark & Property of PrestaShop SA

*/

if (!defined('_CAN_LOAD_FILES_'))

	exit;



class Cssmodule extends Module

{

	public function __construct()

	{

		$this->name = 'cssmodule';

		if (version_compare(_PS_VERSION_, '1.4.0.0') >= 0)

			$this->tab = 'front_office_features';

		else

			$this->tab = 'Blocks';

		$this->version = '1.0';

		$this ->author = 'dh42';

		$this->bootstrap = true;



		parent::__construct();



		$this->displayName = $this->l('CSS Editing Module');

		$this->description = $this->l('Easily edit your shops CSS. From dh42 PrestaShop Certified Partner and PrestaShop support Experts.');

	}

	public function install()

	{

		$this->_clearCache('cssmodule.tpl');

		return (parent::install()

				&& Configuration::updateValue('cssvalue', '')

				&& $this->registerHook('header') && $this->registerHook('displayBackOfficeHeader'));

	}

	public function uninstall()



	{



		$this->_clearCache('cssmodule.tpl');

		return (Configuration::deleteByName('cssvalue') && parent::uninstall());

	}

	public function getContent()

	{

		$html = '';

		if (isset($_POST['submitModule']))

		{

			Configuration::updateValue('cssvalue', ((isset($_POST['cssvalue']) && $_POST['cssvalue'] != '') ? $_POST['cssvalue'] : ''),  true);

			$html .= '<div class="confirm">'.$this->l('Configuration updated').'</div>';

		}



		$this->context->controller->addJS($this->_path.'/js/ace.js', 'all');

		if (version_compare(@_PS_VERSION_,'1.6','>'))

			$html = $this->_displayForm();

		else

			$html = $this->_displayForm15();



		return $html;

	}



	public function _displayForm()

	{



		$html = '

		<style type="text/css" media="screen">



		    #cssvalue{

		        margin: 0;

		        position: absolute;

		        top: 0;

		        bottom: 0;

		        left: 0;

		        right: 0;

		    }

		</style>
<div style="width:100%;height:100px;">
<div style="width:33.3%;text-align:center;float:left;height:100px">
<ins data-revive-zoneid="4" data-revive-id="27f1a68d9b3c239bbbd38cc09b79d453"></ins>
<script async src="//dh42.com/openx/www/delivery/asyncjs.php"></script>
</div>

<div style="width:33.3%;text-align:center;float:left;height:100px">
<ins data-revive-zoneid="5" data-revive-id="27f1a68d9b3c239bbbd38cc09b79d453"></ins>
<script async src="//dh42.com/openx/www/delivery/asyncjs.php"></script>
</div>

<div style="width:33.3%;text-align:center;float:right;height:100px">
<ins data-revive-zoneid="6" data-revive-id="27f1a68d9b3c239bbbd38cc09b79d453"></ins>
<script async src="//dh42.com/openx/www/delivery/asyncjs.php"></script>
</div>
</div>
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post" class="defaultForm form-horizontal">

			<div class="panel">



				<div class="panel-heading">'.$this->l('Settings').'</div>



				<div class="form-group">

					<label class="control-label col-lg-3">'.$this->l('Custom CSS').' :</label>

					<div class="col-lg-4" style="position:relative;height: 300px;width:100%">

						<div id="cssvalue">'.Configuration::get('cssvalue').'</div>

						<textarea name="cssvalue"></textarea>

					</div>

				</div>





				<script>



				var editor = ace.edit("cssvalue");

			    editor.setTheme("ace/theme/chrome");

			    editor.getSession().setMode("ace/mode/css");

			    var textarea = $(\'textarea[name="cssvalue"]\').hide();

			    textarea.text(editor.getSession().getValue());

				editor.getSession().on(\'change\', function(){

				  textarea.text(editor.getSession().getValue());

				});



				</script>



				<div class="margin-form">

					<input type="submit" name="submitModule" value="'.$this->l('Save').'" class="button" /></center>

				</div>

			</div>

		</form>

		<form class="defaultForm form-horizontal" >



			<div class="panel">



				<div class="panel-heading">'.$this->l('CSS Module Reference').'</div>



				<p>The way that the module works is that it appends the CSS directly to the page. This should override the CSS files and make your changes the most prominent. If a changes does not take effect, you can try to use the modifier !important and that should work.

				<br><br>

				Also you should use either Google Chrome or Firefox with Firebug to figure out the targeting of the CSS you are trying to change. You can access the CSS reference here, http://www.w3schools.com/cssref/default.asp

				<br>

				<br><strong>Prestashop 1.5 common classes and ids, you can use these copy these and add CSS to them to change your theme.</strong>

				<br>

				<br><strong>Logo</strong> - .logo{}



				<br><strong>Product Name</strong> - #pb-left-column h1 {}



				<br><strong>Main Background</strong> - body{}



				<br><strong>Main Footer</strong> - #footer{}



				<br><strong>Menu Background</strong> - .sf-menu{}



				<br><strong>Menu Hover Color</strong> - .sf-menu li {}



				<br><strong>Category Heading</strong> - h1{}</p>

			</div>

		</form>

		';



		return $html;

	}

	public function _displayForm15()

	{



		$html = '

		<h2>'.$this->displayName.'</h2>

		<style type="text/css" media="screen">



		    #cssvalue{

		        margin: 0;

		        position: absolute;

		        top: 0;

		        bottom: 0;

		        left: 0;

		        right: 0;

		    }

		</style>

		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">

			<fieldset>

				<label for="cssvalue">'.$this->l('Custom CSS').' :</label>

				<div class="margin-form" style="position:relative;height: 300px; width: 700px;padding-left:0;margin-left: 260px">

					<div id="cssvalue">'.Configuration::get('cssvalue').'</div>

					<textarea name="cssvalue"></textarea>

				</div>





				<script>



				var editor = ace.edit("cssvalue");

			    editor.setTheme("ace/theme/chrome");

			    editor.getSession().setMode("ace/mode/css");

			    var textarea = $(\'textarea[name="cssvalue"]\').hide();

			    textarea.text(editor.getSession().getValue());

				editor.getSession().on(\'change\', function(){

				  textarea.text(editor.getSession().getValue());

				});



				</script>



				<div class="margin-form">

					<input type="submit" name="submitModule" value="'.$this->l('Save').'" class="button" /></center>

				</div>

			</fieldset>

		</form>

		<form>



			<h2>CSS Module Reference</h2>

			<fieldset>

				<p>The way that the module works is that it appends the CSS directly to the page. This should override the CSS files and make your changes the most prominent. If a changes does not take effect, you can try to use the modifier !important and that should work.

				<br><br>

				Also you should use either Google Chrome or Firefox with Firebug to figure out the targeting of the CSS you are trying to change. You can access the CSS reference here, http://www.w3schools.com/cssref/default.asp

				<br>

				<br><strong>Prestashop 1.5 common classes and ids, you can use these copy these and add CSS to them to change your theme.</strong>

				<br>

				<br><strong>Logo</strong> - .logo{}



				<br><strong>Product Name</strong> - #pb-left-column h1 {}



				<br><strong>Main Background</strong> - body{}



				<br><strong>Main Footer</strong> - #footer{}



				<br><strong>Menu Background</strong> - .sf-menu{}



				<br><strong>Menu Hover Color</strong> - .sf-menu li {}



				<br><strong>Category Heading</strong> - h1{}</p>

			</fieldset>

		</form>

		';



		return $html;

	}



	public function hookHeader($params)

	{



		if (!$this->isCached('cssmodule.tpl', $this->getCacheId()))

	{

		global $smarty;

		$smarty->assign(array(

			'cssvalue' => Configuration::get('cssvalue')

		));

			}

	return $this->display(__FILE__, 'cssmodule.tpl', $this->getCacheId());

	}



	public function hookDisplayBackOfficeHeader($params)



	{



		if( isset($this->context->controller->dh_support) )



			return;



		$this->context->controller->dh_support = 1;

		if (version_compare(@_PS_VERSION_,'1.6','<'))

			$this->context->controller->addJS($this->_path . '/dh42_15.js', 'all');

		else

			$this->context->controller->addJS($this->_path . '/dh42.js', 'all');



		return;







	}



}