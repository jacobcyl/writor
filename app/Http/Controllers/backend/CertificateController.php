<?php
namespace App\Http\Controllers\backend;
use \View;

class CertificateController extends BaseController{

    public function getAll(){
        return View::make('backend.pages.certificate-all');
    }
}