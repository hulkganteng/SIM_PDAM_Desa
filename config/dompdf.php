<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    |
    | Set some default values. It is possible to add all defines that can be set
    | in dompdf_config.inc.php. You can also override the whole config file.
    |
    */
    'show_warnings' => false,

    'public_path' => null,

    /*
    |--------------------------------------------------------------------------
    | Orientation
    |--------------------------------------------------------------------------
    |
    | The default paper orientation.
    |
    */
    'orientation' => 'portrait',

    /*
    |--------------------------------------------------------------------------
    | Paper Size
    |--------------------------------------------------------------------------
    |
    | The default paper size for all PDF documents.
    |
    */
    'paper' => 'A4',

    'defines' => [
        'DOMPDF_FONT_HEIGHT_RATIO' => 1.1,
        'DOMPDF_ENABLE_PHP' => false,
        'DOMPDF_ENABLE_JAVASCRIPT' => true,
        'DOMPDF_ENABLE_REMOTE' => false,
        'DOMPDF_FONT_DIR' => storage_path('fonts'),
        'DOMPDF_FONT_CACHE' => storage_path('fonts'),
        'DOMPDF_TEMP_DIR' => sys_get_temp_dir(),
        'DOMPDF_CHROOT' => realpath(base_path()),
        'DOMPDF_UNICODE_ENABLED' => true,
        'DOMPDF_ENABLE_CSS_FLOAT' => true,
        'DOMPDF_DEFAULT_MEDIA_TYPE' => 'screen',
        'DOMPDF_DEFAULT_PAPER_SIZE' => 'A4',
        'DOMPDF_DEFAULT_FONT' => 'sans-serif',
    ],

];
