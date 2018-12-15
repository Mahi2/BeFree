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

use \DateTime;
use \Exception;
use \InvalidArgumentException;
use \RuntimeException;
use \SplFileObject;
use \TypeError;

/**
 * Class LogWriterService
 * @package Befree\Services
 */
class LogWriterService
{
    /**
     * path to logs files
     * @var string
     */
    private $logFilesPath = LOGFILES_PATH;


    /**
     * the directory name format
     * @var string
     */
    private $logDirectoryNameFormat = "Y-F";


    /**
     * the log filename format
     * @var string
     */
    private $logFileNameFormat = "d";


    /**
     * the log file default extension
     * @var string
     */
    private $extension = ".log";


    /**
     * LogRegisterManager constructor.
     * @param string $logFilesPath
     */
    public function __construct(string $logFilesPath)
    {
        $this->logFile = $logFilesPath;
        if (!is_dir($this->logFilesPath)) {
            throw new InvalidArgumentException(sprintf("the logFile %s must be a directory", $logFilesPath));
        }
    }


    /**
     * whether we have the right access to the file
     * @param SplFileObject|\Directory|string $file
     * @return bool
     */
    private function isAccessible($file): bool
    {
        if ($file instanceof SplFileObject) {
            return $file->isReadable() && $file->isWritable();
        } elseif ($file) {
            return is_writable($file) && is_readable($file);
        } else {
            throw new InvalidArgumentException("the files should be an instance of \\SplFileObject or \\Directory");
        }
    }


    /**
     * generate or create a folder for the month logs
     * @return string
     */
    private function getSubDirectory(): string
    {
        $currentMoth = (new DateTime("now"))->format($this->logDirectoryNameFormat);
        $subDirectoryName = $this->logFilesPath . DIRECTORY_SEPARATOR . $currentMoth;
        if (is_dir($subDirectoryName)) {
            if ($this->isAccessible($subDirectoryName)) {
                return $subDirectoryName;
            } else {
                throw new RuntimeException(sprintf("Cannot open %s , access forbidden", $subDirectoryName));
            }
        } else {
            mkdir($subDirectoryName, 0777, true);
            return $subDirectoryName;
        }
    }


    /**
     * generate or create the log file of the day
     * @return SplFileObject
     */
    private function getLogFile(): SplFileObject
    {
        $currentDay = (new DateTime("now"))->format($this->logFileNameFormat);
        $logFileName = $this->getSubDirectory() . DIRECTORY_SEPARATOR . $currentDay . $this->extension;
        if (is_file($logFileName) && $this->isAccessible($logFileName)) {
            return new SplFileObject($logFileName, "a+");
        } else {
            $file = fopen($logFileName, "w+");
            fclose($file);
            $file = new SplFileObject($logFileName, "a+");
            $file = $this->putCursor($file);
            return $file;
        }
    }


    /**
     * create the heading of the log file
     * @return string
     */
    public function setFileHeader(): string
    {
        $author = "bernard ng <ngandubernard@gmail.com>";
        $generateAt = date("Y-m-d", time());
        $header = <<< EOF
#----------------------------------------------------------------
\t LOGFILE OF YOUR APPLICATION
\t GENERATED AT : {$generateAt}
\t DEVELOPED BY : {$author}
\t SEE : https://github.com/bernard-ng
-----------------------------------------------------------------
\n
EOF;
        return $header;
    }


    /**
     * put the cursor a the right position, so that we can write
     * or update the file
     * @param SplFileObject $file
     * @return SplFileObject|false
     */
    private function putCursor(SplFileObject $file)
    {
        if (!empty($file->fgets())) {
            return $file;
        } else {
            $file->fwrite($this->setFileHeader());
            return $file;
        }
    }


    /**
     * writing...
     * @param string|array|Exception $logs
     */
    public function write($logs): void
    {
        $file = $this->getLogFile();
        $errorTime = date("d-M-Y H:i:s");

        if (is_array($logs)) {
            $log = "[Error] ({$errorTime}) => \t";
            foreach ($logs as $item) {
                if (is_array($item)) {
                    break;
                } else {
                    $log .= " #### {$item}";
                }
            }
            $log .= "\n";
            $file->fwrite($log);
        } elseif ($logs instanceof Exception or $logs instanceof TypeError) {
            $log = "[" . get_class($logs) ."] ({$errorTime}) => \t";
            $log .= " #### {$logs->getMessage()}";
            $log .= " #### {$logs->getFile()}";
            $log .= " #### {$logs->getFile()}";
            $log .= "\n";
            $file->fwrite($log);
        } else {
            $file->fwrite($logs);
        }
    }

    /**
     * @param string $extension
     */
    public function setExtension(string $extension): void
    {
        $this->extension = $extension;
    }


    /**
     * @param string $logDirectoryNameFormat
     */
    public function setLogDirectoryNameFormat(string $logDirectoryNameFormat): void
    {
        $this->logDirectoryNameFormat = $logDirectoryNameFormat;
    }


    /**
     * @param string $logFileNameFormat
     */
    public function setLogFileNameFormat(string $logFileNameFormat): void
    {
        $this->logFileNameFormat = $logFileNameFormat;
    }
}
