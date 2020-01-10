<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Time</th>
                                <th>Type</th>
                                <th>Message</th>
                                <th>Sender</th>
                                <th>Receiver</th>
                                <th>Submitter</th>
                            </tr>
                        </thead>
                        <tbody v-if="!this.loading">
                            <tr v-for="message in messages">
                                <td>
                                    <router-link tag="a" :to="{ name: 'message-view', params: { message_id: message.id } }">
                                        {{message.id}}
                                    </router-link>
                                </td>
                                <td>{{message.time}}</td>
                                <td>{{message.type}}</td>
                                <td>{{message.message}}</td>
                                <td>{{message.sender}}</td>
                                <td>{{message.receiver}}</td>
                                <td>{{message.user.name}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <vue-loading v-if="this.loading" type="bubbles" color="#d9544e" :size="{ width: '50px', height: '50px' }"></vue-loading>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <pagination :pagination="pagination" :callback="loadMessages" :options="paginationOptions"></pagination>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</template>

<script>
    export default {
        name: "message-listing",
        data: function() {
            return {
                messages: [],
                loading: true,
                pagination: {
                    total: 0,
                    per_page: 12,    // required
                    current_page: 1, // required
                    last_page: 0,    // required
                    from: 1,
                    to: 12
                },
                paginationOptions: {
                    offset: 4,
                    previousText: 'Prev',
                    nextText: 'Next',
                    alwaysShowPrevNext: true
                }
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
                axios.get('/api/messages',options)
                    .then(response => {
                        this.messages = response.data.data;
                        this.pagination = response.data.meta;
                        this.loading = false;
                    });
            }
        },
        mounted() {
            this.loadMessages()
        }
    }
</script>

<style scoped>

</style>
