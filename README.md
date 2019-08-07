# phpBB Gluu OAuth/OpenID Extension
This is a phpBB extension to implement a Gluu instance as another OAuth Service Provider

## Install

1. Download the content of this repo and place it into `ext/nockiro/gluuauth`
2. Navigate in the ACP to `Customise -> Manage extensions` and enable the extension
3. Create a client in Gluu with the following necessary settings:
  * **Redirect Login URIs**
    * https://www.example.com/forum/ucp.php?mode=login&login=external&oauth_service=gluu
    * https://www.example.com/forum/ucp.php?i=ucp_auth_link&mode=auth_link&link=1&oauth_service=gluu
  * **Scopes**
    * `openid`
    * `email`
  * **Response Types**
    * `code`
    * `id_token`
    * `token`
  * **Grant Types**
    * `authorization_code`
    * `refresh_token`
  * **Authentication method for the Token endpoint**
    * `client_secret_post`
  * **Include Claims in Id Token** (In tab "Advanced settings")
    * `True`
4. Set the base URI to your Gluu instance (e.g. https://auth.example.com/oxauth/restv1/) in the ACP (`Extensions -> Gluu OAuth/OpenID Settings`)
5. Give your Gluu instance a name (that shows on the button on the login page and in the ACP above the two fields) through adding the new Service in `language/en/common.php` around line 100:
  `'AUTH_PROVIDER_OAUTH_SERVICE_GLUU' 						=> "Gluu Login",`
6. Copy Client ID and Secret from Gluu into the ACP to `General -> Client Communication -> Authentication` in the last box that should have your given Name (e.g. Gluu Login) from step 5

## Uninstall

1. Navigate in the ACP to `Customise -> Extension Management -> Extensions`.
2. Look for `Gluu OAuth` under the Enabled Extensions list, and click its `Disable` link.
3. For a complete uninstall, click `Delete Data` and delete the `/ext/nockiro/gluuauth` directory.

## Misc

* Feel free to ask questions and open issues at any time
* This is my first phpBB plugin and it might have some unnecessary complicated ways to solve some (in my opinion) weaknesses of the Extension API. If you think there is a better way for a bit of code, please feel also free to open an issue about it

## License
[GNU General Public License v2](http://opensource.org/licenses/GPL-2.0)
