<?php

require(__DIR__.'/../src/docopt.php');

$in = '';

while (!feof(STDIN)) {
    $in .= fread(STDIN, 1024);
}

ob_start();
$result = Docopt\docopt($in, array('exit'=>false));
$out = ob_get_clean();

if (getenv('DOCOPT_DEBUG'))
    echo $out;

if (!$result->success)
    print '"user-error"';
elseif (empty($result->args))
    echo '{}';
else
    echo json_encode($result->args);
