<?php

function addLog($log)
{
  $fname = "/tmp/" . date("d-m-Y") . ".log";

  $handle = fopen($fname, 'ab');
  /* Datetime to add at the beginning of the log line. */
  $date = date('d/m/Y H:i:s');
  
  /* Complete log line. */
  $line = $date . ' ' . $log . "\n";
  
  /* Add the new line to the log file. */
  fwrite($handle, $line);

  fclose($handle);
}


function executeCmd($cmd_toexec)
{
  addLog("Start::Going to execute command " . $cmd_toexec);
  // Execute command
  $output = shell_exec($cmd_toexec);

  addLog("End::Output is " . $output);

  return $output;
}

?>
