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
 * Instance of this class is returned by Zend_Service_ChartLyrics::searchLyric()
 * and Zend_Service_ChartLyrics::searchLyricText()
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
class Zend_Service_ChartLyrics_Entity_LyricSearchResult
    implements Zend_Service_ChartLyrics_Entity_HasTrackInterface
{
    /**
     *
     * @var Zend_Service_ChartLyrics_Entity_Track
     */
    protected $_track;
    
    /**
     * Checksum required to retrieve the song using GetLyric function.
     * 
     * @var string
     */
    protected $_lyricChecksum;
    
    /**
     * Id required to retrieve the song using GetLyric function, The ID must 
     * match the Checksum. Returns a positive integer when there is a lyric available.
     * 
     * @var int
     */
    protected $_lyricId;
    
    /**
     * The URL of the song on the ChartLyrics website, If the lyric does not 
     * exist this will show the Add Lyric link. 
     * 
     * @var string
     */
    protected $_songUrl;
    
    /**
     * The URL of the artist on the chartlyrics website.
     * 
     * @var string
     */
    protected $_artistUrl;
    
    /**
     * The title of the song.
     * 
     * @var string
     */
    protected $_song;
    
    /**
     * The ChartLyrics rank of the song on a 0 to 10 scale where 10 is the 
     * most popular.
     * 
     * @var int
     */
    protected $_songRank;
    
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
     * Return the id of the lyric
     * 
     * @return int
     */
    public function getLyricId()
    {
        return $this->_lyricId;
    }

    /**
     * Set the id of the lyric
     * 
     * @param int $lyricId 
     * @return self
     */
    public function setLyricId($lyricId)
    {
        $this->_lyricId = (int) $lyricId;
        
        return $this;
    }

    /**
     * Return the checksum of the lyric
     * 
     * @return string
     */
    public function getLyricChecksum()
    {
        return $this->_lyricChecksum;
    }

    /**
     * Set checksum of the lyric
     * 
     * @param string $lyricChecksum
     * @return self 
     */
    public function setLyricChecksum($lyricChecksum)
    {
        $this->_lyricChecksum = $lyricChecksum;
        
        return $this;
    }    
    
    /**
     * The URL of the song on the ChartLyrics website, If the lyric does not 
     * exist this will return the Add Lyric link. 
     * 
     * @return string
     */
    public function getSongUrl()
    {
        return $this->_songUrl;
    }
    
    /**
     * Set the URL of the song on the ChartLyrics website, or the Add Lyric link
     * if the Lyric does not exist.
     * 
     * @param string $songUrl
     * @return self
     */
    public function setSongUrl($songUrl)
    {
        $this->_songUrl = $songUrl;
        
        return $this;        
    }
    
    /**
     * Return the URL of the artist on the chartlyrics website
     * 
     * @return string
     */
    public function getArtistUrl()
    {
        return $this->_artistUrl;
    }
    
    /**
     * Set the URL of the artist on the chartlyrics website
     * 
     * @param string $artistUrl
     * @return self
     */
    public function setArtistUrl($artistUrl)
    {
        $this->_artistUrl = $artistUrl;
        
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
        
        return $this;
    }    
    
    /**
     * Return rank of song on a scale of 0 to 10
     * 
     * @return int
     */
    public function getSongRank()
    {
        return $this->_rank;
    }

    /**
     * Set rank of song on a scale of 0 to 10
     * 
     * @param int $rank 
     * @return self
     */
    public function setSongRank($rank)
    {
        if (0 > $rank || 10 < $rank) {
            $rank = 0;
        }
                
        $this->_songRank = (int) $rank;
        
        return $this;
    }    
    
    
}
