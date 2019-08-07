<?php
/**
 *
 * Gluu OAuth Plugin. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, Robin Freund, https:/www.nockiro.de
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace nockiro\gluuauth\acp;

/**
 * Gluu OAuth Plugin ACP module info.
 */
class main_info
{
	public function module()
	{
		return array(
			'filename'	=> '\nockiro\gluuauth\acp\main_module',
			'title'		=> 'ACP_GLUUAUTH_TITLE',
			'modes'		=> array(
				'settings'	=> array(
					'title'	=> 'ACP_GLUUAUTH',
					'auth'	=> 'ext_nockiro/gluuauth && acl_a_board',
					'cat'	=> array('ACP_GLUUAUTH_TITLE')
				),
			),
		);
	}
}
