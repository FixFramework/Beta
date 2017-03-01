<?php
/**
 * Created by PhpStorm.
 * User: cengizakcan
 * Date: 28.02.2017
 * Time: 15:47
 */

namespace System\Core\Assets;

use System\Router;

class Assets
{

    /**
     * @param null $Path
     * @param bool $Url
     * @return string
     */
    public static function path($Path = null, $Url = false){

        return $Url ? FIX_PROTOCOL.FIX_URL.FIX_SLASH.FIX_APP_DIR.FIX_SLASH.Router\FIX_Router::appMultipleStatus().FIX_SLASH."views".FIX_SLASH.$Path : FIX_SLASH.FIX_APP_DIR.FIX_SLASH.Router\FIX_Router::appMultipleStatus().FIX_SLASH."views".FIX_SLASH.$Path;

    }


}