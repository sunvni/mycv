<?php
namespace Core\Model;

use Core\Lib\Model;
use Core\Lib\Database;

class Blog extends Model
{
    private $table = "post";
    public static function getInstance($id)
    {
        $db = new Database;

        $data = $db->get("*");

        dd($data);
        if (!is_numeric($id)) {
            return false;
        }
        $post['title'] = "test blog $id";
        $post['writer'] = "Hieu";
        $post['date'] = date("Y-m-d", time());
        $post['content'] = "My blog, my virtual life!";
        return $post;
    }
}
