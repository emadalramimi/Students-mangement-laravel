<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitialDataSeeder extends Seeder
{
    public function run(): void
    {
        // Insert eleves
        DB::table('eleves')->insert([
            ['nom' => 'Al Ramimi', 'prenom' => 'Emad', 'date_naissance' => '2000-01-15', 'numero_etudiant' => 'S2023001', 'email' => 'emad.ramimi@example.com', 'image' => NULL],
            ['nom' => 'Armand', 'prenom' => 'Simon', 'date_naissance' => '2001-03-12', 'numero_etudiant' => 'S2023002', 'email' => 'simon.armand@example.com', 'image' => NULL],
            ['nom' => 'Belloc', 'prenom' => 'Adrien', 'date_naissance' => '2002-05-08', 'numero_etudiant' => 'S2023003', 'email' => 'adrien.belloc@example.com', 'image' => NULL],
            ['nom' => 'Bouissou', 'prenom' => 'Romain', 'date_naissance' => '2001-07-21', 'numero_etudiant' => 'S2023004', 'email' => 'romain.bouissou@example.com', 'image' => NULL],
            ['nom' => 'Brando', 'prenom' => 'Titouan', 'date_naissance' => '2002-11-10', 'numero_etudiant' => 'S2023005', 'email' => 'titouan.brando@example.com', 'image' => NULL],
            ['nom' => 'Carcenac', 'prenom' => 'Mathis', 'date_naissance' => '2001-02-18', 'numero_etudiant' => 'S2023006', 'email' => 'mathis.carcenac@example.com', 'image' => NULL],
            ['nom' => 'Chaux', 'prenom' => 'Pierre-Louis', 'date_naissance' => '2003-06-05', 'numero_etudiant' => 'S2023007', 'email' => 'pierre.chaux@example.com', 'image' => NULL],
            ['nom' => 'Clement', 'prenom' => 'Thibault', 'date_naissance' => '2000-08-22', 'numero_etudiant' => 'S2023008', 'email' => 'thibault.clement@example.com', 'image' => NULL],
            ['nom' => 'Croguennoc', 'prenom' => 'Yanis', 'date_naissance' => '2002-10-01', 'numero_etudiant' => 'S2023009', 'email' => 'yanis.croguennoc@example.com', 'image' => NULL],
            ['nom' => 'Curylo', 'prenom' => 'Rafael', 'date_naissance' => '2001-12-14', 'numero_etudiant' => 'S2023010', 'email' => 'rafael.curylo@example.com', 'image' => NULL],
            ['nom' => 'Dariel', 'prenom' => 'Margaux', 'date_naissance' => '2002-01-05', 'numero_etudiant' => 'S2023011', 'email' => 'margaux.dariel@example.com', 'image' => NULL],
            ['nom' => 'Delagnes', 'prenom' => 'Antoine', 'date_naissance' => '2001-11-30', 'numero_etudiant' => 'S2023012', 'email' => 'antoine.delagnes@example.com', 'image' => NULL],
            ['nom' => 'Fouilhac', 'prenom' => 'Benjamin', 'date_naissance' => '2002-03-20', 'numero_etudiant' => 'S2023013', 'email' => 'benjamin.fouilhac@example.com', 'image' => NULL],
            ['nom' => 'Ghobrini', 'prenom' => 'Sofian', 'date_naissance' => '2000-09-25', 'numero_etudiant' => 'S2023014', 'email' => 'sofian.ghobrini@example.com', 'image' => NULL],
            ['nom' => 'Gikapa', 'prenom' => 'Christian', 'date_naissance' => '2002-04-18', 'numero_etudiant' => 'S2023015', 'email' => 'christian.gikapa@example.com', 'image' => NULL],
            ['nom' => 'Gribanova', 'prenom' => 'Sofia', 'date_naissance' => '2001-06-10', 'numero_etudiant' => 'S2023016', 'email' => 'sofia.gribanova@example.com', 'image' => NULL],
            ['nom' => 'Guerin', 'prenom' => 'Romain', 'date_naissance' => '2003-02-12', 'numero_etudiant' => 'S2023017', 'email' => 'romain.guerin@example.com', 'image' => NULL],
            ['nom' => 'Herbaut', 'prenom' => 'Titouan', 'date_naissance' => '2002-08-30', 'numero_etudiant' => 'S2023018', 'email' => 'titouan.herbaut@example.com', 'image' => NULL],
            ['nom' => 'Lamarti', 'prenom' => 'Nail', 'date_naissance' => '2001-12-08', 'numero_etudiant' => 'S2023019', 'email' => 'nail.lamarti@example.com', 'image' => NULL],
            ['nom' => 'Lugagne', 'prenom' => 'Theo', 'date_naissance' => '2002-05-03', 'numero_etudiant' => 'S2023020', 'email' => 'theo.lugagne@example.com', 'image' => NULL],
            ['nom' => 'Mangado', 'prenom' => 'Mateo', 'date_naissance' => '2003-01-01', 'numero_etudiant' => 'S2023021', 'email' => 'mateo.mangado@example.com', 'image' => NULL],
            ['nom' => 'Miled', 'prenom' => 'Willem', 'date_naissance' => '2000-10-27', 'numero_etudiant' => 'S2023022', 'email' => 'willem.miled@example.com', 'image' => NULL],
            ['nom' => 'Pelletier', 'prenom' => 'Alex', 'date_naissance' => '2002-03-15', 'numero_etudiant' => 'S2023023', 'email' => 'alex.pelletier@example.com', 'image' => NULL],
            ['nom' => 'Richard', 'prenom' => 'Gabriel', 'date_naissance' => '2001-11-05', 'numero_etudiant' => 'S2023024', 'email' => 'gabriel.richard@example.com', 'image' => NULL],
            ['nom' => 'Zizi', 'prenom' => 'Anis', 'date_naissance' => '2002-07-20', 'numero_etudiant' => 'S2023025', 'email' => 'anis.zizi@example.com', 'image' => NULL],
        ]);

        // Insert modules
        DB::table('modules')->insert([
            ['code' => 'R5A05', 'nom' => 'Laravel', 'coefficient' => 2],
            ['code' => 'R5A10', 'nom' => 'Programmation Multimédia', 'coefficient' => 3],
            ['code' => 'R5A11', 'nom' => 'Optimisation', 'coefficient' => 3],
            ['code' => 'R5A12', 'nom' => 'Modélisation Mathématique', 'coefficient' => 4],
            ['code' => 'R5A04', 'nom' => 'Qualité Algorithmique', 'coefficient' => 2],
        ]);

        // Insert evaluations
        DB::table('evaluations')->insert([
            ['module_id' => 1, 'titre' => 'Contrôle 1 Laravel', 'coefficient' => 2, 'date' => '2024-01-15'],
            ['module_id' => 1, 'titre' => 'Projet Laravel', 'coefficient' => 3, 'date' => '2024-03-01'],
            ['module_id' => 2, 'titre' => 'Examen Continu', 'coefficient' => 2, 'date' => '2024-01-20'],
            ['module_id' => 2, 'titre' => 'Projet Final', 'coefficient' => 3, 'date' => '2024-04-10'],
            ['module_id' => 3, 'titre' => 'Mini-Test', 'coefficient' => 1, 'date' => '2024-01-25'],
            ['module_id' => 3, 'titre' => 'Examen Final', 'coefficient' => 4, 'date' => '2024-05-15'],
            ['module_id' => 4, 'titre' => 'Contrôle 1 Modélisation', 'coefficient' => 3, 'date' => '2024-02-05'],
            ['module_id' => 4, 'titre' => 'Examen Final Modélisation', 'coefficient' => 5, 'date' => '2024-06-01'],
            ['module_id' => 5, 'titre' => 'Contrôle Continu', 'coefficient' => 2, 'date' => '2024-03-05'],
            ['module_id' => 5, 'titre' => 'Examen Final', 'coefficient' => 4, 'date' => '2024-06-10'],
        ]);

        // Insert evaluation_eleves (first set)
        $evaluationElevesData1 = [
            [1, 1, 14], [1, 2, 16], [1, 3, 15], [1, 4, 12], [1, 5, 10],
            [1, 6, 18], [1, 7, 13], [1, 8, 17], [1, 9, 19], [1, 10, 14],
            [2, 1, 15], [2, 2, 12], [2, 3, 14], [2, 4, 16], [2, 5, 13],
            [2, 6, 11], [2, 7, 18], [2, 8, 14], [2, 9, 15], [2, 10, 19],
            [3, 11, 13], [3, 12, 16], [3, 13, 17], [3, 14, 15], [3, 15, 14],
            [3, 16, 12], [3, 17, 11], [3, 18, 18], [3, 19, 14], [3, 20, 13],
            [4, 11, 19], [4, 12, 14], [4, 13, 12], [4, 14, 17], [4, 15, 15],
            [5, 16, 15], [5, 17, 13], [5, 18, 14], [5, 19, 18], [5, 20, 11],
            [5, 21, 16], [5, 22, 13], [5, 23, 14], [5, 24, 12], [5, 25, 19],
            [6, 21, 12], [6, 22, 14], [6, 23, 15], [6, 24, 18], [6, 25, 11],
            [6, 1, 19], [6, 2, 13], [6, 3, 14], [6, 4, 12], [6, 5, 15],
            [7, 21, 15], [7, 22, 14], [7, 23, 12], [7, 24, 17], [7, 25, 18]
        ];

        // Insert evaluation_eleves (second set)
        $evaluationElevesData2 = [
            [1, 1, 8], [1, 2, 7], [1, 3, 6], [1, 4, 5], [1, 5, 9],
            [1, 6, 8], [1, 7, 4], [1, 8, 7], [1, 9, 6], [1, 10, 5],
            [2, 1, 9], [2, 2, 6], [2, 3, 8], [2, 4, 7], [2, 5, 5],
            [2, 6, 9], [2, 7, 7], [2, 8, 6], [2, 9, 4], [2, 10, 8],
            [3, 11, 6], [3, 12, 5], [3, 13, 7], [3, 14, 8], [3, 15, 9],
            [3, 16, 4], [3, 17, 8], [3, 18, 6], [3, 19, 7], [3, 20, 5],
            [4, 11, 7], [4, 12, 6], [4, 13, 5], [4, 14, 8], [4, 15, 4],
            [5, 16, 6], [5, 17, 8], [5, 18, 7], [5, 19, 5], [5, 20, 9],
            [5, 21, 6], [5, 22, 4], [5, 23, 5], [5, 24, 7], [5, 25, 8],
            [6, 21, 9], [6, 22, 7], [6, 23, 6], [6, 24, 4], [6, 25, 8],
            [6, 1, 7], [6, 2, 8], [6, 3, 9], [6, 4, 5], [6, 5, 4],
            [7, 21, 6], [7, 22, 5], [7, 23, 8], [7, 24, 7], [7, 25, 6]
        ];

        // Convert evaluation_eleves data to proper format and insert
        foreach ([$evaluationElevesData1, $evaluationElevesData2] as $dataSet) {
            foreach ($dataSet as $data) {
                DB::table('evaluation_eleves')->insert([
                    'evaluation_id' => $data[0],
                    'eleve_id' => $data[1],
                    'note' => $data[2]
                ]);
            }
        }
    }
}
