#!/usr/bin/env php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dumper = new \ClassDumper\ClassDumper();
$cache = $dumper->dump([
    \Idnentity\Idnentity::class,
    \Idnentity\Kinds\Typo3\Below60::class,
    \Idnentity\Kinds\Typo3\Classic60::class,
    \Idnentity\Kinds\Typo3\Classic61::class,
    \Idnentity\Kinds\Typo3\ClassicAboveEqual62::class,
    \Idnentity\Kinds\Typo3\ComposerAboveEqual62::class,
    \Idnentity\Kinds\Laravel\LaravelAll::class,
    \Idnentity\Kinds\Symfony\SymfonyAboveEqual2::class,
    \Idnentity\Kinds\Symfony\Symfony1::class,
    \Idnentity\Kinds\WordPress\WordPressAll::class,
], true);
file_put_contents(
    __DIR__ . '/../build/idnentity.php',
    "<?php\n" . $cache . "\n" . 'namespace { $idnentity = new \Idnentity\Idnentity(); echo $idnentity->identify(); }');
