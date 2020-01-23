<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Message</h3>
                </div>
                <div v-if="loading" class="card-body">
                    <vue-loading type="bubbles" color="#d9544e" :size="{ width: '50px', height: '50px' }" />
                </div>
                <div v-if="!loading" class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="type">Message Type</label>
                                <select v-model="type" id="type" class="form-control" v-bind:class="{ 'is-invalid': this.$errors.has('type') }" :disabled="submitting === true || loading === true">
                                    <option disabled value="">Select...</option>
                                    <option value="RADIOCHECK">Radio Check</option>
                                    <option value="ALLSTATIONS">All Stations</option>
                                    <option value="SKYKING">Sky King</option>
                                    <option value="SKYMASTER">Sky Master</option>
                                    <option value="SKYBIRD">Sky Bird</option>
                                    <option value="OTHER">Other</option>
                                    <option value="DISREGARDED">Disregarded</option>
                                    <option value="BACKEND">Backend</option>
                                </select>
                                <error input="type" class="text-danger" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="time">Broadcasted at</label>
                                <input v-model="time" type="datetime-local" id="time" class="form-control" v-bind:class="{ 'is-invalid': this.$errors.has('time') }" :disabled="submitting === true || loading === true">
                                <error input="time" class="text-danger" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="sender">Sender</label>
                                <input v-model="sender" type="text" id="sender" class="form-control" v-bind:class="{ 'is-invalid': this.$errors.has('sender') }" :disabled="submitting === true || loading === true">
                                <error input="sender" class="text-danger" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="receiver">Receiver</label>
                                <input v-model="receiver" type="text" id="receiver" class="form-control" v-bind:class="{ 'is-invalid': this.$errors.has('receiver') }" :disabled="submitting === true || loading === true">
                                <error input="receiver" class="text-danger" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="message">Message</label>
                            <textarea v-model="message" id="message" class="form-control" v-bind:class="{ 'is-invalid': this.$errors.has('message') }" :disabled="submitting === true || loading === true" />
                            <error input="message" class="text-danger" />
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <input class="btn btn-primary float-right" v-on:click="updateMessage" type="submit" value="Update Message"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "message-edit",
        data: function() {
            return {
                loading: true,
                submitting: false,
                message_id:null,
                type: "",
                sender: null,
                receiver: null,
                time: null,
                message:null
            }
        },
        methods: {
            updateMessage: function() {
                this.$errors.flush();
                this.submitting = true;
                axios.put('/api/messages/'+this.message_id,{
                    type: this.type,
                    sender: this.sender,
                    receiver: this.receiver,
                    time: this.time,
                    message: this.message
                })
                    .then(response => {
                        console.log("THEN");
                        this.$router.push({ name: 'message-view', params: { message_id: response.data.data.id } })
                    })
                    .catch(error => {
                        if(error.response.status === 303){
                            this.$router.push({ name: 'message-view', params: { message_id: error.response.data.data.id } })
                        }
                        this.submitting = false;
                    })
            },
            loadMessage: function() {
                axios.get('/api/messages/'+this.message_id)
                    .then(response => {
                        this.type = response.data.data.type;
                        this.sender = response.data.data.sender;
                        this.receiver = response.data.data.receiver;
                        this.time = response.data.data.time.replace(" ","T");
                        this.message = response.data.data.message;
                        this.loading = false;
                    });
            }
        },
        mounted() {
            this.message_id = this.$route.params.message_id;
            this.loadMessage()
        },
    }
</script>

<style scoped>

</style>
