<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Afficher la page gallery/workshop
     */
    public function index()
    {
        // Récupérer les activités par onglet
        $atelierActivities = Activity::active()
            ->byTab('atelier')
            ->ordered()
            ->get();

        $activities = Activity::active()
            ->byTab('activites')
            ->ordered()
            ->get();

        $evenements = Activity::active()
            ->byTab('evenements')
            ->ordered()
            ->get();

        $podcasts = Activity::active()
            ->byTab('podcasts')
            ->ordered()
            ->get();

        return view('gallery', compact('atelierActivities', 'activities', 'evenements', 'podcasts'));
    }
}

