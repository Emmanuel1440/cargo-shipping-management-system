<?php

namespace App\Notifications;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ShipmentArrivalNotification extends Notification
{
    protected $shipment;

    public function __construct($shipment)
    {
        $this->shipment = $shipment;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Shipment arriving today')
            ->line("Shipment #{$this->shipment->id} is scheduled to arrive today.")
            ->action('View Shipment', url("/shipments/{$this->shipment->id}"));
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Shipment #{$this->shipment->id} arriving today.",
            'shipment_id' => $this->shipment->id
        ];
    }
}
