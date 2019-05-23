<?php
// based on the code supplied by the reCAPTCHA web site
// with modifications by Roger Moffat and Bryan S. Larson to work with TNG
// Version: No Captcha reCAPTCHA v10.1.0.3 last modified 23 Feb 2015 by Bryan S. Larson
// This update adds a feature to 'remember' if a visitor has successfully completed a reCAPTCHA challenge, no further challenges will be presented to that visitor during the visit.

// Sign up for a reCAPTCHA account from https://www.google.com/recaptcha/admin/create
// Once your account is created, enter your assigned keys
// in customconfig.php or uncomment the next 2 lines and enter it below.
//$siteKey = "yoursiteKeyHere";
//$secret = "yoursecretKeyHere";

//First part of original code to be restored here...

if($tngSiteKey && $tngSecret) {

    // The response from reCAPTCHA
    $resp = null;
    // The error code from reCAPTCHA, if any
    $error = null;

    # was there a reCAPTCHA response?
    if ($_POST["g-recaptcha-response"]) {

 		// Curl implementation LJoubert - 21 May 2019 - Github LouJou - TNG Recaptcha V2
		// in part based on curl example code from this thread
                // https://stackoverflow.com/questions/49695936/file-get-contents-and-curl-in-php?rq=1


		$curl = curl_init();

	    	curl_setopt_array($curl, array(
	      	CURLOPT_URL => "https://www.google.com/recaptcha/api/siteverify",
	      	CURLOPT_RETURNTRANSFER => true,
	      	CURLOPT_ENCODING => "",
	      	CURLOPT_MAXREDIRS => 10,
	      	CURLOPT_TIMEOUT => 30,
	      	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => array(
			'secret' => $tngSecret,
			'response' => $_POST["g-recaptcha-response"],
			'remoteip' => $remoteip
		),
	      	CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
	     	 ),
	   	 ));
	    	// GET VERION
		// curl_setopt_array($curl, array(
		//  CURLOPT_URL => "https://www.google.com/recaptcha/api/siteverify?secret=".$tngSecret."&response=".$_POST["g-recaptcha-response"]."&remoteip=".$remoteip,
		//  CURLOPT_RETURNTRANSFER => true,
		//  CURLOPT_ENCODING => "",
		//  CURLOPT_MAXREDIRS => 10,
		//  CURLOPT_TIMEOUT => 30,
		//  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		//  CURLOPT_CUSTOMREQUEST => "GET",
		//  CURLOPT_HTTPHEADER => array(
		//    "cache-control: no-cache",
		//  ),
		// ));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {

		  echo "cURL Error #:" . $err;

		} else {

		 $_SESSION['passedcaptcha'] = 'true';
		                    return;
		   // if the response from the reCAPTCHA is valid, return to suggest.php

		}

}
 ?>

	<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
		<div class="g-recaptcha" data-sitekey="<?php echo $tngSiteKey;?>" data-theme="<?php echo $captchatheme;?>"></div>
			<script type="text/javascript"
			src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang;?>">
			</script>
	<br/>
		<input type="submit" value="<?php echo $admtext['text_continue']; ?>" />
		<input type="hidden" name="enttype" value="<?php echo $enttype; ?>" />
		<input type="hidden" name="ID" value="<?php echo $ID; ?>" />
		<input type="hidden" name="tree" value="<?php echo $tree; ?>" />
	</form>
	<input type="hidden" name="fingerprint" value="realperson" />

<!-- Rest of original code to be restored -->
