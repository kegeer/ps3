<template>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="demo-box">
                <h4 class="m-t-0 header-title"><b>项目信息</b></h4>
                <p class="text-muted font-13 m-b-20">
                    此页面管理公司项目信息，项目分配和建立，并能匹配的管理下游任务信息。
                </p>
                <div class="m-b-30">
                    <button @click="showCreateProjectForm" class="btn btn-success waves-effect waves-light">新建项目 <i class="mdi mdi-plus-circle-outline"></i></button>
                </div>

                <p class="m-b-30" v-if="projects.length === 0">
                    目前还未建立任何项目信息！
                </p>

                <table class="table m-0" v-if="projects.length > 0">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>名称</th>
                            <th>开始时间</th>
                            <th>结束时间</th>
                            <th>项目负责人</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="project of projects">
                            <th scope="row">{{ project.id }}</th>
                            <td style="vertical-align: middle;">{{ project.name }}</td>
                            <td style="vertical-align: middle;">{{ project.start }}</td>
                            <td style="vertical-align: middle;">{{ project.end }}</td>
                            <td style="vertical-align: middle;">{{ project.manager_user_id }}</td>
                            <td style="vertical-align: middle;">
                                <a class="action-link" @click="edit(project)">
                                    编辑此项目
                                </a>
                            </td>

                            <!-- Delete Button -->
                            <td style="vertical-align: middle;">
                                <a class="action-link text-danger" @click="destroy(project)">
                                    删除
                                </a>
                            </td>
                            <td>
                                <a :href="allTasks(project)" class="action-link">所有关联任务</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- Create Client Modal -->
    <div class="modal fade" id="modal-create-project" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">
                            创建项目
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
                                    <label for="manager_user_id" class="control-label">负责人</label>
                                    <select v-model="createForm.manager_user_id" id="manager_user_id" class="form-control">
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
    <div class="modal fade" id="modal-edit-project" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">
                            编辑此项目
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
                                    <label for="manager_user_id" class="control-label">项目负责人</label>
                                    <select v-model="editForm.manager_user_id" id="manager_user_id" class="form-control">
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
    data() {
        return {
            projects: {},
            createForm: {
                errors: [],
                name: '',
                start: '',
                end: '',
                manager_user_id: null
            },
            editForm: {
                errors: [],
                id: null,
                name: '',
                start: '',
                end: '',
                manager_user_id: null
            }
        }
    },
    mounted() {
        this.prepareComponent();
    },
    methods: {
        allTasks(project) {
            return "/projects/" + project.id + "/tasks";
        },
        prepareComponent() {
            this.getProjects();
            $('#modal-create-project').on('shown.bs.modal', () => {
                $('#create-project-name').focus();
            });
            $('#modal-edit-project').on('shown.bs.modal', () => {
                $('#edit-project-name').focus();
            });
        },

        getProjects() {
            this.$http.get('/api/projects')
                .then(response => {
                    this.projects = response.body.data;
                });
        },
        showCreateProjectForm() {
            $('#modal-create-project').modal('show');
        },
        store() {
            this.persistClient(
                'post', '/api/projects', this.createForm, '#modal-create-project'
            );
        },
        edit(project) {
            this.editForm.id = project.id;
            this.editForm.name = project.name;
            this.editForm.start = project.start;
            this.editForm.end = project.end;
            this.editForm.manager_user_id = project.manager_user_id;
            $('#modal-edit-project').modal('show');
        },
        update() {
            this.persistClient(
                'put', '/api/projects/' + this.editForm.id, this.editForm, '#modal-edit-project'
            );
        },
        persistClient(method, uri, form, modal) {
            form.errors = [];
            this.$http[method](uri, form)
                .then(response => {
                    this.getProjects();
                    form.name = '';
                    form.start = '';
                    form.end = '';
                    form.manager_user_id = null;

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
        destroy(project) {
            this.$http.delete('/api/projects/' + project.id)
                .then(response => {
                    this.getProjects();
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
