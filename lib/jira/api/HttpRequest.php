<?php

namespace Jira\Api;


class HttpRequest
{
    /**
     * **************************************************************************
     * **************************************************************************
     * DO NOT USE BASIC AUTH IN PRODUCTION
     * **************************************************************************
     * **************************************************************************
     * @todo Implement OAuth and do away with $username/$password authentication
     * @var string $username
     *
     */
    private $username = '';
    /**
     * @var string $password
     */
    private $password = '';

    /**
     * Base URL To Jira Server
     * @var string $jiraUrl
     */


    /**
     * @param array $headers
     * @return $this - makes this chainable
     */
    public function setHeaders($headers = array())
    {
        // If no headers are sent use json by default
        if ($headers == '') {

            $headers = array(
                'Accept: application/json',
                'Content-Type: application/json'
            );
        }

        $this->headers = $headers;
        return $this;
    }


    /**
     * @param $methodToCheck
     * @return bool
     */
    private function isAvailableMethod($methodToCheck)
    {
        $methods = [
            'GET',
            'POST'
        ];

        if (in_array($methodToCheck, $methods)) {
            return true;
        }
    }

    /**
     *
     * @param string $method
     * @return string
     */
    public function sendRequest($url, $method = 'GET')
    {
        if (!$this->isAvailableMethod($method)) {
            return 'The method you passed is not allowed';
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        //  curl_setopt ($ch, CURLOPT_POST, true);
        //  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ":" . $this->password);


        $result = curl_exec($ch);

        $ch_error = curl_error($ch);

        curl_close($ch);
        if ($ch_error) {

            return "cURL Error: $ch_error";

        } else {

            return $result;
        }
    }
}