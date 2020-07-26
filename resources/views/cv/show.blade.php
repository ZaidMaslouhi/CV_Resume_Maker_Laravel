@extends('layouts.app')


@section('content')

<div class="container" id="app">
    <div class="row">
        <div class="col-md-10 mx-auto">
            {{-- Experience --}}
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-10">
                            <h3 class="panel-title text-primary">Experience</h3>
                            <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="success.experience" @click="success.experience=false">
                                l'operation a été avec succes !
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="error.experience" @click="error.experience=false">
                                Erreur l'experience !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-2 text-right">
                            <button class="btn btn-success" data-toggle="modal" data-target="#addexper">Ajouter</button>
                            {{-- Modal / Alert --}}
                            <div class="modal fade" id="addexper" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <form @submit.prevent="validateForm('formExperience')" data-vv-scope="formExperience">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle" v-if="!edit.experience">Ajouter un Experience</h5>
                                            <h5 class="modal-title" id="exampleModalCenterTitle" v-else>Modifier un Experience</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group text-left" >
                                                <label for="titre">Titre</label>
                                                <input v-validate="'required'" type="text" class="form-control" :class="{'is-invalid': errors.has('formExperience.titre')}" id="titre" name="titre" v-model="experience.titre">
                                                <div class="invalid-feedback" v-show="errors.has('formExperience.titre')">@{{ errors.first('formExperience.titre') }}</div><br>
                                            </div>
                                                {{--  --}}
                                            <div class="form-group text-left">
                                                <label for="body">Body</label>
                                                <textarea v-validate="'required|min:5|max:255'" class="form-control" id="body" name="body" v-model="experience.body"  :class="{'is-invalid': errors.has('formExperience.body')}"></textarea>
                                                    <div class="invalid-feedback" v-show="errors.has('formExperience.body')">@{{ errors.first('formExperience.body') }}</div>
                                            </div>
                                                {{--  --}}
                                            <div class="form-group text-left">
                                                <label for="debut">Date de Debut</label>
                                                <input type="date" class="form-control" id="debut" name="debut" v-model="experience.debut"><br>
                                                <label for="fin">Date de Fin</label>
                                                <input type="date" class="form-control" id="fin" name="fin" v-model="experience.fin">
                                            </div>
                                            {{-- </div> --}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-primary" v-if="!edit.experience" >Ajouter</button>
                                            <button type="submit" class="btn btn-primary" data-dismiss="modal" @click="editExperience()" v-else >Modifier</button>
                                        </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body mb-2" v-for="exper in experiences">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="float-right">
                                <button class="btn btn-info" @click="experience=exper;edit.experience=true;" data-toggle="modal" data-target="#addexper">Editer</button>
                                <button class="btn btn-outline-danger" @click="deleteexperience(exper)">Supprimer</button>
                            </div>
                            <h4>@{{ exper.titre }}</h4>
                            <p>@{{ exper.body }}</p>
                            <small class="text-secondary">@{{ exper.debut }} - @{{ exper.fin }}</small>
                        </li>
                    </ul>
                </div>
            </div>

                <hr>
            {{-- Formation --}}
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-10">
                            <h3 class="panel-title text-primary">Formation</h3>
                            <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="success.formation" @click="success.formation=false">
                                l'operation a été avec succes !
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="error.formation" @click="error.formation=false">
                                Erreur Formation !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-2 text-right">
                            <button class="btn btn-success" data-toggle="modal" data-target="#addFormation">Ajouter</button>
                            {{-- Modal / Alert --}}
                            <div class="modal fade" id="addFormation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <form @submit.prevent="validateForm('formFormation')" data-vv-scope="formFormation">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle" v-if="!edit.Formation">Ajouter un Formation</h5>
                                            <h5 class="modal-title" id="exampleModalCenterTitle" v-else>Modifier un Formation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group text-left" >
                                                <label for="titre">Titre</label>
                                                <input v-validate="'required'" type="text" class="form-control" :class="{'is-invalid': errors.has('formFormation.titre')}" id="titre" name="titre" v-model="formation.titre">
                                                <div class="invalid-feedback" v-show="errors.has('formFormation.titre')">@{{ errors.first('formFormation.titre') }}</div><br>
                                            </div>
                                                {{--  --}}
                                            <div class="form-group text-left">
                                                <label for="description">Description</label>
                                                <textarea v-validate="'required|min:5|max:255'" class="form-control" id="description" name="description" v-model="formation.description"  :class="{'is-invalid': errors.has('formFormation.description')}"></textarea>
                                                    <div class="invalid-feedback" v-show="errors.has('formFormation.description')">@{{ errors.first('formFormation.description') }}</div>
                                            </div>
                                                {{--  --}}
                                            <div class="form-group text-left">
                                                <label for="debut">Date de Debut</label>
                                                <input type="date" class="form-control" id="debut" name="debut" v-model="formation.debut"><br>
                                                <label for="fin">Date de Fin</label>
                                                <input type="date" class="form-control" id="fin" name="fin" v-model="formation.fin">
                                            </div>
                                            {{-- </div> --}}
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-primary" v-if="!edit.Formation">Ajouter</button>
                                            <button type="submit" class="btn btn-primary" data-dismiss="modal" @click="editFormation()" v-else >Modifier</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body mb-2" v-for="formt in formations">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="float-right">
                                <button class="btn btn-info" @click="formation=formt;edit.Formation=true;" data-toggle="modal" data-target="#addFormation">Editer</button>
                                <button class="btn btn-outline-danger" @click="deleteFormation(formt)">Supprimer</button>
                            </div>
                            <h4>@{{ formt.titre }}</h4>
                            <p>@{{ formt.description }}</p>
                            <small class="text-secondary">@{{ formt.debut }} - @{{ formt.fin }}</small>
                        </li>
                    </ul>
                </div>
            </div>

                <hr>

            {{-- Competence --}}
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-10">
                            <h3 class="panel-title text-primary">Competence</h3>
                            <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="success.competence" @click="success.competence=false">
                                l'operation a été avec succes !
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="error.competence" @click="error.competence=false">
                                Erreur Competence !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-2 text-right">
                            <button class="btn btn-success" data-toggle="modal" data-target="#addCompetence">Ajouter</button>
                            {{-- Modal / Alert --}}
                            <div class="modal fade" id="addCompetence" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <form @submit.prevent="validateForm('formCompetence')" data-vv-scope="formCompetence">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle" v-if="!edit.competence">Ajouter un Competence</h5>
                                            <h5 class="modal-title" id="exampleModalCenterTitle" v-else>Modifier un Competence</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group text-left" >
                                                <label for="titre">Titre</label>
                                                <input v-validate="'required'" type="text" class="form-control" :class="{'is-invalid': errors.has('formCompetence.titre')}" id="titre" name="titre" v-model="competence.titre">
                                                <div class="invalid-feedback" v-show="errors.has('formCompetence.titre')">@{{ errors.first('formCompetence.titre') }}</div><br>
                                            </div>
                                                {{--  --}}
                                            <div class="form-group text-left">
                                                <label for="description">Description</label>
                                                <textarea v-validate="'required|min:5|max:255'" class="form-control" id="description" name="description" v-model="competence.description"  :class="{'is-invalid': errors.has('formCompetence.description')}"></textarea>
                                                    <div class="invalid-feedback" v-show="errors.has('formCompetence.description')">@{{ errors.first('formCompetence.description') }}</div>
                                            </div>
                                            {{-- </div> --}}
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-primary" v-if="!edit.competence">Ajouter</button>
                                            <button type="submit" class="btn btn-primary" data-dismiss="modal" @click="editCompetence()" v-else >Modifier</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body mb-2" v-for="compt in competences">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="float-right">
                                <button class="btn btn-info" @click="competence=compt;edit.competence=true;" data-toggle="modal" data-target="#addCompetence">Editer</button>
                                <button class="btn btn-outline-danger" @click="deleteCompetence(compt)">Supprimer</button>
                            </div>
                            <h4>@{{ compt.titre }}</h4>
                            <p>@{{ compt.description }}</p>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>





@endsection


@section('javascripts')
    <script src="{{ asset('assets/js/vue.min.js') }}"></script>
    <script src="{{ asset('assets/js/veeValidation.js') }}"></script>
    <script src="{{ asset('assets/js/axios.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        // For get the url and id dynamically
        window.laravel = {!! json_encode([
            'csrfToken'     => csrf_token(),
            'idCv'  => $id,
            'url'           => '/'
        ]) !!};
    </script>
    <script src="{{ asset('assets/js/myScript.vue.js') }}"></script>


@endsection
