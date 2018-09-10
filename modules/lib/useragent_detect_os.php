<?php
  class useragent_detect_os{
    private static $_windows_version = array(
      "10.0" => array("10", "6"),
        "6.4" => array("10", "6"), // Windows 10 before 10240
        "6.3" => array("8.1", "5"),
        "6.2" => array("8", "5"),
        "6.1" => array("7", "4"),
        "6.0" => array("Vista", "3"),
        "5.2" => array("Server 2003", "2"),
        "5.1" => array("XP", "2"),
        "5.01" => array("2000 Service Pack 1", "1"),
        "5.0" => array("2000", "1"),
        "4.0" => array("NT 4.0", "1"),
        "3.51" => array("NT 3.11", "1"),
    );

    public static function analyze($useragent) {

        $result = array();

        // Check if is AMD64
        $x64 = false;
        if (preg_match('/x86_64|Win64; x64|WOW64|IRIX64/i', $useragent)) {
            $x64 = true;
        }
  }
