<?php
namespace Core\Controller;

use Core\Lib\Controller;

class AboutController extends Controller
{
    public function more()
    {
        $msg = "Hello About";
        return view('home.index', compact('msg'));
    }
    public function index()
    {
        $msg = "Hello About Index";
        return view('home.index', compact('msg'));
    }
}
