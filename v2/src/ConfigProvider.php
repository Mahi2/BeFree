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

namespace Befree;

use Befree\Helpers\Collection;

class ConfigProvider
{

    /**
     * @var Collection
     */
    private $config;


    /**
     * ConfigProvider constructor.
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        if (file_exists($filename)) {
            $this->config = new Collection(require($filename));
            return $this;
        } else {
            throw new \InvalidArgumentException(sprintf("the %s file doesn't exists", $filename));
        }
    }


    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return $this->config->has($key);
    }


    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->config->get($key);
    }
}
