<template>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="demo-box">
                <h4 class="m-t-0 header-title"><b>All tasks</b></h4>
                <p class="text-muted font-13 m-b-20">
                    See all tasks and add tasks <code>.table</code> to any <code>&lt;table&gt;</code>.
                </p>
                <div class="m-b-30">
                    <button @click="showCreateTaskForm" class="btn btn-success waves-effect waves-light">Add <i class="mdi mdi-plus-circle-outline"></i></button>
                </div>

                <p class="m-b-30" v-if="tasks.length === 0">
                    You have not created any tasks.
                </p>

                <table class="table m-0" v-if="tasks.length > 0">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Roadmap</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="task of tasks">
                            <th scope="row">{{ task.id }}</th>
                            <td style="vertical-align: middle;">{{ task.name }}</td>
                            <td style="vertical-align: middle;">{{ task.start }}</td>
                            <td style="vertical-align: middle;">{{ task.end }}</td>
                            <td style="vertical-align: middle;">{{ task.roadmap_id }}</td>
                            <td style="vertical-align: middle;">
                                <a class="action-link" @click="edit(task)">
                                    Edit
                                </a>
                            </td>

                            <!-- Delete Button -->
                            <td style="vertical-align: middle;">
                                <a class="action-link text-danger" @click="destroy(task)">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- Create Client Modal -->
    <div class="modal fade" id="modal-create-task" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">
                            Create task
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
                                    <label for="name" class="control-label">Name</label>
                                    <input type="text" id="name" v-model="createForm.name" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="roadmap_id" class="control-label">Roadmap</label>
                                    <select v-model="createForm.roadmap_id" id="roadmap_id" class="form-control">
                                          <option value="1">poop</option>
                                          <option value="2">blood</option>
                                          <option value="3">Jack</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start" class="control-label">start</label>
                                    <input type="date" id="start" v-model="createForm.start" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end" class="control-label">end</label>
                                    <input type="date" id="end" v-model="createForm.end" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exp_manager" class="control-label">Manager</label>
                                    <select v-model="createForm.exp_manager" id="exp_manager" class="form-control">
                                          <option value="1">poop</option>
                                          <option value="2">blood</option>
                                          <option value="3">Jack</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="info_manager" class="control-label">Manager</label>
                                    <select v-model="createForm.info_manager" id="info_manager" class="form-control">
                                          <option value="1">poop</option>
                                          <option value="2">blood</option>
                                          <option value="3">Jack</option>
                                    </select>
                                </div>
                            </div>
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
    <div class="modal fade" id="modal-edit-task" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">
                            Edit task
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
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="control-label">Name</label>
                                    <input type="text" id="name" v-model="editForm.name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="roadmap_id" class="control-label">Roadmap</label>
                                    <select v-model="editForm.roadmap_id" id="roadmap_id" class="form-control">
                                          <option value="1">poop</option>
                                          <option value="2">blood</option>
                                          <option value="3">Jack</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start" class="control-label">start</label>
                                    <input type="date" id="start" v-model="editForm.start" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end" class="control-label">end</label>
                                    <input type="date" id="end" v-model="editForm.end" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exp_manager" class="control-label">Manager</label>
                                    <select v-model="editForm.exp_manager" id="exp_manager" class="form-control">
                                          <option value="1">poop</option>
                                          <option value="2">blood</option>
                                          <option value="3">Jack</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="info_manager" class="control-label">Manager</label>
                                    <select v-model="editForm.info_manager" id="info_manager" class="form-control">
                                          <option value="1">poop</option>
                                          <option value="2">blood</option>
                                          <option value="3">Jack</option>
                                    </select>
                                </div>
                            </div>
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
    props: [
        'project'
    ],
    data() {
        return {
            tasks: {},
            createForm: {
                errors: [],
                project_id: this.project,
                name: '',
                start: '',
                end: '',
                roadmap_id: null,
                exp_manager: null,
                info_manager: null
            },
            editForm: {
                errors: [],
                id: null,
                name: '',
                start: '',
                end: '',
                roadmap_id: null,
                exp_manager: null,
                info_manager: null
            }
        }
    },
    mounted() {
        this.prepareComponent();
    },
    methods: {
        prepareComponent() {
            this.getTasks(this.project);
            $('#modal-create-task').on('shown.bs.modal', () => {
                $('#create-task-name').focus();
            });
            $('#modal-edit-task').on('shown.bs.modal', () => {
                $('#edit-task-name').focus();
            });
        },

        getTasks(project) {
            this.$http.get('/api/projects/' + project + '/tasks')
                .then(response => {
                    this.tasks = response.body.data;
            });
        },
        showCreateTaskForm() {
            $('#modal-create-task').modal('show');
        },
        store() {
            this.persistClient(
                'post', '/api/tasks', this.createForm, '#modal-create-task'
            );
        },
        edit(task) {
            this.editForm.id = task.id;
            this.editForm.name = task.name;
            this.editForm.start = task.start;
            this.editForm.end = task.end;
            this.editForm.roadmap_id = task.roadmap_id;
            this.editForm.exp_manager = task.exp_manager;
            this.editForm.info_manager = task.info_manager;
            $('#modal-edit-task').modal('show');
        },
        update() {
            this.persistClient(
                'put', '/api/tasks/' + this.editForm.id, this.editForm, '#modal-edit-task'
            );
        },
        persistClient(method, uri, form, modal) {
            form.errors = [];
            this.$http[method](uri, form)
                .then(response => {
                    this.getTasks(this.project);
                    form.name= '';
                    form.start= '';
                    form.end= '';
                    form.roadmap_id= null;
                    form.exp_manager= null;
                    form.info_manager= null;
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
        destroy(task) {
            this.$http.delete('/api/tasks/' + task.id)
                .then(response => {
                    this.getTasks(this.project);
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
