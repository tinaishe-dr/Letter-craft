<?php
return [
    'setup_code' => '', // Set a random code of 20+ characters for first setup.
    'data_dir' => __DIR__ . '/lettercraft-private',
    // Set true only after the deployed access-check.txt returns HTTP 403.
    'webroot_data_protection_verified' => false,
];
