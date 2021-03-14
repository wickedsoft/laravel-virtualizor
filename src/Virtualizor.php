<?php

namespace wickedsoft\Virtualizor;

class Virtualizor
{
    /** @var \Illuminate\Foundation\Application */
    protected $app;

    /** @var \wickedsoft\Virtualizor\Client */
    protected $client;

    /** @var array */
    protected $sites = [];

    /**
     * NetBox constructor.
     * @param $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array([$this->client, $method], $args);
    }

    /**
     * @param null|string $name
     * @return \wickedsoft\Virtualizor\Client
     */
    public function site($name = null)
    {
        $name = $name ?: $this->getDefaultSite();

        return $this->sites[$name] = $this->get($name);
    }

    /**
     * @return string
     */
    public function getDefaultSite()
    {
        return $this->app['config']['virtualizor.default'];
    }

    /**
     * @param string $name
     * @return \wickedsoft\Virtualizor\Client
     */
    protected function get($name)
    {
        return $this->sites[$name] ?? $this->resolve($name);
    }

    /**
     * @param string $name
     * @return \wickedsoft\Virtualizor\Client
     */
    protected function resolve($name)
    {
        $config = $this->getConfig($name);

        $this->client = new \wickedsoft\Virtualizor\Client();
        $this->client->setOptions([
            'base_url' => $config['url'],
            'key' => $config['key']
        ]);

        return $this->client;
    }

    /**
     * @param string $name
     * @return array
     */
    protected function getConfig($name)
    {
        return $this->app['config']["virtualizor.sites.{$name}"];
    }
}
