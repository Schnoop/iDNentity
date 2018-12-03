<?php namespace Idnentity;

use Idnentity\Kinds\Laravel\LaravelAll;
use Idnentity\Kinds\Symfony\Symfony1;
use Idnentity\Kinds\Symfony\SymfonyAboveEqual2;
use Idnentity\Kinds\Typo3\Below60;
use Idnentity\Kinds\Typo3\Classic60;
use Idnentity\Kinds\Typo3\Classic61;
use Idnentity\Kinds\Typo3\ClassicAboveEqual62;
use Idnentity\Kinds\Typo3\ComposerAboveEqual62;
use Idnentity\Kinds\WordPress\WordPressAll;

/**
 * Class Idnentity
 */
class Idnentity
{

    /**
     * @var string
     */
    protected $webRoot;

    /**
     * @var array
     */
    protected $supportedKinds = array(
        Below60::class,
        Classic60::class,
        Classic61::class,
        ClassicAboveEqual62::class,
        ComposerAboveEqual62::class,
        LaravelAll::class,
        SymfonyAboveEqual2::class,
        Symfony1::class,
        WordPressAll::class,
    );

    /**
     * IDNetity constructor.
     */
    public function __construct()
    {
        $this->webRoot = realpath('.') . '/';
    }

    /**
     * Identify.
     *
     * @return array
     */
    public function identify()
    {
        foreach ($this->supportedKinds as $supportedKind) {
            $kind = new $supportedKind($this->webRoot);
            if ($kind->isKindOf() === false) {
                continue;
            }
            if ($this->isCommandLineInterface() === true) {
                return print_r($kind->getDetails(), 1);
            }
            return json_encode($kind->getDetails());
        }
    }

    /**
     * @return bool
     */
    private function isCommandLineInterface()
    {
        return (php_sapi_name() === 'cli');
    }
}
