<?php
// Message.php
class Message
{
    public $id;
    public $text;

    public function __construct($id, $text)
    {
        $this->id = $id;
        $this->text = $text;
    }
}
