<?php

namespace Shopceed\FormBuilder\Jobs\Traits;

trait HeaderLinkApiPagination
{
    /**
     * Checks the header response from API if has a next page link
     *
     * @param  \Illuminate\Http\Client\Response  $response
     * @return string|null
     */
    public function getNextPageUrl(\Illuminate\Http\Client\Response $response): ?string
    {
        $link = $response->header('Link');

        if (empty($link)) {
            return null;
        }

        $nextPageUrl = preg_replace('/<(.*)>; rel="next"/', '$1', $link, -1, $count);
        if (empty($count)) {
            return null;
        }

        return $nextPageUrl;
    }
}
