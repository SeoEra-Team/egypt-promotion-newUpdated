<?php

namespace App\Http\Controllers;

use App\Helpers\Classes\Email;
use App\Helpers\Schema\SchemaHelper;
use App\Http\Requests\TailorMadeRequest;
use App\Mail\TailorMadeEmail;
use App\Models\City;
use App\Models\Contact;
use App\Models\TailorMade;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request as HttpRequest;
use Carbon\Carbon;
class FormController extends Controller
{
   
    /**
     * Display the tailor-made form view with a list of all cities.
     *
     * @param  \Illuminate\Http\Request  $request  The incoming HTTP request instance.
     * @return \Illuminate\View\View  The view displaying the tailor-made form.
     */
    public function tailorMade(HttpRequest $request)
    {
        $cities = City::all();
        $jsonBreadcrumb = $this->jsonBreadcrumb('tailor_made');
        return view('tailor_made.index', compact('cities', 'jsonBreadcrumb'));
    }



    /**
     * Handles a specific functionality within the FormController.
     *
     * @return void
     */
    public function saveTailorMade(TailorMadeRequest $request)
    {
        
        $data = $request->except('_token');
        $data['start_date'] = Carbon::parse($data['start_date'])->format('Y-m-d');
        // dd($data);  
        
        if (isset($data['cities'])) {
            $data['city'] = json_encode($data['cities']);
            unset($data['cities']); 
        }
        $data['phone_number'] = "+" . $data['phone_code'] . "" . $data['phone_number'];
       
        $tailorMade = TailorMade::create($data);
        $receiversMails = Email::getReceiversMails('tailor');
        $receiversMails[] = $tailorMade->email;
        try {
            Email::send($tailorMade, __('messages.tailor_mail_message'), $receiversMails, 'mails.forms', __('messages.tailor_mail_subject') . ' #' . $tailorMade->id);
        } catch (\Throwable $th) {
            //throw $th;
        }
        return redirect()->route('thanks'); 
    }

    /**
     * Display the Contact Us page.
     *
     * This method returns the view for the Contact Us form,
     * allowing users to get in touch with the site administrators.
     *
     * @return \Illuminate\View\View
     */
    public function contactUs()
    {

        return view('contact_us.index');
    }

    /**
     * Handles the submission of the "Contact Us" form.
     *
     * This method receives the HTTP request, extracts all input data except the CSRF token,
     * creates a new Contact record in the database, and redirects back with a success message.
     *
     * @param  \Illuminate\Http\Request  $request  The incoming HTTP request containing form data.
     * @return \Illuminate\Http\RedirectResponse   Redirects back with a success message.
     */
    public function saveContactUs(HttpRequest $request)
    {
        $data = $request->except('_token');
        // dd($data);
        $data['phone_number'] = "+" . $data['code'] . "" . $data['phone'];
        $contact = Contact::create($data);
        try {
            $contactMails = Email::getReceiversMails('contact');
            Email::send($contact, __('messages.contact_mail_message'), $contactMails, 'mails.contact', __('messages.contact_mail_subject') . ' #' . $contact->id);
        } catch (\Throwable $th) {
            //throw $th;
        }
        return redirect()->route('thanks');
    }

    public static function jsonBreadcrumb($type)
    {
        $itemListElement = [];
        if ($type == 'tailor_made') {
            $itemListElement = [
                [
                    'name' => nova_get_setting_translate('tailor_made_title', env('APP_NAME')),
                    'url' => route('tailorMade')
                ]
            ];
        } 

        // dd($itemListElement);
        $Breadcrumb = SchemaHelper::jsonBreadcrumb($itemListElement);
        return $Breadcrumb;
    }

}
