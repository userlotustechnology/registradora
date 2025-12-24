<?php

return [
    'csp' => [
        'default-src' => [
            "'self'",
            'http:',
            'https:',
            'data:',
            'blob:',
            "'unsafe-inline'",
            "'unsafe-eval'"
        ],
        'script-src' => [
            "'self'",
            "'unsafe-inline'",
            "'unsafe-eval'",
            'https://fonts.googleapis.com',
            'https://cdn.jsdelivr.net',
            'https://cdnjs.cloudflare.com',
            'http:',
            'https:',
            'data:',
            'blob:'
        ],
        'style-src' => [
            "'self'",
            "'unsafe-inline'",
            'https://fonts.googleapis.com'
        ],
        'font-src' => [
            "'self'",
            'https://fonts.gstatic.com'
        ],
        'img-src' => [
            "'self'",
            'data:',
            'https:',
            'blob:'
        ],
        'connect-src' => ["'self'"],
        'frame-src' => ["'none'"],
        'object-src' => ["'none'"],
        'base-uri' => ["'self'"],
        'form-action' => ["'self'"]
    ]
];
