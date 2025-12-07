<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Mail;

class MailService
{

    public function __construct() {}

    /**
     * @throws Exception
     */
    public function sendEmail($type, $data, $attachments = []): void
    {
        $template = $this->getTemplate($type);

        // Add settings to the data array
        $data['settings'] = [
            'name' => app('settings')->find('name'),
            'logo' => app('settings')->find('logo'),
        ];

        Mail::send($template, $data, function ($message) use ($data, $attachments) {
            $message->to($data['email'])
                ->subject($data['subject']);

            foreach ($attachments as $attachment) {
                $message->attach($attachment);
            }
        });
    }

    /**
     * @throws Exception
     */
    protected function getTemplate($type): string
    {
        return match ($type) {
            'welcome' => 'emails.welcome',
            'reset_password' => 'emails.reset_password',
            'general' => 'emails.general',
             'contact' => 'emails.contact',
            default => throw new Exception('Invalid email type'),
        };
    }
}
