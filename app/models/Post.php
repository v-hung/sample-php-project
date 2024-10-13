<?php

require_once ROOTPATH . '/app/models/Model.php';

class Post extends Model
{
    protected $id;
    protected $title;

    public function __construct($title = null)
    {
        $this->title = $title;
    }

    public static function getAll() {
        $sql = "SELECT id, title FROM posts";
        $data = query($sql);

        return $data;
    }
}
