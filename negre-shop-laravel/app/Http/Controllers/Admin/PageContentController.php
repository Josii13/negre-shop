<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageContentController extends Controller
{
    /**
     * Display a listing of the pages.
     */
    public function index()
    {
        $pages = [
            'home' => 'Page d\'Accueil',
            'peinture' => 'Page Peinture',
            'design' => 'Page Design',
            'gallery' => 'Page Gallery',
            'contact' => 'Page Contact',
            'marques' => 'Page Marques',
        ];

        return view('admin.developer.page-contents.index', compact('pages'));
    }

    /**
     * Show the form for editing the specified page.
     */
    public function edit($page)
    {
        $validPages = ['home', 'peinture', 'design', 'gallery', 'contact', 'marques'];

        if (!in_array($page, $validPages)) {
            abort(404, 'Page introuvable');
        }

        // Récupérer le contenu de la page
        $content = DB::table('page_' . $page . '_contents')->first();

        // Si aucun contenu n'existe, retourner un objet vide
        if (!$content) {
            $content = (object)[];
        }

        return view('admin.developer.page-contents.edit', compact('page', 'content'));
    }

    /**
     * Update the specified page content in storage.
     */
    public function update(Request $request, $page)
    {
        $validPages = ['home', 'peinture', 'design', 'gallery', 'contact', 'marques'];

        if (!in_array($page, $validPages)) {
            abort(404, 'Page introuvable');
        }

        $tableName = 'page_' . $page . '_contents';

        // Récupérer toutes les données sauf _token et _method
        $data = $request->except(['_token', '_method']);
        $data['updated_at'] = now();

        // Vérifier si un enregistrement existe déjà
        $exists = DB::table($tableName)->count() > 0;

        if ($exists) {
            // Mise à jour
            DB::table($tableName)->update($data);
        } else {
            // Création
            $data['created_at'] = now();
            DB::table($tableName)->insert($data);
        }

        return redirect()
            ->route('admin.developer.page-contents.edit', $page)
            ->with('success', 'Contenu de la page mis à jour avec succès !');
    }
}

