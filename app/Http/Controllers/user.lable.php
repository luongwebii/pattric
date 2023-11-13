<?php

namespace symbio\user\classes;

include_once('../../symbio.php');

class ShippingLabel
{
	var $fedex_account_number = '208205994';// '740561073';// '740561073';
	var $fedex_api_key = 'l7d334d3f3c11d42aabdf984ba61766c44';// 'l7cba9fe531368453292a04a029829cb5f';// 'l795cd6d2ae00442d290255c5bc85f046b';// 'l795cd6d2ae00442d290255c5bc85f046b';
	var $fedex_secret_key = 'bd3928c5-db08-437b-bcd3-59560df03e9b';//'1c7fdb514c3d43659bda23813edc866d';// '8056fdb4b7f54979be2dab542cb1866c';//'8056fdb4b7f54979be2dab542cb1866c';
	var $fedex_api_base_url = 'https://apis.fedex.com';// 'https://apis-sandbox.fedex.com';
	/*
	var $fedex_account_number = '740561073';
	var $fedex_api_key = 'l795cd6d2ae00442d290255c5bc85f046b';// 'l795cd6d2ae00442d290255c5bc85f046b';
	var $fedex_secret_key =  '8056fdb4b7f54979be2dab542cb1866c';//'8056fdb4b7f54979be2dab542cb1866c';
	var $fedex_api_base_url = 'https://apis-sandbox.fedex.com';
	*/
    public function createAccessToken()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->fedex_api_base_url . '/oauth/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials&client_id=' . $this->fedex_api_key . '&client_secret=' . $this->fedex_secret_key,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }

        if (isset($error_msg)) {
            echo $error_msg;
            return null;
        }

        $res = json_decode($response);
        $_SESSION['fedex_token'] = $res->access_token;
        $_SESSION['fedex_token_start'] = time();
        return $res->access_token;
    }

    public function createShippingLabel($data)
    {
        $auth_token = $this->getFedExAuthToken();
		
		//echo $this->fedex_api_key;
		//echo $this->fedex_secret_key;
		//echo $this->fedex_account_number;
        $curl = curl_init();
		
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->fedex_api_base_url . '/ship/v1/shipments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $auth_token,
                'X-locale: en_US',
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);
		
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }

        if (isset($error_msg)) {
            echo $error_msg;
            return [
                'error' => $error_msg
            ];
        }

        curl_close($curl);

        return [
            'response' => json_decode($response)
        ];

    }

    public function retrieveShippingLabel($jobId)
    {
        $auth_token = $this->getFedExAuthToken();
        $data = [
            'accountNumber' => [
                'value' => $this->fedex_account_number
            ],
            'jobId' => $jobId
        ];


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->fedex_api_base_url . '/ship/v1/shipments/results',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'content-type: application/json',
                'x-locale: en_US',
                'authorization: Bearer ' . $auth_token,
            ),
        ));


        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }

        if (isset($error_msg)) {
            echo $error_msg;
            return [
                'error' => $error_msg
            ];
        }

        curl_close($curl);

        return [
            'response' => json_decode($response)
        ];
    }

    public function getFedExAuthToken()
    {
        if(isset($_SESSION['fedex_token']) && $_SESSION['fedex_token']){
            if($_SESSION['fedex_token_start']) {
                if(time() - $_SESSION['fedex_token_start'] > 3600){
                    $auth_token = $this->createAccessToken();
                } else {
                    $auth_token = $_SESSION['fedex_token'];
                }
            } else {
                $auth_token = $this->createAccessToken();
            }

        } else {
            $auth_token = $this->createAccessToken();
        }

        return $auth_token;
    }
}