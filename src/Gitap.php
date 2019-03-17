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
use \Psr\Http\Message\ServerRequestInterface;

class Gitap {

    /**
     * Git Service Routers
     *
     * @var array
     */
    public static $routers = [
        "/git-upload-pack$" => ["POST", "serveRpc", "upload-pack"],
        "/git-receive-pack$" => ["POST", "serveRpc", "receive-pack"],
        "/HEAD$" => ["GET", "getTextFile", ""],
        "/info/refs$" => ["GET", "getInfoRefs", ""],
        "/objects/info/alternates$" => ["GET", "getTextFile", ""],
        "/objects/info/http-alternates$" => ["GET", "getTextFile", ""],
        "/objects/info/packs$" => ["GET", "getInfoPacks", ""],
        "/objects/info/[^/]*$" => ["GET", "getTextFile", ""],
        "/objects/[0-9a-f]{2}/[0-9a-f]{38}$" => ["GET", "getLooseObject", ""],
        "/objects/pack/pack-[0-9a-f]{40}\.pack$" => ["GET", "getPackFile", ""],
        "/objects/pack/pack-[0-9a-f]{40}\.idx$" => ["GET", "getIdxFile", ""],
    ];

    /**
     * Configure Class
     *
     * @var Configure
     */
    protected $config = null;

    /**
     * Constructor
     *
     * @param Configure $conf
     */
    public function __construct(Configure $conf) {
        $this->setConfigure($conf);
    }

    /**
     * Set the configure
     *
     * @param Configure $conf
     * @return self
     */
    public function setConfigure(Configure $conf): self {
        $this->config = $conf;
        return $this;
    }

    /**
     * Handle a request
     *
     * @param ServerRequestInterface $req
     * @return ResponseInterface
     */
    public function handleRequest(ServerRequestInterface $req): ResponseInterface {
        $uri = explode("?", $req->getServerParams()['REQUEST_URI'])[0];
        $method = $req->getServerParams()['REQUEST_METHOD'];
        if (substr($uri, 0, 1) == "/") $uri = substr($uri, 1); 
        $uris = explode("/", $uri);
        $repo = $uris[0];
        $uri = "/" . join("/", array_slice($uris, 1));
        // Check Repos...
        if (!true) { // TODO: Write Repository Check
            return Utils::build404Response();
        }
        foreach ($this->routers as $router=>$value) {
            $matches = [];
            if (preg_match('~^'.$router.'~', $repo_path)) {
                if ($method !== $value[0]) return Utils::buildMethodNotAllowed();
                $rpc = $value[2];
                $action = $value[1];
                // TODO: Add authentication
            }
        }
        return Utils::build404Response();
    }

}