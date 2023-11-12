<?php

function runCommand(string $command)
{
    echo "WORKING";
    echo "<br>";
    echo "<br>";
    $output = shell_exec($command);
    echo "<pre>$output</pre>";
    echo "<br>";
    echo "<br>";
    echo "END FILE";
}

runCommand("python --version");
