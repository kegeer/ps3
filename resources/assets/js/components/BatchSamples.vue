<template>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="demo-box">
                <h4 class="m-t-0 header-title"><b>该批次样本信息</b></h4>
                <p class="text-muted font-13 m-b-20">
                   管理该批次样本信息，在此可以添加或修改，批量导入功能完善中。
                </p>
                <div class="m-b-30">
                    <button @click="showCreateSampleForm" class="btn btn-success waves-effect waves-light">添加新样本<i class="mdi mdi-plus-circle-outline"></i></button>
                </div>

                <p class="m-b-30" v-if="samples.length === 0">
                    此批次还没有添加任何新样本！
                </p>

                <table class="table m-0" v-if="samples.length > 0">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Source</th>
                            <th>Client Name</th>
                            <th>原始编号</th>
                            <th>谱元编号</th>
                            <th>样本量</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="sample of samples">
                            <th scope="row">{{ sample.id }}</th>
                            <td style="vertical-align: middle;">{{ sample.client.source }}</td>
                            <td style="vertical-align: middle;">{{ sample.client.name }}</td>
                            <td style="vertical-align: middle;">{{ sample.ori_num }}</td>
                            <td style="vertical-align: middle;">{{ sample.py_num }}</td>
                            <td style="vertical-align: middle;">{{ sample.sample_weight }}</td>
                            <td style="vertical-align: middle;">
                                <a class="action-link" @click="edit(sample)">
                                        编辑
                                    </a>
                            </td>

                            <!-- Delete Button -->
                            <td style="vertical-align: middle;">
                                <a class="action-link text-danger" @click="destroy(sample)">
                                        删除
                                    </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <div class="modal fade" id="modal-create-sample" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="width:85%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">
                                添加新样本
                            </h4>
                </div>

                <div class="modal-body">
                    <!-- Form Errors -->
                    <div class="alert alert-danger" v-if="createForm.errors.length > 0">
                        <p><strong>糟糕！出问题了！</strong> 大多数是由于网络原因，请联系技术人员帮助解决！</p>
                        <br>
                        <ul>
                            <li v-for="error in createForm.errors">
                                {{ error }}
                            </li>
                        </ul>
                    </div>

                    <!-- Create Batch Form -->
                    <form role="form">
                    <table class="table table-condensed m-0">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Source</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Height</th>
                                <th>Weight</th>
                                <th>Disease</th>
                                <th>
                                    Samples
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="client in createForm.clients">
                                <td scope="row">
                                    <button type="button" class="btn btn-danger btn-xs" @click="removeClientLine(client)"><i class="mdi mdi-window-close"></i></button>
                                </td>
                                <td>
                                    <input type="text" v-model="client.source" class="form-control">
                                </td>
                                <td>
                                    <input type="text" v-model="client.name" class="form-control">
                                </td>
                                <td>
                                    <input type="text" v-model="client.age" class="form-control">
                                </td>
                                <td>
                                    <input type="text" v-model="client.height" class="form-control">
                                </td>
                                <td>
                                    <input type="text" v-model="client.weight" class="form-control">
                                </td>
                                <td>
                                    <input type="text" v-model="client.disease_history" class="form-control" v-if="client.disease == true">
                                    <div class="checkbox checkbox-primary">
                                        <input :id="clientCheckbox(client)" type="checkbox" v-model="client.disease">
                                        <label :for="clientCheckbox(client)">
                                            Disease?
                                        </label>
                                    </div>
                                </td>
                                <td colspan="4">
                                    <tr v-for="sample of client.samples">
                                        <td scope="row">
                                                <a type="button" class="btn btn-danger btn-xs" @click="removeSampleLine(client, sample)"><i class="mdi mdi-window-close"></i></a>
                                        </td>
                                        <td>
                                            <input type="text" v-model="sample.ori_num" class="form-control input-sm m-b-5" placeholder="Origin  NUmber">
                                        </td>
                                        <td>
                                            <input type="text" v-model="sample.py_num" class="form-control input-sm m-b-5" placeholder="Pyyuan Number">
                                        </td>
                                        <td>
                                            <input type="text" v-model="sample.sample_weight" class="form-control input-sm m-b-5" placeholder="Sample weight">
                                        </td>
                                        <td>
                                            <input type="date" v-model="sample.sample_time" class="form-control input-sm m-b-5" placeholder="Sample time">
                                        </td>
                                    </tr>
                                    <tr>
                                        <button type="button" class="btn btn-primary btn-xs m-t-15" @click="addCreateSampleLine(client)"><i class=" mdi mdi-plus"></i> Add sample</button>
                                    </tr>
                                </td>
                            </tr>
                            <tr>
                                <button type="button" class="btn btn-primary btn-sm m-t-15" @click="addCreateClientLine"><i class=" mdi mdi-plus">Add new client</i></button>
                            </tr>
                        </tbody>
                    </table>
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
        <div class="modal-dialog" style="width:85%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">
                        更新样品
                    </h4>
                </div>

                <div class="modal-body">
                    <!-- Form Errors -->
                    <div class="alert alert-danger" v-if="editForm.errors.length > 0">
                        <p><strong>糟糕！出问题了！</strong> 大多数是由于网络原因，请联系技术人员帮助解决！</p>
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
                                    <label for="ori_num" class="control-label">原始样本编号</label>
                                    <input type="text" id="ori_num" v-model="editForm.ori_num" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="py_num" class="control-label">谱元编号</label>
                                    <input type="text" id="py_num" v-model="editForm.py_num" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount" class="control-label">样品量</label>
                                    <input type="text" id="amount" v-model="editForm.amount" class="form-control">
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

                <!-- Modal Actions -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>

                    <button type="button" class="btn btn-primary" @click="update">
                                更新
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

                clients: [{
                    source: '',
                    name: '',
                    age: null,
                    height: null,
                    weight: null,
                    disease: false,
                    disease_history: '',
                    samples:[{
                        batch_id : this.batch,
                        ori_num : '',
                        py_num : '',
                        sample_weight : null,
                        sample_time : '',
                    }]
                }]
            },
            editForm: {
                errors: [],
                id: null,
                ori_num : '',
                py_num : '',
                sample_weight : null,
                sampling_time : ''
            }
        }
    },
    mounted() {
        this.prepareComponent();
    },
    methods: {
        clientCheckbox(client) {
            return 'checkbox' + this.createForm.clients.indexOf(client);
        },
        prepareComponent() {
            this.getSamples(this.batch);
            $('#modal-create-sample').on('shown.bs.modal', () => {
                $('#create-sample-ori-num').focus();
            });
            $('#modal-edit-batch').on('shown.bs.modal', () => {
                $('#edit-sample-ori-num').focus();
            });
        },
        addCreateSampleLine(client) {
            client.samples.push({
                batch_id : this.batch,
                ori_num : '',
                py_num : '',
                sample_weight : null,
                sample_time : ''
            });
        },
        addCreateClientLine() {
            this.createForm.clients.push({
                source: '',
                name: '',
                age: '',
                height: '',
                weight: '',
                disease: '',
                disease_history: '',
                samples:[{
                    batch_id : this.batch,
                    ori_num : '',
                    py_num : '',
                    sample_weight : null,
                    sample_time : '',
                }]
            });
        },
        removeSampleLine(client, sample){
            let index = client.samples.indexOf(sample);
            client.samples.splice(index, 1);
        },
        removeClientLine(client){
            let index = this.createForm.clients.indexOf(client);
            this.createForm.clients.splice(index, 1);
        },
        getSamples(batch) {
            this.$http.get('/api/batches/' + batch + '/samples')
                .then(response => {
                    this.samples = response.body.data;
                    console.log(this.samples);
                });
        },
        showCreateSampleForm() {
            $('#modal-create-sample').modal('show');
        },
        store() {
            this.$http.post('/api/samples', this.createForm)
            .then(response => {
                this.getSamples(this.batch);
                this.createForm.clients = [];

                $('#modal-create-sample').modal('hide');
            })
            .catch( response => {
                if (typeof response.data === 'object') {
                    this.createForm.errors = _.flatten(_.toArray(response.data));
                } else {
                    this.createForm.errors = ['Something went wrong, please try again']
                }
            });
        },
        edit(sample) {
            this.editForm.id = sample.id;
            this.editForm.ori_num = sample.ori_num;
            this.editForm.py_num = sample.py_num;
            this.editForm.sample_weight = sample.sample_weight;
            this.editForm.sample_time = sample.sample_time;
            $('#modal-edit-sample').modal('show');
        },
        update() {
            this.persistClient(
                'put', '/api/samples/' + this.editForm.id, this.editForm, '#modal-edit-sample'
            );
            this.$http.put('/api/samples/' + this.editForm.id, this.editForm)
            .then(response => {
                this.editForm.id= null;
                this.editForm.ori_num = '';
                this.editForm.py_num = '';
                this.editForm.sample_weight = null;
                this.editForm.sampling_time = '';
                $('#modal-edit-sample').modal('hide');
            })
            .catch(response => {
                if (typeof response.data === 'object') {
                    this.editForm.errors = _.flatten(_.toArray(response.data));
                } else {
                    this.editForm.errors = ['Something went wrong, please try again']
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
