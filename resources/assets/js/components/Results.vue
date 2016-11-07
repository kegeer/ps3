<template>
    <div class="card-box">
        <div class="demo-box">
            <h4 class="m-t-0 header-title"><b>结果信息</b></h4>
            <p class="text-muted font-13 m-b-20">
                由下机数据直接到处产生的结果通过自动化直接导入的信息，你可以选择预览和直接下载结果文档。
            </p>

            <p class="m-b-30" v-if="results.length === 0">
                目前还未有任何结果数据产生。
            </p>

            <table class="table m-0" v-if="results.length > 0">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>样品编号</th>
                        <th>版本号</th>
                        <th>创建日期</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="results of results">
                        <th scope="row">{{ results.id }}</th>
                        <td style="vertical-align: middle;">{{ results.sample_id }}</td>
                        <td style="vertical-align: middle;">{{ results.version }}</td>
                        <td style="vertical-align: middle;">{{ results.created_at }}</td>
                        <td style="vertical-align: middle;">
                            <a class="action-link" @click="preview(results)">
                                预览
                            </a>
                        </td>

                        <!-- Delete Button -->
                        <td style="vertical-align: middle;">
                            <a class="action-link text-danger" @click="download(results)">
                                下载
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            results: {}
        }
    },
    mounted() {
        this.getResults();
    },
    methods: {
        getResults() {
            this.$http.get('/api/results')
            .then(response => {
                this.results = response.body.data;
            });
        },
        preview(result) {

        },
        download(result) {

        }
    }
}
</script>

<style lang="css">
</style>
