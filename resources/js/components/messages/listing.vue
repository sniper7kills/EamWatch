<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Messages</h3>
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
                                <th>Type</th>
                                <th>Time</th>
                                <th>Sender/Receiver</th>
                                <th>Message</th>
                                <th>Counts/Submitter</th>
                                <th>Actions</th>
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
                                <td>{{message.type}}</td>
                                <td>{{message.time}}</td>
                                <td>
                                    <p v-if="message.receiver === ''" class="text-muted text-sm">
                                        <b>Sender: </b> {{message.sender}}
                                    </p>
                                    <p v-else class="text-muted text-sm">
                                        <b>Sender: </b> {{message.sender}} <br/>
                                        <b>Receiver: </b> {{message.receiver}}
                                    </p>
                                </td>
                                <td>
                                    <span style="font-family: monospace" v-html="formatMessage(message.message, message.type)"></span>
                                </td>
                                <td>
                                    <p class="text-muted text-sm">
                                        <b>Recordings: </b> {{message.recording_count}} <br/>
                                        <b>Comments: </b> {{message.comment_count}} <br />
                                        <b>Submitter: </b>
                                        <router-link v-if="message.user.type === 'user'" tag="a" :to="{ name: 'user-view', params: { user_id: message.user.id } }">
                                            {{message.user.name}}
                                        </router-link>
                                        <router-link v-if="message.user.type === 'guest'" tag="a" :to="{ name: 'guest-view', params: { guest_id: message.user.id } }">
                                            {{message.user.name}}
                                        </router-link>
                                    </p>
                                </td>
                                <td>
                                    <router-link tag="a" :to="{ name: 'message-view', params: { message_id: message.id } }">
                                        <i class="fa fa-eye" />
                                    </router-link>
                                    <router-link tag="a" v-if="message.permissions.update" :to="{ name: 'message-edit', params: { message_id: message.id } }">
                                        <i class="fa fa-edit" />
                                    </router-link>
                                    <router-link tag="a" v-if="message.permissions.delete" :to="{ name: 'message-delete', params: { message_id: message.id } }">
                                        <i class="fa fa-trash" />
                                    </router-link>
                                </td>
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
        name: "message-listing",
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
                axios.get('/api/messages',options)
                    .then(response => {
                        this.messages = response.data.data;
                        this.pagination = response.data.meta;
                        this.loading = false;
                    });
            },
            formatMessage: function(message, type) {
                if(type === "ALLSTATIONS") {
                    var messageLength = message.length;
                    var chunks = message.match(/.{1,30}/g);
                    var formatted =  chunks.join("<br />")
                    if(messageLength !== 30){
                        return "["+messageLength+" CHAR]<br />"+formatted;
                    }
                    return formatted;
                }else if(type === "OTHER") {
                    return message.replace(/(?:\r\n|\r|\n)/g, '<br />');
                }
                return message;
            }
        },
        mounted() {
            this.loadMessages()
        }
    }
</script>

<style scoped>

</style>
