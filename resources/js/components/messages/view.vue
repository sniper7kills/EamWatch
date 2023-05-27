<template>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-8">
            <div class="card" v-if="this.loading">
                <div class="card-body">
                    <vue-loading type="bubbles" color="#d9544e" :size="{ width: '50px', height: '50px' }" />
                </div>
            </div>
            <div class="card" v-if="!this.loading">
                <div class="card-header">
                    <h3 class="card-title">Message {{this.message.id}}</h3>
                    <div class="card-tools">
                        <router-link tag="a" v-if="message.permissions.update" :to="{ name: 'message-edit', params: { message_id: message.id } }">
                            <i class="fa fa-edit" />
                        </router-link>
                        <router-link tag="a" v-if="message.permissions.delete" :to="{ name: 'message-delete', params: { message_id: message.id } }">
                            <i class="fa fa-trash" />
                        </router-link>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Broadcast Time</td>
                                <td>{{this.message.time}}</td>
                            </tr>
                            <tr>
                                <td>Message Type</td>
                                <td>{{this.message.type}}</td>
                            </tr>
                            <tr>
                                <td>Sender</td>
                                <td>{{this.message.sender}}</td>
                            </tr>
                            <tr>
                                <td>Receiver</td>
                                <td>{{this.message.receiver}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-number text-center text-muted mb-0">
                                        <pre style="overflow-x: auto; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word;" v-html="formatMessage(message.message, message.type, message.repeats)"></pre>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer clearfix" >
                    <div class="text-sm float-right">
                        <b>Submitted By:</b>
                        <router-link v-if="this.message.user.type === 'user'" tag="a" :to="{ name: 'user-view', params: { user_id: this.message.user.id } }">
                            {{this.message.user.name}}
                        </router-link>
                        <router-link v-if="this.message.user.type === 'guest'" tag="a" :to="{ name: 'guest-view', params: { guest_id: this.message.user.id } }">
                            {{this.message.user.name}}
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Message Recordings
                        </div>
                        <div class="card-body">
                            <vue-loading v-if="this.loading" type="bubbles" color="#d9544e" :size="{ width: '50px', height: '50px' }" />
                            <div v-if="!this.loading">
                                <recording-list-stub  :recordings="message.recordings" />
                            </div>
                        </div>
                        <div class="card-footer clearfix">

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Automated Recordings Within 4 Minutes
                        </div>
                        <div class="card-body">
                            <vue-loading v-if="this.loading" type="bubbles" color="#d9544e" :size="{ width: '50px', height: '50px' }" />
                            <div v-if="!this.loading">
                                <recording-list-stub  :recordings="message.automated_recordings" />
                            </div>
                        </div>
                        <div class="card-footer clearfix">

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <recording-add-stub v-if="!this.loading" v-bind:message_id="message.id" />
                </div>
            </div>

        </div>
        <div class="col-12 col-md-12 col-lg-12">
            <div v-if="this.loading" class="card">
                <div class="card-header">
                    <p class="card-title">Comments</p>
                </div>
                <div class="card-body">
                    <vue-loading type="bubbles" color="#d9544e" :size="{ width: '50px', height: '50px' }" />
                </div>
            </div>
            <comment-listing v-if="!this.loading" v-bind:message_id="message.id" />
        </div>
    </div>
</template>

<script>
    export default {
        name: "message-view",
        data: function() {
            return {
                message_id: null,
                loading: true,
                message: null,
            }
        },
        methods: {
            loadMessage: function() {
                axios.get('/api/messages/'+this.message_id)
                    .then(response => {
                        this.message = response.data.data;
                        this.loading = false;
                    });
            },
            formatMessage: function(message, type, repeats) {
                if(type === "ALLSTATIONS") {
                    var messageLength = message.length;
                    var chunks = message.match(/.{1,30}/g);
                    var formatted =  chunks.join('\r\n');
                    var returnContent = formatted;
                    if(messageLength !== 30){
                        returnContent = "["+messageLength+" CHAR]<br />"+returnContent;
                    }
                    if(repeats > 0){
                        returnContent = "["+ repeats +" REPEATS]<br />"+returnContent;
                    }
                    return returnContent;
                }
                return message;
            }
        },
        mounted() {
            this.message_id = this.$route.params.message_id;
            this.loadMessage()
        }
    }
</script>

<style scoped>

</style>
