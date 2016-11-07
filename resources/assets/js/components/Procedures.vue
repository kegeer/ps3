<template>
<div class="container">
    <div class="card-box">
        <h4 class="m-t-0 header-title"><b>All Projects</b></h4>
        <p class="text-muted font-13 m-b-20">
            See all procedures and add procedures.
        </p>
        <div class="m-b-30">
            <button @click="showCreateProcedureForm" class="btn btn-success waves-effect waves-light">Add new procedure<i class="mdi mdi-plus-circle-outline"></i></button>
            <button @click="showCreateProtocolForm" class="btn btn-success waves-effect waves-light">Add new protocol<i class="mdi mdi-plus-circle-outline"></i></button>
        </div>
        <p class="m-b-30" v-if="procedures.length === 0">
            You have not created any procedure.
        </p>

        <ul class="nav nav-tabs navtab-bg nav-justified" v-if="procedures.length > 0">
            <li v-for="procedure of procedures">
                <a :href="procedureId(procedure)" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                    <span class="hidden-xs">{{ procedure.name }}</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" :class="currentTab(procedure)" v-for="procedure of procedures" :id="procedureId(procedure)">
                <procedure-samples :procedure="procedure.id"></procedure-samples>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-create-procedure" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">
                            Create procedure
                        </h4>
                </div>

                <div class="modal-body">
                    <!-- Form Errors -->
                    <div class="alert alert-danger" v-if="createForm.errors.length > 0">
                        <p><strong>Whoops!</strong> Something went wrong!</p>
                        <br>
                        <ul>
                            <li v-for="error in createForm.errors">
                                {{ error }}
                            </li>
                        </ul>
                    </div>

                    <!-- Create Batch Form -->
                    <form role="form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="control-label">Name</label>
                                    <input type="text" id="name" v-model="createForm.name" class="form-control">
                                </div>
                            </div>
                        </div>


                    </form>
                </div>

                <!-- Modal Actions -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="button" class="btn btn-primary" @click="storeProcedure">
                            Create
                        </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-create-protocol" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">
                            Create procedure
                        </h4>
                </div>

                <div class="modal-body">
                    <!-- Form Errors -->
                    <div class="alert alert-danger" v-if="createForm.errors.length > 0">
                        <p><strong>Whoops!</strong> Something went wrong!</p>
                        <br>
                        <ul>
                            <li v-for="error in createForm.errors">
                                {{ error }}
                            </li>
                        </ul>
                    </div>

                    <!-- Create Batch Form -->
                    <form role="form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="procedure_id" class="control-label">Procedure</label>
                                    <select v-model="createProtocolForm.procedure_id" id="procedure_id" class="form-control">
                                          <option value="1">poop</option>
                                          <option value="2">blood</option>
                                          <option value="3">Jack</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pname" class="control-label">Name</label>
                                    <input type="text" id="pname" v-model="createProtocolForm.name" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="control-label">Description</label>
                                    <input type="text" id="description" v-model="createProtocolForm.description" class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="content" class="control-label">Content</label>
                                    <input type="text" id="content" v-model="createProtocolForm.content" class="form-control">
                                </div>
                            </div>
                        </div>



                    </form>
                </div>

                <!-- Modal Actions -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="button" class="btn btn-primary" @click="storeProtocol">
                            Create
                        </button>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>

import procedureSamples from './ProcedureSamples.vue';
export default {
    data() {
        return {
            currentTab: null,
            procedures: {},
            createForm: {
                errors: [],
                name: ''
            },
            createProtocolForm: {
                errors: [],
                procedure_id: null,
                name: '',
                description: '',
                content: ''
            }
        }

    },
    components: {
        'procedure-samples': procedureSamples
    },
    mounted() {
        this.prepareComponent();
    },
    methods: {
        procedureId(procedure) {
            return '#procedure' + procedure.id;
        },
        prepareComponent() {
            this.getProcedures();
            $('#modal-create-procedure').on('shown.bs.modal', () => {
                $('#create-procedure-name').focus();
            });
            $('#modal-create-protocol').on('shown.bs.modal', () => {
                $('#create-protocol-name').focus();
            });
        },
        showTab(procedure) {
            this.currentTab = procedure.id;
        },
        currentTab(procedure) {
            return procedure.id === this.currentTab ? 'active' : '';
        },
        showCreateProcedureForm() {
            $('#modal-create-procedure').modal('show');
        },
        showCreateProtocolForm() {
            $('#modal-create-protocol').modal('show');
        },
        getProcedures() {
            this.$http.get('/api/procedures')
            .then(response => {
                this.procedures = response.body.data
            });
        },
        storeProcedure() {
            this.$http.post('/api/procedures', this.createForm)
            .then(response => {
                this.getProcedures();
                this.createForm.name = '';
                $('#modal-create-procedure').modal('hide');
            })
            .catch(response => {
                if (typeof response.data === 'object') {
                    form.errors = _.flatten(_.toArray(response.data));
                } else {
                    form.errors = ['Something went wrong, please try again']
                }
            })
        },
        storeProtocol() {
            this.$http.post('/api/protocols', this.createProtocolForm)
            .then(response => {
                this.createForm.procedure_id = null;
                this.createForm.name = '';
                this.createForm.description = '';
                this.createForm.content = '';
                $('#modal-create-protocol').modal('hide');
            })
            .catch(response => {
                if (typeof response.data === 'object') {
                    form.errors = _.flatten(_.toArray(response.data));
                } else {
                    form.errors = ['Something went wrong, please try again']
                }
            })
        }
    }
}
</script>
