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
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id:$
 */

/**
 * Chartlyrics
 * SOAP client wrapper for the Chartlyrics API.
 * Uses Zend_Cache by default
 * 
 * @see http://www.chartlyrics.com/api.aspx
 *
 * @uses Zend_Soap_Client
 * @uses Zend_Cache
 * 
 * @category   Zend
 * @package    Zend_Service_ChartLyrics
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @author     Maghiel Dijksman <mail@mdijksman.nl>
 * @version    $Id:$
 */
class Zend_Service_ChartLyrics
{
    const SERVICE_NS   = 'Chartlyrics';
    const SOAP_VERSION = SOAP_1_2;
    const WSDL_URL     = 'http://api.chartlyrics.com/apiv1.asmx?WSDL';

    /**
     * @var Zend_Soap_Client
     */
    protected $_client;

    /**     
     * @var Zend_Cache_Core
     */
    protected static $_cache;

    /**
     * Internal option, cache disabled
     *
     * @var    boolean     
     */
    protected static $_cacheDisabled = false;

    /**
     * Instantiate client instance
     *
     * @var Zend_Cache_Core $cache
     */
    public function  __construct(Zend_Cache_Core $cache = null)
    {
        ini_set('default_socket_timeout', 120);
       
        if (!isset(self::$_cache) && !self::$_cacheDisabled) {
            if (null !== $cache) {
                $this->setCache($cache);
            } else {
                self::$_cache = Zend_Cache::factory(
                    'Core',
                    'File',
                    array(
                        'automatic_serialization' => true,
                        'lifetime' => 604800
                    ),
                    array(
                        'cache_dir' => APPLICATION_PATH . '/../tmp/'
                    )
                    );
            }
        }       
        
        $this->_client = new Zend_Soap_Client(self::WSDL_URL, array(
           'soapVersion'    => self::SOAP_VERSION,
        ));
        
        $this->_client->setUserAgent('Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3');
    }

    /**
     * @return Zend_Soap_Client
     */
    public function getClient()
    {
        return $this->_client;
    }

    /**
     * Search for lyrics and return the lyricId and lyricChecksum
     * for the GetLyric function. It has the following input parameters:
     *
     * @param string $artist    The artist name.
     * @param string $song      The song title.
     *
     * @return StdClass[]
     */
    public function searchLyric($artist = null, $song = null)
    {
        $cacheId = $this->_normalizeCacheId(array(
            'searchLyric',
            $artist,
            $song
        ));
      
        if (self::hasCache()) {        
            if (false !== ($result = self::$_cache->load($cacheId))) {
                return $result;
            }
        }

        try {
            $result = $this->_client->SearchLyric(array(
                'artist' => $artist,
                'song'   => $song
            ));
        } catch (SoapFault $e) {
            // In some rare situations the webservice returns invalid http headers
            // or takes to long to respond.            
            self::_saveToCache(null, $cacheId);
            return;
        } catch (Exception $e) {            
            self::_saveToCache(null, $cacheId);
            return;
        }

        self::_saveToCache($result, $cacheId, 'SearchLyricResult');
        
        return $result->SearchLyricResult;
    }

    /**
     * Search for lyrics and return the lyricId and lyricChecksum
     * for the GetLyric function.
     *
     * @todo Implement
     * @param string $lyricText     The lyric text to search.
     * @return stdClass[]           Each call for artist and title combination
     *                              can return a total of 25 possible songs
     *                              orderd by ChartLyrics rank.
     */
    public function searchLyricText($lyricText)
    {
        // TODO: implement
    }
    
    /**
     * GetLyric retreives the lyric using the lyricId and lyricChecksum.
     *
     * @param int       $id         The lyric ID.
     * @param string    $checksum   The lyric Checksum.
     * @return stdClass
     */
    public function getLyric($id, $checksum)
    {
        $cacheId = $this->_normalizeCacheId(array(
            'getLyric',
            $id,
            $checksum
        ));

        if (self::hasCache()) {
            if (false !== ($result = self::$_cache->load($cacheId))) {
                return $result;
            }
        }

        try {
            $lyric = $this->_client->GetLyric(array(
                'lyricId'       => $id,
                'lyricCheckSum' => $checksum
            ));
        } catch (SoapFault $e) {
            self::_saveToCache(null, $cacheId);
        }

        self::_saveToCache($lyric, $cacheId, 'GetLyricResult');

        return $lyric->GetLyricResult;
    }

    /**
     * SearchLyricDirect retreives the lyric using the artist and song.
     *
     * @param string $artist    Both artist name and song title are needed.
     * @param string $song      Stop-words are removed from the search query,
     *                          see the General section for the stop words.
     * @param bool $canBeRelatedLyric   [Optional] By default chartlyrics always
     *                          returns a result instance, in favour of encouraging
     *                          users to add the lyric if not found in their
     *                          database.
     * @return stdClass|null
     */
    public function searchLyricDirect($artist, $song, $canBeRelatedLyric = true)
    {
        $cacheId = $this->_normalizeCacheId(array(
            'searchLyricDirect',
            $artist,
            $song
        ));
        
        if (self::hasCache()
            && (false !== ($result = self::$_cache->load($cacheId)))
        ) {
            return $result;
        }

        try {
            $result = $this->_client->SearchLyricDirect(array(
                'artist' => $artist,
                'song'   => $song
            ));
        } catch (SoapFault $e) {
            self::_saveToCache(null, $cacheId);
            return;
        }

        if (false === $canBeRelatedLyric) {
            if ($artist != $result->SearchLyricDirectResult->LyricArtist
                || $song != $result->SearchLyricDirectResult->LyricSong
            ) {
                self::_saveToCache(null, $cacheId);
                return;
            }
        }

        self::_saveToCache($result, $cacheId, 'SearchLyricDirectResult');
        
        return $result->SearchLyricDirectResult;
    }
    
    /**
     * Returns the set cache
     *
     * @return Zend_Cache_Core The set cache
     */
    public static function getCache()
    {
        return self::$_cache;
    }

    /**
     * Set a cache for Zend_Locale_Data
     *
     * @param Zend_Cache_Core $cache A cache frontend
     */
    public static function setCache(Zend_Cache_Core $cache)
    {
        self::$_cache = $cache;
    }

    /**
     * Returns true when a cache is set
     *
     * @return boolean
     */
    public static function hasCache()
    {
        if (self::$_cache !== null) {
            return true;
        }

        return false;
    }

    /**
     * Removes any set cache
     *
     * @return void
     */
    public static function removeCache()
    {
        self::$_cache = null;
    }

    /**
     * Clears all set cache data
     *
     * @return void
     */
    public static function clearCache()
    {
        self::$_cache->clean();
    }

    /**
     * Save data to cache if cache is set.
     * If data is false or null, saves null.
     * If property is given and data is not null or false, save the given
     * property.
     *
     * @param mixed     $data
     * @param string    $id
     * @param string    $property
     * @return mixed|null
     */
    private static function _saveToCache($data, $id, $property = null)
    {
        if (!self::hasCache()) {
            return;
        }

        if (!$data) {
            return self::$_cache->save(null, $id);
        }

        if (null !== $property) {
            return self::$_cache->save($data->{$property}, $id);
        } else {
            return self::$_cache->save($data, $id);
        }
    }

    /**
     * Filters each value in given array so it can be used as a CacheId
     *
     * @param array $parts
     * @return string
     */
    private function _normalizeCacheId(array $parts)
    {
        $id = self::SERVICE_NS;
        
        foreach ($parts as $part) {            
            $part = iconv('UTF-8', 'ASCII//IGNORE', $part);
            $part = Zend_Filter::filterStatic($part, 'Alpha');
            
            $id .= '_' . $part;
        }

        return $id;
    }
}
