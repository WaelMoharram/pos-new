$url = "https://cibpaynow.gateway.mastercard.com/api/nvp/version/61";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
"Content-Type: application/x-www-form-urlencoded",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
$data = "apiOperation=CREATE_CHECKOUT_SESSION&apiPassword=a231d5e23eb6f047edad85810dd5fde3&apiUsername=merchant.TESTCIB701248&merchant=TESTCIB701248&interaction.operation=AUTHORIZE&order.id=2&order.amount=100.00&order.currency=EGP";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
var_dump($resp);
