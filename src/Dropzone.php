<?php

namespace Ajaz\widget;

/**
 * Php Dropzone widget
 * Dropzone.js with PHP for Upload File
 * 
 * @author Ajaz Alam <ajazaalam@gmail.com>
 */

class Dropzone
{
    /**
     * @var array An array of options that are supported by Dropzone
     */

    public $options = [];

    /**
     * @var array An array of client events that are supported by Dropzone
     */

    public $clientEvents = [];

    //Default Values

    /**
     * @var string default id for container
     */

    public $id = 'myDropzone';

    /**
     * @var string your upload action path or url
     */

    public $uploadUrl;

    /**
     * @var string dropzoneContainer
     */

    public $dropzoneContainer = 'myDropzone';

    /**
     * @var string dropzoneContainer
     */

    public $previewsContainer = 'previews';

    /**
     * @var bool 
     */

    public $autoDiscover = false;

    /**
     * Initializes the constructor
     * @param array $config
     * @throw InvalidConfigException
     */

    public function __construct(array $config = [])
    {
        $this->init($config);
    }

    /**
     * Initializes the widget
     * @param array $config
     * @throw InvalidConfigException
     */

    public function init($config)
    {
        if(!isset($config['uploadUrl']))
        {
            throw new \InvalidArgumentException("uploadUrl key is required");
        }
        $this->uploadUrl = $config['uploadUrl'];
        if(isset($config['id']))
        {
            $this->id = $config['id'];
        }
        if(isset($config['dropzoneContainer']))
        {
            $this->dropzoneContainer = $config['dropzoneContainer'];
        }
        if(isset($config['previewsContainer']))
        {
            $this->previewsContainer = $config['previewsContainer'];
        }
        if(isset($config['autoDiscover']))
        {
            $this->autoDiscover = $config['autoDiscover'];
        }
        if(isset($config['clientEvents']))
        {
            $this->clientEvents = $config['clientEvents'];
        }
        if(isset($config['options']))
        {
            $this->options = $config['options'];
        }
        if(!isset($config['options']['clickable']))
        {
            $this->options['clickable'] = true; // Define the element that should be used as click trigger to select files.
        }
        if(!isset($config['options']['previewsContainer']))
        {
            $this->options['previewsContainer'] = '#' . $this->previewsContainer;
        }
        if(!isset($config['options']['url']))
        {
            $this->options['url'] = $this->uploadUrl;
        }

        $this->autoDiscover = $this->autoDiscover===false?'false':'true';
    }

    /**
     * render dropzone
     * @return string
     */

    private function renderDropzone()
    {
        return '<div id="'.$this->previewsContainer.'" class="dropzone-previews"></div>';
    }

    /**
     * render dropzone
     * @return string
     */

    public function run()
    {
        echo '<div id="'.$this->dropzoneContainer.'" class="dropzone">'.$this->renderDropzone().'</div>';
        $this->registerJs();
    }

    /**
     * Registers the needed javascript code
     */

    private function registerJs()
    {
        $js = '<script type="text/javascript">';
        $js .= 'Dropzone.autoDiscover = ' . $this->autoDiscover . '; var ' . $this->id . ' = new Dropzone("div#' . $this->dropzoneContainer . '", ' . json_encode($this->options) . ');';
        //register client events
        if(!empty($this->clientEvents))
        {
            foreach($this->clientEvents as $event => $handler)
            {
                $js .= "$this->id.on('$event', $handler);";
            }
        }
        $js .= '</script>';
        echo $js;
    }
}