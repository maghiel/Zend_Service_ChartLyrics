<?php

class IndexController extends Zend_Controller_Action
{
    /**
     * @var Zend_Service_ChartLyrics
     */
    protected $_service;

    /**
     * Instantiate new service instance
     */
    public function init()
    {
        $this->_service = new Zend_Service_ChartLyrics();
    }

    /**
     * Do some example calls and pass them to a view
     */
    public function indexAction()
    {
        Zend_Debug::dump($this->_service->getClient());
       
        $this->_service->clearCache();
        // UC-01: search for lyrics of the artist Bad Religion and retreive 
        // the LyricId and LyricChecksums of these lyrics. Pass the results to
        // getLyric to retrieve the actual lyrics.       
        $lyrics = $this->_service->searchLyric('Bad Religion');
        
        if ($lyrics) {
            Zend_Debug::dump($lyrics);
            foreach ($lyrics as $lyricResult) {
                $lyric = $this->_service->getLyric(
                    $lyricResult->lyricID, $lyricResult->lyricChecksum
                    );
                
                Zend_Debug::Dump($lyric);
            }
        }
               
        // UC-02: Search for lyric of the song Generator by Bad Religion, retreive
        // lyricID and Checksums, and pass to getLyric.
        $lyrics = $this->_service->searchLyric('Bad Reli-gion', 'Generator');

        if ($lyrics) {
            foreach ($lyrics as $lyricResult) {
                $lyric = $this->_service->getLyric(
                    $lyricResult->lyricID, $lyricResult->lyricChecksum
                    );
            }
        }        

        // UC-03: search for lyric of Generator by Bad Religion, and directly 
        // return the lyric as a result instead of the ID and checksum. 
        // If the lyric cannot be found, return a related lyric to encourage
        // the end-user to add the lyric him/her-self.
        $lyric = $this->_service->searchLyricDirect(
            'Bad Religion', 'Generator'
            );
        
        Zend_Debug::dump($lyric);
        $this->view->lyric           = $lyric->Lyric;
        $this->view->lyricUrl        = $lyric->LyricUrl;
        $this->view->lyricCorrectUrl = $lyric->LyricCorrectUrl;
        
        // UC-04: Same as UC-03, but searchLyricDirect does not return a result
        // if the lyric cannot be found here.
        $lyric = $this->_service->searchLyricDirect(
            'Bad Religion', 'Generator'
            );
        
        if ($lyric) {
            $this->view->lyric           = $lyric->Lyric;
            $this->view->lyricUrl        = $lyric->LyricUrl;
            $this->view->lyricCorrectUrl = $lyric->LyricCorrectUrl;        
        } else {
            echo 'Lyric could not be found!';
        }
        
        // UC-05: Search for lyrics with "talk about the birds" in the text,
        // and return the lyricId and lyricChecksum.
        $result = $this->_service->searchLyricText('talk about the birds');
        
        if ($result) {
            foreach ($result as $lyricResult) {
                // Etc.
            }
        }
        
        
    }
    
    


}

