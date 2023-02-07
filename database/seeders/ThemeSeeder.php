<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Parish;
use App\Models\Theme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Theme::query()->truncate();

        // $grades = Grade::all();
        $parishes = Parish::all();

        foreach ($parishes as $parish) {
            $gradeId = 1;
            Theme::insert([
                [ 'parish_id' => $parish->id, 'sequence' => 1, 'grade_id' => $gradeId, 'title' => 'Que grande alegria, Jesus nasceu!' ],
                [ 'parish_id' => $parish->id, 'sequence' => 2, 'grade_id' => $gradeId, 'title' => 'Jesus é nosso amigo' ],
                [ 'parish_id' => $parish->id, 'sequence' => 3, 'grade_id' => $gradeId, 'title' => 'A Bíblia nos fala de Jesus' ],
                [ 'parish_id' => $parish->id, 'sequence' => 4, 'grade_id' => $gradeId, 'title' => 'Jesus nos chama para segui-lo' ],
                [ 'parish_id' => $parish->id, 'sequence' => 5, 'grade_id' => $gradeId, 'title' => 'É preciso amar de verdade' ],
                [ 'parish_id' => $parish->id, 'sequence' => 6, 'grade_id' => $gradeId, 'title' => 'A partilha nos faz felizes' ],
                [ 'parish_id' => $parish->id, 'sequence' => 7, 'grade_id' => $gradeId, 'title' => 'Jesus, aumenta a nossa fé!' ],
                [ 'parish_id' => $parish->id, 'sequence' => 8, 'grade_id' => $gradeId, 'title' => 'Com Jesus aprendemos a rezar' ],
                [ 'parish_id' => $parish->id, 'sequence' => 9, 'grade_id' => $gradeId, 'title' => 'Usar nossos talentos para o bem' ],
                [ 'parish_id' => $parish->id, 'sequence' => 10, 'grade_id' => $gradeId, 'title' => 'Devemos perdoar sempre' ],
                [ 'parish_id' => $parish->id, 'sequence' => 11, 'grade_id' => $gradeId, 'title' => 'Jesus curou o surdo' ],
                [ 'parish_id' => $parish->id, 'sequence' => 12, 'grade_id' => $gradeId, 'title' => 'Em ti, Jesus, posso confiar!' ],
                [ 'parish_id' => $parish->id, 'sequence' => 13, 'grade_id' => $gradeId, 'title' => 'Jesus e Maria na festa de casamento' ],
                [ 'parish_id' => $parish->id, 'sequence' => 14, 'grade_id' => $gradeId, 'title' => 'O cuidado de Jesus por nós' ],
                [ 'parish_id' => $parish->id, 'sequence' => 15, 'grade_id' => $gradeId, 'title' => 'Ser paciente com as pessoas' ],
                [ 'parish_id' => $parish->id, 'sequence' => 16, 'grade_id' => $gradeId, 'title' => 'Jesus não condena a riqueza' ],
                [ 'parish_id' => $parish->id, 'sequence' => 17, 'grade_id' => $gradeId, 'title' => 'A lição do pai bondoso' ],
                [ 'parish_id' => $parish->id, 'sequence' => 18, 'grade_id' => $gradeId, 'title' => 'Ele está vivo no meio de nós!' ],
                [ 'parish_id' => $parish->id, 'sequence' => 19, 'grade_id' => $gradeId, 'title' => 'Jesus nos mandou o Espírito Santo' ],
                [ 'parish_id' => $parish->id, 'sequence' => 20, 'grade_id' => $gradeId, 'title' => 'Convidados a viver em comunidade' ],
            ]);
        };

        foreach ($parishes as $parish) {
            $gradeId = 3;
            Theme::insert([
                [ 'parish_id' => $parish->id, 'sequence' => 1, 'grade_id' => $gradeId, 'title' => 'Minha turma de catequese' ],
                [ 'parish_id' => $parish->id, 'sequence' => 2, 'grade_id' => $gradeId, 'title' => 'Amigos de Jesus' ],
                [ 'parish_id' => $parish->id, 'sequence' => 3, 'grade_id' => $gradeId, 'title' => 'Bíblia, um caminho para conhecer Jesus' ],
                [ 'parish_id' => $parish->id, 'sequence' => 4, 'grade_id' => $gradeId, 'title' => 'Maria, mãe de Jesus' ],
                [ 'parish_id' => $parish->id, 'sequence' => 5, 'grade_id' => $gradeId, 'title' => 'O Pai nos envia seu Filho' ],
                [ 'parish_id' => $parish->id, 'sequence' => 6, 'grade_id' => $gradeId, 'title' => 'Crescer diante de Deus e dos homens' ],
                [ 'parish_id' => $parish->id, 'sequence' => 7, 'grade_id' => $gradeId, 'title' => 'Este é o meu Filho amado' ],
                [ 'parish_id' => $parish->id, 'sequence' => 8, 'grade_id' => $gradeId, 'title' => 'Jesus anuncia o Reino de Deus' ],
                [ 'parish_id' => $parish->id, 'sequence' => 9, 'grade_id' => $gradeId, 'title' => 'Palavras que falam ao coração' ],
                [ 'parish_id' => $parish->id, 'sequence' => 10, 'grade_id' => $gradeId, 'title' => 'Sinais de vida nova' ],
                [ 'parish_id' => $parish->id, 'sequence' => 11, 'grade_id' => $gradeId, 'title' => 'O jeito de Jesus acolher' ],
                [ 'parish_id' => $parish->id, 'sequence' => 12, 'grade_id' => $gradeId, 'title' => 'Jesus nos ensina a rezar' ],
                [ 'parish_id' => $parish->id, 'sequence' => 13, 'grade_id' => $gradeId, 'title' => 'Jesus nos ensina a perdoar' ],
                [ 'parish_id' => $parish->id, 'sequence' => 14, 'grade_id' => $gradeId, 'title' => 'Permanecei no meu amor' ],
                [ 'parish_id' => $parish->id, 'sequence' => 15, 'grade_id' => $gradeId, 'title' => 'Jesus nos ensina a ter compaixão' ],
                [ 'parish_id' => $parish->id, 'sequence' => 16, 'grade_id' => $gradeId, 'title' => 'Sou chamado a formar comunidade no amor' ],
                [ 'parish_id' => $parish->id, 'sequence' => 17, 'grade_id' => $gradeId, 'title' => 'Jesus, doação e serviço' ],
                [ 'parish_id' => $parish->id, 'sequence' => 18, 'grade_id' => $gradeId, 'title' => 'A cruz é sinal de amor' ],
                [ 'parish_id' => $parish->id, 'sequence' => 19, 'grade_id' => $gradeId, 'title' => 'Jesus está sempre conosco' ],
                [ 'parish_id' => $parish->id, 'sequence' => 20, 'grade_id' => $gradeId, 'title' => 'A comunidade vive e celebra unida' ],
            ]);
        };

        foreach ($parishes as $parish) {
            $gradeId = 4;
            Theme::insert([
                [ 'parish_id' => $parish->id, 'sequence' => 1, 'grade_id' => $gradeId, 'title' => 'Jesus nos revela o Pai' ],
                [ 'parish_id' => $parish->id, 'sequence' => 2, 'grade_id' => $gradeId, 'title' => 'Deus nos fala de muitas maneiras' ],
                [ 'parish_id' => $parish->id, 'sequence' => 3, 'grade_id' => $gradeId, 'title' => 'Deus fez todas as coisas' ],
                [ 'parish_id' => $parish->id, 'sequence' => 4, 'grade_id' => $gradeId, 'title' => 'Deus criou e entregou ao nosso cuidado' ],
                [ 'parish_id' => $parish->id, 'sequence' => 5, 'grade_id' => $gradeId, 'title' => 'Somos irmãos no amor de Deus' ],
                [ 'parish_id' => $parish->id, 'sequence' => 6, 'grade_id' => $gradeId, 'title' => 'Deus tem um plano para nos fazer felizes' ],
                [ 'parish_id' => $parish->id, 'sequence' => 7, 'grade_id' => $gradeId, 'title' => 'Estabeleço minha aliança convosco!' ],
                [ 'parish_id' => $parish->id, 'sequence' => 8, 'grade_id' => $gradeId, 'title' => 'Abraão, deixa a tua terra!' ],
                [ 'parish_id' => $parish->id, 'sequence' => 9, 'grade_id' => $gradeId, 'title' => 'Abraão, pai dos que creem' ],
                [ 'parish_id' => $parish->id, 'sequence' => 10, 'grade_id' => $gradeId, 'title' => 'Moisés, liberta o meu povo!' ],
                [ 'parish_id' => $parish->id, 'sequence' => 11, 'grade_id' => $gradeId, 'title' => 'Deus nos prepara para sermos o seu povo' ],
                [ 'parish_id' => $parish->id, 'sequence' => 12, 'grade_id' => $gradeId, 'title' => 'Façam também vocês assim como eu' ],
                [ 'parish_id' => $parish->id, 'sequence' => 13, 'grade_id' => $gradeId, 'title' => 'Os mandamentos guiam meu olhar para Deus' ],
                [ 'parish_id' => $parish->id, 'sequence' => 14, 'grade_id' => $gradeId, 'title' => 'Os mandamentos guiam meu olhar para os irmãos' ],
                [ 'parish_id' => $parish->id, 'sequence' => 15, 'grade_id' => $gradeId, 'title' => 'Comunidade que nasce da Lei de Deus' ],
                [ 'parish_id' => $parish->id, 'sequence' => 16, 'grade_id' => $gradeId, 'title' => 'Davi, o pastor de ovelhas escolhido para ser rei' ],
                [ 'parish_id' => $parish->id, 'sequence' => 17, 'grade_id' => $gradeId, 'title' => 'Profetas, mensageiros do Deus verdadeiro' ],
                [ 'parish_id' => $parish->id, 'sequence' => 18, 'grade_id' => $gradeId, 'title' => 'Isaías, profeta da esperança' ],
                [ 'parish_id' => $parish->id, 'sequence' => 19, 'grade_id' => $gradeId, 'title' => 'Amós, profeta da justiça' ],
                [ 'parish_id' => $parish->id, 'sequence' => 20, 'grade_id' => $gradeId, 'title' => 'Maria, a Nova Arca da aliança' ],
            ]);
        };

        foreach ($parishes as $parish) {
            $gradeId = 5;
            Theme::insert([
                [ 'parish_id' => $parish->id, 'sequence' => 1, 'grade_id' => $gradeId, 'title' => 'Eis a nossa missão: anunciar a Boa-nova a toda criatura' ],
                [ 'parish_id' => $parish->id, 'sequence' => 2, 'grade_id' => $gradeId, 'title' => 'O Espírito Santo anima a comunidade' ],
                [ 'parish_id' => $parish->id, 'sequence' => 3, 'grade_id' => $gradeId, 'title' => 'A Igreja nasce no coração de Jesus Cristo' ],
                [ 'parish_id' => $parish->id, 'sequence' => 4, 'grade_id' => $gradeId, 'title' => 'Somos Igreja, povo de Deus' ],
                [ 'parish_id' => $parish->id, 'sequence' => 5, 'grade_id' => $gradeId, 'title' => 'Nós somos o corpo de Cristo' ],
                [ 'parish_id' => $parish->id, 'sequence' => 6, 'grade_id' => $gradeId, 'title' => 'Rezemos ao Senhor!' ],
                [ 'parish_id' => $parish->id, 'sequence' => 7, 'grade_id' => $gradeId, 'title' => 'Maria, mãe da Igreja' ],
                [ 'parish_id' => $parish->id, 'sequence' => 8, 'grade_id' => $gradeId, 'title' => 'Os sacramentos são sinais de Deus em nossa vida' ],
                [ 'parish_id' => $parish->id, 'sequence' => 9, 'grade_id' => $gradeId, 'title' => 'Batismo, nascimento para a comunidade' ],
                [ 'parish_id' => $parish->id, 'sequence' => 10, 'grade_id' => $gradeId, 'title' => 'Batizados: sal da terra e luz do mundo!' ],
                [ 'parish_id' => $parish->id, 'sequence' => 11, 'grade_id' => $gradeId, 'title' => 'Somos testemunhas de Cristo no mundo' ],
                [ 'parish_id' => $parish->id, 'sequence' => 12, 'grade_id' => $gradeId, 'title' => 'Comam, bebam, isto é o meu Corpo, isto é o meu Sangue' ],
                [ 'parish_id' => $parish->id, 'sequence' => 13, 'grade_id' => $gradeId, 'title' => 'O Pão da Vida, a Comunhão' ],
                [ 'parish_id' => $parish->id, 'sequence' => 14, 'grade_id' => $gradeId, 'title' => 'Pecar é afastar-se de Deus' ],
                [ 'parish_id' => $parish->id, 'sequence' => 15, 'grade_id' => $gradeId, 'title' => 'No Reino de Deus existe perdão' ],
                [ 'parish_id' => $parish->id, 'sequence' => 16, 'grade_id' => $gradeId, 'title' => 'Reconciliados com Deus' ],
                [ 'parish_id' => $parish->id, 'sequence' => 17, 'grade_id' => $gradeId, 'title' => 'Bendito seja Deus que nos reuniu no amor de Cristo!' ],
                [ 'parish_id' => $parish->id, 'sequence' => 18, 'grade_id' => $gradeId, 'title' => 'Com Jesus caminhamos na Igreja' ],
                [ 'parish_id' => $parish->id, 'sequence' => 19, 'grade_id' => $gradeId, 'title' => 'Símbolos e gestos para a comunhão com Deus' ],
                [ 'parish_id' => $parish->id, 'sequence' => 20, 'grade_id' => $gradeId, 'title' => 'Estando a caminho, explicou-lhes as Escrituras e colocou-se à mesa com eles' ],
            ]);
        };

        foreach ($parishes as $parish) {
            $gradeId = 7;
            Theme::insert([
                [ 'parish_id' => $parish->id, 'sequence' => 1, 'grade_id' => $gradeId, 'title' => 'O homem: centro da atenção de Deus' ],
                [ 'parish_id' => $parish->id, 'sequence' => 2, 'grade_id' => $gradeId, 'title' => 'Desvios de rota' ],
                [ 'parish_id' => $parish->id, 'sequence' => 3, 'grade_id' => $gradeId, 'title' => 'Colaboradores de Deus' ],
                [ 'parish_id' => $parish->id, 'sequence' => 4, 'grade_id' => $gradeId, 'title' => 'Nosso sim a um viver diferente' ],
                [ 'parish_id' => $parish->id, 'sequence' => 5, 'grade_id' => $gradeId, 'title' => 'Ela viveu diferente' ],
                [ 'parish_id' => $parish->id, 'sequence' => 6, 'grade_id' => $gradeId, 'title' => 'Eles viveram de um jeito diferente' ],
                [ 'parish_id' => $parish->id, 'sequence' => 7, 'grade_id' => $gradeId, 'title' => 'Mandamentos, caminho do bem' ],
                [ 'parish_id' => $parish->id, 'sequence' => 8, 'grade_id' => $gradeId, 'title' => 'Deus em primeiro lugar' ],
                [ 'parish_id' => $parish->id, 'sequence' => 9, 'grade_id' => $gradeId, 'title' => 'Cada família é única!' ],
                [ 'parish_id' => $parish->id, 'sequence' => 10, 'grade_id' => $gradeId, 'title' => 'Em defesa da vida' ],
                [ 'parish_id' => $parish->id, 'sequence' => 11, 'grade_id' => $gradeId, 'title' => 'Amor e responsabilidade' ],
                [ 'parish_id' => $parish->id, 'sequence' => 12, 'grade_id' => $gradeId, 'title' => 'Ser honesto vale a pena?' ],
                [ 'parish_id' => $parish->id, 'sequence' => 13, 'grade_id' => $gradeId, 'title' => 'A cobiça nos tira a paz' ],
                [ 'parish_id' => $parish->id, 'sequence' => 14, 'grade_id' => $gradeId, 'title' => 'Caminho para a felicidade' ],
                [ 'parish_id' => $parish->id, 'sequence' => 15, 'grade_id' => $gradeId, 'title' => 'A fé em Jesus' ],
            ]);
        };

        foreach ($parishes as $parish) {
            $gradeId = 8;
            Theme::insert([
                [ 'parish_id' => $parish->id, 'sequence' => 16-15, 'grade_id' => $gradeId, 'title' => 'A vida ligada a Cristo Jesus' ],
                [ 'parish_id' => $parish->id, 'sequence' => 17-15, 'grade_id' => $gradeId, 'title' => 'A oração me faz íntimo do Senhor' ],
                [ 'parish_id' => $parish->id, 'sequence' => 18-15, 'grade_id' => $gradeId, 'title' => 'Na liturgia celebramos Jesus Cristo' ],
                [ 'parish_id' => $parish->id, 'sequence' => 19-15, 'grade_id' => $gradeId, 'title' => 'Jesus Cristo e o Espírito Santo' ],
                [ 'parish_id' => $parish->id, 'sequence' => 20-15, 'grade_id' => $gradeId, 'title' => 'Os sinais do amor de Deus' ],
                [ 'parish_id' => $parish->id, 'sequence' => 21-15, 'grade_id' => $gradeId, 'title' => 'Sacramentos da Iniciação Cristã' ],
                [ 'parish_id' => $parish->id, 'sequence' => 22-15, 'grade_id' => $gradeId, 'title' => 'Sacramentos de Cura' ],
                [ 'parish_id' => $parish->id, 'sequence' => 23-15, 'grade_id' => $gradeId, 'title' => 'Sacramentos de Serviço' ],
                [ 'parish_id' => $parish->id, 'sequence' => 24-15, 'grade_id' => $gradeId, 'title' => 'Sacramento da Confirmação' ],
                [ 'parish_id' => $parish->id, 'sequence' => 25-15, 'grade_id' => $gradeId, 'title' => 'Símbolos e gestos da Confirmação' ],
                [ 'parish_id' => $parish->id, 'sequence' => 26-15, 'grade_id' => $gradeId, 'title' => 'Vivendo os Sacramentos expresso minha fé' ],
                [ 'parish_id' => $parish->id, 'sequence' => 27-15, 'grade_id' => $gradeId, 'title' => 'Espírito Santo na vida dos cristãos' ],
                [ 'parish_id' => $parish->id, 'sequence' => 28-15, 'grade_id' => $gradeId, 'title' => 'Ser sinal de comunhão na comunidade' ],
                [ 'parish_id' => $parish->id, 'sequence' => 29-15, 'grade_id' => $gradeId, 'title' => 'Ser cristão: sal da terra' ],
                [ 'parish_id' => $parish->id, 'sequence' => 30-15, 'grade_id' => $gradeId, 'title' => 'Missão do crismando: ouvir e praticar o Evangelho' ],
            ]);
        };

        // foreach($parishes as $parish) {
        //     foreach($grades as $grade) {
        //         Theme::factory(8)->create([
        //             'parish_id' => $parish->id,
        //             'grade_id' => $grade->id,
        //         ]);
        //     }
        // }
    }
}
