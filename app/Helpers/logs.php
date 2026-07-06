<?php

if (! function_exists('debug')) {
    /**
     * Write some information to the log.
     *
     * @param  string  $message
     * @param  array  $context
     * @return void
     */
    function debug($message, $context = [])
    {
        app('log')->debug('🐛 ' . $message, $context);
    }
}

if (! function_exists('notice')) {
    /**
     * Write some information to the log.
     *
     * @param  string  $message
     * @param  array  $context
     * @return void
     */
    function notice($message, $context = [])
    {
        app('log')->notice('💡 ' . $message, $context);
    }
}

if (! function_exists('warning')) {
    /**
     * Write some information to the log.
     *
     * @param  string  $message
     * @param  array  $context
     * @return void
     */
    function warning($message, $context = [])
    {
        app('log')->warning('⚠️ ' . $message, $context);
    }
}

if (! function_exists('error')) {
    /**
     * Write some information to the log.
     *
     * @param  string  $message
     * @param  array  $context
     * @return void
     */
    function error($message, $context = [])
    {
        app('log')->error('❗️ ' . $message, $context);
    }
}

if (! function_exists('critical')) {
    /**
     * Write some information to the log.
     *
     * @param  string  $message
     * @param  array  $context
     * @return void
     */
    function critical($message, $context = [])
    {
        app('log')->critical('‼️ ' . $message, $context);
    }
}

if (! function_exists('alert')) {
    /**
     * Write some information to the log.
     *
     * @param  string  $message
     * @param  array  $context
     * @return void
     */
    function alert($message, $context = [])
    {
        app('log')->alert('🚨 ' . $message, $context);
    }
}

if (! function_exists('emergency')) {
    /**
     * Write some information to the log.
     *
     * @param  string  $message
     * @param  array  $context
     * @return void
     */
    function emergency($message, $context = [])
    {
        app('log')->emergency('💀 ' . $message, $context);
    }
}
