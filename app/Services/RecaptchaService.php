<?php

namespace App\Services;

use ReCaptcha\ReCaptcha;

class RecaptchaService
{
    private $recaptcha;
    private $siteKey;

    public function __construct()
    {
        $this->siteKey = config('services.recaptcha.site_key');
        $secretKey = config('services.recaptcha.secret_key');
        
        if ($secretKey) {
            $this->recaptcha = new ReCaptcha($secretKey);
        }
    }

    public function getSiteKey(): ?string
    {
        return $this->siteKey;
    }

    public function verify(string $response, string $remoteIp = null): bool
    {
        if (!$this->recaptcha) {
            return true; // Allow if not configured (for development)
        }

        $result = $this->recaptcha->verify($response, $remoteIp);
        
        return $result->isSuccess() && $result->getScore() >= 0.5;
    }

    public function renderScript(): string
    {
        if (!$this->siteKey) {
            return '';
        }

        return sprintf(
            '<script src="https://www.google.com/recaptcha/api.js?render=%s"></script>',
            $this->siteKey
        );
    }

    public function renderField(): string
    {
        if (!$this->siteKey) {
            return '<input type="hidden" name="g-recaptcha-response" value="test">';
        }

        return sprintf(
            '<input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
            <script>
                grecaptcha.ready(function() {
                    grecaptcha.execute("%s", {action: "contact"}).then(function(token) {
                        document.getElementById("g-recaptcha-response").value = token;
                    });
                });
            </script>',
            $this->siteKey
        );
    }
}