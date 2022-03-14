<?php
namespace App\WebHooks;

class FetchUsersWebHook {

    /**
     * Update the specified resource in storage.
     *
     * @return object
     */
    static public function fetchUser($number = 30)
    {
        $request = curl_init();
        curl_setopt($request, CURLOPT_URL, "https://randomuser.me/api?results=$number");
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);

        return json_decode(curl_exec($request));
    }
}