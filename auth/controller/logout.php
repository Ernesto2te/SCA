<?php 
function close()
{
  #
  session_start();
  session_destroy();
  return "1";
}

?>

