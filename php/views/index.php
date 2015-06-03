<?php

echo "This part of text is written in file php/views/index.php I have 2 arguments with me. I can use the, ".$inp1." for ".$inp2;

?>
<br>
This line is out of PHP.
<br>
<?php
for($i=0;$i<$num;$i++){
?>
Any part of code in this file won't do computation.[i.e. will just read the input] It will just display inputs.<br>
<?php
}
?>

