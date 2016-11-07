<template>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="demo-box">
                <h4 class="m-t-0 header-title"><b>All roadmaps</b></h4>
                <p class="text-muted font-13 m-b-20">
                    See all roadmaps and add roadmaps <code>.table</code> to any <code>&lt;table&gt;</code>.
                </p>
                <div class="m-b-30">
                    <button @click="showCreateRoadmapForm" class="btn btn-success waves-effect waves-light">Add new roadmap<i class="mdi mdi-plus-circle-outline"></i></button>
                </div>

                <p class="m-b-30" v-if="roadmaps.length === 0">
                    You have not created any roadmaps.
                </p>

                <table class="table m-0" v-if="roadmaps.length > 0">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="roadmap of roadmaps">
                            <th scope="row">{{ roadmap.id }}</th>
                            <td style="vertical-align: middle;">{{ roadmap.name }}</td>
                            <td style="vertical-align: middle;">{{ roadmap.description }}</td>
                            <td style="vertical-align: middle;">
                                <a class="action-link" @click="edit(roadmap)">
                                    Edit
                                </a>
                            </td>

                            <!-- Delete Button -->
                            <td style="vertical-align: middle;">
                                <a class="action-link text-danger" @click="destroy(roadmap)">
                                    Delete
                                </a>
                            </td>
                            <td>
                                <a :href="allPipelines(roadmap)" class="action-link">Pipeline detail</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- Create Client Modal -->
    <div class="modal fade" id="modal-create-roadmap" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">
                            Create roadmap
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="control-label">Description</label>
                                    <textarea id="description" v-model="createForm.description" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row well">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Step</th>
                                        <th>Procedure</th>
                                        <th>Protocol</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="pipeline of createForm.pipelines">
                                        <td>
                                            <input type="text" id="step" v-model="pipeline.step" class="form-control">
                                        </td>
                                        <td>
                                            <select v-model="pipeline.procedure_id" class="form-control">
                                              <option value="1">poop</option>
                                              <option value="2">blood</option>
                                              <option value="3">Jack</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select v-model="pipeline.protocol_id" class="form-control">
                                              <option value="1">poop</option>
                                              <option value="2">blood</option>
                                              <option value="3">Jack</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" id="time" v-model="pipeline.time" class="form-control">
                                        </td>
                                        <td>
                                            <button role="button" class="btn btn-icon waves-effect btn-danger m-b-5" @click.prevent="removeCreateLine(pipeline)"><i class="mdi mdi-delete"></i></button>
                                        </td>

                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <button role="button" class="btn btn-icon waves-effect btn-default m-b-5" @click.prevent="addCreateLine"><i class="mdi mdi-plus"></i> Add new Line</button>
                                        </td>
                                    </tr>

                                </tfoot>

                            </table>


                        </div>

                    </form>
                </div>

                <!-- Modal Actions -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="button" class="btn btn-primary" @click="store">
                            Create
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-edit-roadmap" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">
                            Edit roadmap
                        </h4>
                </div>

                <div class="modal-body">
                    <!-- Form Errors -->
                    <div class="alert alert-danger" v-if="editForm.errors.length > 0">
                        <p><strong>Whoops!</strong> Something went wrong!</p>
                        <br>
                        <ul>
                            <li v-for="error in editForm.errors">
                                {{ error }}
                            </li>
                        </ul>
                    </div>

                    <!-- Edit Batch Form -->
                    <form role="form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="control-label">Name</label>
                                    <input type="text" id="name" v-model="editForm.name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="control-label">Description</label>
                                    <textarea id="description" v-model="editForm.description" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row well">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Step</th>
                                        <th>Procedure</th>
                                        <th>Protocol</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="pipeline of editForm.pipelines">
                                        <input type="hidden" name="name" v-model="pipeline.id">
                                        <td>
                                            <input type="text" id="step" v-model="pipeline.step" class="form-control">
                                        </td>
                                        <td>
                                            <select v-model="pipeline.procedure_id" class="form-control">
                                              <option value="1">poop</option>
                                              <option value="2">blood</option>
                                              <option value="3">Jack</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select v-model="pipeline.protocol_id" class="form-control">
                                              <option value="1">poop</option>
                                              <option value="2">blood</option>
                                              <option value="3">Jack</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" id="time" v-model="pipeline.time" class="form-control">
                                        </td>
                                        <td>
                                            <button role="button" class="btn btn-icon waves-effect btn-danger m-b-5" @click.prevent="removeEditLine(pipeline)"><i class="mdi mdi-delete"></i></button>
                                        </td>

                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <button role="button" class="btn btn-icon waves-effect btn-default m-b-5" @click.prevent="addEditLine(editForm)"><i class="mdi mdi-plus"></i> Add new Line</button>
                                        </td>
                                    </tr>

                                </tfoot>

                            </table>


                        </div>
                    </form>
                </div>

                <!-- Modal Actions -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="button" class="btn btn-primary" @click="update">
                            Update
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
</template>

<script>
export default {
    data() {
        return {
            roadmaps: {},
            createForm: {
                errors: [],
                name: '',
                description: '',
                pipelines: [{
                    'step': 1,
                    'procedure_id': null,
                    'protocol_id': null,
                    'time': null
                }]
            },
            editForm: {
                errors: [],
                id: null,
                name: '',
                description: '',
                pipelines: [{
                    'id': null,
                    'step': null,
                    'procedure_id': null,
                    'protocol_id': null,
                    'time': null
                }]
            }
        }
    },
    mounted() {
        this.prepareComponent();
    },
    methods: {
        allPipelines(roadmap) {
            return "/roadmaps/" + roadmap.id + "/pipelines";
        },
        prepareComponent() {
            this.getRoadmaps();
            $('#modal-create-roadmap').on('shown.bs.modal', () => {
                $('#create-roadmap-name').focus();
            });
            $('#modal-edit-roadmap').on('shown.bs.modal', () => {
                $('#edit-roadmap-name').focus();
            });
        },
        addCreateLine() {
            this.createForm.pipelines.push({
                'step': this.createForm.pipelines.length + 1,
                'procedure_id': null,
                'protocol_id': null,
                'time': null
            });
        },
        addEditLine() {
            this.editForm.pipelines.push({
                'step': this.editForm.pipelines.length + 1,
                'procedure_id': null,
                'protocol_id': null,
                'time': null
            });
        },
        removeCreateLine(pipeline) {
            let index = this.createForm.pipelines.indexOf(pipeline);
            this.createForm.pipelines.splice(index, 1);
        },
        removeEditLine(pipeline) {
            let index = this.editForm.pipelines.indexOf(pipeline);
            this.editForm.pipelines.splice(index, 1);
        },
        getRoadmaps() {
            this.$http.get('/api/roadmaps')
                .then(response => {
                    this.roadmaps = response.body.data;
                });
        },
        showCreateRoadmapForm() {
            $('#modal-create-roadmap').modal('show');
        },
        store() {
            this.persistClient(
                'post', '/api/roadmaps', this.createForm, '#modal-create-roadmap'
            );
        },
        edit(roadmap) {
            this.editForm.id = roadmap.id;
            this.editForm.name = roadmap.name;
            this.editForm.description = roadmap.description;
            this.editForm.pipelines = roadmap.pipelines
            $('#modal-edit-roadmap').modal('show');
        },
        update() {
            this.persistClient(
                'put', '/api/roadmaps/' + this.editForm.id, this.editForm, '#modal-edit-roadmap'
            );
        },
        persistClient(method, uri, form, modal) {
            form.errors = [];
            this.$http[method](uri, form)
                .then(response => {
                    this.getRoadmaps();
                    form.name = '';
                    form.description = '';
                    form.pipelines = [{
                        'step': 1,
                        'procedure_id': null,
                        'protocol_id': null,
                        'time': null
                    }];
                    $(modal).modal('hide');
                })
                .catch(response => {
                    if (typeof response.data === 'object') {
                        form.errors = _.flatten(_.toArray(response.data));
                    } else {
                        form.errors = ['Something went wrong, please try again']
                    }
                });
        },
        destroy(roadmap) {
            this.$http.delete('/api/roadmaps/' + roadmap.id)
                .then(response => {
                    this.getRoadmaps();
                });
        }
    }
}
</script>
<style>
.action-link {
    cursor: pointer;
}
</style>
