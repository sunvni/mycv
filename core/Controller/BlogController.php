<?php
namespace Core\Controller;

use Core\Lib\Controller;
use Core\Model\Blog;

class BlogController extends Controller
{
    public function show($id)
    {
        $post = Blog::getInstance($id);
        if ($post) {
            return view("blog.post", compact('post'));
        } else {
            return view("errors.msg", ["msg" => "Blog not found"]);
        }
    }
}
