<?php
require_once "../model/Message.php";
// controller.php
$messages = [
    1 => new Message(1, "Hello World"),
    2 => new Message(2, "Bonjour le monde")
];

$requestMethod = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;

switch ($requestMethod) {
    case 'GET':
        if ($id) {
            echo json_encode($messages[$id] ?? "Message not found");
        } else {
            echo json_encode($messages);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $newId = count($messages) + 1;
        $messages[$newId] = new Message($newId, $data['text']);
        echo json_encode($messages[$newId]);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        if ($id && isset($messages[$id])) {
            $messages[$id]->text = $data['text'];
            echo json_encode($messages[$id]);
        } else {
            echo json_encode("Message not found");
        }
        break;

    case 'DELETE':
        if ($id && isset($messages[$id])) {
            unset($messages[$id]);
            echo json_encode("Message deleted");
        } else {
            echo json_encode("Message not found");
        }
        break;
}
