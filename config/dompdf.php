<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    |
    | Set some default values. It is possible to add all defines that can be set
    | in dompdf_config.inc.php. You can also override the entire config file.
    |
    */
    'show_warnings' => false,   // Throw an Exception on warnings from dompdf

    'public_path' => null,  // Override the public path if needed

    /*
    |--------------------------------------------------------------------------
    | Defines
    |--------------------------------------------------------------------------
    |
    | The dompdf_config.inc.php configuration file.
    | These settings are JIT - Just In Time, so they can be changed after instantiation
    |
    | The extensive list of available constants can be found at
    | https://github.com/dompdf/dompdf/blob/master/src/Options.php
    |
    */
    'defines' => [
        // The location of the DOMPDF font directory
        "font_dir" => storage_path('fonts/'), // advised by dompdf (https://github.com/dompdf/dompdf/pull/782)

        // The location of the DOMPDF font cache directory
        "font_cache" => storage_path('fonts/'), // advised by dompdf (https://github.com/dompdf/dompdf/pull/782)

        // The location of a temporary directory.
        "temp_dir" => sys_get_temp_dir(),

        // dompdf's "chroot"; limits file access to this directory.
        "chroot" => realpath(base_path()),

        // Whether to enable font subsetting or not.
        "enable_font_subsetting" => false,

        // The PDF rendering backend to use
        "pdf_backend" => "CPDF", // PDFLib or CPDF (the bundled version)

        // PDFlib license key, used if PDFlib backend is enabled
        "pdftlib_license" => "",

        // The default media type to target when rendering, 'screen' or 'print'
        "default_media_type" => "screen",

        // The default paper size.
        "default_paper_size" => "a4",

        // The default paper orientation.
        "default_paper_orientation" => "portrait",

        // The default font family
        "default_font" => "serif", // Use web-safe fonts for hosting compatibility

        // Image DPI setting
        "dpi" => 96,

        // Enable inline PHP
        "enable_php" => false,

        // Enable inline Javascript
        "enable_javascript" => true,

        // Enable remote file access
        "enable_remote" => true,

        // A ratio applied to the fonts height
        "font_height_ratio" => 1.1,

        // Use the HTML5 Lib parser
        "enable_html5_parser" => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    | Here you can override or extend the config
    |
    */
    'options' => [
        // Font directory - optimized for hosting compartido
        'font_dir' => storage_path('fonts/'),
        
        // Font cache directory
        'font_cache' => storage_path('fonts/'),
        
        // Temporary directory
        'temp_dir' => sys_get_temp_dir(),
        
        // Security settings for hosting compartido
        'chroot' => realpath(base_path()),
        'allowed_protocols' => [
            'file://' => ['rules' => []],
            'http://' => ['rules' => []],
            'https://' => ['rules' => []],
        ],
        
        // Logging
        'log_output_file' => null,
        
        // Performance settings
        'enable_font_subsetting' => false,
        'pdf_backend' => 'CPDF',
        'default_media_type' => 'screen',
        'default_paper_size' => 'a4',
        'default_paper_orientation' => 'portrait',
        'default_font' => 'serif',
        'dpi' => 96,
        
        // Security settings
        'enable_php' => false,
        'enable_javascript' => true,
        'enable_remote' => true,
        
        // Layout settings
        'font_height_ratio' => 1.1,
        'enable_html5_parser' => true,
        
        // Additional settings for hosting compartido
        'isRemoteEnabled' => true,
        'isJavascriptEnabled' => true,
        'isHtml5ParserEnabled' => true,
        'isFontSubsettingEnabled' => false,
    ],

];