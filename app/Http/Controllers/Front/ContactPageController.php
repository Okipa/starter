<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactPageSendMessageRequest;
use App\Models\LogContactFormMessage;
use App\Models\PageContent;
use App\Notifications\ContactFormMessage;
use App\Services\Seo\SeoService;
use Notification;

class ContactPageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function show()
    {
        /** @var PageContent $pageContent */
        $pageContent = (new PageContent)->firstOrCreate(['slug' => 'contact-page-content']);
        (new SeoService)->displayMetaTagsFromModel($pageContent);
        $css = mix('/css/contact/page/show.css');

        return view('templates.front.contact.page.show', compact('pageContent', 'css'));
    }

    public function sendMessage(ContactPageSendMessageRequest $request)
    {
        Notification::route('mail', cache('settings')->email)
            ->notify(new ContactFormMessage('original', $request->validated()));
        Notification::route('mail', cache('settings')->email)
            ->notify(new ContactFormMessage('copy', $request->validated()));
        (new LogContactFormMessage)->create(['data' => $request->validated()]);

        return back()->with('toast_success', __('Your message have been sent, thank you for your interest.'));
    }
}
