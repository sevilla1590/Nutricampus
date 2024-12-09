<?php  

namespace App\Mail;  

use Illuminate\Bus\Queueable;  
use Illuminate\Mail\Mailable;  
use Illuminate\Queue\SerializesModels;  

class ConfirmacionPedido extends Mailable  
{  
    use Queueable, SerializesModels;  

    public $pedido;  

    /**  
     * Crear una nueva instancia del mensaje.  
     */  
    public function __construct($pedido)  
    {  
        $this->pedido = $pedido;  
    }  

    /**  
     * Construir el mensaje.  
     */  
    public function build()  
    {  
        return $this->subject('Confirmación de tu pedido en Nutricampus')  
                    ->view('emails.confirmacion_pedido');  
    }  
}  