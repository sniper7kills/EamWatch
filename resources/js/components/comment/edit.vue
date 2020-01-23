<template>
    <div class="card">
        <div class="card-header">
            Edit Comment
        </div>
        <div class="card-body">
            <textarea :disabled="submitting === true || loading === true" v-model="message" class="form-control form-control-sm" placeholder="New Comment" />
        </div>
        <div class="card-footer">
            <button :disabled="submitting === true || loading === true" v-on:click="updateComment" type="submit" class="btn btn-primary float-right">Edit Comment</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "comment-add",
        data: function() {
            return {
                comment_id: null,
                message_id: null,
                loading: true,
                submitting: false,
                message: null,
            }
        },
        methods: {
            updateComment: function() {
                this.submitting = true;
                axios.put('/api/comments/'+this.comment_id, {
                    message: this.message,
                })
                    .then(response => {
                        this.$router.push({ name: 'message-view', params: { message_id: this.message_id } })
                    });
            },
            loadComment: function() {
                axios.get('/api/comments/'+this.comment_id)
                    .then(response => {
                        this.message = response.data.data.comment;
                        this.loading = false;
                    });
            }
        },
        mounted() {
            this.message_id = this.$route.params.message_id;
            this.comment_id = this.$route.params.comment_id;
            this.loadComment()
        },
    }
</script>

<style scoped>

</style>
