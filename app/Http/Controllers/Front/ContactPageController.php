<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactPageSendMessageRequest;
use App\Models\Logs\LogContactFormMessage;
use App\Models\Pages\TitleDescriptionPageContent;
use App\Notifications\ContactFormMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Notification;

class ContactPageController extends Controller
{
    /**
     * @return \Illuminate\View\View
     * @throws \Exception
     */
    public function show(): View
    {
        $pageContent = TitleDescriptionPageContent::firstOrCreate(['unique_key' => 'contact_page_content']);
        $pageContent->displaySeoMeta();
        $css = mix('/css/templates/front/contact/page/show.css');

        return view('templates.front.contact.page.show', compact('pageContent', 'css'));
    }

    /**
     * @param \App\Http\Requests\Contact\ContactPageSendMessageRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function sendMessage(ContactPageSendMessageRequest $request): RedirectResponse
    {
        Notification::route('mail', settings()->email)
            ->notify((new ContactFormMessage(
                $request->validated()['first_name'],
                $request->validated()['last_name'],
                $request->validated()['email'],
                $request->validated()['phone_number'],
                $request->validated()['message'],
            ))->locale(app()->getLocale()));
        Notification::route('mail', settings()->email)
            ->notify((new ContactFormMessage(
                $request->validated()['first_name'],
                $request->validated()['last_name'],
                $request->validated()['email'],
                $request->validated()['phone_number'],
                $request->validated()['message'],
                true
            ))->locale(app()->getLocale()));
        LogContactFormMessage::create(['data' => $request->validated()]);

        return back()->with('toast_success', __('Your message have been sent, thank you for your interest.'));
    }
}
