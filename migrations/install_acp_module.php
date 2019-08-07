<?php
/**
 *
 * Gluu OAuth Plugin. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, Robin Freund, https://www.nockiro.de
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace nockiro\gluuauth\migrations;

class install_acp_module extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['nockiro_gluuauth_goodbye']);
	}

	public static function depends_on()
	{
		return array('\phpbb\db\migration\data\v320\v320');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('nockiro_gluuauth_goodbye', 0)),

			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_GLUUAUTH_TITLE'
			)),
			array('module.add', array(
				'acp',
				'ACP_GLUUAUTH_TITLE',
				array(
					'module_basename'	=> '\nockiro\gluuauth\acp\main_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}
}
