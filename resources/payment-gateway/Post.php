<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=8">
<?php

 $var_amount =$_GET['amnt'];


 $curl = curl_init();
 $post_fields = "command=a&amount=".$var_amount."&currency=981&client_ip_addr=208.109.11.88
&description=UFCTEST&msg_type=SMS";
        $submit_url = "https://ecommerce.ufc.ge:18443/ecomm2/MerchantHandler";
		Curl_setopt($curl, CURLOPT_SSLVERSION, 1); //0 
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt($curl, CURLOPT_VERBOSE, '1');
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 120);
      	curl_setopt($curl, CURLOPT_SSLCERT,         getcwd().'/5302362.pem');
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
	

<html>
<head>
<title>Merchant example post template to ECOMM</title>
<script type='text/javascript' language='javascript'>
function redirect() {
  document.returnform.submit();
}
</script>
</head>
<body onLoad='javascript:redirect()'>
<form name='returnform' action='https://ecommerce.ufc.ge/ecomm2/ClientHandler' method='POST'>
  <input type='hidden' name='trans_id' value='<?php echo $result; ?>'>
 
<noscript>
    <center>Please click the submit button below.<br>
    <input type='submit' name='submit' value='Submit'></center>
</noscript>
</form>
 
</body>
</html>            
