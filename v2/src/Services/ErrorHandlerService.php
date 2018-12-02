<?php
namespace Befree\Services;

/**
 * Class ErrorHandlerService
 * @package Befree\Services
 */
class ErrorHandlerService
{
    /**
     * @var LogWriterService
     */
    private $log;


    /**
     * ErrorManager constructor.
     * @param string $logFilesPath
     */
    public function __construct(string $logFilesPath)
    {
        $this->log = new LogWriterService($logFilesPath);
    }


    /**
     * catch all uncatched error and exception
     */
    public function catch()
    {
        set_exception_handler(function ($e) {
            if (ENV  === 'production') {
                $this->log->write($e);
            } else {
                echo $this->header();
                print_r($e, true);
                echo "</pre>";
            }
        });

        set_error_handler(function (...$args) {
            if (ENV === 'production') {
                $this->log->write($args);
            } else {
                echo $this->header();
                print_r($args, true);
                echo "</pre>";
            }
        });
    }


    /**
     * put a nice HTML header :)
     * @return string
     */
    private function header(): string
    {
        $author = "bernard ng <nganduberanrd@gmail.com>";
        $generateAt = date("Y-m-d", time());
        $header = <<< EOF
<div>
    <h3 style='color: red'>!! BUG !!</h3>
    <span>GENERATED AT : <strong>{$generateAt}</strong></span>
    <span>DEVELOPED BY : <strong>{$author}</strong></span>
    <strong>SEE : <a href="https://github.com/bernard-ng">bernard-ng (github)</a></strong>
</div>
<br><hr>
<pre>
EOF;
        return $header;

    }
}