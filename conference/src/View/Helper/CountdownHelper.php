<?php
namespace App\View\Helper;

use Cake\View\Helper;

/**
 * Countdown helper
 */
class CountdownHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function tillDate(\DateTimeInterface $time) {
        $now = new \DateTime();
        $difference = $time->diff($now);

        return $this->_View->element(
            '/Countdown/static', [
                'timeDiff' => $difference,
            ]
        );
    }
}
