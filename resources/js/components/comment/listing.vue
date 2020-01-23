<template>
    <div class="card">
        <div class="card-header">
            <p class="card-title">Comments</p>
            <div class="card-tools">
                <a v-on:click="loadComments" href="" class="float-right pl-2"><i class="fa fa-sync" /></a>
                <div class="input-group input-group-sm" style="width: 150px;">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Per Page</span>
                    </div>
                    <select :disabled="loading === true" class="form-control float-right" v-model="pagination.per_page">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="75">75</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <vue-loading v-if="loading" type="bubbles" color="#d9544e" :size="{ width: '50px', height: '50px' }" />
            <comment-view-stub v-if="!loading" v-for="comment in comments" v-bind:key="comment.id" v-bind:comment="comment" />
        </div>
        <div class="card-footer clearfix">
            <div class="row">
                <div class="col-6">
                    <comment-add-stub v-bind:message_id="message_id" />
                </div>
                <div class="col-6">
                    <pagination :pagination="pagination" :callback="loadComments" :options="paginationOptions" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CommentListing",
        props: ['message_id', 'recording_id'],
        data: function() {
            return {
                loading: false,
                comments: null,
                pagination: {
                    total: 0,
                    per_page: 15,    // required
                    current_page: 1, // required
                    last_page: 0,    // required
                    from: 1,
                    to: 15
                },
                paginationOptions: {
                    offset: 4,
                    previousText: 'Prev',
                    nextText: 'Next',
                    alwaysShowPrevNext: true
                }
            }
        },
        computed: {
            perPage() {
                return this.pagination.per_page;
            }
        },
        watch: {
            perPage: function (oldPerPage, newPerPage) {
                this.pagination.current_page = 1;
            }
        },
        methods: {
            loadComments: function() {
                const options = {
                    params: {
                        message_id: this.message_id,
                        recording_id: this.recording_id,
                        paginate: this.pagination.per_page,
                        page: this.pagination.current_page,
                    }
                };
                this.loading = true;
                axios.get('/api/comments',options)
                    .then(response => {
                        this.comments = response.data.data;
                        this.pagination = response.data.meta;
                        this.loading = false;
                    });
            }
        },
        mounted() {
            this.loadComments()
        }
    }
</script>

<style scoped>

</style>
