<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class SportActivityControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test the return of all sport activities
     *
     * @return void
     */
    public function testReturnAllSportActivities(): void
    {
        $response = $this->call('GET', '/sports/activies');

        $this->assertEquals(200, $response->status());
    }

    /**
     * Test the validation for create a new sport activity
     *
     * @return void
     */
    public function testCreateSportActivityValidation(): void
    {
        $response = $this->call('POST', '/sports/activity', []);

        $this->assertEquals(400, $response->status());
    }
}
