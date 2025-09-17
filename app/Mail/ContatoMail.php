<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;   // <- IMPORTANTE (Laravel)
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContatoMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $dados;

    public function __construct(array $dados)
    {
        $this->dados = $dados;
    }

    // Destinatários/assunto/reply-to aqui:
    public function envelope(): Envelope
    {
        return new Envelope(
              subject: 'Contato via site - ' . ($this->dados['assunto'] ?? 'Contato via Site'),
        replyTo: [
            new Address($this->dados['email'], $this->dados['nome'] ?? null),
        ],
        );
    }

    // Conteúdo do e-mail (markdown/blade e variáveis)
    public function content(): Content
    {
        return new Content(
            markdown: 'views.emails.contato',
            with: ['dados' => $this->dados],
        );
    }

    // Se for anexos, defina aqui (opcional)
    public function attachments(): array
    {
        return [];
    }
}
