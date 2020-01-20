<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Delete Message</h3>
                </div>
                <div class="card-body">
                    <p>Are you sure you want to delete this message?</p>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="float-right">
                        <input class="btn btn-secondary" v-on:click="cancelDelete" type="submit" value="Cancel" />
                        <input class="btn btn-primary" v-on:click="deleteMessage" type="submit" value="Delete Message"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "message-delete",
        data: function() {
            return {
                message_id:null,
            }
        },
        methods: {
            deleteMessage: function() {
                this.$errors.flush();
                this.submitting = true;
                axios.delete('/api/messages/'+this.message_id,{
                })
                    .then(response => {
                        this.$router.push({ name: 'message-listing' })
                    })
                    .catch(response => {
                        this.submitting = false;
                    })
            },
            cancelDelete: function() {
                this.$router.push({ name: 'message-view', params: { message_id: this.message_id } })
            }
        },
        mounted() {
            this.message_id = this.$route.params.message_id;
        },
    }
</script>

<style scoped>

</style>
