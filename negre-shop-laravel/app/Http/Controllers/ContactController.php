<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\SiteSetting;
use App\Http\Requests\StoreContactRequest;

class ContactController extends Controller
{
    /**
     * Afficher la page contact
     */
    public function index()
    {
        // Récupérer les informations de contact depuis les paramètres du site
        $contactInfo = [
            'address' => SiteSetting::get('contact_address', 'Cocody, Riviera Abatta<br>Abidjan, Côte d\'Ivoire'),
            'email' => SiteSetting::get('contact_email', 'fredericnda.ci@gmail.com'),
            'phone' => SiteSetting::get('contact_phone', '+225 07 68 29 89 65'),
            'hours' => SiteSetting::get('contact_hours', 'Lundi - Vendredi: 9h - 18h<br>Sur rendez-vous uniquement'),
        ];

        return view('contact', compact('contactInfo'));
    }

    /**
     * Traiter le formulaire de contact
     */
    public function store(StoreContactRequest $request)
    {
        Contact::create($request->validated());

        return back()->with('success', 'Merci pour votre message ! Nous vous contacterons bientôt.');
    }
}

