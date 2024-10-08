<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
abstract class IfwPsn_Vendor_Twig_Profiler_Dumper_Base
{
    private $root;

    public function dump(IfwPsn_Vendor_Twig_Profiler_Profile $profile)
    {
        return $this->dumpProfile($profile);
    }

    abstract protected function formatTemplate(IfwPsn_Vendor_Twig_Profiler_Profile $profile, $prefix);

    abstract protected function formatNonTemplate(IfwPsn_Vendor_Twig_Profiler_Profile $profile, $prefix);

    abstract protected function formatTime(IfwPsn_Vendor_Twig_Profiler_Profile $profile, $percent);

    private function dumpProfile(IfwPsn_Vendor_Twig_Profiler_Profile $profile, $prefix = '', $sibling = false)
    {
        if ($profile->isRoot()) {
            $this->root = $profile->getDuration();
            $start = $profile->getName();
        } else {
            if ($profile->isTemplate()) {
                $start = $this->formatTemplate($profile, $prefix);
            } else {
                $start = $this->formatNonTemplate($profile, $prefix);
            }
            $prefix .= $sibling ? '│ ' : '  ';
        }

        $percent = $this->root ? $profile->getDuration() / $this->root * 100 : 0;

        if ($profile->getDuration() * 1000 < 1) {
            $str = $start."\n";
        } else {
            $str = sprintf("%s %s\n", $start, $this->formatTime($profile, $percent));
        }

        $nCount = count($profile->getProfiles());
        foreach ($profile as $i => $p) {
            $str .= $this->dumpProfile($p, $prefix, $i + 1 !== $nCount);
        }

        return $str;
    }
}

//class_alias('IfwPsn_Vendor_Twig_Profiler_Dumper_Base', 'Twig\Profiler\Dumper\BaseDumper', false);
class_exists('IfwPsn_Vendor_Twig_Profiler_Profile');
