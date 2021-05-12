<?php

namespace Tests\Feature\Front;

use App\Models\Logs\LogContactFormMessage;
use App\Models\PageContents\PageContent;
use App\Models\Pages\Page;
use App\Models\Settings\Settings;
use App\Notifications\ContactFormMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ContactPageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMix();
    }

    /** @test */
    public function it_can_display_contact_page(): void
    {
        $settings = Settings::factory()->withMedia()->create();
        PageContent::factory()->contact()
            ->withTitleBrick()
            ->withOneTextColumnBrick()
            ->withSeoMeta()
            ->create();
        $termsOfServicePage = Page::factory()->create([
            'unique_key' => 'terms_of_service_page',
            'nav_title' => ['fr' => 'CGU et mentions légales', 'en' => 'Terms and legal notice'],
        ]);
        $gdprPage = Page::factory()->create([
            'unique_key' => 'gdpr_page',
            'nav_title' => ['fr' => 'Vie privée et RGPD', 'en' => 'Privacy policy and GDPR'],
        ]);
        $this->get(route('contact.page.show'))
            ->assertOk()
            // Contact form is displayed.
            ->assertSeeInOrder([
                'action="' . route('contact.sendMessage') . '"',
                'name="first_name"',
                'name="last_name"',
                'name="email"',
                'name="phone_number"',
                'name="message"',
                // Terms of service and GDPR messages are displayed.
                __('By clicking on the "Send" button, I acknowledge that I have read the '
                    . ':terms_of_service_page_link, :gdpr_page_link pages and that this data will be used in the context '
                    . 'of the commercial relationship that may result from it.', [
                    'terms_of_service_page_link' => '<a href="' . route('page.show', $termsOfServicePage)
                        . '" title="'
                        . $termsOfServicePage->nav_title . '" target="_blank">' . $termsOfServicePage->nav_title
                        . '</a>',
                    'gdpr_page_link' => '<a href="' . route('page.show', $gdprPage) . '" title="'
                        . $gdprPage->nav_title . '" target="_blank">' . $gdprPage->nav_title . '</a>',
                ]),
                e(__('Your personal data is subject to computer processing by :company, in order to answer '
                    . 'your questions and/or complaints. You have a right of access, rectification, opposition, limitation '
                    . 'and portability by contacting: :email or by mail to: :postal_address. You also have the right to '
                    . 'lodge a complaint with the CNIL.', [
                    'company' => config('app.name'),
                    'email' => $settings->email,
                    'postal_address' => $settings->full_postal_address,
                ])),
                // Contact information is displayed.
                config('app.name'),
                $settings->phone_number,
                $settings->email,
                $settings->full_postal_address,
                'href="https://www.google.com/maps/embed/v1/place?key=' . config('services.google.key') . '&q='
                . str_replace([' ', ','], '+', $settings->full_postal_address) . '"',
            ], false);
    }

    /** @test */
    public function it_can_send_mail_message_from_contact_page(): void
    {
        $settings = Settings::factory()->create();
        Notification::fake();
        $this->from(route('contact.page.show'))
            ->post(route('contact.sendMessage'), [
                'first_name' => 'First name test',
                'last_name' => 'Last name test',
                'email' => 'email@test.fr',
                'phone_number' => '0606060606',
                'message' => 'Message test',
            ])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('Your message has been sent, we have emailed you a copy.'))
            ->assertRedirect(route('contact.page.show'));
        // Mail is sent to app owner.
        Notification::assertSentTo(new AnonymousNotifiable(), ContactFormMessage::class, fn(
            ContactFormMessage $notification,
            array $channels,
            AnonymousNotifiable $notifiable
        ) => $notification->locale === config('app.locale')
            && $notification->queue === 'high'
            && $notification->firstName === 'First name test'
            && $notification->lastName === 'Last name test'
            && $notification->email === 'email@test.fr'
            && $notification->phoneNumber === '0606060606'
            && $notification->message === 'Message test'
            && ! $notification->isCopyToSender
            && $channels === ['mail']
            && $notifiable->routes['mail'] === $settings->email);
        // Mail copy is sent to sender.
        Notification::assertSentTo(new AnonymousNotifiable(), ContactFormMessage::class, fn(
            ContactFormMessage $notification,
            array $channels,
            AnonymousNotifiable $notifiable
        ) => $notification->locale === config('app.locale')
            && $notification->queue === 'high'
            && $notification->firstName === 'First name test'
            && $notification->lastName === 'Last name test'
            && $notification->email === 'email@test.fr'
            && $notification->phoneNumber === '0606060606'
            && $notification->message === 'Message test'
            && $notification->isCopyToSender
            && $channels === ['mail']
            && $notifiable->routes['mail'] === 'email@test.fr');
        Notification::assertTimesSent(2, ContactFormMessage::class);
        // Mail log is saved.
        $this->assertDatabaseHas(app(LogContactFormMessage::class)->getTable(), [
            'data->first_name' => 'First name test',
            'data->last_name' => 'Last name test',
            'data->email' => 'email@test.fr',
            'data->phone_number' => '0606060606',
            'data->message' => 'Message test',
        ]);
    }
}
