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

use \Psr\Http\Message\MessageInterface;
use \Psr\Http\Message\ResponseInterface;

class Gitap {

    /**
     * Git Service Routers
     *
     * @var array
     */
    public static $routers = [
        "/HEAD$" => "get_text_file",
        "/info/refs$" => "get_info_refs",
        "/objects/info/alternates$" => "get_text_file",
        "/objects/info/http-alternates$" => "get_text_file",
        "/objects/info/packs$" => "get_info_packs",
        "/objects/[0-9a-f]{2}/[0-9a-f]{38}$" => "get_loose_object",
        "/objects/pack/pack-[0-9a-f]{40}\.pack$" => "get_pack_file",
        "/objects/pack/pack-[0-9a-f]{40}\.idx$" => "get_idx_file",
    ];

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
     * @param Confifure $conf
     * @return self
     */
    public function setConfigure(Confifure $conf): self {

    }

    /**
     * Handle a request
     *
     * @param MessageInterface $req
     * @return ResponseInterface
     */
    public function handleRequest(MessageInterface $req): ResponseInterface {

    }

}