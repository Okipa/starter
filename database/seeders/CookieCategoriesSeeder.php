<?php

namespace Database\Seeders;

use App\Models\Cookies\CookieCategory;
use Illuminate\Database\Seeder;

class CookieCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        CookieCategory::factory()->create([
            'title' => ['fr' => 'Nécessaire', 'en' => 'Necessary'],
            'description' => [
                'fr' => 'Ces cookies sont nécessaires au fonctionnement du site Web et ne peuvent pas être désactivés dans nos systèmes. Ils sont généralement établis en tant que réponse à des actions que vous avez effectuées et qui constituent une demande de services, telles que la définition de vos préférences en matière de confidentialité, la connexion ou le remplissage de formulaires. Vous pouvez configurer votre navigateur afin de bloquer ou être informé de l\'existence de ces cookies, mais certaines parties du site Web peuvent être affectées. Ces cookies ne stockent aucune information d’identification personnelle.',
                'en' => 'These cookies are necessary for the website to function and cannot be disabled in our systems. They are usually set as a response to actions you have taken that constitute a request for services, such as setting your privacy preferences, logging in, or filling out forms. You can configure your browser to block or be notified of the existence of these cookies, but parts of the website may be affected. These cookies do not store any personally identifying information.',
            ],
        ]);
        CookieCategory::factory()->create([
            'title' => ['fr' => 'Statistique', 'en' => 'Statistic'],
            'description' => [
                'fr' => 'Ces cookies nous permettent de déterminer le nombre de visites et les sources du trafic, afin de mesurer et d’améliorer les performances de notre site Web. Ils nous aident également à identifier les pages les plus/moins visitées et d’évaluer comment les visiteurs naviguent sur le site Web. Toutes les informations collectées par ces cookies sont agrégées et donc anonymisées. Si vous n\'acceptez pas ces cookies, nous ne serons pas informé de votre visite sur notre site.',
                'en' => 'These cookies allow us to determine the number of visits and the sources of traffic, in order to measure and improve the performance of our website. They also help us identify the most / least visited pages and assess how visitors navigate the website. All the information collected by these cookies is aggregated and therefore anonymized. If you do not accept these cookies, we will not be notified of your visit to our site.',
            ],
        ]);
        CookieCategory::factory()->create([
            'title' => ['fr' => 'Publicitaire', 'en' => 'Advertising'],
            'description' => [
                'fr' => 'Ces cookies peuvent être mis en place au sein de notre site Web par nos partenaires publicitaires. Ils peuvent être utilisés par ces sociétés pour établir un profil de vos intérêts et vous proposer des publicités pertinentes sur d\'autres sites Web. Ils ne stockent pas directement des données personnelles, mais sont basés sur l\'identification unique de votre navigateur et de votre appareil Internet. Si vous n\'autorisez pas ces cookies, votre publicité sera moins ciblée.',
                'en' => 'These cookies may be set within our website by our advertising partners. They may be used by these companies to build a profile of your interests and serve you with relevant advertisements on other websites. They do not directly store personal data, but are based on the unique identification of your browser and internet device. If you do not allow these cookies, your advertising will be less targeted.',
            ],
        ]);
    }
}
