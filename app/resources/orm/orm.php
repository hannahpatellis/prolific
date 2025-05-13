<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/config.php';

$q = new Art\RegistryQuery();
$firstAuthor = $q->findPK(2);


// $registry = new Art\Registry();
// $registry->setName('Jane');
// $registry->setValue('Austen');
// $registry->save();


?>

<pre>

<?php 
print_r($firstAuthor);

?>
</pre>
