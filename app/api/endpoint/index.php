<?php

echo parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
echo "hello";