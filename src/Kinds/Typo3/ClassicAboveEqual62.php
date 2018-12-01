<?php namespace Idnentity\Kinds\Typo3;

/**
 * Class ClassicAboveEqual62
 *
 * @package Idnentity\Kinds\Typo3
 */
class ClassicAboveEqual62 extends AbstractTypo3Kind
{

    /**
     * @var string
     */
    protected $regexp = '/define\(\'TYPO3_version\', \'(.*)\'\)/m';

    /**
     * @var string
     */
    protected $configFile = 'typo3/sysext/core/Classes/Core/SystemEnvironmentBuilder.php';

}
