#!/usr/local/bin/php
<?php declare(strict_types=1);

use Skeleton\App;
use Skeleton\Console;
use Skeleton\InputSanitizer;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new App();
$console = new Console();

$console->askStringValue('App name', function ($appName) use ($app) {
    $app->name = InputSanitizer::removeNonAsciiAlphanumericCharacters(InputSanitizer::transliterateString($appName));
});

$console->askStringValueDefault('App description', '', function ($appDescription) use ($app) {
    $app->description = $appDescription;
});

$console->askStringValue('App organization/author', function ($appOrganizationName) use ($app) {
    $app->organizationName = $appOrganizationName;
});

$console->askStringValueDefault(
    'App namespace root',
    InputSanitizer::removeSpaces($app->name),
    function ($appNamespaceRoot) use ($app) {
        $app->namespaceRoot = $appNamespaceRoot;
    }
);

$console->askStringValueDefault(
    'Composer package organization/author',
    InputSanitizer::lowercaseAndSanitizeName($app->organizationName),
    function ($appPackageOrganization) use ($app) {
        $app->packageOrganization = strtolower($appPackageOrganization);
    }
);

$console->askStringValueDefault(
    'Composer package name',
    InputSanitizer::lowercaseAndSanitizeName($app->name),
    function ($appPackageName) use ($app) {
        $app->packageName = $appPackageName;
    }
);

var_dump($app);
