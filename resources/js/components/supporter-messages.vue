<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Supports & Messages</h3>
                    <div class="card-tools">
                        <a v-on:click="loadMessages" href="" class="float-right pl-2"><i class="fa fa-sync" /></a>
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
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody v-if="loading === true">
                            <tr>
                                <td colspan="6">
                                    <vue-loading type="bubbles" color="#d9544e" :size="{ width: '50px', height: '50px' }" />
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-if="loading === false">
                            <tr v-for="message in messages" v-bind:key="message.id">
                                <td>{{message.name}}</td>
                                <td>{{message.message}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <pagination :pagination="pagination" :callback="loadMessages" :options="paginationOptions" />
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</template>

<script>
    export default {
        name: "supporter-messages",
        data: function() {
            return {
                messages: [],
                loading: true,
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
                //this.loadMessages();
            }
        },
        methods: {
            loadMessages: function() {
                const options = {
                    params: {
                        paginate: this.pagination.per_page,
                        page: this.pagination.current_page,
                    }
                };
                this.loading = true;
                axios.get('/api/supporter-messages',options)
                    .then(response => {
                        this.messages = response.data.data;
                        this.pagination = response.data.meta;
                        this.loading = false;
                    });
            },
        },
        mounted() {
            this.loadMessages()
        }
    }
</script>
