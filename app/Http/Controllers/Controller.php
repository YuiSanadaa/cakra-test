<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function decodeMessage($error)
    {
        if ($error) {
            $response = $error->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $errorMessages = '';
            $string = json_decode($responseBodyAsString);
            foreach ($string as $field => $errors) {
                $fieldErrors = implode(', ', $errors);
                $errorMessages .= ucfirst($field) . ": " . $fieldErrors . "\n";
            }
            return $errorMessages;
        } else {
            echo "Unable to decode the JSON response.";
        }
    }
}
