<?php

use Mckenziearts\Notify\LaravelNotify;

if (! function_exists('notify')) {
    function notify(string $message = null, string $title = null): LaravelNotify
    {
        $notify = app('notify');

        if (! is_null($message)) {
            return $notify->success($message, $title);
        }

        return $notify;
    }
}

if (! function_exists('connectify')) {
    function connectify(string $type, string $title, string $message): LaravelNotify
    {
        return app('notify')->connect($type, $title, $message);
    }
}

//Função para formatar CPF e mostra-lo no blade
if (! function_exists('formata_cpf')) {
    function formata_cpf($cpf)
    {
        $bloco_1 = substr($cpf, 0, 3);
        $bloco_2 = substr($cpf, 3, 3);
        $bloco_3 = substr($cpf, 6, 3);
        $dig_verificador = substr($cpf, -2);
        $cpf_formatado = $bloco_1.".".$bloco_2.".".$bloco_3."-".$dig_verificador;
        return $cpf_formatado;
    }
}

if (! function_exists('drakify')) {
    function drakify(string $type): LaravelNotify
    {
        return app('notify')->drake($type);
    }
}

if (! function_exists('smilify')) {
    function smilify(string $type, string $message): LaravelNotify
    {
        return app('notify')->smiley($type, $message);
    }
}
if (! function_exists('emotify')) {
    function emotify(string $type, string $message): LaravelNotify
    {
        return app('notify')->emotify($type, $message);
    }
}

if (! function_exists('notifyJs')) {
    /**
     * @return string
     */
    function notifyJs(): string
    {
        return '<script type="text/javascript" src="'.asset('vendor/mckenziearts/laravel-notify/js/notify.js').'"></script>';
    }
}

if (! function_exists('notifyCss')) {
    /**
     * @return string
     */
    function notifyCss(): string
    {
        return '<link rel="stylesheet" type="text/css" href="'.asset('vendor/mckenziearts/laravel-notify/css/notify.css').'"/>';
    }
}
