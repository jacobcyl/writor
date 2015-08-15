<?php namespace App\Http\Controllers\Backend;

use \View;

class HomeController extends BaseController {

    /**
     * 后台首页
     *
     * @return Response
     */
    public function index()
    {
        return View::make('backend.pages.home');
    }
}