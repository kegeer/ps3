<template>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="demo-box">
                <h4 class="m-t-0 header-title"><b>All Samples</b></h4>
                <p class="text-muted font-13 m-b-20">
                    See all samples and add samples <code>.table</code> to any <code>&lt;table&gt;</code>.
                </p>
                <div class="m-b-30">
                    <button @click="showCreateSampleForm" class="btn btn-success waves-effect waves-light">Add <i class="mdi mdi-plus-circle-outline"></i></button>
                </div>

                <p class="m-b-30" v-if="samples.length === 0">
                    You have not created any samples.
                </p>

                <table class="table m-0" v-if="samples.length > 0">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Origin Id</th>
                            <th>Puyuan Id</th>
                            <th>Sample amount</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="sample of samples">
                            <th scope="row">{{ sample.id }}</th>
                            <td style="vertical-align: middle;">{{ sample.ori_num }}</td>
                            <td style="vertical-align: middle;">{{ sample.py_num }}</td>
                            <td style="vertical-align: middle;">{{ sample.amount }}</td>
                            <td style="vertical-align: middle;">
                                <a class="action-link" @click="edit(sample)">
                                        Edit
                                    </a>
                            </td>

                            <!-- Delete Button -->
                            <td style="vertical-align: middle;">
                                <a class="action-link text-danger" @click="destroy(sample)">
                                        Delete
                                    </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <div class="modal fade" id="modal-create-sample" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">
                                Create Batch
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
                                    <label for="ori_num" class="control-label">Origin Number</label>
                                    <input type="text" id="ori_num" v-model="createForm.ori_num" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="py_num" class="control-label">Puyuan Number</label>
                                    <input type="text" id="py_num" v-model="createForm.py_num" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_id" class="control-label">Client ID</label>
                                    <input type="text" id="client_id" v-model="createForm.client_id" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount" class="control-label">Amount</label>
                                    <input type="text" id="amount" v-model="createForm.amount" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="split_type" class="control-label">Split type</label>
                                    <select v-model="createForm.split_type" id="split_type" class="form-control">
                                          <option value="1">poop</option>
                                          <option value="2">blood</option>
                                          <option value="3">Jack</option>
                                        </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sampling_time" class="control-label">Sample type</label>
                                    <input type="date" id="sampling_time" v-model="createForm.sampling_time" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="split_time" class="control-label">Split Time</label>
                                    <input type="date" id="split_time" v-model="createForm.split_time" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="due_time" class="control-label">Due time</label>
                                    <input type="date" id="due_time" v-model="createForm.due_time" class="form-control">
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
    <div class="modal fade" id="modal-edit-sample" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">
                                Update Batch
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

                    <!-- Create Batch Form -->
                    <form role="form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ori_num" class="control-label">Origin Number</label>
                                    <input type="text" id="ori_num" v-model="editForm.ori_num" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="py_num" class="control-label">Puyuan Number</label>
                                    <input type="text" id="py_num" v-model="editForm.py_num" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_id" class="control-label">Client ID</label>
                                    <input type="text" id="client_id" v-model="editForm.client_id" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount" class="control-label">Amount</label>
                                    <input type="text" id="amount" v-model="editForm.amount" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="split_type" class="control-label">Split type</label>
                                    <select v-model="editForm.split_type" id="split_type" class="form-control">
                                          <option value="1">poop</option>
                                          <option value="2">blood</option>
                                          <option value="3">Jack</option>
                                        </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sampling_time" class="control-label">Sample type</label>
                                    <input type="date" id="sampling_time" v-model="editForm.sampling_time" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="split_time" class="control-label">Split Time</label>
                                    <input type="date" id="split_time" v-model="editForm.split_time" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="due_time" class="control-label">Due time</label>
                                    <input type="date" id="due_time" v-model="editForm.due_time" class="form-control">
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
        'batch'
    ],
    data() {
        return {
            samples: {},
            createForm: {
                errors: [],
                batch_id : this.batch,
                client_id : null,
                ori_num : '',
                py_num : '',
                amount : null,
                sampling_time : '',
                split_time : '',
                split_type : '',
                due_time : ''
            },
            editForm: {
                errors: [],
                client_id : null,
                ori_num : '',
                py_num : '',
                amount : null,
                sampling_time : '',
                split_time : '',
                split_type : '',
                due_time : ''
            }
        }
    },
    mounted() {
        this.prepareComponent();
    },
    methods: {
        prepareComponent() {
            this.getSamples(this.batch);
            $('#modal-create-sample').on('shown.bs.modal', () => {
                $('#create-sample-ori-num').focus();
            });
            $('#modal-edit-batch').on('shown.bs.modal', () => {
                $('#edit-sample-ori-num').focus();
            });
        },

        getSamples(batch) {
            this.$http.get('/api/batches/' + batch + '/samples')
                .then(response => {
                    this.samples = response.body.data;
                });
        },
        showCreateSampleForm() {
            $('#modal-create-sample').modal('show');
        },
        store() {
            this.persistClient(
                'post', '/api/samples', this.createForm, '#modal-create-sample'
            );
        },
        edit(sample) {
            this.editForm.client_id = sample.client_id;
            this.editForm.ori_num = sample.ori_num;
            this.editForm.py_num = sample.py_num;
            this.editForm.amount = sample.amount;
            this.editForm.sampling_time = sample.sampling_time;
            this.editForm.split_time = sample.split_time;
            this.editForm.split_type = sample.split_type;
            this.editForm.due_time = sample.due_time;
            $('#modal-edit-sample').modal('show');
        },
        update() {
            this.persistClient(
                'put', '/api/samples/' + this.editForm.id, this.editForm, '#modal-edit-sample'
            );
        },
        persistClient(method, uri, form, modal) {
            form.errors = [];
            this.$http[method](uri, form)
                .then(response => {
                    this.getSamples(this.batch);
                    form.client_id = null;
                    form.ori_num = '';
                    form.py_num = '';
                    form.amount = null;
                    form.sampling_time = '';
                    form.split_time = '';
                    form.split_type = '';
                    form.due_time = '';
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
        destroy(sample) {
            this.$http.delete('/api/samples/' + sample.id)
                .then(response => {
                    this.getSamples(this.batch);
                });
        }
    }

}
</script>

<style lang="css">
</style>
