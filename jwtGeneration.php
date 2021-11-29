<?php
    function generateJwt($headers, $payload, $secret = 'N270201') {
        $headers_encoded = base64urlEncode(json_encode($headers));
        
        $payload_encoded = base64urlEncode(json_encode($payload));
        
        $signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", $secret, true);
        $signature_encoded = base64urlEncode($signature);
        
        $jwt = "$headers_encoded.$payload_encoded.$signature_encoded";
        return $jwt;
    }

    function isJwtValid($jwt, $secret = 'N270201') {
        $tokenParts = explode('.', $jwt);
        if(!isset($tokenParts[1])) return null;
        $header = base64_decode($tokenParts[0]);
        $payload = base64_decode($tokenParts[1]);
        $signature_provided = $tokenParts[2];

        // check the expiration time - note this will cause an error if there is no 'exp' claim in the jwt
        if(!json_decode($payload)) return null;
        $expiration = json_decode($payload)->exp;
        $is_token_expired = ($expiration - time()) < 0;

        // build a signature based on the header and payload using the secret
        $base64_url_header = base64urlEncode($header);
        $base64_url_payload = base64urlEncode($payload);
        $signature = hash_hmac('SHA256', $base64_url_header . "." . $base64_url_payload, $secret, true);
        $base64_url_signature = base64urlEncode($signature);

        // verify it matches the signature provided in the jwt
        $is_signature_valid = ($base64_url_signature === $signature_provided);
        
        if ($is_token_expired || !$is_signature_valid) {
            return null;
        } else {
            return json_decode($payload, true)['id'];
        }
    }

    function base64urlEncode($str) {
        return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
    }
?>