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
        /** @var \App\Models\Pages\TitleDescriptionPageContent $pageContent */
        $pageContent = (new TitleDescriptionPageContent)->firstOrCreate(['slug' => 'contact-page-content']);
        $pageContent->displaySeoMeta();
        $css = mix('/css/contact/page/show.css');

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
        Notification::route('mail', settings()->email)->notify(new ContactFormMessage($request->validated()));
        Notification::route('mail', settings()->email)->notify(new ContactFormMessage($request->validated(), true));
        (new LogContactFormMessage)->create(['data' => $request->validated()]);

        return back()->with('toast_success', __('Your message have been sent, thank you for your interest.'));
    }
}
