<?php

Route::get('/app/database.sqlite', function () {
    $path = storage_path('app/database.sqlite');
    $target = '../database.sql';
    $dumper = Spatie\DbDumper\Databases\Sqlite::
                    create()
                    ->setDbName($path)
                    ->dumpToFile($target);
    return $dumper;
});