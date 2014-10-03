<?php
namespace Dynamo;

interface MigrableInterface
{
    public function doMigration();
    public function undoMigration();
}
