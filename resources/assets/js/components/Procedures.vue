<template>
	<div class="row">
	    <div class="col-sm-12">
	        <div class="card-box">
	        	<div class="demo-box">
	        		<h4 class="m-t-0 header-title"><b>项目流程</b></h4>
		        <p class="text-muted font-13 m-b-20">
		            项目流程，以及各样品在项目流程中的进度，相关人员可以直接在页面创建新的流程节点，以及创建新的实验方法，并且可以管理各项目的进度。
		        </p>
		        <div class="m-b-30">
		            <button @click="showCreateProcedureForm" class="btn btn-success waves-effect waves-light">添加新流程<i class="mdi mdi-plus-circle-outline"></i></button>
		            <button @click="showCreateProtocolForm" class="btn btn-success waves-effect waves-light">添加新试验方法<i class="mdi mdi-plus-circle-outline"></i></button>
		        </div>
		        <p class="m-b-30" v-if="procedures.length === 0">
		            目前还没有固定流程。
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
		        
		    </div>
		    <div class="modal fade" id="modal-create-procedure" tabindex="-1" role="dialog">
		        <div class="modal-dialog">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

		                    <h4 class="modal-title">
		                            创建新流程
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
		                            <div class="col-md-12">
		                                <div class="form-group">
		                                    <label for="name" class="control-label">流程名称</label>
		                                    <input type="text" id="name" v-model="createForm.name" class="form-control">
		                                </div>
		                            </div>
		                        </div>


		                    </form>
		                </div>

		                <!-- Modal Actions -->
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>

		                    <button type="button" class="btn btn-primary" @click="storeProcedure">
		                            创建
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
		                           创建新方法
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
		                                    <label for="procedure_id" class="control-label">所属流程</label>
		                                    <select v-model="createProtocolForm.procedure_id" id="procedure_id" class="form-control">
		                                          <option value="1">poop</option>
		                                          <option value="2">blood</option>
		                                          <option value="3">Jack</option>
		                                    </select>
		                                </div>
		                            </div>
		                            <div class="col-md-6">
		                                <div class="form-group">
		                                    <label for="pname" class="control-label">方法名称</label>
		                                    <input type="text" id="pname" v-model="createProtocolForm.name" class="form-control">
		                                </div>
		                            </div>
		                        </div>

		                        <div class="row">
		                            <div class="col-md-12">
		                                <div class="form-group">
		                                    <label for="description" class="control-label">方法简介</label>
		                                    <textarea id="description" v-model="createProtocolForm.description" class="form-control"></textarea>
		                                </div>
		                            </div>
		                        </div>


		                        <div class="row">
		                            <div class="col-md-12">
		                                <div class="form-group">
		                                    <label for="content" class="control-label">方法内容</label>

		                                    <textarea id="content" v-model="createProtocolForm.content" class="form-control"></textarea>
		                                </div>
		                            </div>
		                        </div>



		                    </form>
		                </div>

		                <!-- Modal Actions -->
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>

		                    <button type="button" class="btn btn-primary" @click="storeProtocol">
		                            创建
		                        </button>
		                </div>
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
