<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Compra;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\Log;

class VentaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $compra;

    /**
     * Create a new message instance.
     */
    public function __construct($compraId)
    {
       $this->compra = Compra::find($compraId);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Venta Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.venta',
            with: [
                'event' => $this->compra->session->event,
                'session' => $this->compra->session,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        Log::info('pdf' . $this->compra->pdfTickets);
        return [
            Attachment::fromPath(storage_path('app/pdfs/') . $this->compra->pdfTickets)
                ->as('tickets.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
