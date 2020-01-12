<template>
    <form v-if="!this.submitted" class="form-horizontal">
        <div class="input-group input-group-sm mb-0">
            <textarea :disabled="submitting === true" v-model="message" class="form-control form-control-sm" placeholder="New Comment" />
            <div class="input-group-append">
                <button :disabled="submitting === true" v-on:click="submitComment" type="submit" class="btn btn-primary">Add Comment</button>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        name: "comment-add",
        props: ['message_id','recording_id'],
        data: function() {
            return {
                submitted: false,
                submitting: false,
                message: null,
            }
        },
        methods: {
            submitComment: function() {
                this.submitting = true;
                axios.post('/api/comments', {
                    message: this.message,
                    message_id: this.message_id,
                    recording_id: this.recording_id,
                })
                    .then(response => {
                        this.submitting = false;
                        this.submitted = true;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
