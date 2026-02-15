<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class GoogleAuth
{
    private $serviceAccountFile;

    public function __construct($params = array())
    {
        // Path to your service account JSON file
        $this->serviceAccountFile = isset($params['service_account_file']) ? $params['service_account_file'] : APPPATH . 'libraries/google-services.json';
        
        // Load necessary libraries
        require_once APPPATH . 'libraries/google-auth-library/src/HttpHandler/Guzzle6HttpHandler.php';
        require_once APPPATH . 'libraries/google-auth-library/src/OAuth2.php';
        require_once APPPATH . 'libraries/google-auth-library/src/CredentialsLoader.php';
        require_once APPPATH . 'libraries/google-auth-library/src/FetchAuthTokenInterface.php';
        require_once APPPATH . 'libraries/google-auth-library/src/HttpHandler/HttpHandlerFactory.php';
        require_once APPPATH . 'libraries/google-auth-library/src/ApplicationDefaultCredentials.php';
        require_once APPPATH . 'libraries/google-auth-library/src/ServiceAccountCredentials.php';
    }

    public function getAccessToken()
    {
        // Load the service account credentials
        $credentials = json_decode(file_get_contents($this->serviceAccountFile), true);

        // Set the required scopes
        $scopes = ['https://www.googleapis.com/auth/firebase.messaging'];

        // Create the OAuth2 object
        $oauth2 = new Google\Auth\OAuth2([
            'audience' => 'https://oauth2.googleapis.com/token',
            'issuer' => $credentials['client_email'],
            'scope' => $scopes,
            'signingAlgorithm' => 'RS256',
            'signingKey' => $credentials['private_key']
        ]);

        // Get the access token
        $token = $oauth2->fetchAuthToken();
        return $token['access_token'];
    }
}
