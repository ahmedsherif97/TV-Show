<?php

/**
 * Created by PhpStorm.
 * User: Musa
 * Date: 28.01.2019
 * Time: 18:19
 */

return [

    "enabled" => env('APP_ENV') == 'production', // Is cache enabled?

    // Cache minutes.
    "minutes" => 7200, //5 days 7200 //a day 1440 // Cache minutes.

    /**
     * If this event is triggered on this model,
     * the cache of that table is deleted.
     */
    "clear_events" => [
        "created",
        "updated",
        "deleted",
        "restored",
    ],
];
