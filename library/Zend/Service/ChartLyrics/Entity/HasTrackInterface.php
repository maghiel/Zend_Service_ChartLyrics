<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Service_ChartLyrics
 * @subpackage Entity
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id:$
 */

/**
 * Interface for classes that have a Track entity as a property
 * 
 * @see http://www.chartlyrics.com/api.aspx
 *
 * @category   Zend
 * @package    Zend_Service_ChartLyrics
 * @subpackage Entity
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @author     Maghiel Dijksman <mail@mdijksman.nl>
 * @version    $Id:$
 */
interface Zend_Service_ChartLyrics_Entity_HasTrackInterface
{
    public function getTrack();
    public function setTrack(Zend_Service_ChartLyrics_Entity_Track $track);
}
