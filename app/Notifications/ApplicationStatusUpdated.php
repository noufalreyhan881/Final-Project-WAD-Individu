<?php

namespace App\Notifications;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationStatusUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    protected JobApplication $application;

    /**
     * Create a new notification instance.
     */
    public function __construct(JobApplication $application)
    {
        $this->application = $application;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $jobTitle = $this->application->jobVacancy->title;
        $status = ucfirst($this->application->status); // 'Pending', 'Reviewed', 'Rejected', 'Hired'

        return (new MailMessage)
                    ->subject("Update Status Lamaran: {$jobTitle}")
                    ->greeting("Halo, {$notifiable->name}!")
                    ->line("Ada pembaruan status untuk lamaran Anda pada posisi **{$jobTitle}**.")
                    ->line("Status lamaran Anda saat ini adalah: **{$status}**.")
                    ->action('Lihat Lamaran Saya', route('applications.index'))
                    ->line('Terima kasih telah menggunakan aplikasi kami!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}