<?php

if (!function_exists('toastr')) {
    /**
     * Toastr helper function
     *
     * @return \TJGazel\Toastr\Toastr
     */
    function toastr()
    {
        return app(\TJGazel\Toastr\Toastr::class);
    }

}