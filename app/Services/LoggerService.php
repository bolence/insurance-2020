<?php

namespace App\Service;

use App\Logger;
use Illuminate\Support\Facades\Log;

class LoggerService
{

    /**
     * Main logger action
     *
     * @return void
     */
    public function log( $message, $level = 'info' )
    {
        Log::{$level}($message);
    }


    public function log_to_db( $action, $request )
    {
        Logger::log_to_database($action, $request);
    }

}
