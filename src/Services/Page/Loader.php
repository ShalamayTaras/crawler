<?php declare( strict_types = 1 );

namespace Services\Page;

use Services\Url;

/**
 * Class PageLoader
 */
class Loader
{

    /**
     * @param string $url
     * @return string
     */
    public function load (string $url) : string
    {
        $link       = Url::make($url);

        $firstTime1 = microtime(true);
        $pageData   = $this->loadPageFileGetContent($link->toString());
        $long1      = microtime(true) - $firstTime1;

        $firstTime = microtime(true);
        $pageCurl  = $this->loadPageCurl($link->toString());
        $long      = microtime(true) - $firstTime;

        $imgCount     = ImageTags::getImgCount($pageData);
        $imgCountCurl = ImageTags::getImgCount($pageCurl);


        echo '<pre>';
        var_dump($imgCount, $long1, $imgCountCurl, $long);
        echo '</pre>';

        exit(1);


        return $pageData;
    }

    /**
     * @param $url
     * @return mixed
     */
    public function loadPageCurl (string $url)
    {

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $url);

        $data = curl_exec($curl);
        curl_close($curl);

        return $data;
    }

    /**
     * @param string $url
     * @return bool|string
     */
    public function loadPageFileGetContent (string $url)
    {
        return file_get_contents($url);
    }

}