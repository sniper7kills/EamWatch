<template>
    <div class="card">
        <div class="card-header">
            Comments
        </div>
        <div class="card-body">
            <comment-view-stub v-for="comment in comments" v-bind:key="comment.id" v-bind:comment="comment" />
        </div>
        <div class="card-footer clearfix">
            <comment-add-stub v-bind:message_id="message_id" />
        </div>
    </div>
</template>

<script>
    import CommentViewStub from './stub/view';
    import CommentAddStub from './stub/add';
    export default {
        name: "CommentListing",
        props: ['comments', 'message_id', 'recording_id'],
        components: {
            CommentViewStub,
            CommentAddStub
        }
    }
</script>

<style scoped>

</style>
