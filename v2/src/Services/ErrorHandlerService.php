<?php
/**
 *   This file is part of the Befree.
 *
 *   @copyright   Henrique Mukanda <mahi2hm@outlook.fr>
 *   @copyright   Bernard ngandu <ngandubernard@gmail.com>
 *   @link    https://github.com/Mahi2/BeFree
 *   @link    https://github.com/bernard-ng/Befree
 *   @license   http://framework.zend.com/license/new-bsd New BSD License
 *
 *   For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 */

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
    public function __construct(string $logFilesPath = LOGFILES_PATH)
    {
        $this->log = new LogWriterService($logFilesPath);
    }


    /**
     * @param \Exception | \Error $e
     */
    public function throwException($e): void
    {
        if (ENV  === 'production') {
            $this->log->write($e);
        } else {
            echo $this->header();
            echo $this->body(var_dump($e), $e);
            exit();
        }
    }


    /**
     * @param \Exception | \Error $e
     */
    public static function throw($e): void
    {
        $service = new self();
        $service->throwException($e);
    }


    /**
     * @param array $args
     */
    private function throwError(array $args): void
    {
        if (ENV === 'production') {
            $this->log->write($args);
        } else {
            echo $this->header();
            echo $this->body(print_r($args, true));
            exit();
        }
    }


    /**
     * catch all uncatched error and exception
     */
    public function catch()
    {
        set_exception_handler(function ($e) {
            $this->throwException($e);
        });

        set_error_handler(function (...$args) {
            $this->throwError($args);
        });
    }


    /**
     * put a nice HTML header :)
     * @return string
     */
    private function header(): string
    {
        $generateAt = date("D, d M Y H:i", time());
        $header = <<< EOF
<style>
*{ box-sizing: border-box;}
body,html{margin:0 0;background:#f8f9fa;font-family:sans-serif;}
a{font-color:#007bff}
a{color:#007bff;text-decoration:none;background-color:transparent;}
a:hover{color:#0056b3;text-decoration:none}
</style>
<div style="background: #343a40; color: #ccc; padding: 25px; border-bottom: 5px solid rgba(255,255,255,0.4);">
    <span style='color: #007bff; font-size: 2.5em; font-weight: bold;'>Befree Oups !</span><br>
    <span>Generated at : <strong>{$generateAt}</strong></span><br>
    <span>Developed  by : <a href="https://github.com/bernard-ng">bernard-ng</a></span><br>
</div>
EOF;
        return $header;
    }


    /**
     * write the logs
     * @param string $content
     * @param \Exception|\Error|null $e $
     * @return string
     * @internal param null $e
     */
    private function body(string $content, $e = null): string
    {
        $title = is_null($e)? '' : $e->getMessage();
        $class = get_class($e) ?? '';
        return <<< EOF
<style>
pre{display: block;color: #212529}
pre code{font-size: inherit;color: inherit;word-break: normal}
hr{margin-top: 1rem;margin-bottom: 1rem;border: 0;border-top: 1px solid rgba(0,0,0,.1)}
.jumbotron {padding: 2rem 1rem;margin-bottom: 2rem;background-color: #e9ecef;border-radius: .3rem}
</style>
<div style="padding: 25px;">
<h2><strong style="color: red">$class</strong> : $title</h2><hr>
<div class="jumbotron"><pre>$content</pre></div>
</div>
EOF;
    }
}
