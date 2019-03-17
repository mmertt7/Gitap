<?php
/**
 * Gitap project
 * 
 * @category git
 * @package Gitap
 * @author Tianle Xu <xtl@xtlsoft.top>
 * @license MIT
 */

namespace Gitap;

use \Psr\Http\Message\ResponseInterface;
use \Psr\Http\Message\StreamInterface;
use \Psr\Http\Message\ServerRequestInterface;

class Utils {

    /**
     * Does a string has an extension
     *
     * @param string $str
     * @param string $ext
     * @return boolean
     */
    public static function hasExtension(string $str, string $ext): bool {
        $len = strlen($ext);
        if ($len > strlen($str)) return false;
        return substr($str, -$len) === $ext;
    }

    public static function headerCache(ResponseInterface $req, $forever_or_no = false) {
        if ($forever_or_no) {
            $req->withHeader('Expires', date('r', time() + 31536000));
            $req->withHeader('Cache-Control', 'public, max-age=31536000');
        } else {
            $req->withHeader('Expires', 'Fri, 01 Jan 1980 00:00:00 GMT');
            $req->withHeader('Pragma', 'no-cache');
            $req->withHeader('Cache-Control', 'no-cache, max-age=0, must-revalidate');
        }
    }

    public static function build404Response(): ResponseInterface {
        return new \GuzzleHttp\Psr7\Response(404, ["Status"=>"404"], "404 Not found");
    }

    public static function buildMethodNotAllowed(): ResponseInterface {
        return new \GuzzleHttp\Psr7\Response(405, ["Status"=>"405"], "405 Method Not Allowed");
    }

}