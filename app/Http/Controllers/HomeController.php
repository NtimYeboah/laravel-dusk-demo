<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Jobs\AddContactJob;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contacts = Contact::paginate();

        return view('home', compact('contacts'));
    }

    /**
     * Store a contact
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            dispatch(new AddContactJob($request));
        } catch (\Exception $e) {
            logger()->error('An error occurred whiles creating a contact', [$e->getMessage()]);

            flash()->error('An error occurred whiles creating a contact, please try again');

            return back()->withInput();
        }

        flash()->success('Contact successfully created');

        return redirect()->route('home.index');
    }

    /**
     * Show a view for editing a contact
     *
     * @param Contact $contact
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Contact $contact)
    {
        return view('edit', compact('contact'));
    }

    /**
     * Update a contact
     *
     * @param Request $request
     * @param Contact $contact
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Contact $contact)
    {
        try {
            dispatch(new AddContactJob($request, $contact));
        } catch (\Exception $e) {
            logger()->error('An error occurred whiles updating a contact', [$e->getMessage()]);

            flash()->error('An error occurred whiles updating a contact, please try again');

            return back()->withInput();
        }

        flash()->success('Contact successfully updated');

        return redirect()->route('home.index');
    }
}
