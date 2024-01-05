<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $yape = [
            'Número de teléfono: +51 987477559',
            'Titular: Xavier Ale Ninaja',
            '1.- Ingresa a tu app móvil, busca y elige nuestro contacto',
            '2.- Seleccionar pagar',
            '3. Ingresa el monto, dale "Enviar Pago" y ¡listo!',
            'Obligatorio : Al momento de hacer el pago en referencias indicar su numero de whatsapp.',
        ];

        $plin = [
            'Número de teléfono: +51 987477559',
            'Titular: Xavier Ale Ninaja',
            '1.- Ingresa a tu app móvil, busca y elige nuestro contacto',
            '2.- Seleccionar pagar',
            '3. Ingresa el monto, dale "Enviar Pago" y ¡listo!',
            'Obligatorio : Al momento de hacer el pago en referencias indicar su numero de whatsapp.',
        ];

        $transferencia_bcp = [
            'Titular: Xavier Ale Ninaja',
            'Ahorros Soles N° de cuenta: 191 98967732003',
            '(Transferencias Internet sin cargo)',
            '(Pagos en ventanilla agregar 9 soles)',
            'Email : ventas@area51.com',
        ];

        $transferencia_interbank = [
            'Titular: Xavier Ale Ninaja',
            'Ahorros Soles N° de cuenta: 1513181905487',
            '(Transferencias Internet sin cargo)',
            '(Pagos en ventanilla agregar 9 soles)',
            'Email : ventas@area51.com',
        ];

        $efectivo_bcp = [
            'Titular: Xavier Ale Ninaja',
            'Ahorros Soles N° de cuenta: 191 98967732003',
            '(Pago dentro de Tacna no tiene cargo)',
            '(Pago Fuera de Tacna agregar 9 soles)',
        ];

        $efectivo_interbank = [
            'Titular: Xavier Ale Ninaja',
            'Ahorros Soles N° de cuenta: 1513181905487',
            '(Pago dentro de Tacna no tiene cargo)',
            '(Pago Fuera de Tacna no tiene cargo)',
        ];


        $payments = [
            [
                'payment_method_id' => 1,
                'name' => 'Yape',
                'description' => json_encode($yape, JSON_UNESCAPED_UNICODE),
                'image_logo' => 'payment_methods/yape.png',
                'image_qr' => 'payment_methods/yape_qr.jpg',
            ],
            [
                'payment_method_id' => 1,
                'name' => 'Plin',
                'description' => json_encode($plin, JSON_UNESCAPED_UNICODE),
                'image_logo' => 'payment_methods/plin.png',
                'image_qr' => 'payment_methods/plin_qr.png',
            ],
            [
                'payment_method_id' => 1,
                'name' => 'Transferencia BCP',
                'description' => json_encode($transferencia_bcp, JSON_UNESCAPED_UNICODE),
                'image_logo' => 'payment_methods/transferencia_bcp.png',
            ],
            [
                'payment_method_id' => 1,
                'name' => 'Transferencia Interbank',
                'description' => json_encode($transferencia_interbank, JSON_UNESCAPED_UNICODE),
                'image_logo' => 'payment_methods/transferencia_interbank.png',
            ],
            [
                'payment_method_id' => 1,
                'name' => 'Efectivo BCP',
                'description' => json_encode($efectivo_bcp, JSON_UNESCAPED_UNICODE),
                'image_logo' => 'payment_methods/efectivo_bcp.png',
            ],
            [
                'payment_method_id' => 1,
                'name' => 'Efectivo Interbank',
                'description' => json_encode($efectivo_interbank, JSON_UNESCAPED_UNICODE),
                'image_logo' => 'payment_methods/efectivo_interbank.png',
            ],

        ];

        foreach ($payments as $payment){
            Payment::create($payment);
        }
    }
}
