<?php

namespace App\Http\Controllers;

use App\Competence;
use Illuminate\Http\Request;
use App\Cv;
use App\Experience;
use App\Formation;
use App\Http\Requests\cvRequest;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;

class CvController extends Controller
{

    // Middleware
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Lister les Cvs
    public function index(){
        if(Auth::user()->is_admin)
            $listCvs = Cv::all();
        else
            $listCvs = Auth::user()->cvs;
        // Auth::user()->cvs; || Cv::where('user_id', Auth::user()->id)->get(); // get just data related to the current user
        // Cv::all(); Get all data

        return view('cv.index', ['cvs' => $listCvs]);
    }

    // Affiche le formulaire de creation de cv
    public function create(){
        return view('cv.create');
    }

    // Enregistrer un Cv
    public function store(cvRequest $request){
        $cv = new Cv();
        $cv->titre = $request->input('titre');
        $cv->presentation = $request->input('presentation');
        if($request->hasFile('photo'))
            $cv->photo = $request->photo->store('images');
        $cv->user_id = Auth::user()->id;

        $cv->save();

        session()->flash('success', 'Le cv a ete cree avec succes !!');

        return redirect('cvs');
    }

    // Recuperer un Cv puis de le mettre dans un formulaire
    public function edit($id){
        $cv = Cv::find($id);
        $this->authorize('update', $cv);
        return view('cv.edit', [ 'cv' => $cv ] );
    }

    // Modifier un Cv
    public function update(cvRequest $req, $id){
        $cv = Cv::find($id);

        $cv->titre = $req->input('titre');
        $cv->presentation = $req->input('presentation');
        if($req->hasFile('photo'))
            $cv->photo = $req->photo->store('images');
        $cv->save();

        return redirect('cvs');
    }

    // Supprimer un Cv
    public function destroy(Request $req, $id){
        $cv = Cv::find($id);
        $this->authorize('delete', $cv);
        $cv->delete();
        return redirect('cvs');
    }

    public function show($id){
        return view('cv.show', ['id' => $id]);
    }

    // Get All Data
    public function getData($id){
        $cv = CV::find($id);
        $experiences = $cv->experience()->orderby('debut','desc')->get();
        $formations = $cv->formation()->orderby('debut','desc')->get();
        $competences = $cv->competence()->orderby('updated_at','desc')->get();
        return Response()->json([
            'experiences' => $experiences,
            'formations' => $formations,
            'competences' => $competences
        ]);
    }

    // Gestion d'Experiences
    public function addExperience(Request $req)
    {
        $exper = new Experience;
        $exper->titre = $req->titre;
        $exper->body = $req->body;
        $exper->debut = $req->debut;
        $exper->fin = $req->fin;
        $exper->cv_id = $req->cv_id;

        $exper->save();

        return Response()->json(['etat'=> true, 'id' => $exper->id]);
    }

    public function updateExperience(Request $req)
    {
        $exper = Experience::find($req->id);
        $exper->titre = $req->titre;
        $exper->body = $req->body;
        $exper->debut = $req->debut;
        $exper->fin = $req->fin;
        $exper->cv_id = $req->cv_id;

        $exper->save();

        return Response()->json(['etat'=> true]);
    }

    public function deleteExperience($id)
    {
        $exper = Experience::find($id);
        $exper->delete();
        return Response()->json(['etat'=> true]);
    }

    // Gestion de Formation
    public function addFormation(Request $req)
    {
        $formation = new Formation();
        $formation->titre = $req->titre;
        $formation->description = $req->description;
        $formation->debut = $req->debut;
        $formation->fin = $req->fin;
        $formation->cv_id = $req->cv_id;

        $formation->save();

        return Response()->json(['etat'=> true, 'id' => $formation->id]);
    }

    public function updateFormation(Request $req)
    {
        $formation = Formation::find($req->id);
        $formation->titre = $req->titre;
        $formation->description = $req->description;
        $formation->debut = $req->debut;
        $formation->fin = $req->fin;
        $formation->cv_id = $req->cv_id;

        $formation->save();

        return Response()->json(['etat'=> true]);
    }

    public function deleteFormation($id)
    {
        $formation = Formation::find($id);
        $formation->delete();
        return Response()->json(['etat'=> true]);
    }

    // Gestion de Competence
    public function addCompetence(Request $req)
    {
        $competence = new Competence();
        $competence->titre = $req->titre;
        $competence->description = $req->description;
        $competence->cv_id = $req->cv_id;

        $competence->save();

        return Response()->json(['etat'=> true, 'id' => $competence->id]);
    }

    public function updateCompetence(Request $req)
    {
        $competence = Competence::find($req->id);
        $competence->titre = $req->titre;
        $competence->description = $req->description;
        $competence->cv_id = $req->cv_id;

        $competence->save();

        return Response()->json(['etat'=> true]);
    }

    public function deleteCompetence($id)
    {
        $competence = Competence::find($id);
        $competence->delete();
        return Response()->json(['etat'=> true]);
    }
}
