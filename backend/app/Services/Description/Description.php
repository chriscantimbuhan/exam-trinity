<?php

namespace App\Services\Description;

use App\Domain\Contact\Models\Contact;
use Illuminate\Support\Facades\Cache;

class Description
{
    /**
     * Get one record
     *
     * @param \App\Domain\Contact\Models\Contact $contact
     * @return string
     */
    public function getOne(Contact $contact)
    {
        if (is_null(Cache::get('description')) || is_null(Cache::get('description')->get($contact->getKey()))) {
            try {
                // Initialize cURL session
                $curl = curl_init();

                // Set cURL options
                curl_setopt_array($curl, array(
                    CURLOPT_URL => env('API_URL') . '?loremType=normal&type=paragraphs&number=' . collect([1, 2, 3])->random(),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HTTPHEADER => array(
                        'accept: */*',
                        'X-Api-Key:' . env('API_KEY')
                    ),
                ));

                // Execute cURL request
                $response = curl_exec($curl);

                // Check for errors
                if (curl_errno($curl)) {
                    $error_message = curl_error($curl);
                    // Handle curl error
                    echo "Error: $error_message";
                }

                // Close cURL session
                curl_close($curl);

                // Output the response

                $this->saveToCache($contact->getKey(), $response);

                return $response;
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }

    /**
     * Save Contact description to cache
     *
     * @param string $contactId
     * @param string $description
     * @return void
     */
    protected function saveToCache($contactId, $description)
    {
        $cachedData = collect(Cache::get('description') ?? []);

        $cachedData->put($contactId, $description);

        Cache::put('description', $cachedData);
    }
}
