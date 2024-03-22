<?php
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');

    $descriptorspec = array(
        0 => array("pipe", "r"), // stdin
        1 => array("pipe", "w"), // stdout
        2 => array("pipe", "w")  // stderr
    );

    $process = proc_open('tail -f test.txt', $descriptorspec, $pipes);

    if (is_resource($process)) {
        while ($line = fgets($pipes[1])) {
            echo "data: $line\n\n";
            ob_flush();
            flush();
        }
    }

    proc_close($process);
?>

