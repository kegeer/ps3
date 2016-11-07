<template>
  <div class="container">
      <div class="card-box">
          <div class="demo-box">
              <h4 class="m-t-0 header-title"><b>All results</b></h4>
              <p class="text-muted font-13 m-b-20">
                  See all results and add results <code>.table</code> to any <code>&lt;table&gt;</code>.
              </p>

              <p class="m-b-30" v-if="results.length === 0">
                  You have not created any results.
              </p>

              <table class="table m-0" v-if="results.length > 0">

                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Sample ID</th>
                          <th>Version number</th>
                          <th>Created At</th>
                          <th>Last Update At</th>
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
                                  Preview
                              </a>
                          </td>

                          <!-- Delete Button -->
                          <td style="vertical-align: middle;">
                              <a class="action-link text-danger" @click="download(results)">
                                  Download
                              </a>
                          </td>
                      </tr>
                  </tbody>
              </table>
          </div>

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
