<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwoFaceAuthsController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $googleAuthenticator = new \PHPGangsta_GoogleAuthenticator();
        $secretCode = $googleAuthenticator->createSecret();
        $qrCodeUrl = $googleAuthenticator->getQRCodeGoogleUrl(
            auth()->user()->email, $secretCode, config("app.name")
        );

        session(["secret_code" => $secretCode]);

        return view("two_face_auths.index", compact("qrCodeUrl"));
    }
}
