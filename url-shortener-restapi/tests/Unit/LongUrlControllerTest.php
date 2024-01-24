<?php

namespace Tests\Unit;

use App\Models\LongUrl;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase as TestCases;

class LongUrlControllerTest extends TestCases
{
    use DatabaseTransactions;

    public function findAllTest()
    {
        // Create test data
        LongUrl::factory()->count(3)->create();

        // Make a request to the findAll endpoint
        $response = $this->getJson(route('long-urls.findAll'));

        // Assert the response status code
        $response->assertStatus(Response::HTTP_OK);
    }

    public function testFindByIdWithValidId()
    {
        // Create a test LongUrl
        $longUrl = LongUrl::factory()->create();

        // Make a request to the findById endpoint with a valid ID
        $response = $this->getJson(route('long-urls.findById', ['id' => $longUrl->id]));

        // Assert the response status code
        $response->assertStatus(Response::HTTP_OK);
    }

    public function testFindByIdWithInvalidId()
    {
        // Make a request to the findById endpoint with an invalid ID
        $response = $this->getJson(route('long-urls.findById', ['id' => 999]));

        // Assert the response status code for not found
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testSave()
    {
        // Create a valid request payload
        $requestData = ['content' => 'https://example.com'];

        // Make a request to the save endpoint with the valid payload
        $response = $this->postJson(route('long-urls.save'), $requestData);

        // Assert the response status code
        $response->assertStatus(Response::HTTP_OK);
    }
}
