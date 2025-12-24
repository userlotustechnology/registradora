<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Http\Middleware\ContentSecurityPolicy;

class TestCSP extends Command
{
    protected $signature = 'csp:test';
    protected $description = 'Test Content Security Policy configuration';

    public function handle()
    {
        $this->info('Testing CSP Configuration...');
        
        // Create a mock request
        $request = Request::create('/dashboard', 'GET');
        
        // Create middleware instance
        $middleware = new ContentSecurityPolicy();
        
        // Create a simple HTML response for testing
        $response = response('<html><head><title>Test</title></head><body>Test</body></html>');
        $response->headers->set('Content-Type', 'text/html');
        
        // Apply middleware
        $processedResponse = $middleware->handle($request, function($req) use ($response) {
            return $response;
        });
        
        // Check CSP header
        $cspHeader = $processedResponse->headers->get('Content-Security-Policy');
        
        if ($cspHeader) {
            $this->info('✅ CSP Header found:');
            $this->line($cspHeader);
            
            // Parse CSP directives
            $directives = explode(';', $cspHeader);
            foreach ($directives as $directive) {
                $directive = trim($directive);
                if ($directive) {
                    $this->line("  - {$directive}");
                }
            }
        } else {
            $this->error('❌ No CSP header found');
        }
        
        // Check nonce header
        $nonceHeader = $processedResponse->headers->get('X-Nonce');
        if ($nonceHeader) {
            $this->info("✅ Nonce generated: {$nonceHeader}");
        }
        
        $this->info('CSP test completed.');
    }
}
