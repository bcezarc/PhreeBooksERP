<?php
/*
 * View for Settings tab for any module that has settings
 *
 * NOTICE OF LICENSE
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.TXT.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/OSL-3.0
 *
 * DISCLAIMER
 * Do not edit or add to this file if you wish to upgrade Bizuno to newer
 * versions in the future. If you wish to customize Bizuno for your
 * needs please refer to http://www.phreesoft.com for more information.
 *
 * @name       Bizuno ERP
 * @author     Dave Premo, PhreeSoft <support@phreesoft.com>
 * @copyright  2008-2018, PhreeSoft, Inc.
 * @license    http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * @version    3.x Last Update: 2018-12-10
 * @filesource /lib/view/tabAdminSettings.php
 */

namespace bizuno;

htmlToolbar($output, $viewData, 'tbAdmin');
if (isset($viewData['settings'])) {
	$output['body'] .= "  ".html5('frmAdmin', $viewData['forms']['frmAdmin'])."\n"; // put all the accordian tabs inside of a form
	$output['body'] .= '    <div class="easyui-accordion" style="width:auto;height:auto;">'."\n";
	foreach ($viewData['settings'] as $category => $settings) {
        $title = getModuleCache($category, 'properties', 'title', false, jsLang($category));
		$output['body'] .= '      <div title="'.$title.'" style="padding:20px;">'."\n";
		foreach ($settings as $key => $value) {
            if (!empty($value['attr']['type']) && $value['attr']['type'] == 'password') { $value['attr']['value'] = ''; }
			$output['body'] .= html5($category."_".$key, $value);
            if ( empty($value['attr']['type']) || $value['attr']['type'] != 'hidden')   { $output['body'] .= "<br />\n"; }
		}
		$output['body'] .= "      </div>\n";
	}
	$output['body'] .= "    </div>\n";
	$output['body'] .= "  </form>\n";
	$output['jsReady']['adminSettings']  = "ajaxForm('frmAdmin');";
}
