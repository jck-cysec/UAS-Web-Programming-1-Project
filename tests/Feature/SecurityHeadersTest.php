<?php

namespace Tests\Feature;

use Tests\TestCase;

class SecurityHeadersTest extends TestCase
{
    /** @test */
    public function security_headers_are_present_on_homepage()
    {
        $response = $this->get('/');

        $response->assertHeader('X-Frame-Options');
        $response->assertHeader('X-Content-Type-Options');
        $response->assertHeader('Referrer-Policy');
        $response->assertHeader('X-XSS-Protection');
    }

    /** @test */
    public function csp_report_only_header_is_present_when_enabled()
    {
        config(['app.env' => 'testing']);
        putenv('CSP_REPORT_ONLY=true');

        $response = $this->get('/');
        $this->assertTrue(
            $response->headers->has('Content-Security-Policy-Report-Only'),
            'CSP report-only header not present when CSP_REPORT_ONLY is true'
        );
    }
}
