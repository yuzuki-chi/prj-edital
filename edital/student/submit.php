<?php
echo $_POST['data'];
file_put_contents('/var/www/html/output/'.time().'_answer.json', $_POST['data']);