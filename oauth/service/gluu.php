<?php
/**
 *
 * Gluu OAuth Plugin. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, Robin Freund, https://www.nockiro.de
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace nockiro\gluuauth\oauth\service;

/**
* Gluu OAuth service
*/
class gluu extends \phpbb\auth\provider\oauth\service\base
{
    /**
    * phpBB config
    *
    * @var \phpbb\config\config
    */
    protected $config;

    /**
    * phpBB request
    *
    * @var \phpbb\request\request_interface
    */
    protected $request;
	
	
	/**
	* External OAuth service provider
	* Overriding base
	*
	* @var \OAuth\Common\Service\ServiceInterface
	*/
	protected $service_provider;

    /**
    * Constructor
    *
    * @param    \phpbb\config\config               $config
    * @param    \phpbb\request\request_interface   $request
    */
    public function __construct(\phpbb\config\config $config, \phpbb\request\request_interface $request)
    {
        $this->config = $config;
        $this->request = $request;
		
		// I know, global variables are bad. But there seems to be no other way to get the phpbb configuration variable to the ServiceInterface
		$GLOBALS["auth_oauth_gluu_baseUri"] = $this->config['auth_oauth_gluu_baseUri'];
    }

    /**
    * {@inheritdoc}
    */
    public function get_service_credentials()
    {
        return array(
            'key'     => $this->config['auth_oauth_gluu_key'],
            'secret'  => $this->config['auth_oauth_gluu_secret'],
        );
    }

    /**
    * {@inheritdoc}
    */
    public function perform_auth_login()
    {
        if (!($this->service_provider instanceof \OAuth\OAuth2\Service\Gluu))
        {
            throw new \phpbb\auth\provider\oauth\service\exception('AUTH_PROVIDER_OAUTH_ERROR_INVALID_SERVICE_TYPE');
        }
		
        // This was a callback request from gluu, get the token
        $tokenResponse = $this->service_provider->requestAccessToken($this->request->variable('code', ''));

        // get the unique identifier returned from gluu as JWT
        
		$result = json_decode(base64_decode(explode(".",$tokenResponse->getExtraParams()["id_token"])[1]), true);
		
		return $result["email"];
    }

    /**
    * {@inheritdoc}
    */
    public function perform_token_auth()
    {
        if (!($this->service_provider instanceof \OAuth\OAuth2\Service\Gluu))
        {
            throw new \phpbb\auth\provider\oauth\service\exception('AUTH_PROVIDER_OAUTH_ERROR_INVALID_SERVICE_TYPE');
        }

        // Return the unique identifier returned from gluu
        $resp = $this->service_provider->request('userinfo');
		return json_decode($resp, true)["email"];
    }
	
	
	/**
	* {@inheritdoc}
	*/
	public function get_auth_scope()
	{
		//openid token to get email on perform_auth_login()
		return array('openid', 'email');
	}
}