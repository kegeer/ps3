<template>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="demo-box">
                <h4 class="m-t-0 header-title"><b>此项目下所有任务</b></h4>
                <p class="text-muted font-13 m-b-20">
                    在此可以添加可修改任务
                </p>
                <div class="m-b-30">
                    <button @click="showCreateTaskForm" class="btn btn-success waves-effect waves-light">添加任务 <i class="mdi mdi-plus-circle-outline"></i></button>
                </div>

                <p class="m-b-30" v-if="tasks.length === 0">
                    目前还没有创建任何任务
                </p>

                <table class="table m-0" v-if="tasks.length > 0">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>名称</th>
                            <th>开始时间</th>
                            <th>结束时间</th>
                            <th>结束路线</th>
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
                                    编辑
                                </a>
                            </td>

                            <!-- Delete Button -->
                            <td style="vertical-align: middle;">
                                <a class="action-link text-danger" @click="destroy(task)">
                                    删除
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
                            创建任务
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="control-label">名称</label>
                                    <input type="text" id="name" v-model="createForm.name" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="roadmap_id" class="control-label">技术路线</label>
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
                                    <label for="start" class="control-label">开始时间</label>
                                    <input type="date" id="start" v-model="createForm.start" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end" class="control-label">结束时间</label>
                                    <input type="date" id="end" v-model="createForm.end" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exp_manager" class="control-label">实验负责人</label>
                                    <select v-model="createForm.exp_manager" id="exp_manager" class="form-control">
                                          <option value="1">poop</option>
                                          <option value="2">blood</option>
                                          <option value="3">Jack</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="info_manager" class="control-label">信息负责人</label>
                                    <select v-model="createForm.info_manager" id="info_manager" class="form-control">
                                          <option value="1">poop</option>
                                          <option value="2">blood</option>
                                          <option value="3">Jack</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <h4 class="m-t-0 header-title"><b>选择批次</b></h4>
                                <table>
                                    <thead class="table m-b-30">
                                        <tr>
                                            <th>选择</th>
                                            <th>原始批次号</th>
                                            <th>谱元编号</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="batch in batches">
                                            <td>
                                                <input type="checkbox">
                                            </td>
                                            <td>
                                                {{ batch.ori_num }}
                                            </td>
                                            <td>
                                                {{ batch.py_num }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </form>
                </div>

                <!-- Modal Actions -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>

                    <button type="button" class="btn btn-primary" @click="store">
                            创建
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
                            修改任务信息
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

                    <!-- Edit Batch Form -->
                    <form role="form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="control-label">名称</label>
                                    <input type="text" id="name" v-model="editForm.name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="roadmap_id" class="control-label">技术路线</label>
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
                                    <label for="start" class="control-label">开始时间</label>
                                    <input type="date" id="start" v-model="editForm.start" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end" class="control-label">结束时间</label>
                                    <input type="date" id="end" v-model="editForm.end" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exp_manager" class="control-label">实验负责人</label>
                                    <select v-model="editForm.exp_manager" id="exp_manager" class="form-control">
                                          <option value="1">poop</option>
                                          <option value="2">blood</option>
                                          <option value="3">Jack</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="info_manager" class="control-label">信息负责人</label>
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
        'project'
    ],
    data() {
        return {
            tasks: {},
            batches: [],
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
