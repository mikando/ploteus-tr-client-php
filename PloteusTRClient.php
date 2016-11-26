<?php
/*
* PHP Client for Ploteus Turkey Integration Pool
*
* @author Mehmet Akif Cakar <iletisim@mehmetakifcakar.com>
* @license Apache 2.0
*
*/

class PloteusTRClient{
    private $user_name,$password;

    public function __construct($user_name, $password){
        $this->user_name = $user_name;
        $this->password = $password;
    }

    public function uploadLearningOpportunitiesXml($xmlData) {
        return $this->post_request('uploadLearningOpportunitiesXml', $xmlData);
    }

    public function uploadQualificationsXml($xmlData) {
        return $this->post_request('uploadQualificationsXml', $xmlData);
    }

    public function getXmlStatus($requestId) {
        $curl = curl_init();
        $headers = $this->get_headers();
        curl_setopt($curl, CURLOPT_URL, $this->get_url('getXmlStatus?requestId=' . $requestId));
        curl_setopt($curl, CURLOPT_USERPWD,  $this->user_name . ":" .  $this->password);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 600);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 600);
        $responseData = curl_exec($curl);
        curl_close($curl);

        return $responseData;
    }

    private function get_url($path){
        return 'https://ploteus.iskur.gov.tr/api/Ploteus/' . $path;
    }

    private function get_headers(){
        return array('user-agent: ploteus-tr-php/0.0.1', 'Accept: application/xml');
    }

    private function post_request($path, $xml){
        $curl = curl_init();
        $headers = $this->get_headers();
        array_push($headers, 'content-type: application/xml');
        curl_setopt($curl, CURLOPT_URL, $this->get_url($path));
        curl_setopt($curl, CURLOPT_USERPWD,  $this->user_name . ":" .  $this->password);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($curl, CURLOPT_TIMEOUT, 600);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 600);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}

?>