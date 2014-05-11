<?php
class Paypal {
    //                                       __  _          
    //     ____  _________  ____  ___  _____/ /_(_)__  _____
    //    / __ \/ ___/ __ \/ __ \/ _ \/ ___/ __/ / _ \/ ___/
    //   / /_/ / /  / /_/ / /_/ /  __/ /  / /_/ /  __(__  ) 
    //  / .___/_/   \____/ .___/\___/_/   \__/_/\___/____/  
    // /_/              /_/                                 
    protected $errors;
    protected $credentials;
    protected $end_point;
    protected $version;

    //                    __  __              __    
    //    ____ ___  ___  / /_/ /_  ____  ____/ /____
    //   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
    //  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
    // /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
    public function __construct($user, $pwd, $signature, $mode, $version  = '74.0')
    {
        $this->end_point   = ($mode == 'sandbox') ? 'https://api-3t.sandbox.paypal.com/nvp' : 'https://api-3t.paypal.com/nvp';
        $this->version     = $version;
        $this->credentials = array(
            'USER'      => $user,
            'PWD'       => $pwd,
            'SIGNATURE' => $signature);
    }
   
    /**
     * Create query
     * @param  string $method --- api method
     * @param  array  $params --- additional properties
     * @return array/boolean  --- Response array / boolean false on failure
     */
    public function request($method, $params = array()) 
    {
        if(empty($method)) 
        { 
            $this->errors = array('Unknown method!');
            return false;
        }

        $this->errors   = array();
        $request_params = array(
            'METHOD'  => $method,
            'VERSION' => $this->version
        );
        
        $request = http_build_query($request_params + $params  + $this->credentials);

        $curl_options = array(
            CURLOPT_URL            => $this->end_point,
            CURLOPT_VERBOSE        => 1,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_CAINFO         => dirname(__FILE__) . '/cacert.pem',
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST           => 1,
            CURLOPT_POSTFIELDS     => $request
        );

        $ch = curl_init();
        curl_setopt_array($ch, $curl_options);
        
        $response = curl_exec($ch);

        if (curl_errno($ch)) 
        {
            $this->errors = curl_error($ch);
            curl_close($ch);
            return false;
        } 
        else  
        {
            curl_close($ch);
            $responseArray = array();
            parse_str($response, $responseArray);
            return $responseArray;
        }
    }
}