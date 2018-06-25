<?php

    // Include the DirectoryLister class
    require_once('resources\DirectoryLister.php');

    // Initialize the DirectoryLister object
    $lister = new DirectoryLister();
    $basedir= $_GET['path'];
    //substr_replace($basedir, "", -1);
    echo $basedir;
    echo getcwd();

    // Restrict access to current directory
    ini_set('open_basedir', getcwd().'\\'.$basedir);

    // Return file hash
    if (isset($_GET['hash'])) {

        // Get file hash array and JSON encode it
        $hashes = $lister->getFileHash($_GET['hash']);
        $data   = json_encode($hashes);

        // Return the data
        die($data);

    }

    if (isset($_GET['zip'])) {

        $dirArray = $lister->zipDirectory($_GET['zip']);

    } else {

        // Initialize the directory array
        if (isset($_GET['dir'])) {
            $dirArray = $lister->listDirectory($_GET['dir']);
        } else {
            $dirArray = $lister->listDirectory('.');
        }

        // Define theme path
        if (!defined('THEMEPATH')) {
            define('THEMEPATH', $lister->getThemePath());
        }

        // Set path to theme index
        echo $lister->getThemePath(true);
        $themeIndex = $lister->getThemePath(true) . '\navigatorindex.php';

        // Initialize the theme
        if (file_exists($themeIndex)) {
            include($themeIndex);
        } else {
            die('ERROR: Failed to initialize theme');
        }

}