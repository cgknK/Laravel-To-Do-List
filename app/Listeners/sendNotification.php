<?php

namespace App\Listeners;

use App\Events\ReminderSetEvent;
use App\Mail\WelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class sendNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ReminderSetEvent $event): void
    {
        Log::info("start handle() in Listeners");
        $not = $event->note; // Etkinlikten not nesnesine erişin
        Log::info("$not");

        // Veriyi doğrulayın ve temizleyin (önerilir)
        if (!$not || !$not->user) {
            Log::error('ReminderSetEvent te gecersiz not veya kullanici verisi');
            return;
        }

        $isim = $not->user->name;
        $email = $not->user->email;
        $baslik_ = $not->title;
        $aciklama = $not->description;
        $hatirlatmaZamani = $not->remember_date;

        $baslik = "$baslik_ Alarmı: $hatirlatmaZamani";
        $icerik = "Merhaba Sayın $isim,\n\n"
            . "$baslik_ hatırlatmanız...\n"
            . "$aciklama\n"
            . "Bağlantı\n\n" // Nota veya ilgili başka bir eyleme giden bir bağlantı ekleyin
            . "Saygılarımızla,\nUygulamaAdı";

        // Tercih ettiğiniz yöntemle (örneğin, Mail facade) e-postayı gönderin
        try {
            Mail::to($email)->send(new WelcomeMail($baslik, $icerik));
            Log::info("$email adresine '$baslik_' notu için e-posta başarıyla gönderildi");
        } catch (\Exception $e) {
            Log::error("E-posta gönderilemedi: " . $e->getMessage());
        }
    }
}
