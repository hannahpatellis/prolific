<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/config.php';

$q = new Art\PiecesQuery();
$current_piece = $q->findPK(2)->toArray();


// $registry = new Art\Registry();
// $registry->setName('Jane');
// $registry->setValue('Austen');
// $registry->save();


?>

<pre>

<?php 
print_r($current_piece['SizeUnit']);

?>
</pre>
