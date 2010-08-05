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
 * Track class. Needed for the addLyric method.
 * Implements Fluent Interface
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
class Zend_Service_ChartLyrics_Entity_Track
{
    /** 
     * Id required to add the lyric using AddLyric function, The ID must match 
     * the Checksum. Returns a positive integer when there is no lyric available.
     * 
     * @var int
     */
    protected $_id;
    
    /**
     * Checksum required to add the lyric using the AddLyric function.
     * 
     * @var string
     */
    protected $_checksum;
    
    /**
     * Return id of the track if no lyric exists for it.
     * 
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Set id of the track
     * 
     * @param int $id 
     * @return self
     */
    public function setId($id)
    {
        $this->_id = $id;
        
        return $this;
    }

    /**
     * Return checksum of the track
     * 
     * @return string
     */
    public function getChecksum()
    {
        return $this->_checksum;
    }

    /**
     * Set checksum of the track
     * 
     * @param string $checksum 
     * @return self
     */
    public function setChecksum($checksum)
    {
        $this->_checksum = $checksum;
        
        return $this;
    }

}
