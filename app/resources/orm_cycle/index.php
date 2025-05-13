<?php

declare(strict_types=1);
include __DIR__ . '/../../vendor/autoload.php';
require_once(__DIR__ . "/../env.php");

use Cycle\Database;
use Cycle\Database\Config;

$dbal = new Database\DatabaseManager(
    new Config\DatabaseConfig([
        'default' => 'default',
        'databases' => [
            'default' => ['connection' => 'mysql']
        ],
        'connections' => [
            'mysql' => new Config\MySQLDriverConfig(
              connection: new Config\MySQL\TcpConnectionConfig(
                  database: $env['sql_db'],
                  host: $env['sql_uri'],
                  port: $env['sql_port'],
                  user: $env['sql_user'],
                  password: $env['sql_password'],
                  options: [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::MYSQL_ATTR_SSL_CA => $env['sql_cert'],
                    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
                  ]
              ),
              queryCache: true
          ),
        ]
    ])
);

$finder = (new \Symfony\Component\Finder\Finder())->files()->in([__DIR__ . "/entities"]);
$classLocator = new \Spiral\Tokenizer\ClassLocator($finder);

print_r($classLocator->getClasses());

use Cycle\Schema;
use Cycle\Annotated;
use Cycle\Annotated\Locator\TokenizerEmbeddingLocator;
use Cycle\Annotated\Locator\TokenizerEntityLocator;

$embeddingLocator = new TokenizerEmbeddingLocator($classLocator);
$entityLocator = new TokenizerEntityLocator($classLocator);

$schema = (new Schema\Compiler())->compile(new Schema\Registry($dbal), [
    new Schema\Generator\ResetTables(),             // Reconfigure table schemas (deletes columns if necessary)
    new Annotated\Embeddings($embeddingLocator),    // Recognize embeddable entities
    new Annotated\Entities($entityLocator),         // Identify attributed entities
    new Annotated\TableInheritance(),               // Setup Single Table or Joined Table Inheritance
    new Annotated\MergeColumns(),                   // Integrate table #[Column] attributes
    new Schema\Generator\GenerateRelations(),       // Define entity relationships
    new Schema\Generator\GenerateModifiers(),       // Apply schema modifications
    new Schema\Generator\ValidateEntities(),        // Ensure entity schemas adhere to conventions
    new Schema\Generator\RenderTables(),            // Create table schemas
    new Schema\Generator\RenderRelations(),         // Establish keys and indexes for relationships
    new Schema\Generator\RenderModifiers(),         // Implement schema modifications
    new Schema\Generator\ForeignKeys(),             // Define foreign key constraints
    new Annotated\MergeIndexes(),                   // Merge table index attributes
    // new Schema\Generator\SyncTables(),              // Align table changes with the database
    new Schema\Generator\GenerateTypecast(),        // Typecast non-string columns
]);

use Cycle\ORM;
use Cycle\ORM\EntityManager;

$orm = new ORM\ORM(new ORM\Factory($dbal), new ORM\Schema($schema));
$manager = new EntityManager($orm);

$registry = $orm->getRepository(\Art\Registry::class)->findByPK(1);
$registry->setName("Something agai2n");
$manager->persist($registry)->run();
?>

<pre>

<?php

print_r($registry);

?>

</pre>