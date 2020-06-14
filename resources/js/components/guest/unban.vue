<template>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card" v-if="this.loading">
                <div class="card-body">
                    <vue-loading type="bubbles" color="#d9544e" :size="{ width: '50px', height: '50px' }" />
                </div>
            </div>
            <div v-if="!this.loading">
                <div class="card card-primary card-outline" v-if="this.guest.permissions.unban">
                    <div class="card-header">
                        Unban {{this.guest.name}}
                    </div>
                    <div class="card-body">
                        <p>About to unban guest.... Are you sure?</p>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-danger float-right" v-on:click="unbanGuest">Unban Guest</button>
                        <router-link tag="button" class="btn btn-default float-right mr-1" :to="{ name: 'guest-view', params: { guest_id: this.guest.id } }">
                            Back
                        </router-link>
                    </div>
                </div>
                <div class="card card-danger card-outline" v-if="!this.guest.permissions.unban">
                    <div class="card-header">
                        Error!
                    </div>
                    <div class="card-body">
                        <p>You lack the permissions to unban a guest!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "guest-unban",
        data: function() {
            return {
                guest_id: null,
                loading: true,
                guest: null,
            }
        },
        methods: {
            loadGuest: function() {
                axios.get('/api/guests/'+this.guest_id)
                    .then(response => {
                        this.guest = response.data.data;
                        this.loading = false;
                    });
            },
            unbanGuest: function() {
                axios.put('/api/guests/'+this.guest_id,{
                    'banned': false
                })
                    .then(response => {
                        this.$router.push({name: 'guest-view', params: { guest_id: this.guest.id }});
                    });
            }
        },
        mounted() {
            this.guest_id = this.$route.params.guest_id;
            this.loadGuest()
        }
    }
</script>

<style scoped>

</style>