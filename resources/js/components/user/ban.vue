<template>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card" v-if="this.loading">
                <div class="card-body">
                    <vue-loading type="bubbles" color="#d9544e" :size="{ width: '50px', height: '50px' }" />
                </div>
            </div>
            <div v-if="!this.loading">
                <div class="card card-primary card-outline" v-if="this.user.permissions.ban">
                    <div class="card-header">
                        Ban {{this.user.name}}
                    </div>
                    <div class="card-body">
                        <p>About to ban user.... Are you sure?</p>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-danger float-right" v-on:click="banUser">Ban User</button>
                        <router-link tag="button" class="btn btn-default float-right mr-1" :to="{ name: 'user-view', params: { user_id: this.user.id } }">
                            Back
                        </router-link>
                    </div>
                </div>
                <div class="card card-danger card-outline" v-if="!this.user.permissions.ban">
                    <div class="card-header">
                        Error!
                    </div>
                    <div class="card-body">
                        <p>You lack the permissions to ban a user!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "user-ban",
        data: function() {
            return {
                user_id: null,
                loading: true,
                user: null,
            }
        },
        methods: {
            loadUser: function() {
                axios.get('/api/users/'+this.user_id)
                    .then(response => {
                        this.user = response.data.data;
                        this.loading = false;
                    });
            },
            banUser: function() {
                axios.put('/api/users/'+this.user_id,{
                    'banned': true
                })
                    .then(response => {
                        this.$router.push({name: 'user-view', params: { user_id: this.user.id }});
                    });
            }
        },
        mounted() {
            this.user_id = this.$route.params.user_id;
            this.loadUser()
        }
    }
</script>

<style scoped>

</style>