<template>
    <div class="card" v-if="!uploadFinished">
        <div class="card-header">
            Add Recording
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="receiver">Receiver</label>
                        <input v-model="receiver" type="text" id="receiver" class="form-control" v-bind:class="{ 'is-invalid': this.$errors.has('receiver') }" :disabled="submitting === true">
                        <error input="receiver" class="text-danger" />
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="frequency">Frequency</label>
                        <input v-model="frequency" type="text" id="frequency" class="form-control" v-bind:class="{ 'is-invalid': this.$errors.has('frequency') }" :disabled="submitting === true">
                        <error input="frequency" class="text-danger" />
                    </div>
                </div>
                <div class="col-12">
                    <div class="input-group">
                        <div class="form-group">
                            <label for="recording">Recording</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="recording" ref="recording" v-bind:class="{ 'is-invalid': this.$errors.has('recording') }" :disabled="submitting === true">
                                <label class="custom-file-label" for="recording">Choose file</label>
                            </div>
                            <error input="recording" class="text-danger" />
                        </div>
                    </div>
                    <div class="progress progress-xxs" v-if="submitting">
                        <div class="progress-bar progress-bar-danger progress-bar-striped"
                             role="progressbar"
                             v-bind:aria-valuenow="uploadProgress"
                             aria-valuemin="0" aria-valuemax="100"
                             v-bind:style="'width: '+uploadProgress+'%'">
                            <span class="sr-only">{{uploadProgress}}% Complete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <input :disabled="submitting === true" v-on:click="uploadRecording" class="btn btn-primary float-right" type="submit" value="Add Recording">
        </div>
    </div>
</template>

<script>
    export default {
        name: "RecordingAddStub",
        props: ['message_id'],
        data: function() {
            return {
                uploadProgress: 0,
                uploadFinished: false,
                submitting: false,
                receiver: null,
                frequency: null,
                upload: {
                    uuid: null,
                    key: null,
                    bucket: null,
                    name: null,
                    content_type: null,
                }
            }
        },
        methods: {
            uploadRecording: function()
            {
                this.submitting = true;
                if(this.upload.uuid === null){
                    Vapor.store(this.$refs.recording.files[0], {
                        progress: progress => {
                            this.uploadProgress = Math.round(progress * 100);
                        }
                    }).then(response => {
                        this.upload.uuid = response.uuid;
                        this.upload.key = response.key;
                        this.upload.bucket = response.bucket;
                        this.upload.name = this.$refs.recording.files[0].name;
                        this.upload.content_type = this.$refs.recording.files[0].type;
                        this.submitRecording();
                    }).catch( response => {
                        this.submitting = false;
                        console.log(response);
                    });
                }else{
                    this.submitRecording();
                }
            },
            submitRecording: function() {
                axios.post('/api/recordings', {
                    uuid: this.upload.uuid,
                    key: this.upload.key,
                    bucket: this.upload.bucket,
                    name: this.upload.name,
                    content_type: this.upload.content_type,
                    receiver: this.receiver,
                    frequency: this.frequency,
                    message_id: this.message_id
                })
                    .then(response => {
                        this.uploadFinished = true;
                    })
                    .catch(response => {
                        console.log(response);
                        this.submitting = false;
                    })
            }
        }
    }
</script>

<style scoped>

</style>
