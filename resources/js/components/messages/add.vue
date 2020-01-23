<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Message</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="type">Message Type</label>
                                <select v-model="type" id="type" class="form-control" v-bind:class="{ 'is-invalid': this.$errors.has('type') }" :disabled="submitting === true">
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
                                <input v-model="time" type="datetime-local" id="time" class="form-control" v-bind:class="{ 'is-invalid': this.$errors.has('time') }" :disabled="submitting === true">
                                <error input="time" class="text-danger" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="sender">Sender</label>
                                <input v-model="sender" type="text" id="sender" class="form-control" v-bind:class="{ 'is-invalid': this.$errors.has('sender') }" :disabled="submitting === true">
                                <error input="sender" class="text-danger" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="receiver">Receiver</label>
                                <input v-model="receiver" type="text" id="receiver" class="form-control" v-bind:class="{ 'is-invalid': this.$errors.has('receiver') }" :disabled="submitting === true">
                                <error input="receiver" class="text-danger" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="message">Message</label>
                            <textarea v-model="message" id="message" class="form-control" v-bind:class="{ 'is-invalid': this.$errors.has('message') }" :disabled="submitting === true" />
                            <error input="message" class="text-danger" />
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <input class="btn btn-primary float-right" v-on:click="submitMessage" type="submit" value="Add Message"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "message-add",
        data: function() {
            return {
                submitting: false,
                type: "",
                sender: null,
                receiver: null,
                time: null,
                message:null
            }
        },
        methods: {
            submitMessage: function() {
                this.$errors.flush();
                this.submitting = true;
                axios.post('/api/messages',{
                    type: this.type,
                    sender: this.sender,
                    receiver: this.receiver,
                    time: this.time,
                    message: this.message
                })
                    .then(response => {
                        this.$router.push({ name: 'message-view', params: { message_id: response.data.data.id } })
                    })
                    .catch(error => {
                        if(error.response.status === 303){
                            this.$router.push({ name: 'message-view', params: { message_id: error.response.data.data.id } })
                        }
                        this.submitting = false;
                    })
            }
        }
    }
</script>

<style scoped>

</style>
