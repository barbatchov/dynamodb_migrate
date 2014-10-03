Dynamodb Migrate
================

[![Build Status](https://travis-ci.org/barbatchov/dynamodb_migrate.svg?branch=master)](http://travis-ci.org/barbatchov/dynamodb_migrate)

A migration functionality for Amazon DynamoDB
---------------------------------------------

How it works:
    There is a runnable script 'migrate' with some options.
    Just run it as follows:
    
    * For create a new migration - ./migrate create - then put the name;
    * For run your migrations    - ./migrate update - and wait for finish;
    * For undo a migration       - ./migrate undo   - then puth a date [YmdHMS]

Warning:
    Undo is experimental.


The help output:

    Use these options:
        migrate create [followed by name]      - to create a migration
        migrate update                         - to update the db
        migrate undo [followed by date YmdHMS] - to undo modifications
