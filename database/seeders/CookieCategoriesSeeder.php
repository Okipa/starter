<?php

namespace Database\Seeders;

use App\Models\Cookies\CookieCategory;
use Illuminate\Database\Seeder;

class CookieCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        CookieCategory::factory()->create([
            'unique_key' => 'necessary',
            'title' => ['fr' => 'Nécessaire', 'en' => 'Necessary'],
            'description' => [
                'fr' => 'Ces cookies sont nécessaires au fonctionnement de l\'application. Ils ne peuvent pas être '
                    . 'désactivés et ne stockent aucune information d’identification personnelle.',
                'en' => 'These cookies are necessary for the operation of the application. They cannot be deactivated '
                    . 'and do not store any personal identifiable information.',
            ],
        ]);
        CookieCategory::factory()->create([
            'unique_key' => 'security',
            'title' => ['fr' => 'Sécurité', 'en' => 'Security'],
            'description' => [
                'fr' => 'Ces cookies permettent de sécuriser l\'application et de prévenir le piratage de la session '
                    . 'de l\'utilisateur authentifié. Ils ne peuvent pas être désactivés et ne stockent aucune '
                    . 'information d’identification personnelle.',
                'en' => 'These cookies help to secure the application and prevent hacking of the session of the '
                    . 'authenticated user. They cannot be deactivated and do not store any personal identifiable '
                    . 'information.',
            ],
        ]);
        CookieCategory::factory()->create([
            'unique_key' => 'statistic',
            'title' => ['fr' => 'Statistique', 'en' => 'Statistic'],
            'description' => [
                'fr' => 'Ces cookies nous permettent de déterminer le nombre de visites et les sources du trafic, '
                    . 'afin de mesurer et d’améliorer les performances de notre application. Toutes les informations '
                    . 'collectées par ces cookies sont agrégées et anonymisées. Si vous n\'acceptez pas ces cookies, '
                    . 'nous ne serons pas informé de votre visite sur notre site.',
                'en' => 'These cookies allow us to determine the number of visits and the sources of traffic, in order '
                    . 'to measure and improve the performance of our application. All information collected by these '
                    . 'cookies is aggregated and anonymized. If you do not accept these cookies, we will not be '
                    . 'notified of your visit to our site.',
            ],
        ]);
        CookieCategory::factory()->create([
            'unique_key' => 'advertising',
            'title' => ['fr' => 'Publicitaire', 'en' => 'Advertising'],
            'description' => [
                'fr' => 'Ces cookies peuvent être utilisés par nos partenaires pour établir un profil de vos intérêts '
                    . 'et vous proposer des publicités pertinentes sur d\'autres plateformes. Ils ne stockent pas '
                    . 'directement des données personnelles, mais sont basés sur l\'identification unique de votre '
                    . 'navigateur et de votre appareil Internet. Si vous n\'autorisez pas ces cookies, votre publicité '
                    . 'sera moins ciblée.',
                'en' => 'These cookies may be used by our partners to build a profile of your interests and deliver '
                    . 'relevant advertising to you on other platforms. They do not directly store personal data, but '
                    . 'are based on the unique identification of your browser and internet device. If you do not allow '
                    . 'these cookies, your advertising will be less targeted.',
            ],
        ]);
    }
}
