<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todos los usuarios con email
        $users = User::whereNotNull('email')->get();
        
        if ($users->count() < 2) {
            // Si no hay suficientes usuarios con email, crear usuarios de prueba
            $admin = User::firstOrCreate(
                ['email' => 'admin@zonacinco.org.ve'],
                [
                    'name' => 'Administrador del Sistema',
                    'password' => \Illuminate\Support\Facades\Hash::make('password'),
                    'national_id' => null,
                    'degree' => 'Maestro',
                ]
            );
            
            $user = User::firstOrCreate(
                ['email' => 'usuario@zonacinco.org.ve'],
                [
                    'name' => 'Usuario de Prueba',
                    'password' => \Illuminate\Support\Facades\Hash::make('password'),
                    'national_id' => null,
                    'degree' => 'Maestro',
                ]
            );
            
            $users = collect([$admin, $user]);
        }

        // Crear algunos mensajes de prueba entre usuarios
        $messages = [
            [
                'sender_name' => $users->first()->name,
                'sender_email' => $users->first()->email,
                'subject' => 'Bienvenida al sistema',
                'content' => "Estimado usuario,\n\nTe damos la más cordial bienvenida al sistema de gestión de la Gran Zona 5. Esperamos que esta herramienta te sea de utilidad en tu labor dentro de la organización.\n\nAtentamente,\nJunta Directiva",
                'recipient_id' => $users->last()->id,
                'status' => 'unread',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sender_name' => $users->last()->name,
                'sender_email' => $users->last()->email,
                'subject' => 'Recordatorio de reunión',
                'content' => "Querido compañero,\n\nSolo para recordarte que la próxima reunión de la logia está programada para el próximo viernes a las 7:00 PM en el salón principal.\n\nEsperamos contar con tu presencia.\n\nSaludos fraternales.",
                'recipient_id' => $users->first()->id,
                'status' => 'read',
                'read_at' => now()->subDay(),
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'sender_name' => $users->first()->name,
                'sender_email' => $users->first()->email,
                'subject' => 'Invitación especial',
                'content' => "Estimado hermano,\n\nTe invitamos cordialmente a participar en el taller de formación masónica que se llevará a cabo el próximo mes. Será una excelente oportunidad para profundizar en nuestro conocimiento y compartir experiencias.\n\nMás detalles serán enviados próximamente.\n\nFraternidad eterna.",
                'recipient_id' => $users->last()->id,
                'status' => 'unread',
                'created_at' => now()->subHour(),
                'updated_at' => now()->subHour(),
            ],
        ];

        // Crear algunos mensajes de contacto desde el formulario público
        $contactMessages = [
            [
                'sender_name' => 'Ana Torres',
                'sender_email' => 'ana.torres@email.com',
                'subject' => 'Consulta sobre horarios',
                'content' => "Estimados Hermanos,\n\nMi nombre es Ana Torres y estoy interesada en conocer más sobre la masonería. Me gustaría saber si tienen horarios de atención al público o si es posible concertar una cita para conversar y aclarar algunas dudas que tengo.\n\nAgradezco de antemano su tiempo y su guía.\n\nSaludos cordiales,\nAna Torres",
                'recipient_id' => $users->first()->id,
                'status' => 'unread',
                'created_at' => now()->subHours(2),
                'updated_at' => now()->subHours(2),
            ],
            [
                'sender_name' => 'Marcos Rivas',
                'sender_email' => 'marcos.rivas@email.com',
                'subject' => 'Información de ingreso',
                'content' => "Buenos días,\n\nSoy Marcos Rivas y quisiera obtener información sobre cómo puedo ingresar a la orden. Tengo 35 años, soy profesor y me interesa profundamente la filosofía y los valores que promueven.\n\n¿Podrían proporcionarme información sobre los requisitos y el proceso de ingreso?\n\nGracias por su atención.\n\nAtte.\nMarcos Rivas",
                'recipient_id' => $users->last()->id,
                'status' => 'unread',
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'sender_name' => 'Carlos Mendoza',
                'sender_email' => 'carlos.mendoza@email.com',
                'subject' => 'Agradecimiento',
                'content' => "Estimados Hermanos,\n\nQuiero expresarles mi más sincero agradecimiento por la charla que tuvimos la semana pasada. Me resultó muy enriquecedora y he decidido iniciar el proceso para solicitar mi ingreso.\n\n¿Podrían indicarme cuáles son los siguientes pasos?\n\nQuedo atento a su respuesta.\n\nCordialmente,\nCarlos Mendoza",
                'recipient_id' => $users->first()->id,
                'status' => 'read',
                'read_at' => now()->subDays(3),
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(3),
            ],
        ];

        // Combinar ambos tipos de mensajes
        $allMessages = array_merge($messages, $contactMessages);

        foreach ($allMessages as $messageData) {
            Message::create($messageData);
        }

        echo "Se han creado " . count($allMessages) . " mensajes de prueba (" . count($messages) . " internos y " . count($contactMessages) . " de contacto).\n";
    }
}
