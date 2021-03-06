<?php
namespace Core\Lib;

class Model extends Database
{
    private $table = "";
    public static function getInstance($id)
    {
        if (!is_numeric($id)) {
            return false;
        }
        $post['title'] = "test blog $id";
        $post['writer'] = "Hieu";
        $post['date'] = date("Y-m-d", time());
        $post['content'] = "My blog, my virtual life!";
        return $post;
    }

    public function save($id = null)
    {
        echo "saved!";
    }

    public function delete($id)
    {
        echo "deleted!";
    }

    private function getTableName()
    {
        return $this->table;
    }
}
