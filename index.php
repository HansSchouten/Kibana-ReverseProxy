<?php
$targetUrl = "http://localhost:5601";

// init curl to $targetUrl with the requested URI
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $targetUrl . $_SERVER['REQUEST_URI']);

// get post data
$postvars = '';
if (isset($_POST) && empty($_POST)) {
    $rest_json = file_get_contents("php://input");
    if ($rest_json) {
        $postvars = $rest_json;
        //set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
    }
} else {
    if (isset($_POST)) {
        foreach ($_POST as $key => $value) {
            $postvars .= $key . '=' . $value . '&';
        }
    }
}

// return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// enable headers in response
curl_setopt($ch, CURLOPT_HEADER, 1);
// forward post data
if ($postvars) {
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
}
// set connection timeout
curl_setopt($ch, CURLOPT_TIMEOUT, 3);

// execute curl request
$response = curl_exec($ch);
curl_close($ch);

// set headers from response
list($header, $body) = explode("\r\n\r\n", $response, 2);
$headerLines = explode("\n",$header);
foreach ($headerLines as $headerLine) {
    // response to client is not chuncked, so skip this header
    if (strpos($headerLine, "Transfer-Encoding: chunked") === 0) continue;
    // set header
    header($headerLine);
}

echo $body;