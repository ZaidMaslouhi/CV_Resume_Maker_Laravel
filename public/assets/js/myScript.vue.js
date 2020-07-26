
Vue.use(VeeValidate);

var app = new Vue({
    el: '#app',
    data: {
        url : window.laravel.url,
        id : window.laravel.idCv,
        experiences : [],
        formations : [],
        competences : [],
        experience : {
            cv_id: window.laravel.idCv,
        },
        formation : {
            cv_id: window.laravel.idCv,
        },
        competence : {
            cv_id: window.laravel.idCv,
        },
        success: {
            experience: false,
            formation: false,
            competence: false
        },
        error:{
            experience: false,
            formation: false,
            competence: false
        },
        edit:{
            experience: false,
            formation: false,
            competence: false
        }
    },
    mounted: function(){
        this.getData();

    },
    methods: {
        getData: function(){
            axios.get(this.url + 'getData/' + this.id)
            .then((response) => {
                this.experiences = response.data.experiences;
                this.formations = response.data.formations;
                this.competences = response.data.competences;
            })
            .catch((error)=>{
                console.log(error);
            });
        },
        // Module Experience
        addExperience: function(){
            axios.post(this.url + 'addexperience', this.experience)
                .then((response) => {
                    if(response.data.etat){
                        this.success.experience = true;
                        this.experience.id = response.data.id;
                        this.experiences.unshift(this.experience);
                        this.experience = {
                            cv_id: window.laravel.idCv
                        }
                    }
                })
                .catch((error)=>{
                    console.log(error);
                    this.error.experience = true;
            });
        },
        editExperience: function(){
            axios.put(this.url + 'updateexperience', this.experience)
                .then((response) => {
                    if(response.data.etat){
                        this.success.experience = true;
                        this.experience = {
                            cv_id: window.laravel.idCv
                        }
                        this.edit.experience = false;
                    }
                })
                .catch((error)=>{
                    console.log(error);
                    this.error.experience = true;
            });
        },
        deleteexperience: function(experience){
            Swal.fire({
                    title: 'Etes vous sur ?',
                    text: "De supprimer cette experience!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, supprimer!'
                }).then((result) => {
                    if (result.value) {
                        Swal.fire('Supprimé!', 'Votre expérience a été supprimée.', 'success')
                        axios.delete(this.url + 'deleteexperience/' + experience.id)
                            .then((response) => {
                                if(response.data.etat){
                                    let index = this.experiences.indexOf(experience);
                                    this.experiences.splice(index, 1);
                                    this.success.experience = true;
                                }
                            })
                            .catch((error)=>{
                                console.log(error);
                                this.error.experience = true;
                        });
                    }
                })
            },
            // Module Formation
            addFormation: function(){
                axios.post(this.url + 'addFormation', this.formation)
                    .then((response) => {
                        if(response.data.etat){
                            this.success.formation = true;
                            this.formation.id = response.data.id;
                            this.formations.unshift(this.formation);
                            this.formation = {
                                cv_id: window.laravel.idCv
                            }
                        }
                    })
                    .catch((error)=>{
                        console.log(error);
                        this.error.formation = true;
                });
            },
            editFormation: function(){
                axios.put(this.url + 'updateFormation', this.formation)
                    .then((response) => {
                        if(response.data.etat){
                            this.success.formation = true;
                            this.formation = {
                                cv_id: window.laravel.idCv
                            }
                            this.edit.formation = false;
                        }
                    })
                    .catch((error)=>{
                        console.log(error);
                        this.error.formation = true;
                });
            },
            deleteFormation: function(formation){
                Swal.fire({
                        title: 'Etes vous sur ?',
                        text: "De supprimer cette formation!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oui, supprimer!'
                    }).then((result) => {
                        if (result.value) {
                            Swal.fire('Supprimé!', 'Votre formation a été supprimée.', 'success')
                            axios.delete(this.url + 'deleteFormation/' + formation.id)
                                .then((response) => {
                                    if(response.data.etat){
                                        let index = this.formations.indexOf(formation);
                                        this.formations.splice(index, 1);
                                        this.success.formation = true;
                                    }
                                })
                                .catch((error)=>{
                                    console.log(error);
                                    this.error.formation = true;
                            });
                        }
                    })
            },

            // Module Competence
            addCompetence: function(){
                axios.post(this.url + 'addCompetence', this.competence)
                    .then((response) => {
                        if(response.data.etat){
                            this.success.competence = true;
                            this.competence.id = response.data.id;
                            this.competences.unshift(this.competence);
                            this.competence = {
                                cv_id: window.laravel.idCv
                            }
                        }
                    })
                    .catch((error)=>{
                        console.log(error);
                        this.error.competence = true;
                });
            },
            editCompetence: function(){
                axios.put(this.url + 'updateCompetence', this.competence)
                    .then((response) => {
                        if(response.data.etat){
                            this.success.competence = true;
                            this.competence = {
                                cv_id: window.laravel.idCv
                            }
                            this.edit.competence = false;
                        }
                    })
                    .catch((error)=>{
                        console.log(error);
                        this.error.competence = true;
                });
            },
            deleteCompetence: function(competence){
                Swal.fire({
                        title: 'Etes vous sur ?',
                        text: "De supprimer cette competence!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oui, supprimer!'
                    }).then((result) => {
                        if (result.value) {
                            Swal.fire('Supprimé!', 'Votre competence a été supprimée.', 'success')
                            axios.delete(this.url + 'deleteCompetence/' + competence.id)
                                .then((response) => {
                                    if(response.data.etat){
                                        let index = this.competences.indexOf(competence);
                                        this.competences.splice(index, 1);
                                        this.success.competence = true;
                                    }
                                })
                                .catch((error)=>{
                                    console.log(error);
                                    this.error.competence = true;
                            });
                        }
                    })
            },

            validateForm(scope) {
                if(scope == "formExperience"){
                    this.$validator.validateAll(scope).then((result)=>{
                        if(result){
                            this.addExperience();
                            $('#addexper').modal('hide');
                        }
                    });
                }else if(scope == "formFormation"){
                        this.$validator.validateAll(scope).then((result)=>{
                            if(result){
                                this.addFormation();
                                $('#addFormation').modal('hide');
                            }
                        });
                }else{
                    this.$validator.validateAll(scope).then((result)=>{
                        if(result){
                            this.addCompetence();
                            $('#addCompetence').modal('hide');
                        }
                    });
                }
            }
        }
    });

