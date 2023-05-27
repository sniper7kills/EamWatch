<template>
    <div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card" v-if="this.loading">
                    <div class="card-body">
                        <vue-loading type="bubbles" color="#d9544e" :size="{ width: '50px', height: '50px' }" />
                    </div>
                </div>
                <div class="card" v-if="!this.loading">
                    <div class="card-header">
                        Recording {{this.recording.id}}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Frequency</td>
                                            <td>{{this.recording.frequency}}</td>
                                        </tr>
                                        <tr>
                                            <td>Receiver</td>
                                            <td>{{this.recording.receiver}}</td>
                                        </tr>
                                        <tr v-if="this.recording.message != null && this.recording.message.length !== 0">
                                            <td>Message</td>
                                            <td>
                                                <router-link tag="a" :to="{ name: 'message-view', params: { message_id: this.recording.message.id } }">
                                                    {{this.recording.message.id}}
                                                </router-link>
                                            </td>
                                        </tr>
                                        <tr v-if="this.recording.message == null">
                                            AUTOMATED RECORDING
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 col-md-6">
                                <vue-plyr>
                                    <audio>
                                        <source v-bind:src="this.recording.link" type="audio/mp3"/>
                                    </audio>
                                </vue-plyr>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-sm float-right">
                            <b>Submitted By:</b>
                            <router-link v-if="this.recording.user.type === 'user'" tag="a" :to="{ name: 'user-view', params: { user_id: this.recording.user.id } }">
                                {{this.recording.user.name}}
                            </router-link>
                            <router-link v-if="this.recording.user.type === 'guest'" tag="a" :to="{ name: 'guest-view', params: { guest_id: this.recording.user.id } }">
                                {{this.recording.user.name}}
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12">
                <div v-if="this.loading" class="card">
                    <div class="card-header">
                        Comments
                    </div>
                    <div class="card-body">
                        <vue-loading type="bubbles" color="#d9544e" :size="{ width: '50px', height: '50px' }" />
                    </div>
                </div>
                <comment-listing v-if="!this.loading" v-bind:recording_id="recording_id.id" v-bind:comments="this.recording.comments" />
            </div>
        </div>
    </div>
</template>

<script>
    import VuePlyr from 'vue-plyr';
    export default {
        name: "recording-view",
        data: function() {
            return {
                recording_id: null,
                loading: true,
                recording: null
            }
        },
        methods: {
            loadRecording: function() {
                axios.get('/api/recordings/'+this.recording_id)
                    .then(response => {
                        this.recording = response.data.data;
                        this.loading = false;
                    });
            }
        },
        mounted() {
            this.recording_id = this.$route.params.recording_id;
            this.loadRecording();
        },
        components: {
            VuePlyr
        }
    }
</script>

<style scoped>

</style>
