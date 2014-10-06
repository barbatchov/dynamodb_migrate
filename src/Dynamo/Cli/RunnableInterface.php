<?php
namespace Dynamo\Cli;

interface RunnableInterface
{
    public function run(array $args = []);
}
