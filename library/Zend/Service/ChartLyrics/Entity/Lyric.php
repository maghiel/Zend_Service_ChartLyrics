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
 * Lyric class.
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
class Zend_Service_ChartLyrics_Entity_Lyric
{
    /**
     * Id required to retrieve the song using GetLyric function, The ID must 
     * match the Checksum. Returns a positive integer when there is a lyric available.
     * 
     * @var int
     */
    protected $_id;
    
    /**
     * Checksum required to retrieve the song using GetLyric function.
     * 
     * @var string
     */
    protected $_checksum;
    
    /**
     *
     * @var Zend_Service_ChartLyrics_Entity_Track
     */
    protected $_track;
    
    /**
     * The song title of the lyric.
     * 
     * @var string
     */
    protected $_song;
    
    /**
     * The artist of the lyric.
     * 
     * @var string
     */
    protected $_artist;
    
    /**
     * The URL of the lyric cover art, if available.
     * 
     * @var string
     */
    protected $_coverArtUrl;
    
    /**
     * The ranking of the lyric on a 0 to 10 scale where 10 is the most popular.
     * 
     * @var int
     */
    protected $_rank;
    
    /**
     * The URL of the song correction page on the chartlyrics website.
     * 
     * @var string
     */
    protected $_correctUrl;
    
    /**
     * The lyric of the song.
     * 
     * @var string
     */
    protected $_lyric;
    
    /**
     * Return the id of the lyric
     * 
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Set the id of the lyric
     * 
     * @param int $id 
     * @return self
     */
    public function setId($id)
    {
        $this->_id = (int) $id;
        
        return $this;
    }

    /**
     * Return the checksum of the lyric
     * 
     * @return string
     */
    public function getChecksum()
    {
        return $this->_checksum;
    }

    /**
     * Set checksum of the lyric
     * 
     * @param string $checksum
     * @return self 
     */
    public function setChecksum($checksum)
    {
        $this->_checksum = $checksum;
        
        return $this;
    }

    /**
     * Return the track the lyric belongs to
     * 
     * @return Zend_Service_ChartLyrics_Entity_Track
     */
    public function getTrack()
    {
        return $this->_track;
    }

    /**
     * Set the track this lyric belongs to
     * 
     * @param Zend_Service_ChartLyrics_Entity_Track $track 
     * @return self
     */
    public function setTrack(Zend_Service_ChartLyrics_Entity_Track $track)
    {
        $this->_track = $track;
        
        return $this;
    }

    /**
     * Return title of the song
     * 
     * @return string
     */
    public function getSong()
    {
        return $this->_song;
    }

    /**
     * Set the title of the song
     * 
     * @param string $song 
     * @return self
     */
    public function setSong($song)
    {
        $this->_song = $song;
        
        return self;
    }

    /**
     * Return name of the artist
     * 
     * @return string
     */
    public function getArtist()
    {
        return $this->_artist;
    }

    /**
     * Set name of the artist
     * 
     * @param string $artist 
     * @return self
     */
    public function set_artist($artist)
    {
        $this->_artist = $artist;
        
        return $this;
    }

    /**
     * Return url to lyric cover art or null if no cover art exists.
     * 
     * @return string|null
     */
    public function getCoverArtUrl()
    {
        return $this->_coverArtUrl;
    }

    /**
     * Set url to lyric cover art
     * 
     * @param string $coverArtUrl 
     * @return self
     */
    public function setCoverArtUrl($coverArtUrl)
    {
        $this->_coverArtUrl = $coverArtUrl;
        
        return $this;
    }

    /**
     * Return rank of lyric on a scale of 0 to 10
     * 
     * @return int
     */
    public function getRank()
    {
        return $this->_rank;
    }

    /**
     * Set rank of lyric on a scale of 0 to 10
     * 
     * @param int $rank 
     * @return self
     */
    public function setRank($rank)
    {
        if (0 > $rank || 10 < $rank) {
            $rank = 0;
        }
                
        $this->_rank = (int) $rank;
        
        return $this;
    }

    /**
     * Return URL of the song correction page on the chartlyrics website.
     * 
     * @return string
     */
    public function getCorrectUrl()
    {
        return $this->_correctUrl;
    }

    /**
     * Set URL of the song correction page on the chartlyrics website.
     * 
     * @param string $correctUrl 
     * @return self
     */
    public function setCorrectUrl($correctUrl)
    {
        $this->_correctUrl = $correctUrl;
        
        return $this;
    }

    /**
     * Return the lyric of the song
     * 
     * @return string
     */
    public function getLyric()
    {
        return $this->_lyric;
    }

    /**
     * Set lyric of the song
     * 
     * @param string $lyric 
     * @return self
     */
    public function setLyric($lyric)
    {
        $this->_lyric = $lyric;
        
        return $this;
    }
}
