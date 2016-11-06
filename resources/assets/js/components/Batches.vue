<template>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="demo-box">
                <h4 class="m-t-0 header-title"><b>All Batches</b></h4>
                <p class="text-muted font-13 m-b-20">
                    See all samples and add samples <code>.table</code> to any <code>&lt;table&gt;</code>.
                </p>
                <div class="m-b-30">
                    <button @click="showCreateBatchForm" class="btn btn-success waves-effect waves-light">Add <i class="mdi mdi-plus-circle-outline"></i></button>
                </div>

                <p class="m-b-30" v-if="batches.length === 0">
                    You have not created any batches.
                </p>

                <table class="table m-0" v-if="batches.length > 0">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Origin Id</th>
                            <th>Puyuan Id</th>
                            <th>Sample amount</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="batch of batches">
                            <th scope="row">{{ batch.id }}</th>
                            <td style="vertical-align: middle;">{{ batch.ori_num }}</td>
                            <td style="vertical-align: middle;">{{ batch.py_num }}</td>
                            <td style="vertical-align: middle;">{{ batch.samples_amount }}</td>
                            <td style="vertical-align: middle;">
                                <a class="action-link" @click="edit(batch)">
                                    Edit
                                </a>
                            </td>

                            <!-- Delete Button -->
                            <td style="vertical-align: middle;">
                                <a class="action-link text-danger" @click="destroy(batch)">
                                    Delete
                                </a>
                            </td>
                            <td>
                                <a :href="allSamples(batch)" class="action-link">All Samples</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- Create Client Modal -->
    <div class="modal fade" id="modal-create-batch" tabindex="-1" role="dialog">
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
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="samples_amount" class="control-label">Samples amount</label>
                                    <input type="text" id="samples_amount" v-model="createForm.samples_amount" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="samples_type" class="control-label">samples_type</label>
                                    <select v-model="createForm.samples_type" id="samples_type" class="form-control">
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
                                    <label for="trans_method" class="control-label">trans_method</label>
                                    <select v-model="createForm.trans_method" id="trans_method" class="form-control">
                                      <option value="1">Alice</option>
                                      <option value="2">None</option>
                                      <option value="3">Jack</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sender" class="control-label">sender</label>
                                    <input type="text" id="sender" v-model="createForm.sender" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="send_time" class="control-label">send_time</label>
                                    <input type="date" id="send_time" v-model="createForm.send_time" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sender_contact" class="control-label">sender_contact</label>
                                    <input type="text" id="sender_contact" v-model="createForm.sender_contact" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="recipients" class="control-label">recipients</label>
                                    <input type="text" id="recipients" v-model="createForm.recipients" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="arrive_time" class="control-label">arrive_time</label>
                                    <input type="date" id="arrive_time" v-model="createForm.arrive_time" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="express_num" class="control-label">express_num</label>
                                    <input type="text" id="express_num" v-model="createForm.express_num" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="arrive_status" class="control-label">arrive_status</label>
                                    <select v-model="createForm.arrive_status" id="arrive_status" class="form-control">
                                      <option value="1">Alice</option>
                                      <option value="2">None</option>
                                      <option value="3">Jack</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="store_method" class="control-label">store_method</label>
                                    <select v-model="createForm.store_method" id="store_method" class="form-control">
                                      <option value="1">Alice</option>
                                      <option value="2">None</option>
                                      <option value="3">Jack</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="store_location" class="control-label">store_location</label>
                                    <input type="text" id="store_location" v-model="createForm.store_location" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="manager" class="control-label">Manager</label>
                                    <select v-model="createForm.anager" id="manager" class="form-control">
                                          <option value="1">Alice</option>
                                          <option value="2">None</option>
                                          <option value="3">Jack</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group no-margin">
                                    <label for="note" class="control-label">note</label>
                                    <textarea id="note" v-model="createForm.note" class="form-control autogrow" placeholder="If any emergence" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea>
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
    <div class="modal fade" id="modal-edit-batch" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">
                            Edit Batch
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
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="samples_amount" class="control-label">Samples amount</label>
                                    <input type="text" id="samples_amount" v-model="editForm.samples_amount" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="samples_type" class="control-label">samples_type</label>
                                    <select v-model="editForm.samples_type" id="samples_type" class="form-control">
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
                                    <label for="trans_method" class="control-label">trans_method</label>
                                    <select v-model="editForm.trans_method" id="trans_method" class="form-control">
                                      <option value="1">Alice</option>
                                      <option value="2">None</option>
                                      <option value="3">Jack</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sender" class="control-label">sender</label>
                                    <input type="text" id="sender" v-model="editForm.sender" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="send_time" class="control-label">send_time</label>
                                    <input type="date" id="send_time" v-model="editForm.send_time" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sender_contact" class="control-label">sender_contact</label>
                                    <input type="text" id="sender_contact" v-model="editForm.sender_contact" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="recipients" class="control-label">recipients</label>
                                    <input type="text" id="recipients" v-model="editForm.recipients" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="arrive_time" class="control-label">arrive_time</label>
                                    <input type="date" id="arrive_time" v-model="editForm.arrive_time" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="express_num" class="control-label">express_num</label>
                                    <input type="text" id="express_num" v-model="editForm.express_num" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="arrive_status" class="control-label">arrive_status</label>
                                    <select v-model="editForm.arrive_status" id="arrive_status" class="form-control">
                                      <option value="1">Alice</option>
                                      <option value="2">None</option>
                                      <option value="3">Jack</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="store_method" class="control-label">store_method</label>
                                    <select v-model="editForm.store_method" id="store_method" class="form-control">
                                      <option value="1">Alice</option>
                                      <option value="2">None</option>
                                      <option value="3">Jack</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="store_location" class="control-label">store_location</label>
                                    <input type="text" id="store_location" v-model="editForm.store_location" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="manager" class="control-label">Manager</label>
                                    <select v-model="editForm.anager" id="manager" class="form-control">
                                          <option value="1">Alice</option>
                                          <option value="2">None</option>
                                          <option value="3">Jack</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group no-margin">
                                    <label for="note" class="control-label">note</label>
                                    <textarea id="note" v-model="editForm.note" class="form-control autogrow" placeholder="If any emergence" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea>
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
    data() {
        return {
            batches: {},
            createForm: {
                errors: [],
                ori_num: '',
                py_num: '',
                manager: null,
                samples_amount: null,
                samples_type: null,
                trans_method: null,
                sender: '',
                send_time: '',
                sender_contact: '',
                recipients: '',
                arrive_time: '',
                express_num: '',
                arrive_status: null,
                store_method: null,
                store_location: '',
                note: '',
            },
            editForm: {
                errors: [],
                id: '',
                ori_num: '',
                py_num: '',
                manager: '',
                samples_amount: '',
                samples_type: '',
                trans_method: '',
                sender: '',
                send_time: '',
                sender_contact: '',
                recipients: '',
                arrive_time: '',
                express_num: '',
                arrive_status: '',
                store_method: '',
                store_location: '',
                note: '',
            }
        }
    },
    mounted() {
        this.prepareComponent();
    },
    methods: {
        allSamples(batch) {
            return "/batches/" + batch.id + "/samples";
        },
        prepareComponent() {
            this.getBatches();
            $('#modal-create-batch').on('shown.bs.modal', () => {
                $('#create-batch-ori-num').focus();
            });
            $('#modal-edit-batch').on('shown.bs.modal', () => {
                $('#edit-batch-ori-num').focus();
            });
        },

        getBatches() {
            this.$http.get('/api/batches')
                .then(response => {
                    this.batches = response.body.data;
                });
        },
        showCreateBatchForm() {
            $('#modal-create-batch').modal('show');
        },
        store() {
            this.persistClient(
                'post', '/api/batches', this.createForm, '#modal-create-batch'
            );
        },
        edit(batch) {
            this.editForm.id = batch.id;
            this.editForm.ori_num = batch.ori_num;
            this.editForm.py_num = batch.py_num;
            this.editForm.manager = batch.manager;
            this.editForm.samples_amount = batch.samples_amount;
            this.editForm.samples_type = batch.samples_type;
            this.editForm.trans_method = batch.trans_method;
            this.editForm.sender = batch.sender;
            this.editForm.send_time = batch.send_time;
            this.editForm.sender_contact = batch.sender_contact;
            this.editForm.recipients = batch.recipients;
            this.editForm.arrive_time = batch.arrive_time;
            this.editForm.express_num = batch.express_num;
            this.editForm.arrive_status = batch.arrive_status;
            this.editForm.store_method = batch.store_method;
            this.editForm.store_location = batch.store_location;
            this.editForm.note = batch.note;
            $('#modal-edit-batch').modal('show');
        },
        update() {
            this.persistClient(
                'put', '/api/batches/' + this.editForm.id, this.editForm, '#modal-edit-batch'
            );
        },
        persistClient(method, uri, form, modal) {
            form.errors = [];
            this.$http[method](uri, form)
                .then(response => {
                    this.getBatches();
                    form.ori_num = '';
                    form.py_num = '';
                    form.manager = '';
                    form.samples_amount = '';
                    form.samples_type = '';
                    form.trans_method = '';
                    form.sender = '';
                    form.send_time = '';
                    form.sender_contact = '';
                    form.recipients = '';
                    form.arrive_time = '';
                    form.express_num = '';
                    form.arrive_status = '';
                    form.store_method = '';
                    form.store_location = '';
                    form.note = '';
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
        destroy(batch) {
            this.$http.delete('/api/batches/' + batch.id)
                .then(response => {
                    this.getBatches();
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
