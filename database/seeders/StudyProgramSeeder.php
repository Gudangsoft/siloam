<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudyProgram;

class StudyProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            ["name" => "Teologi", "slug" => "teologi-s1", "degree" => "S1", "accreditation" => "B", "description" => "Program Teologi S1 dirancang membekali mahasiswa dengan fondasi teologi yang kuat.", "vision" => "Menghasilkan sarjana teologi yang mampu memimpin dan melayani.", "mission" => "Pendidikan teologi berbasis Alkitab yang kontekstual.", "objectives" => "144 SKS, 8 semester.", "career_prospects" => "Pendeta, pengkhotbah, guru Alkitab, konselor, misionaris.", "is_active" => true, "order" => 1],
            ["name" => "Pendidikan Agama Kristen", "slug" => "pendidikan-agama-kristen", "degree" => "S1", "accreditation" => "B", "description" => "Program PAK mempersiapkan mahasiswa menjadi pendidik Kristen yang profesional.", "vision" => "Pendidik Kristen berkualitas dan berkarakter.", "mission" => "Guru agama Kristen yang kompeten dan berintegritas.", "objectives" => "144 SKS, 8 semester.", "career_prospects" => "Guru agama Kristen, pembina pemuda, koordinator pendidikan gereja.", "is_active" => true, "order" => 2],
            ["name" => "Musik Gerejawi", "slug" => "musik-gerejawi", "degree" => "S1", "accreditation" => "C", "description" => "Program Musik Gerejawi membekali mahasiswa dengan keahlian bermusik dan pemahaman liturgi.", "vision" => "Musisi gerejawi yang profisien secara teknis dan rohani.", "mission" => "Pendidikan musik gerejawi yang berkualitas dan berdampak.", "objectives" => "144 SKS, 8 semester.", "career_prospects" => "Worship leader, dirigen, organis gereja, pendidik musik.", "is_active" => true, "order" => 3],
            ["name" => "Teologi", "slug" => "teologi-s2", "degree" => "S2", "accreditation" => "B", "description" => "Program Magister Teologi (M.Th.) untuk pendalaman studi teologi lanjutan.", "vision" => "Teolog Kristen berkontribusi bagi gereja dan masyarakat.", "mission" => "Pendidikan pascasarjana teologi berkualitas tinggi.", "objectives" => "48 SKS, 4 semester.", "career_prospects" => "Dosen, peneliti, konsultan gereja, pemimpin lembaga Kristen.", "is_active" => true, "order" => 4],
        ];
        foreach ($programs as $program) {
            StudyProgram::create($program);
        }
    }
}
