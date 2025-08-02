<?php

declare(strict_types=1);

putenv('DB_TYPE=sqlite');

require_once __DIR__ . '/../vendor/autoload.php';

use MyCms\Database\QueryBuilder;

$faker = Faker\Factory::create();

// $rqb = (new QueryBuilder('sites'))
//   ->select(['name', 'domain'])
//   ->where('id', '=', 1)
//   ->where('name', '=', 'DannyDeeps')
//   ->where('domain', '=', 'dannydeeps.dev')
//   ->buildSql();
// print($rqb) . PHP_EOL;

$cqb = (new QueryBuilder('sites'));

for ($i=0; $i < 10; $i++) { 
  $cqb->insert([
    'name' => 'Metis',
    'domain' => $faker->domainName()
  ]);
}

print($cqb->buildSql()) . PHP_EOL;
