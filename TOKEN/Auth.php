<?php
$users = [
    "654b78b0b6ec0" => "3bHYxa3zkdmRExK4VEye9wVBT8gCWPRra4HOFzBh9dJ62UZFb3blK7q7UzONcrxU"
];


class Auth
{
    public const validity = 30;
    private const sckey = "tbhWoqyJ7yF0y8835wRoo4UesmgQ9QnwGcULZ9MDHk9NtQBby81L7yULDYkGNXec";
    private const rfkey = "boWKIuV908iqIncPl5cVV5qLi8aofiMpzKnQe6z9O4O06eQHNhDO0NXpYDEVutd0";

    private function generete_header(int $validity_delay = self::validity): array
    {
        $dateTime = new DateTime();
        $iat = $dateTime->getTimestamp();
        $header = ["iat" => $iat, "exp" => $iat + $validity_delay];
        return $header;
    }


    private function b64_enc_clean(array $data): string
    {
        $json = json_encode($data);
        $base64 = base64_encode($json);
        return str_replace(['+', '/', '='], ['-', '_', ''], $base64);
    }

    private function generate_signature(string $b64_header, string $b64_payload, string $key = self::sckey): string
    {
        $data = $b64_header . '.' . $b64_payload;
        $bit_signature = hash_hmac('sha256', $data, $key, true);
        $b64_signature = base64_encode($bit_signature);
        $clean_signature = str_replace(['+', '/', '='], ['-', '_', ''], $b64_signature);
        return $clean_signature;
    }

    private function check_vaildity(string $token): bool
    {
        $data = explode('.', $token);
        $header = $data[0];
        $header_json = base64_decode($header);
        $header_arr = json_decode($header_json, true);
        $exp = $header_arr['exp'];
        $dateTime = new DateTime();
        $now = $dateTime->getTimestamp();

        if ($now > $exp) {
            return false;
        } else {
            return true;
        }
    }

    public function generate_access_token(array $data): string
    {
        $key = self::sckey;
        $header = self::generete_header();
        $b64_header = self::b64_enc_clean($header);
        $b64_payload = self::b64_enc_clean($data);
        $signature = self::generate_signature($b64_header, $b64_payload, $key);
        $token = $b64_header . '.' . $b64_payload . '.' . $signature;
        return $token;
    }
    public function generate_refrech_token(): string
    {
        $refrech_key = self::rfkey;
        $header = self::generete_header(36000);
        global $users;
        $payload = ["sub" => "654b78b0b6ec0", "refrechToken" => $users['654b78b0b6ec0']];
        $b64_header = self::b64_enc_clean($header);
        $b64_payload = self::b64_enc_clean($payload);
        $signature = self::generate_signature($b64_header, $b64_payload, $refrech_key);
        return "$b64_header.$b64_payload.$signature";
    }

    function check_access_token(string $token): bool
    {
        $key = self::sckey;
        $valid = self::check_vaildity($token);
        if (!$valid) {
            return false;
        }
        list($header, $payload, $signature) = explode('.', $token);
        $bit_check_sign = hash_hmac('sha256', $header . '.' . $payload, $key, true);
        $check_sign = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($bit_check_sign));
        return hash_equals($signature, $check_sign);
    }

    public function check_refresh_token(string $token)
    {
        $rfkey = self::rfkey;
        $valid = self::check_vaildity($token);
        if (!$valid) {
            return false;
        }
        list($header, $payload, $signature) = explode('.', $token);
        $bit_check_sign = hash_hmac('sha256', $header . '.' . $payload, $rfkey, true);
        $check_sign = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($bit_check_sign));
        return hash_equals($signature, $check_sign);
    }
}
