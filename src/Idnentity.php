<?php namespace Idnentity;

require_once 'Kinds/AbstractKind.php';
require_once 'Kinds/Composer/AbstractComposerKind.php';
require_once 'Kinds/Laravel/LaravelAll.php';
require_once 'Kinds/Typo3/AbstractTypo3Kind.php';
require_once 'Kinds/Typo3/Below60.php';
require_once 'Kinds/Typo3/Classic60.php';
require_once 'Kinds/Typo3/Classic61.php';
require_once 'Kinds/Typo3/ClassicAboveEqual62.php';
require_once 'Kinds/Typo3/ComposerAboveEqual62.php';
require_once 'Kinds/Symfony/SymfonyAboveEqual2.php';
require_once 'Kinds/Symfony/Symfony1.php';
require_once 'Kinds/WordPress/WordPressAll.php';

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
            return $kind->getDetails();
        }
    }

}

echo json_encode((new IDNentity())->identify());
