<template>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card" v-if="this.loading">
                <div class="card-body">
                    <vue-loading type="bubbles" color="#d9544e" :size="{ width: '50px', height: '50px' }" />
                </div>
            </div>
            <div v-if="!this.loading">
                <div class="card" v-if="this.permissions.edit || this.permissions.self">
                    <div class="card-header">
                        Edit {{this.form.name}}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        Profile Image
                                    </div>
                                    <div class="card-body">
                                        <img class="img-fluid img-circle" src="data:image/svg+xml;base64,PHN2ZyBpZD0iNDU3YmYyNzMtMjRhMy00ZmQ4LWE4NTctZTliOTE4MjY3ZDZhIiBkYXRhLW5hbWU9IkxheWVyIDEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHdpZHRoPSI2OTgiIGhlaWdodD0iNjk4IiB2aWV3Qm94PSIwIDAgNjk4IDY5OCI+PGRlZnM+PGxpbmVhckdyYWRpZW50IGlkPSJiMjQ3OTQ2Yy1jNjJmLTRkMDgtOTk0YS00YzNkNjRlMWU5OGYiIHgxPSIzNDkiIHkxPSI2OTgiIHgyPSIzNDkiIGdyYWRpZW50VW5pdHM9InVzZXJTcGFjZU9uVXNlIj48c3RvcCBvZmZzZXQ9IjAiIHN0b3AtY29sb3I9ImdyYXkiIHN0b3Atb3BhY2l0eT0iMC4yNSIvPjxzdG9wIG9mZnNldD0iMC41NCIgc3RvcC1jb2xvcj0iZ3JheSIgc3RvcC1vcGFjaXR5PSIwLjEyIi8+PHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSJncmF5IiBzdG9wLW9wYWNpdHk9IjAuMSIvPjwvbGluZWFyR3JhZGllbnQ+PC9kZWZzPjx0aXRsZT5wcm9maWxlIHBpYzwvdGl0bGU+PGcgb3BhY2l0eT0iMC41Ij48Y2lyY2xlIGN4PSIzNDkiIGN5PSIzNDkiIHI9IjM0OSIgZmlsbD0idXJsKCNiMjQ3OTQ2Yy1jNjJmLTRkMDgtOTk0YS00YzNkNjRlMWU5OGYpIi8+PC9nPjxjaXJjbGUgY3g9IjM0OS42OCIgY3k9IjM0Ni43NyIgcj0iMzQxLjY0IiBmaWxsPSIjZjVmNWY1Ii8+PHBhdGggZD0iTTYwMSw3OTAuNzZhMzQwLDM0MCwwLDAsMCwxODcuNzktNTYuMmMtMTIuNTktNjguOC02MC41LTcyLjcyLTYwLjUtNzIuNzJINDY0LjA5cy00NS4yMSwzLjcxLTU5LjMzLDY3QTM0MC4wNywzNDAuMDcsMCwwLDAsNjAxLDc5MC43NloiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0yNTEgLTEwMSkiIGZpbGw9IiM2YzYzZmYiLz48Y2lyY2xlIGN4PSIzNDYuMzciIGN5PSIzMzkuNTciIHI9IjE2NC45IiBmaWxsPSIjMzMzIi8+PHBhdGggZD0iTTI5My4xNSw0NzYuOTJIMzk4LjgxYTAsMCwwLDAsMSwwLDB2ODQuNTNBNTIuODMsNTIuODMsMCwwLDEsMzQ2LDYxNC4yOGgwYTUyLjgzLDUyLjgzLDAsMCwxLTUyLjgzLTUyLjgzVjQ3Ni45MmEwLDAsMCwwLDEsMCwwWiIgb3BhY2l0eT0iMC4xIi8+PHBhdGggZD0iTTI5Ni41LDQ3M2g5OWEzLjM1LDMuMzUsMCwwLDEsMy4zNSwzLjM1djgxLjE4QTUyLjgzLDUyLjgzLDAsMCwxLDM0Niw2MTAuMzdoMGE1Mi44Myw1Mi44MywwLDAsMS01Mi44My01Mi44M1Y0NzYuMzVBMy4zNSwzLjM1LDAsMCwxLDI5Ni41LDQ3M1oiIGZpbGw9IiNmZGI3OTciLz48cGF0aCBkPSJNNTQ0LjM0LDYxNy44MmExNTIuMDcsMTUyLjA3LDAsMCwwLDEwNS42Ni4yOXYtMTNINTQ0LjM0WiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTI1MSAtMTAxKSIgb3BhY2l0eT0iMC4xIi8+PGNpcmNsZSBjeD0iMzQ2LjM3IiBjeT0iMzcyLjQ0IiByPSIxNTEuNDUiIGZpbGw9IiNmZGI3OTciLz48cGF0aCBkPSJNNDg5LjQ5LDMzNS42OFM1NTMuMzIsNDY1LjI0LDczMy4zNywzOTBsLTQxLjkyLTY1LjczLTc0LjMxLTI2LjY3WiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTI1MSAtMTAxKSIgb3BhY2l0eT0iMC4xIi8+PHBhdGggZD0iTTQ4OS40OSwzMzMuNzhzNjMuODMsMTI5LjU2LDI0My44OCw1NC4zbC00MS45Mi02NS43My03NC4zMS0yNi42N1oiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0yNTEgLTEwMSkiIGZpbGw9IiMzMzMiLz48cGF0aCBkPSJNNDg4LjkzLDMyNWE4Ny40OSw4Ny40OSwwLDAsMSwyMS42OS0zNS4yN2MyOS43OS0yOS40NSw3OC42My0zNS42NiwxMDMuNjgtNjkuMjQsNiw5LjMyLDEuMzYsMjMuNjUtOSwyNy42NSwyNC0uMTYsNTEuODEtMi4yNiw2NS4zOC0yMmE0NC44OSw0NC44OSwwLDAsMS03LjU3LDQ3LjRjMjEuMjcsMSw0NCwxNS40LDQ1LjM0LDM2LjY1LjkyLDE0LjE2LTgsMjcuNTYtMTkuNTksMzUuNjhzLTI1LjcxLDExLjg1LTM5LjU2LDE0LjlDNjA4Ljg2LDM2OS43LDQ2Mi41NCw0MDcuMDcsNDg4LjkzLDMyNVoiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0yNTEgLTEwMSkiIGZpbGw9IiMzMzMiLz48ZWxsaXBzZSBjeD0iMTk0Ljg2IiBjeT0iMzcyLjMiIHJ4PSIxNC4wOSIgcnk9IjI2LjQyIiBmaWxsPSIjZmRiNzk3Ii8+PGVsbGlwc2UgY3g9IjQ5Ny44IiBjeT0iMzcyLjMiIHJ4PSIxNC4wOSIgcnk9IjI2LjQyIiBmaWxsPSIjZmRiNzk3Ii8+PC9zdmc+"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        Information
                                    </div>
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Key</th>
                                                <th>Value</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Name</td>
                                                <td>
                                                    <input v-model="form.name" type="text" :disabled="submitting === true" class="form-control" />
                                                    <error input="name" class="text-danger" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>
                                                    <input v-model="form.email" type="text" :disabled="submitting === true" class="form-control" />
                                                    <error input="email" class="text-danger" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Password Change</td>
                                                <td>
                                                    <input v-model="form.password" type="password" :disabled="submitting === true" class="form-control" />
                                                    <error input="password" class="text-danger" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Password Change Confirm</td>
                                                <td>
                                                    <input v-model="form.password_confirm" type="password" :disabled="submitting === true" class="form-control" />
                                                    <error input="password_confirm" class="text-danger" />
                                                </td>
                                            </tr>
                                            <tr v-if="this.permissions.edit">
                                                <td>Role</td>

                                                <td>
                                                    <select v-model="form.role" :disabled="submitting === true">
                                                        <option disabled value="">Please select one</option>
                                                        <option>Member</option>
                                                        <option>Moderator</option>
                                                        <option>Admin</option>
                                                    </select>
                                                    <error input="role" class="text-danger" />
                                                </td>
                                            </tr>
                                            <tr v-if="this.permissions.ban || this.permissions.unban">
                                                <td>Status</td>
                                                <td>
                                                    <select v-model="form.banned" :disabled="submitting === true">
                                                        <option disabled value="">Please select one</option>
                                                        <option v-if="this.permissions.ban" value="1">Banned</option>
                                                        <option v-if="this.permissions.unban" value="0">Active</option>
                                                    </select>
                                                    <error input="banned" class="text-danger" />
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary float-right" v-on:click="editUser">Save</button>
                                        <router-link tag="button" class="btn btn-default float-right mr-1" :to="{ name: 'user-view', params: { user_id: this.user_id } }">
                                            Back
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-danger card-outline" v-if="!this.permissions.edit && !this.permissions.self">
                    <div class="card-header">
                        Error!
                    </div>
                    <div class="card-body">
                        <p>You lack the permissions to edit this user!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "user-edit",
        data: function() {
            return {
                submitting: false,
                user_id: null,
                loading: true,
                permissions: {},
                form: {
                    'name': null,
                    'email': null,
                    'password': null,
                    'password_confirm': null,
                    'role': null,
                    'banned': null
                }
            }
        },
        methods: {
            loadUser: function() {
                axios.get('/api/users/'+this.user_id)
                    .then(response => {
                        this.form.name = response.data.data.name;
                        this.form.email = response.data.data.email;
                        this.form.role = response.data.data.role;
                        if(response.data.data.banned)
                            this.form.banned = "1";
                        else
                            this.form.banned = "0";
                        this.permissions = response.data.data.permissions;
                        this.loading = false;
                    });
            },
            editUser: function() {
                this.$errors.flush();
                this.submitting = true;
                axios.put('/api/users/'+this.user_id, this.form)
                    .then(response => {
                        this.$router.push({name: 'user-view', params: { user_id: this.user_id }});
                    })
                    .catch(error => {
                        this.submitting = false;
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
