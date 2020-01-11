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
                    Message {{this.message.id}}
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
                                        <pre>{{this.message.message}}</pre>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer clearfix" >
                    <div class="text-sm float-right">
                        <b>Submitted By:</b> {{this.message.user.name}}
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
                    <recording-add-stub v-if="!this.loading" v-bind:message_id="message.id" />
                </div>
            </div>

        </div>
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    Message Comments
                </div>
                <div class="card-body">
                    <vue-loading v-if="this.loading" type="bubbles" color="#d9544e" :size="{ width: '50px', height: '50px' }" />
                    <div v-if="!this.loading">
                        <div class="post clearfix">
                            <div class="user-block">
                                <!--<img class="img-circle img-bordered-sm" src="https://adminlte.io/themes/v3/dist/img/user4-128x128.jpg" alt="User Image">-->
                                <span class="username">
                                    <a href="#">Sarah Ross</a>
                                </span>
                                <span class="description">2020-01-09 06:47:14</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                Lorem ipsum represents a long-held tradition for designers,
                                typographers and the like. Some people hate it and argue for
                                its demise, but others ignore the hate as they create awesome
                                tools to help create filler text for everyone from bacon lovers
                                to Charlie Sheen fans.
                            </p>

                            <!--<form class="form-horizontal">
                                <div class="input-group input-group-sm mb-0">
                                    <textarea class="form-control form-control-sm" placeholder="Response"></textarea>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-danger">Reply</button>
                                    </div>
                                </div>
                            </form>-->
                        </div>
                    </div>
                </div>
                <div class="card-footer clearfix" v-if="!this.loading">
                    <form class="form-horizontal">
                        <div class="input-group input-group-sm mb-0">
                            <textarea class="form-control form-control-sm" placeholder="New Comment" />
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-danger">Add Comment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import VuePlyr from 'vue-plyr';
    import RecordingListStub from '../recording/stub/list';
    import RecordingAddStub from '../recording/stub/add';
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
            }
        },
        mounted() {
            this.message_id = this.$route.params.message_id;
            this.loadMessage()
        },
        components: {
            VuePlyr,
            RecordingListStub,
            RecordingAddStub
        }
    }
</script>

<style scoped>

</style>
