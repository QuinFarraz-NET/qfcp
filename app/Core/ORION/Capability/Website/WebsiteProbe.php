<?php

namespace App\Core\ORION\Capability\Website;

use App\Core\ORION\Capability\Website\DTO\WebsiteStatus;

class WebsiteProbe
{
    /**
     * Website yang dipantau.
     *
     * Nanti akan dipindahkan ke config.
     */
    protected string $url = 'https://panel.quinfarraz.net';

    public function collect(): WebsiteStatus
    {
        $start = microtime(true);

        $ch = curl_init($this->url);

        curl_setopt_array($ch, [

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_NOBODY => true,

            CURLOPT_TIMEOUT => 5,

            CURLOPT_FOLLOWLOCATION => true,

        ]);

        curl_exec($ch);

        $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        $latency = round((microtime(true) - $start) * 1000, 2);

        return new WebsiteStatus(

            url: $this->url,

            online: $status >= 200 && $status < 400,

            statusCode: $status,

            latency: $latency,

            checkedAt: now()->format('Y-m-d H:i:s'),

        );
    }
}
