<?php
 $var_amount =$_GET['amnt'];
$trans_id =$_GET['trans_id'];

 $curl = curl_init();
 $post_fields = "command=r&trans_id=".$trans_id;
        $submit_url = "https://ecommerce.ufc.ge:18443/ecomm2/MerchantHandler";
		Curl_setopt($curl, CURLOPT_SSLVERSION, 1); //0 
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt($curl, CURLOPT_VERBOSE, '1');
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 120);
      	curl_setopt($curl, CURLOPT_SSLCERT,'../5302362.pem');
 		curl_setopt($curl, CURLOPT_SSLKEYPASSWD,   'MKAjkFeBWC1z9AQk');
        curl_setopt($curl, CURLOPT_URL, $submit_url);
        $result = curl_exec($curl);
        $info = curl_getinfo($curl);

		
if(curl_errno($curl))
{
    echo 'curl error:' . curl_error($curl)."<BR>";
}
        curl_close($curl);
echo $result;
echo "<BR><BR>";

echo $result=substr($result,-28);
// echo print_r($info);
// echo "<BR><BR>";


	$curl = curl_init();
	
	?>

