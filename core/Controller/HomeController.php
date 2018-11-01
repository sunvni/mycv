<?php
namespace Core\Controller;

use Core\Lib\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        //echo "Hello Controller";
    }
    public function index()
    {
        for ($i = 0; $i < 10; $i++) {
            $data[] = ['id' => $i, 'name' => "Hieu$i", 'age' => (27 + $i)];
        }
        $test = 1;
        return view("home.index", compact('data', 'test'));
    }
    public function roadMap()
    {
        $msg = "Roadmap is on developing!";
        return view("home.road", compact('msg'));
    }
    public function login()
    {
        $input = request()->getAll();
        dd($input);
    }

    public function contact()
    {
        $msg = "Skype: sunvni";
        return view("home.road", compact('msg'));
    }
}
